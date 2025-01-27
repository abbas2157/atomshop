<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Product};

class HomeController extends Controller
{
    public function home()  {
        $categories = Category::where('status', 'active')->select('id','title','picture', 'slug')->get();
        $feature_products = Product::where(['status' => 'Published', 'feature' => '1'])->select('id','title','slug','price','picture')->get();
        return view('website.home.index', compact('categories', 'feature_products'));
    }
}
