<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, VerifyCode, Cart};
use Illuminate\Support\Facades\{Auth, Validator, DB, Password, Hash, Mail};
use Illuminate\Support\Str;
use App\Jobs\Web\SendVerificationCode;
use App\Jobs\Web\WelcomeEmailJob;
use Illuminate\Support\Facades\Session;

use App\Mail\Web\VerificationCode;

class AuthController extends BaseController
{
    public function login()
    {
        if (!Session::has('url.intended')) {
            Session::put('url.intended', url()->previous());
        }
        return view('website.auth.login');
    }
    public function login_perform(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Please fill all the fields.', $validator->errors(), 200);
            }
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return $this->sendError('Invalid login credentials', $credentials, 200);
            }
            $user = $success['user'] = Auth::user();
            if(is_null($success['user']->email_verified_at)) {
                Auth::logout();
                $verificationCode = rand(1000, 9999);
                VerifyCode::create([
                    'user_id' => $user->id,
                    'verify_code' => $verificationCode
                ]);
                $verify_code = $verificationCode;
                SendVerificationCode::dispatch($user,$verify_code);
                return $this->sendResponse(['user_id' => $user->uuid], 'User registered successfully!');
            }
            
            if($success['user']->status == 'block') {
                Auth::logout();
                return $this->sendError('You are blocked on this website.', $credentials, 200);
            }
            if($success['user']->status == 'support') {
                Auth::logout();
                return $this->sendError('Your account is blocked by Support Team.', $credentials, 200);
            }

            $guest_id = $request->guest_id;
            $cart = Cart::where('guest_id', $guest_id)->where('status', 'Pending')->get();
            
            if($cart->isNotEmpty()) {
                foreach($cart as $item) {
                    $item->user_id = Auth::user()->id;
                    $item->save();
                }
            }
            
            $success['back'] = Session::pull('url.intended', '/');

            return $this->sendResponse($success, 'User Login successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    public function register()
    {
        if (!Session::has('url.intended')) {
            Session::put('url.intended', url()->previous());
        }
        return view('website.auth.register');
    }
    public function register_perform(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 200);
            }
            DB::beginTransaction();

            $user = new User;
            $user->uuid = Str::uuid();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = 'pending';
            $user->password = bcrypt($request->password);
            $user->role = 'customer';
            $user->save();

            $verificationCode = rand(1000, 9999);

            VerifyCode::create([
                'user_id' => $user->id,
                'verify_code' => $verificationCode
            ]);
            $verify_code = $verificationCode;

            SendVerificationCode::dispatch($user,$verify_code);
            
            DB::commit();
            return $this->sendResponse(['user_id' => $user->uuid], 'User registered successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    public function verification()
    {
        if(!request()->has('user')) {
            return redirect()->route('website');
        }
        $user_uuid = request()->user;
        $user = User::where('uuid', $user_uuid)->first();
        if(is_null($user)) {
            return redirect()->route('website');
        }
        $code = VerifyCode::where('user_id', $user->id)->where('used', '0')->first();
        if(is_null($code)) {
            return redirect()->route('website');
        }
        return view('website.auth.verification', compact('user'));
    }
    public function verification_perform(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'user_id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return $this->sendError('Validation Error', $validator->errors()->first(), 422);
            }
    
            $user_uuid = request()->user_id;
            $user = User::where('uuid', $user_uuid)->where('status', 'pending')->first();
            if(is_null($user)) {
                return $this->sendError('User not found.', $request->all(), 200);
            }
            $user_id = $user->id;
            $verification_code = $request->input('code');
            $code = VerifyCode::where('user_id', $user_id)->where('verify_code', $verification_code)->first();
    
            if (is_null($code)) {
                return $this->sendError('Code is invalid', $request->all(), 200);
            }
            if ($code->used == '1') {
                return $this->sendError('Code is expired.', $request->all(), 200);
            } else {
                $code->used = '1';
                $code->save();
                
                if(is_null($user->email_verified_at)) {
                    WelcomeEmailJob::dispatch($user);
                }

                $user->status = 'active';
                $user->email_verified_at = now();
                $user->save();
            }
            $success['back'] = Session::pull('url.intended', url('login'));
            return $this->sendResponse($success, 'Code matched successfully.', 200);
        } catch (\Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 500);
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('login');
    }
}
