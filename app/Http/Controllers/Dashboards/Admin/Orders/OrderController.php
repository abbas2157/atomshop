<?php

namespace App\Http\Controllers\Dashboards\Admin\Orders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InstallmentCalculator;
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use App\Models\{User, Customer, Cart, Order, City, Area, Product};

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::select('id','uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at');
        if(request()->has('status') && !empty(request()->status)) {
            $orders->where('status', request()->status);
        }
        if(request()->has('portal') && !empty(request()->portal)) {
            $orders->where('portal', request()->portal);
        }
        $orders = $orders->paginate(10);
        return view('dashboards.admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
            $customers = User::orderBy('id', 'desc')->where('role', 'customer')->get();
            $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();

            return view('dashboards.admin.orders.create', compact('customers','calculator','categories'));
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

            return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
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
        return view('dashboards.admin.orders.show', compact('order', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
