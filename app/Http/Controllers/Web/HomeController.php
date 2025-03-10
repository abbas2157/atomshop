<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Product, Category, WebsiteSetup, InstallmentCalculator,};
use Illuminate\Support\Facades\{Auth, DB, Session};

class HomeController extends Controller
{
    public function home()
    {
        $website = WebsiteSetup::first();
        $sliders = [];
        if (!is_null($sliders)) {
            $sliders = json_decode($website->sliders);
        }
        $categories = [];
        if (!is_null($website)) {
            $categories = json_decode($website->categories);
        }
        $feature_products = [];
        if (!is_null($website)) {
            $feature_products = json_decode($website->feature_products);
        }
        $brands = [];
        if (!is_null($website)) {
            $brands = json_decode($website->brands);
        }
        $products = [];
        if (!is_null($website)) {
            $products = json_decode($website->products);
        }
        return view('website.home.index', compact('sliders', 'categories', 'feature_products', 'brands', 'products'));
    }

    public function product_detail($slug)
    {
        try {
            $product = Product::with('category', 'brand', 'colors', 'memories', 'gallery', 'description')
                ->where('slug', $slug)
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'detail_page_title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id')
                ->first();
            if (is_null($product)) {
                return abort(404);
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
                    $product_deatil['gallery'][] = array('id' => $img->id, 'url' => $img->url);
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
            $products = Product::where(['status' => 'Published'])->where('category_id', $product->category_id)->where('brand_id', $product->brand_id)->limit(12)->select('id', 'title', 'slug', 'price', 'min_advance_price', 'picture','brand_id')->get();
            $product = $product_deatil;
            return view('website.home.detail', compact('product', 'products'));
        } catch (Exception $e) {
            return abort(505, $e->getMessage());
        }
    }
    public function throttle()
    {
        return view('website.errors.404');
    }
}
