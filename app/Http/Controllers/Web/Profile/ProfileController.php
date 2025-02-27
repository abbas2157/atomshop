<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Customer, Cart, Order, City, Area};
use Illuminate\Support\Facades\{Auth, DB, Password, Hash, Mail};
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('id', 'desc')->get();
        $areas = Area::orderBy('id', 'desc')->get();
        return view('website.profile.index', compact('cities', 'areas'));
    }
    public function profile_update(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'name'    => 'required',
                'city_id' => 'required',
                'area_id' => 'required',
                'address' => 'required'
            ]);

            $user = User::where('uuid', Auth::user()->uuid)->first();
            if (is_null($user)) {
                $validator['error'] = 'User not found.';
                return back()->withErrors($validator);
            }

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->save();

            $customer = Customer::where('user_id', $user->id)->first();
            if(is_null($customer)) {
                $customer = new Customer;
            }
            $customer->city_id = $request->city_id;
            $customer->area_id = $request->area_id;
            $customer->address = $request->address;
            $customer->save();

            $validator['success'] = 'Profile updated successfully.';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            $validator['error'] = 'Profile not updated Error...';
            return back()->withErrors($validator);
        }
    }
    public function password()
    {
        return view('website.profile.password');
    }
    public function password_update(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        try {
            $user = auth()->user();
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            $validator['success'] = 'Password updated successfully.';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            $validator['error'] = 'Password not updated Error...';
            return back()->withErrors($validator);
        }
    }
    public function verification()
    {
        return view('website.profile.verification');
    }
    public function favorite()
    {
        return view('website.profile.favorite');
    }
}
