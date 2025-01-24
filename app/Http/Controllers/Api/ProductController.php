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
    public function products(Request $request) {
        try {
            $products = Product::orderBy('id','desc')
                        ->with('category', 'brand')
                        ->where(['status' => 'Published'])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    public function product_detail(Request $request, $id) {
        try {
            $product = Product::with('category', 'brand', 'colors', 'memories')
                        ->where(['status' => 'Published'])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->first();

            $product_deatil = [];
            if(is_null($product)) {
                $product_deatil['product_id'] = $id;
                return $this->sendError($product_deatil, 'Product not found .', 404);
            }

            $product_deatil['title'] = $product->title;
            $product_deatil['price'] = $product->formatted_price;
            $product_deatil['picture'] = $product->product_picture;
            $product_deatil['category'] = $product->category;
            if(!is_null($product->category)) {
                $product_deatil['category'] = $product->category->toArray();
            }
            $product_deatil['brand'] = $product->brand;
            if(!is_null($product->brand)) {
                $product_deatil['brand'] = $product->brand->toArray();
            }
            
            if(!is_null($product->colors)) {
                foreach($product->colors as $clr) {
                    if(!is_null($clr->color)) {
                        $product_deatil['colors'][] = array('color_id' => $clr->color_id, 'title' => $clr->color->title);
                    }
                }
            }
            else {
                $product_deatil['colors'] = [];
            }
            if(!is_null($product->memories)) {
                foreach($product->memories as $mem) {
                    if(!is_null($mem->memory)) {
                        $product_deatil['memories'][] = array('color_id' => $mem->memory_id, 'title' => $mem->memory->title);
                    }
                }
            }
            else {
                $product_deatil['memories'] = [];
            }
            $product_deatil['short_description'] = '';
            $product_deatil['long_description'] = '';
            if(!is_null($product->description)) {
                $product_deatil['short_description'] = $product->description->short;
                $product_deatil['long_description'] = $product->description->long;
            }

            return $this->sendResponse($product_deatil, 'Product deatil is here .', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
}
