<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Seller, Order, ActiveSeller};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
     {
        $authUser = Auth::user();
        $data = [];

        if ($authUser->seller) {
            $active_areas_ids = [];
            $active_areas = ActiveSeller::where('user_id', Auth::user()->id)->pluck('area_id');
            if($active_areas->isNotEmpty()) {
                $active_areas_ids = $active_areas->toArray();
            }

            $customers = Customer::whereIn('area_id', $active_areas_ids)->pluck('user_id');
            $filteredCustomers = User::whereIn('id', $customers)->get();

            $lastcustomer = User::whereIn('id', $customers)->where('role', 'customer')->orderBy('id', 'desc')
                ->take(5)->get();

            $lastOrders = Order::whereIn('user_id', $customers)
                ->select('id', 'uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at')
                ->orderBy('id', 'desc')->take(5)->get();

            $orders = Order::whereIn('user_id', $customers)->get();
         } 
         else {
            $filteredCustomers = collect();
            $lastcustomer = collect();
            $lastOrders = collect();
            $orders = collect();
         }
 
        $sellers = Seller::all();
        $data['customers'] = [
            'total' => $filteredCustomers->count(),
            'verified' => $filteredCustomers->where('verified', 1)->count(),
        ];

        $data['sellers'] = [
            'total' => $sellers->count(),
            'verified' => $sellers->where('verified', 1)->count(),
        ];

        $data['orders'] = [
             'total' => $orders->count(),
             'pending' => $orders->where('status', 'Pending')->count(),
             'verification' => $orders->where('status', 'Verification')->count(),
             'processing' => $orders->where('status', 'Processing')->count(),
             'delivered' => $orders->where('status', 'Delivered')->count(),
             'instalments' => $orders->where('status', 'Instalments')->count(),
             'Completed' => $orders->where('status','Completed')->count()
        ];
        $data['lastcustomer'] = $lastcustomer;
        $data['lastOrders'] = $lastOrders;

        return view('dashboards.sellers.index', $data);
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
