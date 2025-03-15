<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Area, City, Seller, ActiveSeller};
use Illuminate\Support\Facades\Auth;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $areas->where('title', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $areas->where('lat', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $areas->where('lng', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $areas->where('city_id', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $areas->where('status', request()->status);
        }
        $areas = $areas->paginate(10);
        $cities = City::orderBy('id','desc')->get();
        return view('dashboards.admin.components.areas.index',compact('areas', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id','desc')->get();
        $sellers = Seller::all();
        return view('dashboards.admin.components.areas.create', compact('cities', 'sellers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:areas',
            'seller_ids' => 'required|array|min:1',
        ]);
        $areas = new Area;
        $areas->title = $request->title;
        $areas->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $areas->lat = $request->lat;
        $areas->lng = $request->lng;
        $areas->city_id = $request->city_id;
        $areas->status = $request->status;
        $areas->save();

        if (is_array($request->seller_ids)) {
            foreach ($request->seller_ids as $seller_id) {
                ActiveSeller::create([
                    'user_id' => Auth::id(), 
                    'area_id' => $areas->id,
                    'seller_id' => $seller_id,
                    'status' => 'Active',
                ]);
            }
        }

        $validator['success'] = 'Area created successfully';
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
        $cities = City::orderBy('id', 'desc')->get();
        $areas = Area::with('activeSellers')->findOrFail($id);
        $sellers = Seller::all();
        $selectedSellers = $areas->activeSellers->pluck('seller_id')->toArray(); 

        return view('dashboards.admin.components.areas.edit', compact('areas', 'cities', 'sellers', 'selectedSellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:areas,id,'.$id,
        ]);
        $areas = Area::findOrFail($id);
        $areas->title = $request->title;
        $areas->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
        $areas->lat = $request->lat;
        $areas->lng = $request->lng;
        $areas->city_id = $request->city_id;
        $areas->status = $request->status;
        $areas->save();

        ActiveSeller::where('area_id', $id)->delete();

        if (is_array($request->seller_ids)) {
            foreach ($request->seller_ids as $seller_id) {
                ActiveSeller::create([
                    'user_id' => Auth::id(),
                    'area_id' => $areas->id,
                    'seller_id' => $seller_id,
                    'status' => 'Active',
                ]);
            }
        }

        $validator['success'] = 'Area Updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $areas = Area::findOrFail($id);
        $areas->delete();
        $validator['success'] = 'Area deleted successfully';
        return back()->withErrors($validator);
    }

}
