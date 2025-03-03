<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Product, Favorite};
use Illuminate\Support\Facades\{Auth, DB, Session};
use App\Http\Controllers\Api\BaseController as BaseController;

class FavoritesController extends BaseController
{
    public function get_favorites(Request $request)
    {
        if ($request->has('user_type') && $request->user_type == 'auth') {
            $user_id = $request->user_id;
            $user = User::select('id', 'name')->where('id', $user_id)->where('status', 'active')->first();
            if (is_null($user)) {
                return $this->sendError($request->all(), 'User not found.', 200);
            }
            $favorites = Favorite::where('user_id', $user_id)->with('product', 'color', 'memory')->get();
        }
        if ($request->has('guest_id') && $request->user_type != 'auth') {
            $guest_id = $request->guest_id;
            $favorites = Favorite::where('guest_id', $guest_id)->with('product')->get();
        }
        if (isset($favorites) && $favorites->isNotEmpty()) {
            $data = [];
            foreach ($favorites as $favorite) {
                $data[] = [
                    'id' => $favorite->product->id,
                    'title' => $favorite->product->title,
                    'picture' => $favorite->product->product_picture,
                    'price' => $favorite->product->formatted_advance_price,
                    'category' => $favorite->product->category->title ?? null,
                    'brand' => $favorite->product->brand->title ?? null,
                ];
            }
            return $this->sendResponse($data, 'Favorites get successfully', 200);
        } else {
            return $this->sendError('Favorites is empty', [], 200);
        }
    }

    public function remove_from_favorite(Request $request)
    {
        try {
            DB::beginTransaction();
            $favorite_id = $request->favorite_id;
            Favorite::where('id', $favorite_id)->delete();
            DB::commit();
            return response()->json($this->sendResponse($request->all(), 'Item removed from favorites successfully!', 200));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function add_to_favorite(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::select('id', 'title')->where('id', $request->product_id)->first();
            if (is_null($product)) {
                return $this->sendError($request->all(), 'Product not found.', 404);
            }
            if ($request->has('user_type') && $request->user_type == 'auth') {
                $user_id = $request->user_id;
                $user = User::select('id', 'name')->where('id', $user_id)->where('status', 'active')->first();
                if (is_null($user)) {
                    return $this->sendError($request->all(), 'User not found.', 404);
                }
                $favorite_item = Favorite::where('user_id', $user_id)->where('product_id', $product->id)->first();
                if (is_null($favorite_item)) {
                    $favorite_item = new Favorite;
                    $favorite_item->product_id = $product->id;
                    $favorite_item->user_id = $user_id;
                    $favorite_item->save();
                }
                $data = ['user_id' => $user_id, 'product' => [$product->id,  $product->title]];
            }
            if ($request->has('guest_id') && $request->user_type != 'auth') {
                $guest_id = $request->guest_id;
                $favorite_item = Favorite::where('guest_id', $guest_id)->where('product_id', $product->id)->first();
                if (is_null($favorite_item)) {
                    $favorite_item = new Favorite;
                    $favorite_item->product_id = $product->id;
                    $favorite_item->guest_id = $guest_id;
                    $favorite_item->save();
                }
                $data = ['guest_id' => $guest_id, 'product' => [$product->id,  $product->title]];
            }
            DB::commit();
            return $this->sendResponse($data, 'Product added to favorites successfully!', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function favorite_count(Request $request)
    {
        $count = 0;

        if ($request->has('user_type') && $request->user_type == 'auth') {
            $user_id = $request->user_id;
            $count = Favorite::where('user_id', $user_id)->count();
        } elseif ($request->has('guest_id') && $request->user_type != 'auth') {
            $guest_id = $request->guest_id;
            $count = Favorite::where('guest_id', $guest_id)->count();
        }

        return response()->json(['success' => true, 'count' => $count], 200);
    }
}
