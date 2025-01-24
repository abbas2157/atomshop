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
    public function feature_products(Request $request) {
        try {
            $products = Product::orderBy('id','desc')->where(['status' => 'Published'])->select('id','title','picture')->get();
            return $this->sendResponse($products, 'Here list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
}
