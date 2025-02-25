<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, Seller, Customer, City, Area};
use Illuminate\Support\Facades\{Auth, Hash, DB, Mail};

class CustomerController extends Controller
{
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $customers = Customer::where('area_id', $area_id)->pluck('user_id');
        $customer_ids = [];
        if ($customers->isNotEmpty()) {
            $customer_ids =  $customers->toArray();
        }
        $customers = User::whereIn('id', $customer_ids)->where('joined_through', 'Seller')->paginate(10);
        return view('dashboards.sellers.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id', 'desc')->where('status', 'active')->get();
        $areas = [];
        if ($cities->isNotEmpty()) {
            $areas = Area::orderBy('id', 'desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.sellers.customers.create', compact('cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:250|unique:users'
        ]);
        try {
            DB::beginTransaction();

            $user = new User;
            $user->uuid  = Str::uuid();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = 'Atom@shop!';
            $user->role = 'customer';
            $user->status = $request->status;
            $user->joined_through = 'Seller';
            $user->save();

            $customer = new Customer;
            $customer->user_id  = $user->id;
            $customer->city_id = $request->city_id;
            $customer->area_id = $request->area_id;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();

            $validator['success'] = 'User created successfully';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
    }
}
