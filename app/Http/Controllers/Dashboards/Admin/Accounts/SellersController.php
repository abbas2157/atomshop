<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use App\Models\{User, Seller, City, Area};
use Illuminate\Support\Str;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = User::orderBy('id','desc')->where('role', 'seller');
        if(request()->has('q') && !empty(request()->q)) {
            $sellers->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $sellers->where('email', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $sellers->where('phone', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $sellers->where('status', request()->status);
        }
        $sellers = $sellers->paginate(10);
        return view('dashboards.admin.accounts.sellers.index',compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::orderBy('id','desc')->where('status', 'active')->get();
        $areas = [];
        if($cities->isNotEmpty()) {
            $areas = Area::orderBy('id','desc')->where('status', 'active')->where('city_id', $cities[0]->id)->get();
        }
        return view('dashboards.admin.accounts.sellers.create', compact('cities', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            try {
                DB::beginTransaction();

                $user = new User;
                $user->uuid  = Str::uuid();
                $user->name  = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = 'Atom@shop!';
                $user->role = 'seller';
                $user->status = $request->status;
                $user->save();

                $seller = new Seller;
                $seller->user_id  = $user->id;
                $seller->business_name = $request->business_name;
                $seller->name = $request->name;
                $seller->cnic_number = $request->cnic_number;
                $seller->website = $request->website;
                $seller->city_id = $request->city_id;
                $seller->area_id = $request->area_id;
                $seller->address = $request->business_address;
                $seller->investment_capacity = $request->investment_capacity;
                $seller->previous_experience = $request->previous_experience;
                $seller->save();

                DB::commit();

                $response = [ 'success' => true, 'message' => 'Sellers Added Successfully'];
                return response()->json($response);

            } catch (\Exception $e) {
                DB::rollBack();
                $response = [ 'success' => true, 'message' => $e->getMessage()];
                return response()->json($response);
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
        $seller = Seller::where('user_id', $id)->firstOrFail();
        $user = User::where('id', $id)->firstOrFail();
        $cities = City::orderBy('id', 'desc')->where('status', 'active')->get();
        $areas = [];
        if ($seller && $seller->city_id) {
            $areas = Area::orderBy('id', 'desc')->where('status', 'active')->where('city_id', $seller->city_id)->get();
        }
        return view('dashboards.admin.accounts.sellers.edit', compact('seller', 'cities', 'areas', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $seller = Seller::where('id', $id)->firstOrFail();
            $user = User::where('id', $seller->user_id)->firstOrFail();

            if (is_null($user)) {
                return abort(404);
            }

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = 'Atom@shop!';
            $user->role = 'seller';
            $user->status = $request->status;
            $user->save();

            if (is_null($seller)) {
                return abort(404);
            }

            $seller->business_name = $request->business_name;
            $seller->name = $request->name;
            $seller->cnic_number = $request->cnic_number;
            $seller->website = $request->website;
            $seller->city_id = $request->city_id;
            $seller->area_id = $request->area_id;
            $seller->address = $request->business_address;
            $seller->investment_capacity = $request->investment_capacity;
            $seller->previous_experience = $request->previous_experience;
            $seller->save();

            DB::commit();

            $response = ['success' => true, 'message' => 'Seller updated successfully'];
            return response()->json($response);

        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vendor = User::where('uuid', $id)->first();
        $vendor->delete();
        $validator['success'] = 'Vendor deleted successfully';
        return back()->withErrors($validator);
    }
}
