<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Mail, Hash};
use App\Mail\ForgotPaswordMail;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function forgot_password()
    {
        return view('dashboards.auth.password.forgot');
    }
    public function send_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where("email",$request->email)->first();
        if(is_null($user))
        {
            $validator['error'] = 'Your Email is not registered with any account.';
            return back()->withErrors($validator);
        }
        Mail::to($user->email)->send(new ForgotPaswordMail($user));
        $validator['success'] = 'We have sent verification mail on your email. Please check your mailbox and follow instructions.';
        return back()->withErrors($validator);
    }
    public function reset_password(string $id)
    {
        $user = User::where('uuid',$id)->first();
        if(is_null($user))
            abort(404);
        return view('dashboards.auth.password.reset',compact('user'));
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'password' => ['required','confirmed'],
            'password_confirmation' => 'required'
        ]);
        $user = User::where('uuid',$request->uuid)->first();
        if(is_null($user)) {
            $validator['success'] = 'User not found.';
            return redirect('login')->withErrors($validator);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        if($user->role == 'admin') {
            return redirect()->route('admin');
        }
        if($user->role == 'seller') {
            return redirect()->route('seller');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role == 'admin') {
                return redirect()->route('admin');
            }
            if($user->role == 'seller') {
                if(is_null($user->seller)) {
                    Auth::logout();
                    $validator['error'] = 'Your Seller information is not completed. Please contact with our Support Team.';
                    return redirect("portal/login")->withErrors($validator);
                }
                if($user->seller->verified = '0') {
                    Auth::logout();
                    $validator['error'] = 'You are not verified by our Support Team. Please contact with our Support Team.';
                    return redirect("portal/login")->withErrors($validator);
                }
                return redirect()->route('seller');
            }
        }
        $validator['error'] = 'Your details are incorrect.';
        return redirect("portal/login")->withErrors($validator);
    }

    /**
     * Display the specified resource.
     */
    public function verify(string $id)
    {
        $user = User::where("uuid",$id)->first();
        if(is_null($user))
            abort(404);
        $user->markEmailAsVerified();
        $validator['success'] = 'Your Account has been verified. Login Now';
        return redirect('login')->withErrors($validator);
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
    public function destroy()
    {
        Auth::logout();
        return redirect('portal/login');
    }
}
