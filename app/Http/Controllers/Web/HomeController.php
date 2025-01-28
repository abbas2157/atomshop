<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Product, ProductDescription, ProductImage};

class HomeController extends Controller
{
    public function home()  {
        $categories = Category::where('status', 'active')->select('id','title','picture', 'slug')->get();
        $feature_products = Product::where(['status' => 'Published', 'feature' => '1'])->select('id','title','slug','price','picture')->get();
        return view('website.home.index', compact('categories', 'feature_products'));
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $description = ProductDescription::where('product_id', $product->id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $feature_products = Product::where(['status' => 'Published', 'feature' => '1'])->select('id','title','slug','price','picture')->get();
        return view('website.home.product-detail', compact('product', 'description', 'productImages', 'feature_products'));
    }
}
