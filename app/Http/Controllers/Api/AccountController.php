<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\Web\WelcomeEmailJob;
use App\Http\Controllers\Controller;
use App\Jobs\Web\SendVerificationCode;
use App\Models\{User, VerifyCode, Cart};
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\{Auth, Validator, DB, Password, Hash, Mail};
class AccountController extends BaseController
{

    /**
     * Create Account API
     */
    public function create_account(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 200);
            }
            DB::beginTransaction();

            $user = new User;
            $user->uuid = Str::uuid();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'customer';
            $user->save();

            $verificationCode = rand(1000, 9999);

            VerifyCode::create([
                'user_id' => $user->id,
                'verify_code' => $verificationCode
            ]);

            SendVerificationCode::dispatch($user,$verificationCode);

            DB::commit();
            return $this->sendResponse(['user_id' => $user->uuid, 'code' => $verificationCode], 'User registered successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Login User API
     */
    public function login(Request $request)
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
            $success['token'] =  $success['user']->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($success, 'User Login successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something Went Wrong.', $e->getMessage(), 200);
        }
    }
    /**
     * Send Code on Email API
     */
    public function send_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return $this->sendError('User not found.', $request->all(), 200);
        }

        $code = rand(1000, 9999);
        VerifyCode::create([
            'user_id' => $user->id,
            'verify_code' => $code
        ]);

        SendVerificationCode::dispatch($user,$code);

        $success['user'] = $user;
        $success['code'] = $code;
        return $this->sendResponse('Code hase been sent successfully.', $success, 200);
    }
    /**
     * Verify Code on Email API
     */
    public function verify_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'code' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $user = User::where('uuid', $request->input('user_id'))->first();
        if (is_null($user)) {
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
        $success['user'] = $user;
        return $this->sendResponse('Code matched successfully.', $request->all(), 200);
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $user = User::where('uuid', $request->input('user_id'))->first();
        if (is_null($user)) {
            return $this->sendError('User not found.', $request->all(), 200);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        $success['user'] = $user;
        return $this->sendResponse('Password has been reset successfully.', $success, 200);
    }

    public function profile_upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $user = User::where('uuid', $request->input('user_id'))->first();
        if (is_null($user)) {
            return $this->sendError('User not found.', $request->all());
        }

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_images', $fileName, 'public/profiles');

            $user->profile_image = $filePath;
            $user->save();

            $success['user'] = $user;
            return $this->sendResponse($success, 'Profile image uploaded successfully.');
        } else {
            return $this->sendError('Profile image not uploaded.');
        }
    }

    public function profile($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();
            if (is_null($user)) {
                return $this->sendError('User not found.', [], 200);
            }

            $customer = Customer::where('user_id', $user->id)
                ->with('city', 'area')
                ->first();
            if (is_null($customer)) {
                $customer = [];
            }

            $data['user']['id'] = $user->id;
            $data['user']['uuid'] = $user->uuid;
            $data['user']['name'] = $user->name;
            $data['user']['email'] = $user->email;
            $data['user']['phone'] = $user->phone;
            $data['user']['role'] = $user->role;
            $data['user']['joined_through'] = $user->joined_through;
            $data['user']['joined_date'] = $user->created_at->format('M d, Y');

            $data['customer']['area_id'] = $customer->area_id;
            $data['customer']['city_id'] = $customer->city_id;
            $data['customer']['address'] = $customer->address;
            return $this->sendResponse('Profile retrieved successfully.', $data, 200);
        } catch (\Exception $e) {
            return $this->sendError('Profile not retrieved Error...', [$e->getMessage()], 500);
        }
    }

    public function profile_update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'city_id' => 'required',
                'area_id' => 'required',
                'address' => 'required',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 200);
            }

            $user = User::where('uuid', $request->input('user_id'))->first();
            if (is_null($user)) {
                return $this->sendError('User not found.', $request->all(), 200);
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
            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))) . '.' . $extension;
                $file->move(public_path('images/profile'), $filename);
                $customer->picture = 'images/profile/' . $filename;
            }
            $customer->user_id = $user->id;
            $customer->save();

            $data['user']['id'] = $user->id;
            $data['user']['uuid'] = $user->uuid;
            $data['user']['name'] = $user->name;
            $data['user']['email'] = $user->email;
            $data['user']['phone'] = $user->phone;
            $data['user']['role'] = $user->role;
            $data['user']['joined_through'] = $user->joined_through;
            $data['user']['joined_date'] = $user->created_at->format('M d, Y');
            
            $data['customer']['area_id'] = $customer->area_id;
            $data['customer']['city_id'] = $customer->city_id;
            $data['customer']['address'] = $customer->address;
            return $this->sendResponse('Profile updated successfully.', $data, 200);
        } catch (\Exception $e) {
            return $this->sendError('Profile not updated Error...', [$e->getMessage()], 500);
        }
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $user = User::where('uuid', $request->input('user_id'))->first();
        if (is_null($user)) {
            return $this->sendError('User not found.', $request->all(), 200);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return $this->sendError('Old password is incorrect.', $request->all(), 200);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $success['user'] = $user;
        return $this->sendResponse($success, 'Password changed successfully.');
    }
}
