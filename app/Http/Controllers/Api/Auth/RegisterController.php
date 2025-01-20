<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\VerifyCode;
use App\Mail\RegisterEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Api\BaseController;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|max:250|unique:users',
                'password' => 'required'
            ]);

            $user = new User;
            $user->uuid = Str::uuid();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'customer';
            $user->save();

            $verificationCode = rand(1000, 9999);

            VerifyCode::create([
                'user_id' => $user->uuid,
                'verify_code' => $verificationCode
            ]);

            Mail::to($request->email)->send(new RegisterEmail($user, $verificationCode));

            DB::commit();

            return $this->sendResponse(['user_id' => $user->uuid], 'User registered successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage(), [], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendError('Validation error', $e->errors(), 422);
        }
    }

    public function emailverify(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'verify_code' => 'required',
            ]);

            $userId = $request->input('user_id');
            $verifyCode = $request->input('verify_code');

            $verifyCodeRecord = VerifyCode::where('user_id', $userId)
                ->where('verify_code', $verifyCode)
                ->first();

            if (!$verifyCodeRecord) {
                return $this->sendError('Invalid verification code', [], 401);
            }

            $user = User::where('uuid', $userId)->first();
            $user->email_verified_at = now();
            $user->save();

            VerifyCode::where('user_id', $userId)->delete();

            return $this->sendResponse([], 'Email verified successfully!');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendError('Validation error', $e->errors(), 422);
        }
    }
}
