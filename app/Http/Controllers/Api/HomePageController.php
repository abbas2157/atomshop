<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\{Category, Brand, Product, AppSetup};
use Illuminate\Support\Facades\{Auth, DB};

class HomePageController extends BaseController
{
    /**
     * Get Categories For Home Page App
     */
    public function categories(Request $request)
    {
        try {
            $app = AppSetup::first();
            $categories = [];
            if (!is_null($categories)) {
                $categories = json_decode($app->categories);
            }

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
            $app = AppSetup::first();
            $brands = [];
            if (!is_null($brands)) {
                $brands = json_decode($app->brands);
            }
            return $this->sendResponse($brands, 'Here is the list of brands.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Products For Home Page App
     */
    public function sliders(Request $request)
    {
        try {
            $app = AppSetup::first();
            $sliders = [];
            if (!is_null($sliders)) {
                $sliders = json_decode($app->sliders);
            }
            return $this->sendResponse($sliders, 'Here is the list of slider.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
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
}
