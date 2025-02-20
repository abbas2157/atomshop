<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use Illuminate\Support\Str;
use App\Models\{User, Customer, City, Area};

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::orderBy('id','desc')->where('role', 'customer');
        if(request()->has('q') && !empty(request()->q)) {
            $customers->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $customers->where('email', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $customers->where('phone', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $customers->where('status', request()->status);
        }
        $customers = $customers->paginate(10);
        return view('dashboards.admin.accounts.customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        $areas = [];
        if($cities->isNotEmpty()) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.admin.accounts.customers.create', compact('cities', 'areas'));
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
            $user->joined_through = 'Admin';
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

        } catch (Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
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
        $user = User::with('customer')->where('uuid', $id)->first();
        if(is_null($user)) {
            return abort(404);
        }
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        if(is_null($user->customer)) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        else {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $user->customer->city_id)->get();
        }
        return view('dashboards.admin.accounts.customers.edit',compact('user', 'cities', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $id)->first();
            if(is_null($user)) {
                return abort(404);
            }
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $customer = Customer::where('user_id', $user->id)->first();
            if(is_null($customer)) {
                $customer = new Customer;
                $customer->user_id  = $user->id;
            }

            $customer->city_id = $request->city_id;
            $customer->area_id = $request->area_id;
            $customer->address = $request->address;
            $customer->save();

            DB::commit();

            $validator['success'] = 'User updated successfully';
            return back()->withErrors($validator);
        } catch (Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = User::where('uuid', $id)->first();
        $customer->delete();
        $validator['success'] = 'Customer deleted successfully';
        return back()->withErrors($validator);
    }
}
