<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Brand, Color, Memory};
use App\Models\{ProductDescription, ProductImage, ProductColor, ProductMemory};
use Illuminate\Support\Facades\{Auth, Hash, DB};
use Illuminate\Support\Str;


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
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = [];
        if($categories->isNotEmpty()) {
            $brands = Brand::orderBy('id','desc')->where('status', 'active')->where('category_id', $categories[0]->id)->get();
        }
        $colors = Color::orderBy('id', 'desc')->where('status', 'active')->get();
        $memories = Memory::orderBy('id', 'desc')->where('status', 'active')->get();

        return view('dashboards.admin.components.products.create', compact('categories', 'brands', 'colors', 'memories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $product = new Product;
            $product->uuid  = Str::uuid();
            $product->title  = $request->title;
            $product->slug  = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            if($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
                $file->move(public_path('images/categories'),$filename);
                $product->picture = 'images/products/'.$filename;
            }
            $product->status = $request->status;
            $product->save();

            $product->pr_number = 'PR-'.$product->id;
            $product->save();

            $description = new ProductDescription;
            $description->product_id = $product->id;
            $description->short = $request->short;
            $description->long = $request->long;
            $description->save();

            if(!empty($request->colors)) {
                $colors = $request->colors;
                for($i = 0; $i < count($colors); $i++){
                    $color = new ProductColor;
                    $color->product_id = $product->id;
                    $color->color_id = $colors[$i];
                    $color->save();
                }
            }

            if(!empty($request->memory)) {
                $memories = $request->memory;
                for($i = 0; $i < count($memories); $i++){
                    $memory = new ProductMemory;
                    $memory->product_id = $product->id;
                    $memory->memory_id = $memories[$i];
                    $memory->save();
                }
            }
            

            DB::commit();

            $response = [ 'success' => true, 'message' => 'Product Published Successfully'];
            return response()->json($response);

        } catch (Exception $e) {
            DB::rollBack();
            $response = [ 'success' => true, 'message' => $e->getMessage()];
            return response()->json($response);
        }
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
