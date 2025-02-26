<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, Seller, Customer, City, Area, CustomerVerification};
use Illuminate\Support\Facades\{Auth, Hash, DB, Mail};

class CustomerController extends Controller
{
    public function index()
    {
        $area_id = Auth::user()->seller->area_id;
        $customers = Customer::where('area_id', $area_id)->pluck('user_id');
        $customer_ids = [];
        if ($customers->isNotEmpty()) {
            $customer_ids =  $customers->toArray();
        }
        $customers = User::whereIn('id', $customer_ids)->where('joined_through', 'Seller')->paginate(10);
        return view('dashboards.sellers.customers.index', compact('customers'));
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
        return view('dashboards.sellers.customers.create', compact('cities', 'areas'));
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
            $user->joined_through = 'Seller';
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

            DB::commit();

            $validator['success'] = 'User created successfully';
            return back()->withErrors($validator);
        } catch (\Exception $e) {
            DB::rollBack();
            $validator['error'] = $e->getMessage();
            return back()->withErrors($validator);
        }
    }
}
