<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Support\Str;
use App\Models\User;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = User::orderBy('id','desc')->where('role', 'vendor');
        if(request()->has('q') && !empty(request()->q)) {
            $vendors->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $vendors->where('email', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $vendors->where('phone', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $vendors->where('status', request()->status);
        }
        $vendors = $vendors->paginate(10);
        return view('dashboards.admin.accounts.vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.admin.accounts.vendors.create');
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
        $user->role = 'vendor';
        $user->status = $request->status;
        $user->save();

        $validator['success'] = 'Vendors created successfully';
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
        $vendor = User::where('uuid', $id)->first();
        if(is_null($vendor)) {
            return abort(404);
        }
        return view('dashboards.admin.accounts.vendors.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = User::where('uuid', $id)->first();
        if(is_null($vendor)) {
            return abort(404);
        }
        $vendor->name  = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->status = $request->status;
        $vendor->save();

        $validator['success'] = 'Vendor updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = User::where('uuid', $id)->first();
        $vendor->delete();
        $validator['success'] = 'Vendor deleted successfully';
        return back()->withErrors($validator);
    }
}
