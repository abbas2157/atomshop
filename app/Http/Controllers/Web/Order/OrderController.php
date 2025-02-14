<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Cart, Order, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Session};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;


class OrderController extends Controller
{
    public function index()
    {
        // Cookie::forget('redirect_to');
        // Cookie::queue('redirect_to', url('checkout'), 60);
        // dd(request()->cookie('redirect_to'));
        if(!Auth::check()) {
            return redirect('login');
        }
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->where('status', 'Pending')->get();
        if(!$cart->isNotEmpty()) {
            return redirect('cart');
        }
        $cities = City::orderBy('id','desc')->get();
        $areas = Area::orderBy('id','desc')->get();
        return view('website.order.checkout', compact('cart', 'cities', 'areas'));
    }
    public function checkout_perform(Request $request)
    {
        if(!Auth::check()) {
            return redirect('login');
        }
        if(!$request->has('cart_id') && empty($request->cart_id)) {
            return redirect('cart');
        }
       
        try {
            $cart_ids = $request->cart_id;
            $cart = Cart::whereIn('id', $cart_ids)->where('status', 'Pending')->get();
            if(!$cart->isNotEmpty()) {
                return redirect('cart');
            }
            for($i = 0; $i < count($cart_ids); $i++) {
                $order = new Order;
                $order->uuid = Str::uuid();
                $order->user_id = Auth::user()->id;
                $order->cart_id = $cart_ids[$i];
                $order->portal  = 'Web';
                $order->save();

                $cart = Cart::where('id', $cart_ids[$i])->first();
                $cart->status = 'Purchased';
                $cart->save();
            }
            return redirect('order/success');
        } catch (\Exception $e) {
            return abort(505, $e->getMessage());
        }
    }
    
}
