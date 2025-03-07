<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomerVerification;
use App\Models\{User, Customer, City, Area};
use Illuminate\Support\Facades\{Auth, Hash, DB};

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::orderBy('id', 'desc')->where('role', 'customer');
        if (request()->has('q') && !empty(request()->q)) {
            $customers->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if (request()->has('q') && !empty(request()->q)) {
            $customers->where('email', 'LIKE',  '%' . request()->q . '%');
        }
        if (request()->has('q') && !empty(request()->q)) {
            $customers->where('phone', 'LIKE',  '%' . request()->q . '%');
        }
        if (request()->has('status') && !empty(request()->status)) {
            $customers->where('status', request()->status);
        }
        $customers = $customers->paginate(10);
        return view('dashboards.admin.accounts.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id', 'desc')->where('status', 'active')->get();
        $areas = [];
        if ($cities->isNotEmpty()) {
            $areas = Area::orderBy('id', 'desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.admin.accounts.customers.create', compact('cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:250|unique:users'
        ]);
        try {
            DB::beginTransaction();

            $user = new User;
            $user->uuid  = Str::uuid();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = 'Atom@shop!';
            $user->role = 'customer';
            $user->status = $request->status;
            $user->joined_through = 'Admin';
            $user->save();

            $customer = new Customer;
            $customer->user_id  = $user->id;
            $customer->city_id = $request->city_id;
            $customer->area_id = $request->area_id;
            $customer->address = $request->address;
            $customer->save();

            $customerVerification = new CustomerVerification;
            $customerVerification->user_id = $user->id;
            $customerVerification->customer_id = $customer->id;

            if ($request->hasFile('id_card_front_side')) {
                $idCardFrontSide = $request->file('id_card_front_side');
                $fileName  = pathinfo($idCardFrontSide->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($idCardFrontSide->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_id_card_front_side'))) . '.' . $extension;
                $idCardFrontSide->move(public_path('images/customers'), $filename);
                $customerVerification->id_card_front_side = 'images/customers/' . $filename;
            }

            if ($request->hasFile('id_card_back_side')) {
                $idCardBackSide = $request->file('id_card_back_side');
                $fileName  = pathinfo($idCardBackSide->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($idCardBackSide->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_id_card_back_side'))) . '.' . $extension;
                $idCardBackSide->move(public_path('images/customers'), $filename);
                $customerVerification->id_card_back_side = 'images/customers/' . $filename;
            }

            if ($request->hasFile('selfie_with_customer')) {
                $selfieWithCustomer = $request->file('selfie_with_customer');
                $fileName  = pathinfo($selfieWithCustomer->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($selfieWithCustomer->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_selfie_with_customer'))) . '.' . $extension;
                $selfieWithCustomer->move(public_path('images/customers'), $filename);
                $customerVerification->selfie_with_customer = 'images/customers/' . $filename;
            }

            $customerVerification->address_found = $request->address_found;
            $customerVerification->house = $request->house;
            $customerVerification->customer_physical_meet = $request->customer_physical_meet;
            $customerVerification->work = $request->work;
            $customerVerification->save();


            $customer->verified = '1';
            $customer->save();

            DB::commit();

            $validator['success'] = 'Customer created successfully';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('customer', 'customerVerification')->where('uuid', $id)->first();
        if (is_null($user)) {
            return abort(404);
        }
        $cities = City::orderBy('id', 'desc')->where('status', 'active')->get();
        if (is_null($user->customer)) {
            $areas = Area::orderBy('id', 'desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        } else {
            $areas = Area::orderBy('id', 'desc')->where('status', 'active')->where('city_id', $user->customer->city_id)->get();
        }
        return view('dashboards.admin.accounts.customers.edit', compact('user', 'cities', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $user = User::where('uuid', $id)->first();
            if (is_null($user)) {
                return abort(404);
            }
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $customer = Customer::where('user_id', $user->id)->first();
            if (is_null($customer)) {
                $customer = new Customer;
                $customer->user_id  = $user->id;
            }

            $customer->city_id = $request->city_id;
            $customer->area_id = $request->area_id;
            $customer->address = $request->address;
            $customer->save();

            $customerVerification = CustomerVerification::where('user_id', $user->id)->first();
            if (is_null($customerVerification)) {
                $customerVerification = new CustomerVerification;
                $customerVerification->user_id = $user->id;
                $customerVerification->customer_id = $customer->id;
            }

            if ($request->hasFile('id_card_front_side')) {
                $idCardFrontSide = $request->file('id_card_front_side');
                $fileName  = pathinfo($idCardFrontSide->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($idCardFrontSide->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_id_card_front_side'))) . '.' . $extension;
                $idCardFrontSide->move(public_path('images/customers'), $filename);
                $customerVerification->id_card_front_side = 'images/customers/' . $filename;
            }

            if ($request->hasFile('id_card_back_side')) {
                $idCardBackSide = $request->file('id_card_back_side');
                $fileName  = pathinfo($idCardBackSide->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($idCardBackSide->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_id_card_back_side'))) . '.' . $extension;
                $idCardBackSide->move(public_path('images/customers'), $filename);
                $customerVerification->id_card_back_side = 'images/customers/' . $filename;
            }

            if ($request->hasFile('selfie_with_customer')) {
                $selfieWithCustomer = $request->file('selfie_with_customer');
                $fileName  = pathinfo($selfieWithCustomer->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($selfieWithCustomer->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($user->name . '_selfie_with_customer'))) . '.' . $extension;
                $selfieWithCustomer->move(public_path('images/customers'), $filename);
                $customerVerification->selfie_with_customer = 'images/customers/' . $filename;
            }

            $customerVerification->address_found = $request->address_found;
            $customerVerification->house = $request->house;
            $customerVerification->customer_physical_meet = $request->customer_physical_meet;
            $customerVerification->work = $request->work;
            $customerVerification->save();

            $customer->verified = '1';
            $customer->save();

            DB::commit();

            $validator['success'] = 'Customer updated successfully';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = User::where('uuid', $id)->first();
        $customer->delete();
        $validator['success'] = 'Customer deleted successfully';
        return back()->withErrors($validator);
    }
}
