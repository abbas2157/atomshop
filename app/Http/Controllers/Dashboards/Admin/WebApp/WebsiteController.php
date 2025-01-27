<?php

namespace App\Http\Controllers\Dashboards\Admin\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Product};

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', 'active')->select('id','title','picture', 'slug', 'created_at')->get();
        $feature_products = Product::where(['status' => 'Published', 'feature' => '1'])->select('id','title','slug','price','picture')->get();
        return view('dashboards.admin.web-app.website.index', compact('categories', 'feature_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
