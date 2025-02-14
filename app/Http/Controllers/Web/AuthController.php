<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, VerifyCode, Cart};
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\{Auth, Validator, DB, Password, Hash, Mail};

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
}
