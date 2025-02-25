<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Seller, Customer, Cart};
use Illuminate\Support\Facades\{Auth, Hash, DB, Mail};


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $sellers = Seller::with('city', 'area', 'user')->where('area_id', $area_id)->get();
        
        $orders = [];
        foreach ($sellers as $seller) {
            $sellerOrders = Cart::where('user_id', $seller->user->id)->get();
            foreach ($sellerOrders as $order) {
                $customer = Customer::where('user_id', $order->user_id)->first();
                $orders[] = [
                    'seller' => $seller,
                    'order' => $order,
                    'customer' => $customer,
                ];
            }
        }
        return view('dashboards.sellers.sellers.index', compact('orders'));
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
