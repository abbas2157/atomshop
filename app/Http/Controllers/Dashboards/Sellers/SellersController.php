<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use App\Models\{User, Seller, City, Area};
use Illuminate\Support\Str;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return view('dashboards.sellers.sellers.index', compact('cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */

        public function password(Request $request)
        {
            return view('dashboards.sellers.sellers.password');
        }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required'
        ]);
        if ($request->get('new_password') !== $request->get('confirm_new_password'))
        {
            $validator['confirm_new_password'] = 'Please Confirm Password Correctly.';
            return redirect('seller/profile?password')->withErrors($validator);
        }
        $auth = Auth::user();
        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password))
        {
            $validator['current_password'] = 'Current Password is Invalid';
            return redirect('seller/profile?password')->withErrors($validator);
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0)
        {
            $validator['new_password'] = 'New Password cannot be same as your current password.';
            return redirect('seller/profile?password')->withErrors($validator);
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();

        $validator['success'] = 'Password Changed Successfully';
        return back()->withErrors($validator);
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
    public function update(Request $request)
    {
        $user = Auth::user();        
        $seller = $user->seller ?? new Seller();
        $seller->user_id = $user->id;
        $seller->name = $request->name;
        $seller->business_name = $request->business_name;
        $seller->cnic_number = $request->cnic_number;
        $seller->website = $request->website;
        $seller->city_id = $request->city_id;
        $seller->area_id = $request->area_id;
        $seller->address = $request->address;
        $seller->investment_capacity = $request->investment_capacity;
        $seller->previous_experience = $request->previous_experience;
        $seller->save();
        $validator['success'] = 'Seller Updated Successfully.';
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

