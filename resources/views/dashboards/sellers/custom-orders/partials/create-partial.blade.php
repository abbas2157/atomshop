<h5 class="text-uppercase mx-xl-6 mb-2">
    <span class="bg-secondry pr-3">Choose your product</span>
</h5>
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0">
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

<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0" id="other-category-table" style="display: none;">
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
<div class="row px-xl-6">
    <div class="col-lg-12 table-responsive mb-3">
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Product Title</th>
                    <th>Product Price</th>
                    <th>Advance Price</th>
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
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Product Picture</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td class="w-50">
                        <input type="file" id="picture" class="form-control" name="picture" placeholder="Product Picture">
                    </td>
                    <td>
                        <select id="status" class="form-control" name="status">
                            <option value="Published">Published</option>
                            <option value="Pending">Pending</option>
                            <option value="Out of Stock">Out of Stock</option>
                            <option value="On tehold">On hold</option>
                            <option value="Closed">Closed</option>
                        </select>
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
<div class="row px-xl-6">
    <div class="col-lg-12">
        <button type="submit" class="btn btn-success btn-block">Create Order</button>
    </div>
</div>
<!-- Cart End -->
