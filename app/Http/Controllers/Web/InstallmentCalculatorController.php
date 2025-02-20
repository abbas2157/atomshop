<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\{User, Product, Category, Brand, WebsiteSetup, InstallmentCalculator,};
use Illuminate\Support\Facades\{Auth, DB, Session};

class InstallmentCalculatorController extends BaseController
{
    public function index()
    {
        $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
        if (is_null($calculator)) {
            abort(404);
        }
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.installment-calculator', compact('calculator', 'categories'));
    }
    public function brands(Request $request)
    {
        try {
            $brands = Brand::orderBy('id','desc');
            if(request()->has('category_id') && !empty(request()->category_id)) {
                $brands->where('category_id', request()->category_id);
            }
            $brands = $brands->get();
            return $this->sendResponse($brands, 'Here is the list of brands.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function products(Request $request)
    {
        try {
            $products = Product::orderBy('id','desc');
            if(request()->has('brand_id') && !empty(request()->brand_id)) {
                $products->where('brand_id', request()->brand_id);
            }
            $products->select('id', 'title', 'detail_page_title', 'picture', 'price', 'min_advance_price', 'category_id', 'brand_id');
            $products = $products->get();
            return $this->sendResponse($products, 'Here is the list of products.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
