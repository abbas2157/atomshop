<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Product, Cart};
use Illuminate\Support\Facades\{Auth, DB, Session};
use App\Http\Controllers\Api\BaseController as BaseController;

class OrderController extends BaseController
{
    public function index()
    {
        try {
            if(!request()->has('uuid')) {
                return $this->sendError(request()->all(), 'Send user uuid in request.', 200);
            }
            $user_uuid = request()->uuid;

            $user = User::where('uuid', $user_uuid)->where('status', 'active')->first();
            if (is_null($user)) {
                return $this->sendError($request->all(), 'User not found.', 200);
            }

            $cart = Cart::where('user_id', $user->id)->where('status', 'Pending')->get();
            if ($cart->isEmpty()) {
                return $this->sendError($request->all(), 'Cart is Empty.', 200);
            }

            

            $cities = City::orderBy('id', 'desc')->get();
            $areas = Area::orderBy('id', 'desc')->get();

            return view('website.order.checkout', compact('cart', 'cities', 'areas'));
        } catch (\Exception $e) {
            
        }
    }
}
