<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $categories->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $categories->where('status', request()->status);
        }
        $categories = $categories->paginate(10);
        return view('dashboards.admin.components.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.admin.components.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories',
            'slug' => 'required|unique:categories'
        ]);

        $category = new Category;
        $category->title = $request->title;
        $category->slug = $request->slug;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $file->move(public_path('images/categories'),$filename);
            $category->picture = 'images/categories/'.$filename;
        }
        $category->status = $request->status;
        $category->save();

        $validator['success'] = 'Category created successfully';
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
        $category = Category::findOrFail($id);
        return view('dashboards.admin.components.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:categories,id,'.$id,
            'slug' => 'required|unique:categories,id,'.$id
        ]);
        $category = Category::findOrFail($id);

        $category->title = $request->title;
        $category->slug = $request->slug;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $file->move(public_path('images/categories'),$filename);
            $category->picture = $filename;
        }
        $category->status = $request->status;
        $category->save();

        $validator['success'] = 'Category updated successfully';
        return back()->withErrors($validator);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $picture = public_path('images/categories/' . $category->picture);
        if (File::exists($picture)) {
            File::delete($picture);
        }
        $category->delete();

        $validator['success'] = 'Category deleted successfully';
        return back()->withErrors($validator);
    }
}
