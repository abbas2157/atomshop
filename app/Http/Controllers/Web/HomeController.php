<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, WebsiteSetup, InstallmentCalculator};

class HomeController extends Controller
{
    public function home()  {
        $website = WebsiteSetup::first();
        $feature_products = [];
        if(!is_null($website)) {
            $feature_products = json_decode($website->feature_products);
        }
        $categories = [];
        if(!is_null($website)) {
            $categories = json_decode($website->categories);
        }
        return view('website.home.index', compact('categories', 'feature_products'));
    }

    public function product_detail($slug)
    {
        try {
            $product = Product::with('category', 'brand', 'colors', 'memories', 'gallery', 'description')
                ->where('slug', $slug)
                ->where(['status' => 'Published'])
                ->select('id', 'title', 'picture', 'price', 'category_id', 'brand_id')
                ->first();
            if(is_null($product)) {
                return abort(404);
            }

            $product_deatil = [];

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
                foreach ($product->colors as $clr) {
                    if (!is_null($clr->color)) {
                        $product_deatil['colors'][] = array('id' => $clr->color_id, 'title' => $clr->color->title);
                    }
                }
            } else {
                $product_deatil['colors'] = [];
            }
            if ($product->memories->isNotEmpty()) {
                foreach ($product->memories as $mem) {
                    if (!is_null($mem->memory)) {
                        $product_deatil['memories'][] = array('id' => $mem->memory_id, 'title' => $mem->memory->title);
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
            $products = Product::where(['status' => 'Published'])->select('id','title','slug','price','picture')->get();
            return view('website.home.detail', compact('product','products'));
        } catch (Exception $e) {
            return abort(505, $e->getMessage());
        }
    }

    public function calculator()  {
        $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
        if(is_null($calculator)) {
            abort(404);
        }
        return view('website.installment-calculator', compact('calculator'));
    }
}
