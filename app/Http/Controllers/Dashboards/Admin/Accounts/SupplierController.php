<?php

namespace App\Http\Controllers\Dashboards\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash, DB};
use App\Models\{User, Supplier, City, Area};
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = User::orderBy('id','desc')->where('role', 'vendor');
        if(request()->has('q') && !empty(request()->q)) {
            $suppliers->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $suppliers->where('email', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('q') && !empty(request()->q)) {
            $suppliers->where('phone', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('status') && !empty(request()->status)) {
            $suppliers->where('status', request()->status);
        }
        $suppliers = $suppliers->paginate(10);
        return view('dashboards.admin.accounts.suppliers.index',compact('suppliers'));
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
        return view('dashboards.admin.accounts.suppliers.create', compact('cities', 'areas'));
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
            $user->name  = $request->supplier_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = 'Atom@shop!';
            $user->role = 'supplier';
            $user->status = $request->status;
            $user->save();

            $supplier = new Supplier;
            $supplier->user_id  = $user->id;
            $supplier->business_name = $request->business_name;
            $supplier->supplier_name = $request->supplier_name;
            $supplier->cnic_number = $request->cnic_number;
            $supplier->website = $request->website;
            $supplier->city_id = $request->city_id;
            $supplier->area_id = $request->area_id;
            $supplier->address = $request->business_address;
            $supplier->save();

            DB::commit();

            $response = [ 'success' => true, 'message' => 'Supplier Added Successfully'];
            return response()->json($response);

        } catch (Exception $e) {
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
        $vendor = User::where('uuid', $id)->first();
        if(is_null($vendor)) {
            return abort(404);
        }
        return view('dashboards.admin.accounts.suppliers.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = User::where('uuid', $id)->first();
        if(is_null($vendor)) {
            return abort(404);
        }
        $vendor->name  = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->status = $request->status;
        $vendor->save();

        $validator['success'] = 'Vendor updated successfully';
        return back()->withErrors($validator);
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
