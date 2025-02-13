<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Product, Cart, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Session};

class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->where('status', 'Pending')->get();
        if(!$cart->isNotEmpty()) {
            return redirect('cart');
        }
        $cities = City::orderBy('id','desc')->get();
        $areas = Area::orderBy('id','desc')->get();
        return view('website.order.checkout', compact('cart', 'cities', 'areas'));
    }
}
