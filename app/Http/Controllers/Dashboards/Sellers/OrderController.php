<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\{InstallmentCalculator, ActiveSeller};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use App\Models\{User, Customer, Cart, Order, OrderChangeHsitory, OrderInstalment, SellerOrder,Area,City};

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active_areas_ids = [];
        $active_areas = ActiveSeller::where('user_id', Auth::user()->id)->pluck('area_id');
        if($active_areas->isNotEmpty()) {
            $active_areas_ids = $active_areas->toArray();
        }
        $orders = Order::whereIn('area_id', $active_areas_ids)->select('id', 'uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at');
        if(request()->has('status') && !empty(request()->status)) {
            $orders->where('status', request()->status);
        }
        if(request()->has('portal') && !empty(request()->portal)) {
            $orders->where('portal', request()->portal);
        }
        $orders = $orders->orderBy('id','desc')->paginate(10);
        return view('dashboards.sellers.orders.index',compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::where('uuid', $id)->select('id','uuid', 'cart_id', 'total_deal_price', 'advance_price', 'instalment_tenure', 'user_id', 'portal', 'status', 'created_at')->first();
        if(is_null($order)) {
            return abort(404);
        }
        $order_instalments = OrderInstalment::where('order_id',$order->id)->get();
        $user = User::with('customer')->where('id', $order->user_id)->first();
        $order_change_status = OrderChangeHsitory::where('order_id', $order->id)->get();
        return view('dashboards.sellers.orders.show', compact('order', 'order_change_status', 'order_instalments', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function status(Request $request, string $id)
    {
        $order = Order::where('uuid', $id)->first();
        if(is_null($order)) {
            $response = ['success' => false, 'message' => "Order Not Found"];
            return response()->json($response);
        }
        $status = $request->status;
        $payload = [];
        if($status == 'Delivered') {
            $payload['recieved_by'] = $request->recieved_by;
            if($request->hasFile('delivered_pictrue')) {
                $file = $request->file('delivered_pictrue');
                $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = rand(1000,9000) .'.'.$extension;
                $picture_path = public_path('images/orders/delivered/' . $filename);
                if (File::exists($picture_path)) {
                    $filename = rand(1000,9000).'.'.$extension;
                }
                $file->move(public_path('images/orders/delivered'),$filename);
                $payload['img'] = 'images/orders/delivered/'.$filename;
            }
        }
        if($status == 'Instalments') {
            $payload['advance_price'] = $request->advance_price;
            $payload['installment_tenure'] = $request->installment_tenure;
            $payload['payment_method'] = $request->payment_method;

            $calculator = InstallmentCalculator::first();

            $total = (int) $order->cart->product_price;
            $advance = (int) $request->advance_price;
            $remaining_amount = $total - $advance;
            if(is_null($calculator)) {
                $total_tenure_percentage = 4 * ((int) $request->installment_tenure);
            }
            else {
                $total_tenure_percentage = ((int) $calculator->per_month_percentage) * ((int) $request->installment_tenure);
            }
            $total_percentage_amount = round(($total_tenure_percentage / 100) * $remaining_amount);
            $total_amount_with_percentage = $total_percentage_amount + $remaining_amount;
            $per_installment_price   =  round($total_amount_with_percentage / (int) $request->installment_tenure);

            $order->total_deal_price = $total_amount_with_percentage;
            $order->advance_price = $advance;
            $order->instalment_tenure = $request->installment_tenure;

            // First Isert Advance as installment
            $order_instalment = new OrderInstalment;
            $order_instalment->user_id = $order->user_id;
            $order_instalment->order_id = $order->id;
            $order_instalment->installment_price = $advance;
            if($request->hasFile('instalment_pictrue')) {
                $file = $request->file('instalment_pictrue');
                $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = rand(1000,9000) .'.'.$extension;
                $picture_path = public_path('images/orders/instalments/' . $filename);
                if (File::exists($picture_path)) {
                    $filename = rand(1000,9000).'.'.$extension;
                }
                $file->move(public_path('images/orders/instalments'),$filename);
                $payload['img'] = 'images/orders/instalments/'.$filename;
                $order_instalment->receipet = $payload['img'];
            }
            $order_instalment->payment_method = $request->payment_method;
            $order_instalment->month = 'Advance';
            $order_instalment->type = 'Advance';
            $order_instalment->status = 'Paid';
            $order_instalment->save();

            $installment_tenure = ((int) $request->installment_tenure);
            $months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];

            for($i=0; $i < $installment_tenure; $i++) {
                $order_instalment = new OrderInstalment;
                $order_instalment->user_id = $order->user_id;
                $order_instalment->order_id = $order->id;
                $order_instalment->month = $months[$i] . ' Month';
                $order_instalment->installment_price = $per_installment_price;
                $order_instalment->type = 'Instalment';
                $order_instalment->save();
            }
        }

        $order->status = $status;
        $order->save();

        $sellerOrder = SellerOrder::where('order_id', $order->id)->where('seller_id', Auth::user()->seller->id)->first();

        if (is_null($sellerOrder)) {
            $sellerOrder = new SellerOrder();
        }
        $sellerOrder->order_id = $order->id;
        $sellerOrder->user_id = $order->user_id;
        $sellerOrder->seller_id = Auth::user()->seller->id;
        $sellerOrder->status = $request->status;
        $sellerOrder->save();

        $change_order = new OrderChangeHsitory;
        $change_order->order_id = $order->id;
        $change_order->user_id = $order->user_id;
        $change_order->role = 'seller';
        $change_order->status = $status;
        $change_order->payload = json_encode($payload);
        $change_order->changed_by = Auth::user()->id;
        $change_order->save();

        $response = ['success' => true, 'message' => "Order status changed to ".$status];
        return response()->json($response);
    }

    public function create()
    {
        try {
            $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
            $area_id = Auth::user()->seller->area_id;
            $customers = Customer::where('area_id', $area_id)->where('verified', '1')->select('id','user_id')->get();
            $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
            $areas = Area::orderBy('id', 'desc')->get();
            $cities = City::orderBy('id', 'desc')->get();
            return view('dashboards.sellers.orders.create', compact('customers','calculator','categories','areas','cities'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $product = Product::find($request->product_id);
            $price = $product->price;
            $cart = new Cart;
            $cart->user_id = $request->customer_id;
            $cart->product_id = $request->product_id;
            $cart->product_price = $price;
            $cart->product_advance_price =$request->min_advance_price;
            $cart->color_id = $request->color_id;
            if (isset($request->memory_id)) {
                $cart->memory_id = $request->memory_id;
            }
            if (isset($request->size_id)) {
                $cart->size_id = $request->size_id;
            }
            if (isset($request->tenure_months)) {
                $cart->tenure = $request->tenure_months;
            }
            $cart->status = 'Purchased';
            $cart->save();

            $order = new Order;
            $order->uuid = Str::uuid();
            $order->user_id = $request->customer_id;
            $order->area_id = $request->area_id;
            $order->city_id = $request->city_id;
            $order->cart_id = $cart->id;
            $order->save();

            return redirect()->route('seller.orders.index')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
    /**
     * Pay Instalment
     */
    public function pay_instalment(Request $request)
    {
        $id = request()->order_id;
        $order_instalment = OrderInstalment::where('order_id',$id)->where('type','Instalment')->where('status','Unpaid')->first();
        if(is_null( $order_instalment)) {
            $response = ['success' => false, 'message' => "Instalment Not Found"];
            return response()->json($response);
        }

        if($request->hasFile('instalment_pictrue')) {
            $file = $request->file('instalment_pictrue');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = rand(1000,9000) .'.'.$extension;
            $picture_path = public_path('images/orders/instalments/' . $filename);
            if (File::exists($picture_path)) {
                $filename = rand(1000,9000).'.'.$extension;
            }
            $file->move(public_path('images/orders/instalments'),$filename);
            $order_instalment->receipet = 'images/orders/instalments/'.$filename;
        }
        $order_instalment->payment_method = request()->payment_method;
        $order_instalment->status = 'Paid';
        $order_instalment->save();

        $response = ['success' => true, 'message' => "Instalment Paid Successfully."];
        return response()->json($response);
    }

}
