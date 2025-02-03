<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $colors->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('slug') && !empty(request()->slug)) {
            $colors->where('slug', request()->slug);
        }
        if(request()->has('code') && !empty(request()->code)) {
            $colors->where('code', request()->code);    
        }
        if(request()->has('status') && !empty(request()->status)) {
            $colors->where('status', request()->status);
        }
        $colors = $colors->paginate(10);
        return view('dashboards.admin.components.colors.index',compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::orderBy('id','desc')->get();
        return view('dashboards.admin.components.colors.create',compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        
        $colors = new Color;
        $colors->title = $request->title;
        $colors->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $colors->code = $request->code;
        $colors->status = $request->status;
        $colors->save();

        $validator['success'] = 'Color created successfully';
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
        $colors = COlor::findOrFail($id);
        return view('dashboards.admin.components.colors.edit',compact('colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $colors = Color::findOrFail($id);
        $colors->title = $request->title;
        $colors->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $colors->code = $request->code;
        $colors->status = $request->status;
        $colors->save();

        $validator['success'] = 'Color updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $colors = Color::findOrFail($id);
        $colors->delete();
        $validator['success'] = 'Color deleted successfully';
        return back()->withErrors($validator);
    }
}
