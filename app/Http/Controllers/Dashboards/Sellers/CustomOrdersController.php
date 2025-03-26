<?php

namespace App\Http\Controllers\Dashboards\Sellers;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, DB};
use App\Models\{Category, Brand, CustomOrderProduct, CustomOrder, Area, Cart, City, Product, Customer, InstallmentCalculator, Order};

class CustomOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = CustomOrder::where('user_id', $user_id)->with('CustomOrderProduct')->select('id', 'uuid', 'product_id', 'user_id', 'portal', 'status', 'created_at', 'total_deal_price', 'advance_price', 'tenure');
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
            $area_id = Auth::user()->seller->area_id;
            $customers = Customer::where('area_id', $area_id)->where('verified', '1')->select('id','user_id')->get();
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
            $product->status = $request->status;
            $product->created_by = auth()->id();
            $product->save();
            $product->pr_number = 'PR-' . $product->id;
            $product->save();

            $order = new CustomOrder();
            $order->uuid = Str::uuid();
            $order->user_id = auth()->id();
            $order->product_id = $product->id;
            $order->total_deal_price = $product->price;
            $order->advance_price = $product->advance_price;
            $order->tenure = 3;
            $order->area_id = $request->area_id;
            $order->city_id = $request->city_id;
            $order->status = $product->status;
            $order->created_by = $product->created_by;
            $order->save();

            return redirect()->route('seller.custom-orders.index')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
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
