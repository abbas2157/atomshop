<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $sizes->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('slug') && !empty(request()->slug)) {
            $sizes->where('slug', request()->slug);
        }
        if(request()->has('unit') && !empty(request()->unit)) {
            $sizes->where('unit', request()->unit);
        }
        if(request()->has('status') && !empty(request()->status)) {
            $sizes->where('status', request()->status);
        }
        $sizes = $sizes->paginate(10);
        $units = config('website.units');
        return view('dashboards.admin.components.sizes.index',compact('sizes', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Size::orderBy('id', 'desc')->get();
        $units = config('website.units');
        return view('dashboards.admin.components.sizes.create', compact('sizes', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $sizes = new Size;
        $sizes->title = $request->title;
        $sizes->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $sizes->unit = $request->unit;
        $sizes->status = $request->status;
        $sizes->save();

        $validator['success'] = 'Size created successfully';
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
        $sizes = Size::findOrFail($id);
        $units = config('website.units');
        return view('dashboards.admin.components.sizes.edit', compact('sizes', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $sizes = Size::findOrFail($id);
        $sizes->title = $request->title;
        $sizes->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $sizes->unit = $request->unit;
        $sizes->status = $request->status;
        $sizes->save();

        $validator['success'] = 'Size updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sizes = Size::findOrFail($id);
        $sizes->delete();
        $validator['success'] = 'Size deleted successfully';
        return back()->withErrors($validator);
    }
}
