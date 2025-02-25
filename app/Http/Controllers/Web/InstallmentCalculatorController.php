<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\{User, Product, Category, Brand, WebsiteSetup, InstallmentCalculator,};
use Illuminate\Support\Facades\{Auth, DB, Session};

class InstallmentCalculatorController extends BaseController
{
    public function index()
    {
        $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
        if (is_null($calculator)) {
            abort(404);
        }
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.calculator.index', compact('calculator', 'categories'));
    }
    public function brands(Request $request)
    {
        try {
            $brands = Brand::orderBy('id','desc');
            if(request()->has('category_id') && !empty(request()->category_id)) {
                $brands->where('category_id', request()->category_id);
            }
            $brands = $brands->get();
            return $this->sendResponse($brands, 'Here is the list of brands.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function products(Request $request)
    {
        try {
            $products = Product::orderBy('id','desc');
            if(request()->has('brand_id') && !empty(request()->brand_id)) {
                $products->where('brand_id', request()->brand_id);
            }
            $products->select('id', 'title', 'detail_page_title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id');
            $products = $products->get();
            return $this->sendResponse($products, 'Here is the list of products.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function product_detail(Request $request)
    {
        try {
            $product = Product::with('colors', 'memories')
                ->where('id', request()->product_id)
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'detail_page_title', 'picture', 'price', 'min_advance_price')
                ->first();
            if (is_null($product)) {
                return $this->sendError('Product is not found', request()->all(), 200);
            }

            $product_deatil = [];

            $product_deatil['id'] = $product->id;
            $product_deatil['price'] = $product->formatted_price;
            $product_deatil['variation_price'] = $product->price;
            $product_deatil['min_advance_price'] = $product->min_advance_price;
            $product_deatil['colors'] = [];

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
            }
            $product_deatil['memories'] = [];
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
            }
            return $this->sendResponse($product_deatil, 'Here is the list of products.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
