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
                ->where('id', $id)
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'detail_page_title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id')
                ->first();
            if (is_null($product)) {
                return $this->sendResponse(['id' => $id], 'Product not found.', 200);
            }
            $product_deatil = [];

            $product_deatil['id'] = $product->id;
            $product_deatil['title'] = $product->title;
            $product_deatil['detail_page_title'] = $product->detail_page_title;
            $product_deatil['price'] = $product->formatted_price;
            $product_deatil['variation_price'] = $product->price;
            $product_deatil['min_advance_price'] = $product->min_advance_price;
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
                $first = true;
                foreach ($product->colors as $item) {
                    if (!is_null($item->color)) {
                        if ($first) {
                            $product_deatil['colors'][] = array('id' => $item->color_id, 'title' => $item->color->title, 'active' => true);
                            $first = false;
                        } 
                        else {
                            $product_deatil['colors'][] = array('id' => $item->color_id, 'title' => $item->color->title, 'active' => false);
                        }
                    }
                }
            } else {
                $product_deatil['colors'] = [];
            }
            if ($product->memories->isNotEmpty()) {
                $first = true;
                foreach ($product->memories as $item) {
                    if (!is_null($item->memory)) {
                        if ($first) {
                            $product_deatil['memories'][] = array('id' => $item->memory_id, 'title' => $item->memory->title, 'variation_price' => $item->price, 'active' => true);
                            $first = false;
                            $product_deatil['variation_price'] = $item->price;
                        } 
                        else {
                            $product_deatil['memories'][] = array('id' => $item->memory_id, 'title' => $item->memory->title,  'variation_price' => $item->price, 'active' => false);
                        }
                    }
                }
            } else {
                $product_deatil['memories'] = [];
            }

            if ($product->gallery->isNotEmpty()) {
                foreach ($product->gallery as $img) {
                    $product_deatil['gallery'][] = array('id' => $img->id, 'url' => asset($img->url));
                }
            } else {
                $product_deatil['gallery'] = [];
            }

            $product_deatil['short_description'] = '';
            $product_deatil['long_description'] = '';
            if (!is_null($product->description)) {
                $product_deatil['short_description'] = $product->description->short;
                $product_deatil['long_description'] = preg_replace("/\s{2,}/", "\n", strip_tags($product->description->long));
            }
            $product = $product_deatil;

            return $this->sendResponse($product_deatil, 'Product deatil is here.', 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 'Somehting Went Wrong.', 200);
        }
    }
}
