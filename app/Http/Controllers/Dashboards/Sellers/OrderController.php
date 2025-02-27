<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Cart, Order, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use Illuminate\Support\Str;

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
        $orders = $orders->paginate(10);
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
        return view('dashboards.sellers.orders.show', compact('order', 'user'));
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

            $response = ['success' => true, 'message' => "Order status changed to ".$status];
            return response()->json($response);
        }
        $response = ['success' => false, 'message' => "Code not completed"];
        return response()->json($response);
    }
    
}
