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
        if(request()->has('q')) {
            $search = request()->q;
            
            $products->where('title', 'LIKE', "%{$search}%");
            $products->orWhere('detail_page_title', 'LIKE', "%{$search}%");
            $products->orWhere('pr_number', 'LIKE', "%{$search}%");

            $products->orWhereHas('category', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            })
            ->orWhereHas('brand', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%");
            });
        }
        $products = $products->paginate(18)->appends(request()->query());
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        $brands = Brand::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.shop.index', compact('products', 'categories', 'brands'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(is_null($category)) {
            return abort(404);
        }
        $products = Product::where(['status' => 'Published'])->select('id','title','slug', 'price', 'min_advance_price', 'picture', 'brand_id');
        $products->where('category_id', $category->id);
        if(request()->has('brand')) {
            $products->whereIn('brand_id', request()->brand);
        }
        if(request()->has('min') || request()->has('max')) {
            $products->whereBetween('price', [request()->min ?? 0, request()->max ?? 500000000]);
        }
        $products = $products->paginate(20)->appends(request()->query());
        $brands = Brand::orderBy('title','asc')->where('category_id', $category->id)->select('id','title','slug','pr_count')->get();
        return view('website.shop.category', compact('products', 'brands', 'category'));
    }
    public function brand($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        if(is_null($brand)) {
            return abort(404);
        }
        $products = Product::where(['status' => 'Published'])->select('id','title','slug', 'price', 'min_advance_price', 'picture', 'brand_id');
        $products->where('brand_id', $brand->id);
        if(request()->has('min') || request()->has('max')) {
            $products->whereBetween('price', [request()->min ?? 0, request()->max ?? 500000000]);
        }
        $products = $products->paginate(20)->appends(request()->query());
        return view('website.shop.brand', compact('products', 'brand'));
    }
}
