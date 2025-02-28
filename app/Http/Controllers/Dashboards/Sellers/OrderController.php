<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\{InstallmentCalculator};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use App\Models\{User, Customer, Cart, Order, OrderChangeHsitory, OrderInstalment};

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $customers = Customer::where('area_id', $area_id)->pluck('user_id');
        $customer_ids = [];
        if ($customers->isNotEmpty()) {
            $customer_ids =  $customers->toArray();
        }
        $orders = Order::whereIn('user_id', $customer_ids)->select('id','uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at');
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
        $user = User::with('customer')->where('id', $order->user_id)->first();
        $order_change_status = OrderChangeHsitory::where('order_id', $order->id)->get();
        return view('dashboards.sellers.orders.show', compact('order', 'order_change_status', 'user'));
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
            }
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

            $order->total_deal_price = $total_amount_with_percentage;
            $order->advance_price = $advance;
            $order->installment_tenure = $request->installment_tenure;
        }
        $order->status = $status;
        $order->save();

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
        $response = ['success' => false, 'message' => "Code not completed"];
        return response()->json($response);
    }

    public function create()
    {
        try {
            $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
            $area_id = Auth::user()->seller->area_id;
            $customers = Customer::where('area_id', $area_id)->where('verified', '1')->select('id','user_id')->get();
            $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();

            return view('dashboards.sellers.orders.create', compact('customers','calculator','categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
            $order->cart_id = $cart->id;
            $order->save();

            return redirect()->route('seller.orders.index')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

}
