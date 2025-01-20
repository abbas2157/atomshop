<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category, Brand};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $products->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('category_id') && !empty(request()->category_id)) {
            $products->where('category_id', request()->category_id);
        }
        if(request()->has('brand_id') && !empty(request()->brand_id)) {
            $products->where('brand_id', request()->brand_id);
        }
        if(request()->has('status') && !empty(request()->status)) {
            $products->where('status', request()->status);
        }
        $products = $products->paginate(10);
        $categories = Category::orderBy('id','desc')->get();
        $brands = Brand::orderBy('id','desc')->get();
        return view('dashboards.admin.components.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();
        $brands = Brand::orderBy('id','desc')->get();
        return view('dashboards.admin.components.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
