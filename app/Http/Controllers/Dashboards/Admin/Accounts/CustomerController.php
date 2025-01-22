<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Support\Str;
use App\Models\User;

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
        return view('dashboards.admin.accounts.customers.create');
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

        $user = new User;
        $user->uuid  = Str::uuid();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = 'Atom@shop!';
        $user->role = 'customer';
        $user->status = $request->status;
        $user->save();

        $validator['success'] = 'User created successfully';
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
        $customer = User::where('uuid', $id)->first();
        if(is_null($customer)) {
            return abort(404);
        }
        return view('dashboards.admin.accounts.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = User::where('uuid', $id)->first();
        if(is_null($customer)) {
            return abort(404);
        }
        $customer->name  = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->save();

        $validator['success'] = 'User updated successfully';
        return back()->withErrors($validator);
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
