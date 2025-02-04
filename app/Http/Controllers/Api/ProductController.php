<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Category, Brand, Product};
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class ProductController extends BaseController
{

    public function products(Request $request)
    {
        try {
            $products = Product::query()
                ->where('status', 'Published')
                ->orderBy($request->input('order_by', 'title'), strtoupper($request->input('order_type', 'ASC')))
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
                ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
                ->when($request->color_id, fn($q) => $q->whereHas('colors', fn($q) => $q->where('color_id', $request->color_id)))
                ->when($request->memory_id, fn($q) => $q->whereHas('memories', fn($q) => $q->where('memory_id', $request->memory_id)))
                ->with(['category:id,title', 'brand:id,title'])
                ->select('id', 'title', 'price', 'picture', 'category_id', 'brand_id');
                $products = $products->paginate(10);
            return $this->sendResponse($products, 'Here is the list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }

    public function product_detail(Request $request, $id)
    {
        try {
            $product = Product::with('category', 'brand', 'colors', 'memories', 'gallery', 'description')
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->first();

            $product_deatil = [];
            if (is_null($product)) {
                $product_deatil['product_id'] = $id;
                return $this->sendError($product_deatil, 'Product not found .', 404);
            }

            $product_deatil['title'] = $product->title;
            $product_deatil['price'] = $product->formatted_price;
            $product_deatil['picture'] = $product->product_picture;
            $product_deatil['category'] = $product->category;
            if (!is_null($product->category)) {
                $product_deatil['category'] = $product->category->toArray();
            }
            $product_deatil['brand'] = $product->brand;
            if (!is_null($product->brand)) {
                $product_deatil['brand'] = $product->brand->toArray();
            }

            if ($product->colors->isNotEmpty()) {
                foreach ($product->colors as $item) {
                    if (!is_null($item->color)) {
                        $product_deatil['colors'][] = array('id' => $item->color_id, 'title' => $item->color->title);
                    }
                }
            } else {
                $product_deatil['colors'] = [];
            }
            if ($product->memories->isNotEmpty()) {
                foreach ($product->memories as $mem) {
                    if (!is_null($item->memory)) {
                        $product_deatil['memories'][] = array('id' => $item->memory_id, 'title' => $item->memory->title);
                    }
                }
            } else {
                $product_deatil['memories'] = [];
            }

            if ($product->gallery->isNotEmpty()) {
                foreach ($product->gallery as $item) {
                    $product_deatil['gallery'][] = array('id' => $item->id, 'url' => $item->url);
                }
            } else {
                $product_deatil['gallery'] = [];
            }

            $product_deatil['short_description'] = '';
            $product_deatil['long_description'] = '';
            if (!is_null($product->description)) {
                $product_deatil['short_description'] = $product->description->short;
                $product_deatil['long_description'] = $product->description->long;
            }

            return $this->sendResponse($product_deatil, 'Product deatil is here .', 200);
        } catch (Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
}
