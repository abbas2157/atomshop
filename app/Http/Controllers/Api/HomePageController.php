<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\AddToCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\{Category, Brand, Product};
use Illuminate\Support\Facades\{Auth, DB};

class HomePageController extends BaseController
{
    /**
     * Get Categories For Home Page App
     */
    public function categories(Request $request)
    {
        try {
            $categories = Category::where('status', 'active')
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture');

            return $this->sendResponse($categories, 'Here is the list of categories.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Brands For Home Page App
     */
    public function brands(Request $request)
    {
        try {
            $brands = Brand::where('status', 'active')
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture');

            return $this->sendResponse($brands, 'Here is the list of brands.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Products For Home Page App
     */

    /**
     * Get Products For Home Page App
     */
    public function home_products(Request $request)
    {
        try {
            $products = Product::where(['status' => 'Published', 'app_home' => '1'])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
                ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->paginate(10);

            return $this->sendResponse($products, 'Here is the list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    /**
     * Get Feature Products For Home Page App
     */
    public function feature_products(Request $request)
    {
        try {
            $products = Product::where(['status' => 'Published', 'feature' => '1'])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
                ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->paginate(10);

            return $this->sendResponse($products, 'Here is the list of feature products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Category Products For Home Page App
     */
    public function category_products(Request $request, $category_id)
    {
        try {
            $products = Product::where(['status' => 'Published', 'category_id' => $category_id])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->paginate(10);

            return $this->sendResponse($products, 'Here is the list of category products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Brand Products For Home Page App
     */
    public function brand_products(Request $request, $brand_id)
    {
        try {
            $products = Product::where(['status' => 'Published', 'brand_id' => $brand_id])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->paginate(10);

            return $this->sendResponse($products, 'Here is the list of brand products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function addtocart_store(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($request->product_id);
            if (!$product) {
                return $this->sendError('Product not found.', [], 404);
            }

            $userId = $request->cookie('guest_user_id');
            if (!$userId) {
                $userId = 'guest_' . uniqid();
                return response($this->sendResponse([], 'Product added to cart successfully!', 201));
            }

            $cartItem = AddToCart::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
                $data = $cartItem->toArray();
            } else {
                $data = AddToCart::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'status' => 'pending',
                ])->toArray();
            }

            DB::commit();
            return $this->sendResponse($data, 'Product added to cart successfully!', 201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function updateCart(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $userId = Auth::check() ? Auth::id() : $request->cookie('guest_user_id');
            if (!$userId) {
                $userId = 'guest_' . uniqid();
                return response($this->sendResponse([], 'Cart updated successfully!', 200))->withCookie('guest_user_id', $userId);
            }

            $cartItem = AddToCart::where('id', $id)->where('user_id', $userId)->first();
            if (!$cartItem) {
                return $this->sendError('Item not found in cart.', [], 404);
            }

            $cartItem->update(['quantity' => max(1, $request->quantity)]);
            $cartItems = AddToCart::where('user_id', $userId)->with('product')->get();
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $cartTotal = $subtotal + 10;

            DB::commit();
            return response()->json($this->sendResponse([
                'total_price' => $cartItem->product->price * $cartItem->quantity,
                'cart_total' => $cartTotal,
                'subtotal' => $subtotal
            ], 'Cart updated successfully!', 200))->withCookie('guest_user_id', $userId);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function removeCart(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $userId = Auth::check() ? Auth::id() : $request->cookie('guest_user_id');
            if (!$userId) {
                $userId = 'guest_' . uniqid();
                return response($this->sendResponse([], 'Item removed from cart successfully!', 200))->withCookie('guest_user_id', $userId);
            }

            $cartItem = AddToCart::where('id', $id)->where('user_id', $userId)->first();
            if (!$cartItem) {
                return $this->sendError('Item not found in cart.', [], 404);
            }

            $cartItem->delete();
            $cartItems = AddToCart::where('user_id', $userId)->with('product')->get();
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $cartTotal = $subtotal + 10;

            DB::commit();
            return response()->json($this->sendResponse([
                'cart_total' => $cartTotal,
                'subtotal' => $subtotal
            ], 'Item removed from cart successfully!', 200))->withCookie('guest_user_id', $userId);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
