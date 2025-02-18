<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use App\Models\{User, Seller, City, Area};

class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.sellers.profile.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function picture_update(Request $request)
    {
        $file = $request->file('profile_picture');
        $fileName = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $filename = time() .'-'. rand(10000,99999).'-'. preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ','-',strtolower($fileName))).'.'.$extension;
        $file->move(public_path('profile_pictures'),$filename);

        $user = Auth::user();
        $user->profile_picture = $filename;
        $user->save();
        $validator['success'] = 'Profile Picture Updated.';
        return back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     */
    public function password(Request $request)
    {
        return view('dashboards.sellers.profile.password');
    }
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
    public function business_info()
    {
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        $areas = [];
        if($cities->isNotEmpty()) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.sellers.profile.business-info', compact('cities', 'areas'));
    }
    public function business_info_perform(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $seller = Seller::where('user_id', Auth::user()->id)->first();
        if(is_null($seller)) {
            $seller = new Seller;
        }
        $seller->business_name = $request->business_name;
        $seller->investment_capacity = $request->investment_capacity;
        $seller->previous_experience = $request->previous_experience;
        $seller->city_id = $request->city_id;
        $seller->area_id = $request->area_id;
        $seller->address = $request->address;
        $seller->user_id =  Auth::user()->id;
        $seller->save();

        $validator['success'] = 'Business Information Updated Successfully.';
        return back()->withErrors($validator);
    }
    public function seller_info()
    {
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        $areas = [];
        if($cities->isNotEmpty()) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.sellers.profile.seller-info', compact('cities', 'areas'));
    }
    public function seller_info_perform(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $seller = Seller::where('user_id', Auth::user()->id)->first();
        if(is_null($seller)) {
            $seller = new Seller;
        }
        $seller->name = $request->name;
        $seller->cnic_number = $request->cnic_number;
        $seller->website = $request->website;
        $seller->user_id =  Auth::user()->id;
        $seller->save();

        $validator['success'] = 'Seller Information Updated Successfully.';
        return back()->withErrors($validator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::where('id',Auth::user()->id)->first();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        $validator['success'] = 'Profile Updated Successfully.';
        return back()->withErrors($validator);
    }

}
