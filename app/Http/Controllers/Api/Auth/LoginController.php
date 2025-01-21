<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use App\Models\VerifyCode;
use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;

class LoginController extends BaseController
{

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !$user->email_verified_at) {
                return $this->sendError('Your email is not verified.', ['email' => 'Email is not verified.']);
            }

            if (!Auth::attempt($credentials)) {
                return $this->sendError('Invalid login credentials', $credentials);
            }

            $success['user'] = Auth::user();
            $success['token'] = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse($success, 'User Login successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage());
        }
    }

    public function forget_password(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user = User::where('email', $request->email)->first();
            if (is_null($user)) {
                return $this->sendError('User not found.', $request->all());
            }

            $verificationCode = rand(1000, 9999);

            VerifyCode::updateOrCreate([
                'user_id' => $user->uuid,
            ], [
                'verify_code' => $verificationCode,
            ]);

            Mail::to($request->email)->send(new RegisterEmail($user, $verificationCode));

            $success['user'] = $user;
            return $this->sendResponse($success, 'Code has been sent successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage());
        }
    }

    public function verify_code(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'verify_code' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user = User::where('uuid', $request->user_id)->first();
            if (is_null($user)) {
                return $this->sendError('User not found.', $request->all());
            }

            $verifyCode = VerifyCode::where('user_id', $user->uuid)->first();
            if (is_null($verifyCode)) {
                return $this->sendError('Verify code not found.', $request->all());
            }

            if ($verifyCode->verify_code != $request->verify_code) {
                return $this->sendError('Code not matched.', $request->all());
            }

            VerifyCode::where('user_id', $user->uuid)->delete();

            $success['user'] = $user;
            return $this->sendResponse($success, 'Code verified successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage());
        }
    }

    public function reset_password(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $user = User::where('email', $request->email)->first();
            if (is_null($user)) {
                return $this->sendError('User not found.', $request->all());
            }

            $user->password = Hash::make($request->password);
            $user->save();

            $success['user'] = $user;
            return $this->sendResponse($success, 'Password has been reset successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->user()->currentAccessToken();
            if (!$token) {
                return $this->sendError('Invalid token.', []);
            }
            $token->delete();
            return $this->sendResponse([], 'Logged out successfully.');
        } catch (Exception $e) {
            return $this->sendError('Something Went Wrong.', $e->getMessage());
        }
    }

}
