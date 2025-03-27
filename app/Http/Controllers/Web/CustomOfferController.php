<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\{User,Category, Brand, Customer, City, Area, InstallmentCalculator};
use Illuminate\Support\Facades\{Auth, DB, Session};

class CustomOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
        if (is_null($calculator)) {
            abort(404);
        }
        $cities = City::orderBy('id', 'desc')->get();
        $areas = Area::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.custom-offer.index', compact('calculator', 'categories', 'cities', 'areas'));
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
