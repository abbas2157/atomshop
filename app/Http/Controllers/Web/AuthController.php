<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, VerifyCode, Cart};
use Illuminate\Support\Facades\{Auth, Validator, DB, Password, Hash, Mail};
use Illuminate\Support\Str;
use App\Jobs\Web\SendVerificationCode;

class AuthController extends BaseController
{
    public function login()
    {
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
            $guest_id = $request->guest_id;
            $cart = Cart::where('guest_id', $guest_id)->where('status', 'Pending')->get();
            
            if($cart->isNotEmpty()) {
                foreach($cart as $item) {
                    $item->user_id = Auth::user()->id;
                    $item->save();
                }
            }
            $success['user'] = Auth::user();

            return $this->sendResponse($success, 'User Login successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    public function register()
    {
        return view('website.auth.register');
    }
    public function register_perform(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
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
            $user->status = 'pending';
            $user->password = bcrypt($request->password);
            $user->role = 'customer';
            $user->save();

            $verificationCode = rand(1000, 9999);

            VerifyCode::create([
                'user_id' => $user->id,
                'verify_code' => $verificationCode
            ]);
            $user->verify_code = $verificationCode;

            SendVerificationCode::dispatch($user);
            
            DB::commit();
            return $this->sendResponse(['user_id' => $user->uuid, 'code' => $verificationCode], 'User registered successfully!');

        } catch (Exception $e) {
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
        $user = User::where('uuid', $user_uuid)->where('status', 'pending')->first();
        if(is_null($user)) {
            return redirect()->route('website');
        }
        return view('website.auth.verification', compact('user'));
    }
    public function verification_perform(Request $request)
    {
        try {
            DB::beginTransaction();

            if(!request()->has('user_id')) {
                return $this->sendError('User not found.', $request->all(), 200);
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

                $user->status = 'active';
                $user->email_verified_at = now();
                $user->save();
            }
            $success['user'] = $user;

            $guest_id = $request->guest_id;
            $cart = Cart::where('guest_id', $guest_id)->where('status', 'Pending')->get();
            
            if($cart->isNotEmpty()) {
                foreach($cart as $item) {
                    $item->user_id = Auth::user()->id;
                    $item->save();
                }
            }
            DB::commit();

            return $this->sendResponse('Code matched successfully.', $request->all(), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
}
