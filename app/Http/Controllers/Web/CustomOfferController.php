<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\{User, Category, Brand, Customer, City, Area};
use App\Models\{CustomOrderProduct, CustomOrder};

use Illuminate\Support\Facades\{Auth, DB, Session};

class CustomOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderBy('id', 'desc')->get();
        $areas = Area::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('title','asc')->select('id','title','slug','pr_count')->get();
        return view('website.custom-offer.index', compact('categories', 'cities', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!Auth::check()) {
                $user = User::where('email', $request->input('email'))->first();
                if (is_null($user)) {
                    $user = new User;
                    $user->uuid = Str::uuid();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $user->password = bcrypt($request->password);
                    $user->role = 'customer';
                    $user->save();
                }
                $customer = Customer::where('user_id', $user->id)->first();
                if(is_null($customer)) {
                    $customer = new Customer;
                    $customer->city_id = $request->city_id;
                    $customer->area_id = $request->area_id;
                    $customer->address = $request->address;
                    $customer->user_id = $user->id;
                    $customer->save();
                }
            }
            else {
                $user = Auth::user();
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
            $order->user_id = $user->id;
            $order->save();

            DB::commit();

            return redirect('order/success?type=offer&order='.$order->uuid);
        } catch (\Exception $e) {
            DB::rollBack();
           return redirect('order/failed');
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
