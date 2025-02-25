<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Cart, Order, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->select('id', 'cart_id', 'portal', 'status', 'created_at')->paginate(10);
        // dd($orders[0]->cart);
        return view('website.profile.orders.index',compact('orders'));
    }
}
