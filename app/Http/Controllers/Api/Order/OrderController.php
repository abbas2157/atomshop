<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        try {

            $user_id = request()->uuid;
            $cart = Cart::where('user_id', $user_id)->where('status', 'Pending')->get();

            if ($cart->isEmpty()) {
                return redirect('cart');
            }

            $cities = City::orderBy('id', 'desc')->get();
            $areas = Area::orderBy('id', 'desc')->get();

            return view('website.order.checkout', compact('cart', 'cities', 'areas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
