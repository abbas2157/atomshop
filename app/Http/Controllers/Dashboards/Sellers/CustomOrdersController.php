<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Category, Brand, CustomOrderProduct};
use App\Models\{CustomOrder, Area, Cart, City, ActiveSeller};
use App\Models\{Product, Customer, InstallmentCalculator, Order};
use App\Models\{User, OrderChangeHistory, OrderInstalment, SellerOrder};

class CustomOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active_areas_ids = [];
        $active_areas = ActiveSeller::where('user_id', Auth::user()->id)->pluck('area_id');
        if($active_areas->isNotEmpty()) {
            $active_areas_ids = $active_areas->toArray();
        }
        $orders = CustomOrder::whereIn('area_id', $active_areas_ids)->with('CustomOrderProduct')->select('id', 'uuid', 'product_id', 'user_id', 'portal', 'status', 'created_at', 'total_deal_price', 'advance_price', 'tenure');
        if(request()->has('status') && !empty(request()->status)) {
            $orders->where('status', request()->status);
        }
        if(request()->has('portal') && !empty(request()->portal)) {
            $orders->where('portal', request()->portal);
        }
        $orders = $orders->orderBy('id','desc')->paginate(10);
        return view('dashboards.sellers.custom-orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $calculator = InstallmentCalculator::select('installment_tenure', 'per_month_percentage')->first();
            $active_areas_ids = [];
            $active_areas = ActiveSeller::where('user_id', Auth::user()->id)->pluck('area_id');
            if($active_areas->isNotEmpty()) {
                $active_areas_ids = $active_areas->toArray();
            }
            $customers = Customer::whereIn('area_id', $active_areas_ids)->where('verified', '1')->select('id','user_id')->get();
            $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
            $areas = Area::orderBy('id', 'desc')->get();
            $cities = City::orderBy('id', 'desc')->get();
            return view('dashboards.sellers.custom-orders.create', compact('customers','calculator','categories','areas','cities'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $customer_id = $request->customer_id;
            $customer = Customer::where('user_id', $customer_id)->first();
            if(is_null($customer)) {
                $validator['error'] = 'Customer not found.';
                return back()->withErrors($validator);
            }
            $category_id = $request->category_id;
            $brand_id = $request->brand_id;

            if ($request->category_id == 'other') {
                $category = new Category();
                $category->title = $request->category_title;
                $category->slug = Str::slug($request->category_title);
                $category->save();
                $category_id = $category->id;
            }

            if ($request->brand_id == 'other') {
                $brand = new Brand();
                $brand->title = $request->brand_title;
                $brand->slug = Str::slug($request->brand_title);
                $brand->save();
                $brand_id = $brand->id;
            }

            $product = new CustomOrderProduct();
            $product->uuid = Str::uuid();
            $product->title = $request->product_title;
            $product->price = $request->product_price;
            $product->advance_price = $request->advance_price;

            if ($request->hasFile('picture')) {
                $file = $request->file('picture');
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))) . '.' . $extension;
                $file->move(public_path('images/products'), $filename);
                $product->picture = 'images/products/' . $filename;
            }

            $product->category_id = $category_id;
            $product->brand_id = $brand_id;
            $product->created_by = auth()->id();
            $product->save();

            $product->pr_number = 'PR-' . $product->id;
            $product->save();

            $order = new CustomOrder();
            $order->uuid = Str::uuid();
            $order->user_id = auth()->id();
            $order->product_id = $product->id;
            $order->total_deal_price = $request->total_deal_price;
            $order->advance_price = $product->advance_price;
            $order->tenure = $request->tenure_months;
            $order->area_id = $customer->area_id;
            $order->city_id = $customer->city_id;
            $order->created_by = $product->created_by;
            $order->save();

            DB::commit();
            $validator['success'] = 'Custom Order created successfully!';
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
        $order = CustomOrder::where('uuid', $id)->select('id','uuid', 'product_id', 'total_deal_price', 'advance_price', 'tenure', 'user_id', 'portal', 'status', 'created_at')->first();
        if(is_null($order)) {
            return abort(404);
        }
        // dd($order);
        $order_instalments = OrderInstalment::where('order_id',$order->id)->where('order_type', 'Custom')->get();
        $user = User::with('customer')->where('id', $order->user_id)->first();
        $order_change_status = OrderChangeHistory::where('order_id', $order->id)->where('order_type', 'Custom')->get();
        return view('dashboards.sellers.custom-orders.show', compact('order', 'order_change_status', 'order_instalments', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
