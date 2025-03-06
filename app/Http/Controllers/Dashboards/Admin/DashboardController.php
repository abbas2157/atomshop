<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\{User, Customer, Seller, Order, OrderInstalment};

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $lastcustomer = User::orderBy('id', 'desc')->where('role', 'customer')->take(5)->get();
        $lastOrders = Order::select('id','uuid', 'cart_id', 'user_id', 'portal', 'status', 'created_at')->orderBy('id', 'desc')->take(5)->get();
        $lastInstalments = OrderInstalment::withOrderDetails()
         ->select('id', 'month', 'installment_price', 'status', 'type', 'order_id', 'user_id')
         ->where('status', 'Unpaid')->orderBy('id', 'asc')->get()->groupBy('user_id')->take(5)->map(function ($instalments) { return $instalments->first(); });
        $sellers = Seller::all();
        $orders = Order::all();
        $data = [];
        $data['customers'] = array(
            'total' => $customers->count(),
            'verified' => $customers->where('verified','1')->count()
        );
        $data['sellers'] = array(
            'total' => $sellers->count(),
            'verified' => $sellers->where('verified','1')->count()
        );
        $data['orders'] = array(
            'total' => $orders->count(),
            'pending' => $orders->where('status','Pending')->count(),
            'varification' => $orders->where('status','Varification')->count(),
            'processing' => $orders->where('status','Processing')->count(),
            'delivered' => $orders->where('status','Delivered')->count(),
            'instalments' => $orders->where('status','Instalments')->count(),
            'Completed' => $orders->where('status','Completed')->count()
        );
        $data['lastcustomer'] = $lastcustomer;
        $data['lastOrders'] = $lastOrders;
        $data['lastInstalments'] = $lastInstalments;
        return view('dashboards.admin.index', $data);
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
