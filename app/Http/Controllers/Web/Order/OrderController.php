<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Cart, Order, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Session, Log};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Web\OrderConfirmationJob;


class OrderController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::check()) {
                return redirect('login');
            }

            $user_id = Auth::id();
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

    public function checkout_perform(Request $request)
    {
        if(!Auth::check()) {
            return redirect('login');
        }
        if(!$request->has('cart_id') && empty($request->cart_id)) {
            return redirect('cart');
        }
       
        try {
            DB::beginTransaction();

            $cart_ids = $request->cart_id;
            $cart = Cart::whereIn('id', $cart_ids)->where('status', 'Pending')->get();
            if(!$cart->isNotEmpty()) {
                return redirect('cart');
            }
            $user = Auth::user();
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

                OrderConfirmationJob::dispatch($user, $order);
            }
            $user = Auth::user();
            DB::commit();
            return redirect('order/success?order='.$order->uuid);
        } catch (\Exception $e) {
            DB::rollBack();
            return abort(505, $e->getMessage());
        }
    }
    public function success()
    {
        if(!request()->has('order')) {
            return redirect()->route('website');
        }
        $order_uuid = request()->order;
        $order = Order::where('uuid', request()->order)->with('cart')->first();
        if(is_null($order)) {
            return redirect()->route('website');
        }
        // dd($order->toArray());
        return view('website.order.success', compact('order'));
    }
    public function failed()
    {
        return view('website.order.failed');
    }
}
