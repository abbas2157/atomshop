<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Brand};
use Illuminate\Support\Facades\{Auth, DB, Session};

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where(['status' => 'Published'])->select('id','title','slug', 'price', 'min_advance_price', 'picture', 'brand_id');
        if(request()->has('category')) {
            $products->whereIn('category_id', request()->category);
        }
        if(request()->has('brand')) {
            $products->whereIn('brand_id', request()->brand);
        }
        if(request()->has('min') || request()->has('max')) {
            $products->whereBetween('price', [request()->min ?? 0, request()->max ?? 500000000]);
        }
        $products = $products->paginate(20)->appends(request()->query());
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        $brands = Brand::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.shop.index', compact('products', 'categories', 'brands'));
    }
}
