<?php

namespace App\Http\Controllers\Dashboards\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\User;

class ProfileController extends Controller
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
        return view('dashboards.admin.profile.index');
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
        return view('dashboards.admin.profile.password');
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
            return redirect('admin/profile?password')->withErrors($validator);
        }
        $auth = Auth::user();
        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password))
        {
            $validator['current_password'] = 'Current Password is Invalid';
            return redirect('admin/profile?password')->withErrors($validator);
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0)
        {
            $validator['new_password'] = 'New Password cannot be same as your current password.';
            return redirect('admin/profile?password')->withErrors($validator);
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
        $user = User::where('id',Auth::user()->id)->first();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        $validator['success'] = 'Profile Updated Successfully.';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
