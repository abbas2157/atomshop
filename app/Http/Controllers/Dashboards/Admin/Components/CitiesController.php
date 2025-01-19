<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $cities->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $cities->where('provice', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $cities->where('country', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $cities->where('status', request()->status);
        }
        $cities = $cities->paginate(10);
        return view('dashboards.admin.components.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.admin.components.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:cities',
        ]);
        $cities = new City;
        $cities->title = $request->title;
        $cities->provice = $request->provice;
        $cities->country = $request->country;
        $cities->status = $request->status;
        $cities->save();
        $validator['success'] = 'City created successfully';
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
        $city = City::findOrFail($id);
        return view('dashboards.admin.components.cities.edit',compact('city'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:cities,id,'.$id,
        ]);
        $cities = City::findOrFail($id);
        $cities->title = $request->title;
        $cities->provice = $request->provice;
        $cities->country = $request->country;
        $cities->status = $request->status;
        $cities->save();

        $validator['success'] = 'City Updated successfully';
        return back()->withErrors($validator);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        $validator['success'] = 'City deleted successfully';
        return back()->withErrors($validator);
    }
}
