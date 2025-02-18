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
}
