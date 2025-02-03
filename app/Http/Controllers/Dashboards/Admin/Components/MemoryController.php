<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;

class MemoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memory = Memory::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $memory->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('slug') && !empty(request()->slug)) {
            $memory->where('slug', request()->slug);
        }
        if(request()->has('status') && !empty(request()->status)) {
            $memory->where('status', request()->status);
        }
        $memory = $memory->paginate(10);
        return view('dashboards.admin.components.memory.index',compact('memory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $memory = Memory::orderBy('id','desc')->get();
        return view('dashboards.admin.components.memory.create',compact('memory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        
        $memory = new Memory;
        $memory->title = $request->title;
        $memory->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $memory->status = $request->status;
        $memory->save();

        $validator['success'] = 'Memory created successfully';
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
        $memory = Memory::findOrFail($id);
        return view('dashboards.admin.components.memory.edit',compact('memory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $memory = Memory::findOrFail($id);
        $memory->title = $request->title;
        $memory->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $memory->status = $request->status;
        $memory->save();

        $validator['success'] = 'Memory updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $memory = Memory::findOrFail($id);
        $memory->delete();
        $validator['success'] = 'Memory deleted successfully';
        return back()->withErrors($validator);
    }
}
