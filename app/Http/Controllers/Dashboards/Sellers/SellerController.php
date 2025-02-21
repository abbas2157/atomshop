<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Seller, Customer};
use Illuminate\Support\Facades\{Auth, Hash, DB, Mail};


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $sellers = Seller::where('area_id', $area_id)->pluck('user_id');
        $customer_ids = [];
        if($sellers->isNotEmpty()) {
            $customer_ids =  $sellers->toArray();
        }
        $sellers = User::whereIn('id', $customer_ids)->paginate(10);
        return view('dashboards.sellers.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
