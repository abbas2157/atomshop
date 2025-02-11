<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use App\Models\{User, Seller, City, Area};
use Illuminate\Support\Str;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        $areas = [];
        if($cities->isNotEmpty()) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.sellers.sellers.index', compact('cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
           //
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
    public function update(Request $request)
    {
        $user = Auth::user();        
        $seller = $user->seller ?? new Seller();
        $seller->user_id = $user->id;
        $seller->name = $request->name;
        $seller->business_name = $request->business_name;
        $seller->cnic_number = $request->cnic_number;
        $seller->website = $request->website;
        $seller->city_id = $request->city_id;
        $seller->area_id = $request->area_id;
        $seller->address = $request->address;
        $seller->investment_capacity = $request->investment_capacity;
        $seller->previous_experience = $request->previous_experience;
        $seller->save();
        $validator['success'] = 'Seller Updated Successfully.';
        return back()->withErrors($validator);   
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = User::where('uuid', $id)->first();
        $vendor->delete();
        $validator['success'] = 'Vendor deleted successfully';
        return back()->withErrors($validator);
    }
}

