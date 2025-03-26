<h6 class=" mx-xl-6 mb-2">
    <span class="bg-secondry pr-3">Choose your product</span>
</h6>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-2">
        <table class="table az-table-reference text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Select Customer</th>
                    <th>Select Category</th>
                    <th>Select Brand</th>
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
                            <option value="other">Other</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" id="brand_id" name="brand_id">
                            <option selected disabled>Select brand</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="other-category-table" style="display: none;">
    <h6 class=" mx-xl-6 mb-2">
        <span class="bg-secondry pr-3">Add new category and brand</span>
    </h6>
    <div class="row px-xl-6" >
        <div class="col-lg-12 table-responsive mb-2">
            <table class="table az-table-reference text-center mb-0" >
                <thead class="thead-dark">
                    <tr>
                        <th>Category Title</th>
                        <th>Brand Title</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <tr>
                        <td>
                            <input type="text" id="category_title" class="form-control" name="category_title" placeholder="Category Title">
                        </td>
                        <td>
                            <input type="text" id="brand_title" class="form-control" name="brand_title" placeholder="Brand Title">
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
<div class="row px-xl-6 mb-2">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table az-table-reference text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th width="25%">Product Title</th>
                    <th width="25%">Product Price</th>
                    <th width="25%">Advance Price</th>
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
<h5 class=" text-uppercase mx-xl-6 mb-2"><span class="bg-seconary pr-3">Installment Calculator</span></h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table az-table-reference  text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Installment Tenure (Months)</th>
                    <th>Monthly Amount Percentage</th>
                    <th>Total Deal Amount</th>
                    <th>Action</th>
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
                    <td class="align-middle">5%</td>
                    <td class="align-middle">
                        <input type="hidden" name="total_deal_price" id="total_deal_price"> 
                        Rs. <span class="variation-price-calculator" id="variation-price-calculator">00.00</span> 
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-block">Create Order</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<h5 class=" text-uppercase mx-xl-6 mb-2"><span class="bg-seconary pr-3">Your Installments</span></h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-5">
        <table class="table az-table-reference text-center mb-0">
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
<div class="row px-xl-6">
    <div class="col-lg-12">
       
    </div>
</div>
<!-- Cart End -->
