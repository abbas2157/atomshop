<?php

namespace App\Http\Controllers\Dashboards\Admin\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Brand, Product, WebsiteSetup, Slider};
use Illuminate\Support\Facades\{Auth, Hash, DB};

class WebsiteController extends Controller
{
    public function web_products()
    {
        $website = WebsiteSetup::first();
        $products = [];
        if(!is_null($website)) {
            $products = json_decode($website->products);
        }
        return view('dashboards.admin.web-app.website.products.web', compact('products'));
    }

    public function web_products_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $products_id = json_decode($request->products_id, true);
            $products = [];
            for($i = 0; $i < count($products_id); $i++) {
                $product = Product::where('id', $products_id[$i])->first();
                if(!is_null($product)) {
                    $products[] = array('id' => $product->id, 'title' => $product->title, 'slug' => $product->slug, 'price' => $product->formatted_price, 'picture' => $product->product_picture, 'category' => $product->category->title, 'brand' => $product->brand->title);
                }
            }
            $website = WebsiteSetup::first();
            $website->products = json_encode($products);
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

    public function web_products_sync()
    {
        // Initailize Product (Start)
        $products = [];
        $website_products_ids = [];
        $website = WebsiteSetup::first();
        if(!empty($website->products) && !empty(json_decode($website->products,true))) {
            $website_products_ids = array_column(json_decode($website->products,true), 'id');
            $products = json_decode($website->products,true);
        }
        // Initailize Product (end)

        // Remove deleted one from products (Start)
        $products_list_ids = Product::where(['status' => 'Published', 'web_home' => '1'])->pluck('id');
        if($products_list_ids->isNotEmpty()){
            $products_list_ids = $products_list_ids->toArray();
            foreach($products as $key => $product) {
                if(!in_array($product['id'], $products_list_ids)) {
                    unset($products[$key]);
                }
            }
        }
        // Remove deleted one from products (end)
        // Update products in Website_Setup Table (Start)
        $products_list = Product::where(['status' => 'Published', 'web_home' => '1'])->get();
        foreach($products_list as $product) {
            if(!in_array($product->id, $website_products_ids)) {
                $products[] = array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }
            else {
                $index = array_search($product->id, array_column($products, 'id'));
                $products[$index] = array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }
        }
        $products = array_values(array_unique($products, SORT_REGULAR));
        $website->products = json_encode($products);
        $website->updated_by = Auth::user()->id;
        $website->save();
        // Update products in Website_Setup Table (end)

        $validator['success'] = 'Products Sync successfully';
        return back()->withErrors($validator);
    }
    public function feature_products()
    {
        $website = WebsiteSetup::first();
        $products = [];
        if(!is_null($website)) {
            $products = json_decode($website->feature_products);
        }
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
                    $products[] = array('id' => $product->id, 'title' => $product->title, 'slug' => $product->slug, 'price' => $product->formatted_price, 'picture' => $product->product_picture, 'category' => $product->category->title, 'brand' => $product->brand->title);
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
        // Initailize Feature Product (Start)
        $feature_products = [];
        $website_feature_products_ids = [];
        $website = WebsiteSetup::first();
        if(!empty($website->feature_products) && !empty(json_decode($website->feature_products,true))) {
            $website_feature_products_ids = array_column(json_decode($website->feature_products,true), 'id');
            $feature_products = json_decode($website->feature_products,true);
        }
        // Initailize Feature Product (end)

        // Remove deleted one from feature products (Start)
        $feature_products_list_ids = Product::where(['status' => 'Published', 'feature' => '1'])->pluck('id');
        if($feature_products_list_ids->isNotEmpty()){
            $feature_products_list_ids = $feature_products_list_ids->toArray();
            foreach($feature_products as $key => $product) {
                if(!in_array($product['id'], $feature_products_list_ids)) {
                    unset($feature_products[$key]);
                }
            }
        }
        // Remove deleted one from feature products (end)
        // Update feature products in Website_Setup Table (Start)
        $feature_products_list = Product::where(['status' => 'Published', 'feature' => '1'])->get();
        foreach($feature_products_list as $product) {
            if(!in_array($product->id, $website_feature_products_ids)) {
                $feature_products[] = array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }
            else {
                $index = array_search($product->id, array_column($feature_products, 'id'));
                $feature_products[$index] = array(
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->formatted_advance_price,
                    'picture' => $product->product_picture,
                    'category' => $product->category->title,
                    'brand' => $product->brand->title
                );
            }
        }
        $feature_products = array_values(array_unique($feature_products, SORT_REGULAR));
        $website->feature_products = json_encode($feature_products);
        $website->updated_by = Auth::user()->id;
        $website->save();
        // Update feature products in Website_Setup Table (end)

        $validator['success'] = 'Feature Products Sync successfully';
        return back()->withErrors($validator);
    }

    public function categories()
    {
        $website = WebsiteSetup::first();
        $categories = [];
        if(!is_null($website)) {
            $categories = json_decode($website->categories);
        }
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
        // Initailize Category (Start)
        $website = WebsiteSetup::first();
        $website_categories = [];
        $categories = [];
        if(!empty($website->categories) && !empty(json_decode($website->categories,true))) {
            $website_categories = array_column(json_decode($website->categories,true), 'id');
            $categories = json_decode($website->categories,true);
        }
        // Initailize Category (end)

        // Remove Category  (Start)
        $category_list_ids = Category::where('status', 'active')->where('web_home','1')->pluck('id');
        if($category_list_ids->isNotEmpty()){
            $category_list_ids = $category_list_ids->toArray();
            foreach($categories as $key => $category) {
                if(!in_array($category['id'], $category_list_ids)) {
                    unset($categories[$key]);
                }
            }
        }
        // Remove Category  (end)

        // Update Category  (Start)
        $category_list = Category::where('status', 'active')->get();
        foreach($category_list as $category) {
            //Update Category Product Count
            $product_count = Product::where('category_id', $category->id)->where('status', 'Published')->count();
            $category->pr_count = $product_count;
            $category->save();

            if(!in_array($category->id, $website_categories)) {
                $categories[] = array(
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'picture' => $category->category_picture,
                    'pr_count' => $product_count
                );
            }
            else {
                $index = array_search($category->id, array_column($categories, 'id'));
                $categories[$index] = array(
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'picture' => $category->category_picture,
                    'pr_count' => $product_count
                );
            }
        }
        $categories = array_values(array_unique($categories, SORT_REGULAR));
        $website->categories = json_encode($categories);
        $website->updated_by = Auth::user()->id;
        $category->pr_count = $product_count;
        $website->save();
        // Update Category  (Start)

        $validator['success'] = 'Categories Sync successfully';
        return back()->withErrors($validator);
    }

    public function brands()
    {
        $website = WebsiteSetup::first();
        $brands = [];
        if(!is_null($website)) {
            $brands = json_decode($website->brands);
        }
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
        $website_brands = [];
        $brands = [];
        if(!empty($website->brands) && !empty(json_decode($website->brands, true))) {
            $website_brands = array_column(json_decode($website->brands, true), 'id');
            $brands = json_decode($website->brands, true);
        }

        $website_brands_ids = Brand::where('status', 'active')->where('web_home','1')->pluck('id');
        if($website_brands_ids->isNotEmpty()){
            $website_brands_ids = $website_brands_ids->toArray();
            foreach($brands as $key => $brand) {
                if(!in_array($brand['id'], $website_brands_ids)) {
                    unset($brands[$key]);
                }
            }
        }

        $brand_list = Brand::where('status', 'active')->get();
        foreach($brand_list as $brand) {

            $product_count = Product::where('brand_id', $brand->id)->where('status', 'Published')->count();
            $brand->pr_count = $product_count;
            $brand->save();

            if(!in_array($brand->id, $website_brands)) {
                $brands[] = array('id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'picture' => $brand->brand_picture,'pr_count' => $product_count);
            }
            else {
                $index = array_search($brand->id, array_column($brands, 'id'));
                $brands[$index] = array('id' => $brand->id, 'title' => $brand->title, 'slug' => $brand->slug, 'picture' => $brand->brand_picture,'pr_count' => $product_count);
            }
        }
        $brands = array_values(array_unique($brands, SORT_REGULAR));
        $website->brands     = json_encode($brands);
        $website->updated_by = Auth::user()->id;
        $website->save();

        $validator['success'] = 'Brands Sync successfully';
        return back()->withErrors($validator);
    }

    public function sliders()
    {
        $website = WebsiteSetup::first();
        $sliders = [];
        if(!is_null($website)) {
            $sliders = json_decode($website->sliders);
        }
        return view('dashboards.admin.web-app.website.sliders', compact('sliders'));
    }

    public function slider_update(Request $request)
    {
        try {
            DB::beginTransaction();
            $slider_id = json_decode($request->slider_id, true);
            $sliders = [];
            for($i = 0; $i < count($slider_id); $i++) {
                $slider = Slider::where('id', $slider_id[$i])->first();
                if(!is_null($slider)) {
                    $sliders[] = array('id' => $slider->id, 'title' => $slider->title, 'tagline' => $slider->tagline, 'picture' => asset($slider->picture));
                }
            }
            $website = WebsiteSetup::first();
            $website->sliders = json_encode($sliders);
            $website->updated_by = Auth::user()->id;
            $website->save();

            DB::commit();

            $response = ['success' => true, 'message' => 'Slider Updated Successfully'];
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return response()->json($response);
        }
    }

    public function slider_sync()
    {
        $website = WebsiteSetup::first();
        $website_sliders = [];
        $sliders = [];
        if(!empty($website->sliders) && !empty(json_decode($website->sliders, true))) {
            $website_sliders = array_column(json_decode($website->sliders, true), 'id');
            $sliders = json_decode($website->sliders, true);
        }
        $slider_list_ids = Slider::where('status', 'active')->where('web_home','1')->pluck('id');
        if($slider_list_ids->isNotEmpty()){
            $slider_list_ids = $slider_list_ids->toArray();
            foreach($sliders as $key => $slider) {
                if(!in_array($slider['id'], $slider_list_ids)) {
                    unset($sliders[$key]);
                }
            }
        }

        $slider_list = Slider::where('status', 'active')->get();
        foreach($slider_list as $slider) {
            if(!in_array($slider->id, $website_sliders)) {
                $sliders[] = array('id' => $slider->id, 'title' => $slider->title, 'tagline' => $slider->tagline, 'picture' => asset($slider->picture));
            }
            else {
                $index = array_search($slider->id, array_column($sliders, 'id'));
                $sliders[$index] = array('id' => $slider->id, 'title' => $slider->title, 'tagline' => $slider->tagline, 'picture' => asset($slider->picture));
            }
        }
        $website->sliders     = json_encode($sliders);
        $website->updated_by = Auth::user()->id;
        $website->save();

        $validator['success'] = 'Sliders Sync successfully';
        return back()->withErrors($validator);
    }
}
