<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB, Mail};
use App\Models\{User, Seller, Customer};

class CustomerController extends Controller
{
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $customers = Customer::where('area_id', $area_id)->pluck('user_id');
        $customer_ids = [];
        if($customers->isNotEmpty()) {
            $customer_ids =  $customers->toArray();
        }
        $customers = User::whereIn('id', $customer_ids)->paginate(10);
        return view('dashboards.sellers.customers.index', compact('customers'));
    }
}
