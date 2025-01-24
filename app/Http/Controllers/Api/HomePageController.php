<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Category, Brand, Product};
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class HomePageController extends BaseController
{
    /**
     * Get Categories For Home Page App
     */
    public function categories(Request $request) {
        try {
            $categories = Category::orderBy('id','desc')->where('status', 'active')->select('id','title','picture')->get();
            return $this->sendResponse($categories, 'Here list of categories.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Get Brands For Home Page App
     */
    public function brands(Request $request) {
        try {
            $categories = Brand::orderBy('id','desc')->where('status', 'active')->select('id','title','picture')->get();
            return $this->sendResponse($categories, 'Here list of Brands.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Get Products For Home Page App
     */
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
            $product = Product::orderBy('id','desc')
                        ->with('category', 'brand', 'colors', 'memories')
                        ->where(['status' => 'Published', 'id' => $id])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->first();
            return $this->sendResponse($product, 'Product deatil is here .', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Get Products For Home Page App
     */
    public function home_products(Request $request) {
        try {
            $products = Product::orderBy('id','desc')
                        ->with('category', 'brand')
                        ->where(['status' => 'Published', 'app_home' => '1'])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }

    /**
     * Get Feature Products For Home Page App
     */
    public function feature_products(Request $request) {
        try {
            $products = Product::orderBy('id','desc')
                        ->with('category', 'brand')
                        ->where(['status' => 'Published', 'feature' => '1'])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Get Category Products For Home Page App
     */
    public function category_products(Request $request, $category_id) {
        try {

            $products = Product::orderBy('id','desc')
                        ->with('category', 'brand')
                        ->where(['status' => 'Published', 'category_id' => $category_id])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Get Brand Products For Home Page App
     */
    public function brand_products(Request $request, $brand_id) {
        try {

            $products = Product::orderBy('id','desc')
                        ->with('category', 'brand')
                        ->where(['status' => 'Published', 'brand_id' => $brand_id])
                        ->select('id','title','picture', 'price', 'category_id', 'brand_id')
                        ->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
}
