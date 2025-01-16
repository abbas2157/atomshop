<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\{Category, Brand};

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $brands->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $brands->where('status', request()->status);
        }
        if(request()->has('category_id') && !empty(request()->category_id)) {
            $brands->where('category_id', request()->category_id);
        }
        $brands = $brands->paginate(10);
        $categories = Category::orderBy('id','desc')->get();
        return view('dashboards.admin.components.brands.index',compact('brands', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('dashboards.admin.components.brands.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);
        
        $brand = new Brand;
        $brand->title = $request->title;
        $brand->slug = $request->slug;
        $brand->category_id = $request->category_id;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $picture_path = public_path('images/brands/' . $filename);
            if (File::exists($picture_path)) {
                $filename = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).rand(1,9).'.'.$extension;
            }
            $file->move(public_path('images/brands'),$filename);
            $brand->picture = 'images/brands/'.$filename;
        }
        $brand->status = $request->status;
        $brand->save();

        $validator['success'] = 'Brand created successfully';
        return back()->withErrors($validator);
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
        $brand = Brand::findOrFail($id);
        $categories = Category::orderBy('id','desc')->get();
        return view('dashboards.admin.components.brands.edit',compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required'
        ]);
        $brand = Brand::findOrFail($id);
        $brand->title = $request->title;
        $brand->slug = $request->slug;
        $brand->category_id = $request->category_id;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $picture_path = public_path('images/brands/' . $filename);
            if (File::exists($picture_path)) {
                $filename = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).rand(1,9).'.'.$extension;
            }
            $file->move(public_path('images/brands'),$filename);
            $brand->picture = 'images/brands/'.$filename;
        }
        $brand->status = $request->status;
        $brand->save();

        $validator['success'] = 'Brand updated successfully';
        return back()->withErrors($validator);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $picture = public_path('images/brands/' . $brand->picture);
        if (File::exists($picture)) {
            File::delete($picture);
        }
        $brand->delete();
        $validator['success'] = 'Brand deleted successfully';
        return back()->withErrors($validator);
    }
}
