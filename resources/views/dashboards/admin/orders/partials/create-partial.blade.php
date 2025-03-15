<h5 class=" text-uppercase mx-xl-6 mb-2"><span class="bg-secondry pr-3">Choose your product</span></h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Select Customer</th>
                    <th>Select Category</th>
                    <th>Select Brand</th>
                    <th>Select Product</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td>
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            @if ($customers->isNotEmpty())
                                @foreach ($customers as $item)
                                    <option value="{{ $item->user_id ?? '' }}"
                                        {{ $item->user_id == old('customer_id') ? 'selected' : '' }}>
                                        {{ $item->user->name ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                    <td>
                        <select class="form-control" id="category_id" name="category_id">
                            <option selected disabled>Select category</option>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id ?? '' }}"
                                        {{ $item->id == old('category_id') ? 'selected' : '' }}>
                                        {{ $item->title ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="brand_id" name="brand_id">
                            <option selected disabled>Select brand</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="product_id" name="product_id">
                            <option selected disabled>Select product</option>
                        </select>
                        <input type="hidden" id="variation_price" name="variation_price">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Select City (شہر منتخب کریں)</th>
                    <th>Select Area</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td class="w-50">
                        <select class="form-control" name="city_id" id="city_id" required>
                            @if ($cities->isNotEmpty())
                                @foreach ($cities as $item)
                                    <option value="{{ $item->id ?? '' }}"
                                        {{ !is_null(Auth::user()->customer) && Auth::user()->customer->city_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->title ?? '' }}</option>
                                @endforeach
                            @else
                                <option value="0">No City Found</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        <select class="form-control select2" name="area_id" id="area_id" required>
                            @if ($areas->isNotEmpty())
                                @foreach ($areas as $item)
                                    <option value="{{ $item->id ?? '' }}"
                                        {{ !is_null(Auth::user()->customer) && Auth::user()->customer->area_id == $item->id ? 'selected' : '' }}
                                        data-city-id="{{ $item->city_id ?? '' }}">
                                        {{ $item->title ?? '' }}</option>
                                @endforeach
                            @else
                                <option value="0">No Area Found</option>
                            @endif
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="d-none color-storage">
    <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secodary pr-3">Choose product veriation</span></h5>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-3">
            <table class="table table-bordered text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Select Color</th>
                        <th>Select Storage</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td>
                            <select class="form-control" id="color_id" name="color_id">
                                <option selected disabled>Select Color</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" id="memory_id" name="memory_id">
                                <option selected disabled>Select Storage</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-none size-price">
    <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Choose product veriation</span></h5>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-3">
            <table class="table table-bordered text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Select size</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td>
                            <select class="form-control" id="size_id" name="size_id">
                                <option selected disabled>Select size</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<h5 class=" text-uppercase mx-xl-6 mb-2"><span class="bg-seconary pr-3">Installment Calculator</span></h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Minimum Advance Amount</th>
                    <th>Installment Tenure (Months)</th>
                    <th>Monthly Amount Percentage</th>
                    <th>Total Deal Amount</th>
                    <th>Create Order</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td class="align-middle">
                        <input type="text" class="form-control" id="min_advance_price" name="min_advance_price"
                            placeholder="Enter Amount" required="required" />
                    </td>
                    <td class="align-middle">
                        <div class="input-group installment-calculator-page mx-auto" style="width: 100px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-dark btn-minus" style="padding: 5px 10px">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" min="3" max="12"
                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                id="tenure_months" name="tenure_months" readonly value="3">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-dark btn-plus" style="padding: 5px 10px">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="align-middle">{{ $calculator->per_month_percentage ?? 4 }}%</td>
                    <td class="align-middle"> Rs. <span class="variation-price-calculator"
                            id="variation-price-calculator">00.00</span> </td>
                    <td>
                        <div class="loader-btn">
                            <button class="btn btn-primary px-3 w-50"><img src="{{ asset('web/img/loader.gif') }}"
                                    class="w-25" alt="Loader"></button>
                        </div>
                        <div class="cart-btn d-none">
                            <button type="submit" class="btn btn-primary px-3">
                                <i class="fa fa-shopping-cart mr-1"></i> Create Order
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<h5 class=" text-uppercase mx-xl-6   mb-2"><span class="bg-seconary pr-3">Your Installments</span></h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-5">
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Sr No.</th>
                    <th>Months</th>
                    <th>Installment Price</th>
                </tr>
            </thead>
            <tbody class="align-middle" id="installment-rows">
                <tr>
                    <td colspan="5">
                        <img src="{{ asset('web/img/loader.gif') }}" alt="Loader" style="width:10%">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Cart End -->
