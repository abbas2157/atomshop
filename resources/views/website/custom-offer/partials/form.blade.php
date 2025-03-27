<div class="container">
    <h6 class=" mx-xl-6 mb-3">
        <span class="bg-secondry pr-3">Choose your product category & brand</span>
    </h6>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-2">
            <div class="bg-light">
                <table class="table table-bordered text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="25%">Select Category</th>
                            <th width="25%">Select Brand</th>
                            <th width="25%">Category Title</th>
                            <th width="25%">Brand Title</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
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
                                    <option value="other">Other</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="brand_id" name="brand_id">
                                    <option selected disabled>Select brand</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="category_title" class="form-control" disabled name="category_title" placeholder="Category Title">
                            </td>
                            <td>
                                <input type="text" id="brand_title" class="form-control" disabled name="brand_title" placeholder="Brand Title">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h6 class=" mx-xl-6 mb-2">
        <span class="bg-secondry pr-3">Add your product</span>
    </h6>
    <div class="row px-xl-6 mb-3">
        <div class="col-lg-12 table-responsive">
            <div class="bg-light">
                <table class="table table-bordered text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="35%">Product Title</th>
                            <th width="20%">Product Price</th>
                            <th width="20%">Advance Price</th>
                            <th width="25%">Picture</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td>
                                <input type="text" id="product_title" class="form-control" name="product_title" placeholder="Product Title">
                            </td>
                            <td>
                                <input type="number" id="product_price" class="form-control" name="product_price" placeholder="Product Price">
                            </td>
                            <td>
                                <input type="number" id="advance_price" class="form-control" name="advance_price" placeholder="Advance Price">
                            </td>
                            <td class="w-50">
                                <input type="file" id="picture" class="form-control" name="picture" placeholder="Product Picture">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h6 class=" mx-xl-6 mb-2"><span class="bg-seconary pr-3">Installment Calculator</span></h6>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-3">
            <div class="bg-light">
                <table class="table table-bordered text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Installment Tenure (Months)</th>
                            <th>Monthly Amount Percentage</th>
                            <th>Total Deal Amount</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td class="align-middle">
                                <div class="input-group installment-calculator-page mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-dark btn-minus"
                                            style="padding: 5px 10px">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" min="3" max="12" class="form-control form-control-sm bg-secondary border-0 text-center" id="tenure_months" name="tenure_months" readonly value="3">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-dark btn-plus"
                                            style="padding: 5px 10px">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <p>🔹 A <b>5%</b> sourcing agent fee applies for custom market sourcing.</p>
                            </td>
                            <td class="align-middle">
                                <input type="hidden" name="total_deal_price" id="total_deal_price"> 
                                Rs. <span class="variation-price-calculator" id="variation-price-calculator">00.00</span> 
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h6 class=" mx-xl-6 mb-2"><span class="bg-seconary pr-3">Your Installments</span></h6>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-2">
            <div class="bg-light">
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
                                <img src="{{ asset('web/img/loader.gif') }}" alt="Loader" class="w-5">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h6 class=" mx-xl-6 mb-2"><span class="bg-seconary pr-3">Customer Information</span></h6>
    <div class="row px-xl-6">
        <div class="col-lg-12 table-responsive mb-3">
            <div class="bg-light">
                <table class="table table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Full Name" @auth disabled value="{{ Auth::user()->name ?? '' }}" @endauth>
                            </td>
                            <td>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email" @auth disabled value="{{ Auth::user()->email ?? '' }}" @endauth>
                            </td>
                            <td>
                                <input type="text" id="phone" class="form-control" name="phone" placeholder="Mobile Number" @auth disabled value="{{ Auth::user()->phone ?? '' }}" @endauth>
                            </td>
                            <td>
                                @guest
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter password">
                                @endguest
                            </td>
                        </tr>
                    </tbody>
                    <thead class="thead-dark">
                        <tr>
                            <th>Select City</th>
                            <th>Select Area</th>
                            <th>Home Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td>
                                <select class="custom-select" name="city_id" @auth disabled @endauth>
                                    @if ($cities->isNotEmpty())
                                        @foreach ($cities as $item)
                                            @auth
                                                <option value="{{ $item->id ?? '' }}" {{ !is_null(Auth::user()->customer) && Auth::user()->customer->city_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title ?? '' }}
                                                </option>
                                            @endauth
                                            @guest
                                                <option value="{{ $item->id ?? '' }}">
                                                    {{ $item->title ?? '' }}
                                                </option>
                                            @endguest
                                        @endforeach
                                    @else
                                        <option value="0">No City Found</option>
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select class="custom-select select2" name="area_id" id="area_id" @auth disabled @endauth>
                                    @if ($areas->isNotEmpty())
                                        @foreach ($areas as $item)
                                            @auth
                                                <option value="{{ $item->id ?? '' }}" data-city-id="{{ $item->city_id }}"
                                                    {{ !is_null(Auth::user()->customer) && Auth::user()->customer->area_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title ?? '' }}
                                                </option>
                                            @endauth
                                            @guest
                                                <option value="{{ $item->id ?? '' }}" data-city-id="{{ $item->city_id }}">
                                                    {{ $item->title ?? '' }}
                                                </option>
                                            @endguest
                                        @endforeach
                                    @else
                                        <option value="0">No Area Found</option>
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="text" id="address" class="form-control" name="address" placeholder="Home Address" @auth disabled value="{{ (!is_null(Auth::user()->customer) && !is_null(Auth::user()->customer->address)) ? Auth::user()->customer->address : '' }}"  @endauth>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-shopping-cart mr-1"> </i> Place Order</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>