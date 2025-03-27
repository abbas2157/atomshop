<div class="container">
    <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Choose your product</span></h5>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-3">
            <div class="bg-light">
                <table class="table table-bordered text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Select Category</th>
                            <th>Select Brand</th>
                            <th>Select Product</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td>
                                <select class="form-control" id="category_id">
                                    <option selected disabled>Select category</option>
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id ?? '' }}" {{ ($item->id == old('category_id')) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="brand_id">
                                    <option selected disabled>Select brand</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" id="product_id">
                                    <option selected disabled>Select product</option>
                                </select>
                                <input type="hidden" id="variation_price">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-none color-storage">
        <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Choose product veriation</span></h5>
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-3">
                <div class="bg-light">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th >Select Color</th>
                                <th>Select Storage</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <tr>
                                <td>
                                    <select class="form-control" id="color_id">
                                        <option selected disabled>Select Color</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="memory_id">
                                        <option selected disabled>Select Storage</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none size-price">
        <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Choose product veriation</span></h5>
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-3">
                <div class="bg-light">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Select size</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <tr>
                                <td>
                                    <select class="form-control" id="category_id">
                                        <option selected disabled>Select size</option>
                                    </select>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Installment Calculator</span></h5>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-3">
            <div class="bg-light">
                <table class="table table-bordered text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Minimum Advance Amount</th>
                            <th>Installment Tenure (Months)</th>
                            <th>Monthly Amount Pecentage</th>
                            <th>Total Deal Amount</th>
                            <th width="250px">Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td class="align-middle">
                                <input type="text" class="form-control" id="min_advance_price" placeholder="Enter Amount" required="required"/>
                            </td>
                            <td class="align-middle">
                                <div class="input-group installment-calculator-page mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" min="3" max="12" class="form-control form-control-sm bg-secondary border-0 text-center" id="tenure_months" value="3">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $calculator->per_month_percentage ?? 4 }}%</td>
                            <td class="align-middle"> Rs. <span class="variation-price-calculator" id="variation-price-calculator">00.00</span> </td>
                            <td width="250px">
                                <div class="loader-btn">
                                    <button class="btn btn-primary px-3 w-50" ><img  src="{{ asset('web/img/loader.gif') }}" class="w-25" alt="Loader"></button>
                                </div>
                                <div class="checkout-btn"></div>
                                <div class="cart-btn d-none" >
                                    <button class="btn btn-primary px-3 add-to-cart"><i class="fa fa-shopping-cart mr-1"> </i> Add to Cart</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h5 class=" text-uppercase mx-xl-5 mb-2"><span class="bg-secondary pr-3">Your Installments</span></h5>
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
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
                        <tr><td colspan="5"><img src="{{ asset('web/img/loader.gif') }}" class="w-5" alt="Loader"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->