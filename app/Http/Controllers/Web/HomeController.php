<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{Product, WebsiteSetup, InstallmentCalculator};

class HomeController extends Controller
{
    public function home()
    {
        $website = WebsiteSetup::first();
        $sliders = [];
        if (!is_null($sliders)) {
            $sliders = json_decode($website->sliders);
        }
        $feature_products = [];
        if (!is_null($website)) {
            $feature_products = json_decode($website->feature_products);
        }
        $categories = [];
        if (!is_null($website)) {
            $categories = json_decode($website->categories);
        }
        $brands = [];
        if (!is_null($website)) {
            $brands = json_decode($website->brands);
        }
        return view('website.home.index', compact('sliders', 'categories', 'feature_products', 'brands'));
    }

    public function product_detail($slug)
    {
        try {
            $product = Product::with('category', 'brand', 'colors', 'memories', 'gallery', 'description')
                ->where('slug', $slug)
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->first();
            if (is_null($product)) {
                return abort(404);
            }

            $product_deatil = [];

            $product_deatil['id'] = $product->id;
            $product_deatil['title'] = $product->title;
            $product_deatil['price'] = $product->formatted_price;
            $product_deatil['variation_price'] = $product->formatted_price;
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
                            $product_deatil['memories'][] = array('id' => $item->memory_id, 'title' => $item->memory->title, 'active' => true);
                            $first = false;
                            $product_deatil['variation_price'] = $item->formatted_price;
                        } 
                        else {
                            $product_deatil['memories'][] = array('id' => $item->memory_id, 'title' => $item->memory->title, 'active' => false);
                        }
                    }
                }
            } else {
                $product_deatil['memories'] = [];
            }

            if ($product->gallery->isNotEmpty()) {
                foreach ($product->gallery as $img) {
                    if (!is_null($mem->memory)) {
                        $product_deatil['gallery'][] = array('id' => $img->id, 'url' => $img->url);
                    }
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
            $product = $product_deatil;
            
            $products = Product::where(['status' => 'Published'])->select('id', 'title', 'slug', 'price', 'picture','brand_id')->get();
            return view('website.home.detail', compact('product', 'products'));
        } catch (Exception $e) {
            return abort(505, $e->getMessage());
        }
    }

    public function calculator()
    {
        $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
        if (is_null($calculator)) {
            abort(404);
        }
        return view('website.installment-calculator', compact('calculator'));
    }
}
