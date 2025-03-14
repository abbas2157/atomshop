<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Category, Brand, CustomOrderProduct, CustomOrder};
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class CustomOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $orders = CustomOrder::where('area_id', $area_id)->select('id','uuid', 'product_id', 'user_id', 'portal', 'status', 'created_at');
        if(request()->has('status') && !empty(request()->status)) {
            $orders->where('status', request()->status);
        }
        if(request()->has('portal') && !empty(request()->portal)) {
            $orders->where('portal', request()->portal);
        }
        $orders = $orders->orderBy('id','desc')->paginate(10);
        return view('dashboards.sellers.custom-orders.index',compact('orders'));
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
