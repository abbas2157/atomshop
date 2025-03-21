<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Product, Cart};
use Illuminate\Support\Facades\{Auth, DB, Session};
use App\Http\Controllers\Api\BaseController as BaseController;

class CartController extends BaseController
{
    public function get_cart(Request $request)
    {
        if($request->has('user_type') && $request->user_type == 'auth') {
            $user_id = $request->user_id;
            $user = User::select('id', 'name')->where('id', $user_id)->where('status', 'active')->first();
            if (is_null($user)) {
                return $this->sendError($request->all(), 'User not found.', 200);
            }
            $cart_items = Cart::where('user_id', $user_id)->where('status', 'Pending')->get();
        }
        if($request->has('guest_id') && $request->user_type != 'auth') {
            $guest_id = $request->guest_id;
            $cart_items = Cart::where('guest_id', $guest_id)->where('status', 'Pending')->get();
        }
        if(isset($cart_items) && $cart_items->isNotEmpty()) {
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
                    'price' => $item->product_price,
                    'picture' => $item->product->product_picture,
                    'total' => number_format(($item->product->price * $item->quantity),0),
                );
                $cart[] = array('id' => $item->id, 'product' => $product, 'product_advance_price' => number_format($item->product_advance_price,0), 'product_price' => number_format($item->product_price,0), 'quantity' => $item->quantity,'tenure' => $item->tenure);
                $sub_total += ($item->product_price * $item->quantity);
                $total += $sub_total;
            }
            $data = ['cart' => $cart, 'sub_total' => number_format($sub_total,0), 'total' => number_format($total,0)];
            return $this->sendResponse($data, 'Cart get successfully', 200);
        }
        else {
            $data = $request->all();
            return $this->sendError('Cart is empty', $data, 200);
        }

    }
    public function add_to_cart(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::select('id','title')->where('id', $request->product_id)->first();
            if (is_null($product)) {
                return $this->sendError( $request->all(), 'Product not found.', 404);
            }
            if($request->has('user_type') && $request->user_type == 'auth') {
                $user_id = $request->user_id;
                $user = User::select('id', 'name')->where('id', $user_id)->where('status', 'active')->first();
                if (is_null($user)) {
                    return $this->sendError( $request->all(), 'User not found.', 404);
                }
                $cart_item = Cart::where('user_id', $user_id)->where('product_id', $product->id)->where('status', 'Pending')->first();
                if(!is_null($cart_item)) {
                    $cart_item->quantity = ( (int) $cart_item->quantity ) + 1;
                    $cart_item->save();
                }
                else {
                    $cart_item = new Cart;
                    $cart_item->quantity = 1;
                    $cart_item->product_id = $product->id;
                    $cart_item->memory_id = $request->memory_id;
                    $cart_item->color_id = $request->color_id;
                    $cart_item->product_price = $request->price;
                    $cart_item->product_advance_price = $request->min_advance_price;
                    $cart_item->tenure = $request->tenure_months;
                    $cart_item->user_id = $user_id;
                    $cart_item->portal = $request->portal ?? 'Web';
                    $cart_item->status = 'Pending';
                    $cart_item->save();
                }
                $data = ['user_id' => $user_id, 'product' => [ $product->id,  $product->title], 'quantity' => $cart_item->quantity];
            }
            if($request->has('guest_id') && $request->user_type != 'auth') {
                $guest_id = $request->guest_id;
                $cart_item = Cart::where('guest_id', $guest_id)->where('product_id', $product->id)->where('status', 'Pending')->first();
                if(!is_null($cart_item)) {
                    $cart_item->quantity = ( (int) $cart_item->quantity ) + 1;
                    $cart_item->save();
                }
                else {
                    $cart_item = new Cart;
                    $cart_item->quantity = 1;
                    $cart_item->product_id = $product->id;
                    $cart_item->memory_id = $request->memory_id;
                    $cart_item->color_id = $request->color_id;
                    $cart_item->product_price = $request->price;
                    $cart_item->product_advance_price = $request->min_advance_price;
                    $cart_item->tenure = $request->tenure_months;
                    $cart_item->guest_id = $guest_id;
                    $cart_item->status = 'Pending';
                    $cart_item->save();
                }
                $data = ['guest_id' => $guest_id, 'product' => [ $product->id,  $product->title], 'quantity' => $cart_item->quantity];
            }
            DB::commit();
            return $this->sendResponse($data, 'Product added to cart successfully!', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function remove_from_cart(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart_id = $request->cart_id;
            Cart::where('id', $cart_id)->delete();
            DB::commit();
            return response()->json($this->sendResponse($request->all(), 'Item removed from cart successfully!', 200));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function cart_count(Request $request)
    {
        $count = 0;

        if ($request->has('user_type') && $request->user_type == 'auth') {
            $user_id = $request->user_id;
            $count = Cart::where('user_id', $user_id)->where('status', 'Pending')->count();
        } elseif ($request->has('guest_id') && $request->user_type != 'auth') {
            $guest_id = $request->guest_id;
            $count = Cart::where('guest_id', $guest_id)->where('status', 'Pending')->count();
        }

        return response()->json(['success' => true, 'count' => $count], 200);
    }
}
