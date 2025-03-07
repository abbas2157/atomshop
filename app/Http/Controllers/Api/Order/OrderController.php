<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\Web\OrderConfirmationJob;
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

            $cart_items = Cart::where('user_id', $user->id)->where('status', 'Pending')->get();
            if ($cart_items->isEmpty()) {
                return $this->sendError($request->all(), 'Cart is Empty.', 200);
            }
            
            $cart = [];
            $sub_total = 0;
            $total = 0;
            foreach($cart_items as $item) {
               
                if(!is_null($item->memory_id) && !is_null($item->memory)) {
                    $item->product->title = $item->product->title . " - Storage " . $item->memory->title;
                }
                if(!is_null($item->color_id) && !is_null($item->color)) {
                    $item->product->title = $item->product->title . " - Color " . $item->color->title;
                }
                if(!is_null($item->size_id) && !is_null($item->size)) {
                    $item->product->title = $item->product->title . " - Size " . $item->size->title . ' ' . $item->size->unit ;
                }
                $product = array(
                    'id' => $item->product->id, 
                    'title' => $item->product->title ,
                    'price' => $item->product->formatted_price, 
                    'picture' => $item->product->product_picture, 
                    'total' => number_format(($item->product->price * $item->quantity),0),
                );
                $cart[] = array('id' => $item->id, 'product' => $product, 'product_advance_price' => number_format($item->product_advance_price,0), 'product_price' => number_format($item->product_price,0), 'quantity' => $item->quantity );
                $sub_total += ($item->product_price * $item->quantity);
                $total += $sub_total;
            }
            $data = ['cart' => $cart, 'sub_total' => number_format($sub_total,0), 'total' => number_format($total,0)];
            return $this->sendResponse($data, 'Cart get successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function checkout_perform(Request $request)
    {
        if(!$request->has('cart_id') && empty($request->cart_id)) {
            return $this->sendError(request()->all(), 'Send Cart IDs in request.', 200);
        }
        
        try {
            $cart_ids = $request->cart_id;
            $cart = Cart::whereIn('id', $cart_ids)->where('status', 'Pending')->get();
            if(!$cart->isNotEmpty()) {
                return $this->sendError(request()->all(), 'Cart is Empty.', 200);
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

                OrderConfirmationJob::dispatch($user);
            }
            return $this->sendResponse($data, 'Order created successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function success()
    {
        if(!request()->has('order')) {
            return $this->sendError(request()->all(), 'Send order UUID in request.', 200);
        }
        $order_uuid = request()->order;
        $order = Order::where('uuid', request()->order)->with('cart')->first();
        if(is_null($order)) {
            return $this->sendError(request()->all(), 'Order not found.', 200);
        }
        $data = ['text' => 'Order has been submitted successfully.', 'icon' => asset('order/success.png')];
        return $this->sendResponse($data, 'Order created successfully', 200);
    }
    public function failed()
    {
        $data = ['text' => 'Order has not been submitted. Something Went wrong.', 'icon' => asset('order/failed.png')];
        return $this->sendResponse($data, 'Order created successfully', 200);
    }

    public function my_orders()
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

            $orders = Order::where('user_id', $user->id)->select('id', 'cart_id', 'portal', 'status', 'created_at')->orderBy('id','desc')->paginate(10);
            if ($cart_items->isEmpty()) {
                return $this->sendError($request->all(), 'No Order Found.', 200);
            }
            
            $orders_list = [];
            foreach($orders as $item) {
               
                if(!is_null($item->cart->memory_id) && !is_null($item->cart->memory)) {
                    $item->cart->product->title = $item->product->title . " - Storage " . $item->memory->title;
                }
                if(!is_null($item->cart->color_id) && !is_null($item->cart->color)) {
                    $item->cart->product->title = $item->cart->product->title . " - Color " . $item->cart->color->title;
                }
                if(!is_null($item->cart->size_id) && !is_null($item->cart->size)) {
                    $item->cart->product->title = $item->cart->product->title . " - Size " . $item->cart->size->title . ' ' . $item->cart->size->unit ;
                }

                $product = array(
                    'id' => $item->cart->product->id, 
                    'title' => $item->cart->product->title ,
                    'price' => $item->cart->product->formatted_price, 
                    'picture' => $item->cart->product->product_picture, 
                    'total' => number_format(($item->product->price * $item->quantity),0),
                );
                $orders_list[] = array(
                    'id' => $item->id, 
                    'product' => $product, 
                    'product_advance_price' => number_format($item->advance_price,0), 
                    'total_deal_price' => number_format($item->total_deal_price,0),
                    'instalment_tenure' => $item->instalment_tenure
                );
            }
            return $this->sendResponse($orders_list, 'Cart get successfully', 200);
        } catch (\Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
