<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Seller, Order, CustomOrder, ActiveSeller, OrderInstalment};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
     {
        $days = 30;
        $data = [];
        $data['today_date'] = Carbon::today()->format('M d, Y');
        $data['previous_30_date'] = Carbon::today()->subDays($days)->format('M d, Y');
        $user = Auth::user();

        $active_areas_ids = [];
        $active_areas = ActiveSeller::where('user_id', Auth::user()->id)->pluck('area_id');
        if($active_areas->isNotEmpty()) {
            $active_areas_ids = $active_areas->toArray();
        }
        $customers = Customer::whereIn('area_id', $active_areas_ids)->pluck('user_id');

        //Listings
        $data['customers'] = User::whereIn('id', $customers)->where('role', 'customer')->orderBy('id', 'desc')->take(5)->get();
        $data['orders'] = Order::whereIn('area_id', $active_areas_ids)->whereBetween('created_at', [Carbon::now()->subDays($days), Carbon::now()])->orderBy('id', 'desc')->select('id', 'uuid', 'total_deal_price', 'cart_id', 'user_id', 'portal', 'status', 'created_at')->get();
        $data['custom_orders'] = CustomOrder::whereIn('area_id', $active_areas_ids)->whereBetween('created_at', [Carbon::now()->subDays($days), Carbon::now()])->orderBy('id', 'desc')->select('id', 'uuid', 'total_deal_price', 'product_id', 'user_id', 'portal', 'status', 'created_at')->get();

        //Counts 
        $order_ids = $data['orders']->pluck('id')->toArray();
        $data['total_sales'] = $data['orders']->whereIn('status',['Delivered', 'Instalments', 'Completed'])->sum('total_deal_price');
        $data['total_custom_sales'] = $data['custom_orders']->whereIn('status',['Delivered', 'Instalments', 'Completed'])->sum('total_deal_price');

        $data['total_recovery'] = OrderInstalment::whereIn('order_id', $order_ids)->where('order_type', 'Normal')->where('status', 'Paid')->whereBetween('created_at', [Carbon::now()->subDays($days), Carbon::now()])->sum('installment_price');
        $data['total_custom_recovery'] = OrderInstalment::whereIn('order_id', $order_ids)->where('order_type', 'Custom')->where('status', 'Paid')->whereBetween('created_at', [Carbon::now()->subDays($days), Carbon::now()])->sum('installment_price');
        $data['total_recovery_percentage'] = 0;
        if($data['total_recovery'] > 0 && $data['total_sales'] > 0) {
            $data['total_recovery_percentage'] = round(($data['total_recovery']/$data['total_sales']) * 100, 2);
        }
        $data['total_custom_recovery_percentage'] = 0;
        if($data['total_custom_recovery'] > 0 && $data['total_custom_sales'] > 0) {
            $data['total_custom_recovery_percentage'] = round(($data['total_custom_recovery']/$data['total_custom_sales']) * 100, 2);
        }
        $data['total_customers'] = count($customers);
        
        // dd($data['total_sales']);
        return view('dashboards.sellers.index', $data);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function coming_soon()
    {
        return view('dashboards.sellers.coming-soon');
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
