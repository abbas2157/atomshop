<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Memory, Product, ProductDescription, ProductImage, ProductMemory,Color,ProductColor};

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
        $memory = Memory::where('id', ProductMemory::where('product_id', $product->id)->first()->memory_id)->first();
        $color = Color::where('id', ProductColor::where('product_id', $product->id)->first()->color_id)->first();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $feature_products = Product::where(['status' => 'Published', 'feature' => '1'])->select('id','title','slug','price','picture')->get();
        return view('website.home.product-detail', compact('product', 'description', 'productImages', 'feature_products', 'memory','color'));
    }

    public function shop_products()
    {
        $feature_products = Product::where(['status' => 'Published'])->select('id','title','price','picture')->get();

        return view('website.shop', compact('feature_products'));
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $feature_products = $query->get();

        return view('website.shop', [
            'feature_products' => $feature_products,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price
        ]);
    }

}
