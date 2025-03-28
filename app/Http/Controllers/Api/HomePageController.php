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
            if (!is_null($app)) {
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
            if (!is_null($app)) {
                $brands = json_decode($app->brands);
            }
            return $this->sendResponse($brands, 'Here is the list of brands.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Sliders For Home Page App
     */
    public function sliders(Request $request)
    {
        try {
            $app = AppSetup::first();
            $sliders = [];
            if (!is_null($app)) {
                $sliders = json_decode($app->sliders);
            }
            return $this->sendResponse($sliders, 'Here is the list of slider.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    /**
     * Get Sliders For Home Page App
     */
    public function promotions(Request $request)
    {
        try {
            $app = AppSetup::first();
            $sliders = [];
            $sliders[] = array('picture' => asset('sliders/apple.png'));
            $sliders[] = array('picture' => asset('sliders/android.png'));
            return $this->sendResponse($sliders, 'Here is the list of promotions.', 200);
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
            $app = AppSetup::first();
            $products = [];
            if (!is_null($app)) {
                $products = json_decode($app->products);
            }

            return $this->sendResponse($products, 'Here is the list of toprated products.', 200);
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
            $app = AppSetup::first();
            $products = [];
            if (!is_null($app)) {
                $products = json_decode($app->feature_products);
            }

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
            $product_items = Product::where(['status' => 'Published', 'category_id' => $category_id])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->brand_id, fn($q) => $q->where('brand_id', $request->brand_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id')
                ->get();
            $products = [];
            foreach($product_items as $product) {
                $products[] =array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }
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
            $product_items = Product::where(['status' => 'Published', 'brand_id' => $brand_id])
                ->with('category', 'brand')
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
                ->orderBy($request->order_by ?? 'title', $request->order_type ?? 'desc')
                ->select('id', 'title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id')
                ->get();
            $products = [];
            foreach($product_items as $product) {
                $products[] =array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }

            return $this->sendResponse($products, 'Here is the list of brand products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
