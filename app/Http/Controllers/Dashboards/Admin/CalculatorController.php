<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\InstallmentCalculator;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calculator = InstallmentCalculator::first();
        return view('dashboards.admin.calculator.index', compact('calculator'));
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
        $request->validate([
            'installment_tenure' => 'required',
            'per_month_percentage' => 'required',
        ]);

        $calculator = InstallmentCalculator::first();
        if(is_null($calculator)) {
            $calculator = new InstallmentCalculator;
        }
        $calculator->installment_tenure = json_encode($request->installment_tenure);
        $calculator->per_month_percentage = $request->per_month_percentage;
        $calculator->save();

        $validator['success'] = 'Calculator has updated successfully';
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
