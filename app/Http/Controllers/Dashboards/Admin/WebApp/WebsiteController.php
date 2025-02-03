<?php

namespace App\Http\Controllers\Dashboards\Admin\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Product, WebsiteSetup};
use Illuminate\Support\Facades\{Auth, Hash, DB};

class WebsiteController extends Controller
{
    public function feature_products()
    {
        $website = WebsiteSetup::first();
        $products = json_decode($website->feature_products);
        return view('dashboards.admin.web-app.website.products.feature', compact('products'));
    }

    public function feature_products_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $products_id = json_decode($request->products_id, true);
            $products = [];
            for($i = 0; $i < count($products_id); $i++) {
                $product = Product::where('id', $products_id[$i])->first();
                if(!is_null($product)) {
                    $products[] = array('id' => $product->id, 'title' => $product->title, 'slug' => $product->slug, 'picture' => $product->product_picture, 'category' => $product->category->title, 'brand' => $product->brand->title);
                }
            }
            $website = WebsiteSetup::first();
            $website->feature_products = json_encode($products);
            $website->updated_by = Auth::user()->id;
            $website->save();

            DB::commit();

            $response = ['success' => true, 'message' => 'Products Updated Successfully'];
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return response()->json($response);
        }
    }

    public function feature_products_sync()
    {
        $website = WebsiteSetup::first();

        $feature_products_list = Product::where(['status' => 'Published', 'feature' => '1'])->get();
        $website_feature_products = [];
        $feature_products = [];
        if(!empty($website->feature_products) && !empty(json_decode($website->feature_products))) {
            $website_feature_products = array_column(json_decode($website->feature_products), 'id');
            $feature_products = json_decode($website->feature_products);
        }
        foreach($feature_products_list as $product) {
            if(!in_array($product->id, $website_feature_products)) {
                $feature_products[] = array('id' => $product->id, 'title' => $product->title, 'slug' => $product->slug, 'picture' => $product->product_picture, 'category' => $product->category->title, 'brand' => $product->brand->title);
            }
            else {
                $index = array_search($product->id, array_column($feature_products, 'id'));
                $feature_products[$index] = array('id' => $product->id, 'title' => $product->title, 'slug' => $product->slug, 'picture' => $product->product_picture, 'category' => $product->category->title, 'brand' => $product->brand->title);
            }
        }
        $website->feature_products     = json_encode($feature_products);
        $website->updated_by = Auth::user()->id;
        $website->save();

        $validator['success'] = 'Feature Products Sync successfully';
        return back()->withErrors($validator);
    }

    public function categories()
    {
        $website = WebsiteSetup::first();
        $categories = json_decode($website->categories);
        return view('dashboards.admin.web-app.website.categories', compact('categories'));
    }

    public function category_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $categoried_ids = json_decode($request->categories_id, true);
            $categories = [];
            for($i = 0; $i < count($categoried_ids); $i++) {
                $category = Category::where('id', $categoried_ids[$i])->first();
                if(!is_null($category)) {
                    $categories[] = array('id' => $category->id, 'title' => $category->title, 'slug' => $category->slug, 'picture' => $category->category_picture);
                }
            }
            $website = WebsiteSetup::first();
            $website->categories = json_encode($categories);
            $website->updated_by = Auth::user()->id;
            $website->save();

            DB::commit();

            $response = ['success' => true, 'message' => 'Category Updated Successfully'];
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return response()->json($response);
        }
    }

    public function category_sync()
    {
        $website = WebsiteSetup::first();

        $category_list = Category::where('status', 'active')->get();
        $website_categories = [];
        $categories = [];
        if(!empty($website->categories) && !empty(json_decode($website->categories))) {
            $website_categories = array_column(json_decode($website->categories), 'id');
            $categories = json_decode($website->categories);
        }
        foreach($category_list as $category) {
            if(!in_array($category->id, $website_categories)) {
                $categories[] = array('id' => $category->id, 'title' => $category->title, 'slug' => $category->slug, 'picture' => $category->category_picture);
            }
            else {
                $index = array_search($category->id, array_column($categories, 'id'));
                $categories[$index] = array('id' => $category->id, 'title' => $category->title, 'slug' => $category->slug, 'picture' => $category->category_picture);
            }
        }

        $website->categories = json_encode($categories);
        $website->updated_by = Auth::user()->id;
        $website->save();

        $validator['success'] = 'Categories Sync successfully';
        return back()->withErrors($validator);
    }

    public function brands()
    {
        $website = WebsiteSetup::first();
        $brands = json_decode($website->brands);
        return view('dashboards.admin.web-app.website.brands', compact('brands'));
    }

    public function brand_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $brands_id = json_decode($request->brands_id, true);
            $brands = [];
            for($i = 0; $i < count($brands_id); $i++) {
                $brand = Brand::where('id', $brands_id[$i])->first();
                if(!is_null($brand)) {
                    $brands[] = array('id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'picture' => $brand->brand_picture);
                }
            }
            $website = WebsiteSetup::first();
            $website->brands = json_encode($brands);
            $website->updated_by = Auth::user()->id;
            $website->save();

            DB::commit();

            $response = ['success' => true, 'message' => 'Brand Updated Successfully'];
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return response()->json($response);
        }
    }

    public function brand_sync()
    {
        $website = WebsiteSetup::first();

        $brand_list = Brand::where('status', 'active')->get();
        $website_brands = [];
        $brands = [];
        if(!empty($website->brands) && !empty(json_decode($website->brands))) {
            $website_brands = array_column(json_decode($website->brands), 'id');
            $brands = json_decode($website->brands);
        }
        foreach($brand_list as $brand) {
            if(!in_array($brand->id, $website_brands)) {
                $brands[] = array('id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'picture' => $brand->brand_picture);
            }
            else {
                $index = array_search($brand->id, array_column($brands, 'id'));
                $brands[$index] = array('id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'picture' => $brand->brand_picture);
            }
        }
        $website->brands     = json_encode($brands);
        $website->updated_by = Auth::user()->id;
        $website->save();

        $validator['success'] = 'Brands Sync successfully';
        return back()->withErrors($validator);
    }
}
