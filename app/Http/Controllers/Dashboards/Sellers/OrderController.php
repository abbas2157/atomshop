<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InstallmentCalculator;
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use App\Models\{User, Customer, Cart, Order, OrderChangeHsitory, City, Area};

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
        $order = Order::where('uuid', $id)->select('id','uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at')->first();
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
        if(in_array($status, ['Pending', 'Varification', 'Processing'])) {
            $order->status = $status;
            $order->save();

            $change_order = new OrderChangeHsitory;
            $change_order->order_id = $order->id;
            $change_order->user_id = $order->user_id;
            $change_order->role = 'seller';
            $change_order->status = $status;
            $change_order->changed_by = Auth::user()->id;
            $change_order->save();

            $response = ['success' => true, 'message' => "Order status changed to ".$status];
            return response()->json($response);
        }
        $response = ['success' => false, 'message' => "Code not completed"];
        return response()->json($response);
    }

    public function create()
    {
        try {
            $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
            $area_id = Auth::user()->seller->area_id;
            $customers = Customer::where('area_id', $area_id)->join('users', 'customers.user_id', '=', 'users.id')->where('users.joined_through', 'Seller')
            ->where('customers.verified', '1')->select('customers.id','customers.user_id')->get();
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
