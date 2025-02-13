<div class="col-lg-3 col-md-4">
    <form id="filterForm" action="{{ route('shop') }}">
        <!-- Price Start -->
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
        <div class="bg-light p-4 mb-30">
            <div class="form-group">
                <label for="min-price">Min Price</label>
                <input type="number" id="min-price" name="min" class="form-control" placeholder="0"
                    min="0" value="{{ request('min') ?? '' }}">
            </div>
            <div class="form-group">
                <label for="max-price">Max Price</label>
                <input type="number" id="max-price" name="max" class="form-control" placeholder="5000000"
                    min="0" value="{{ request('max') ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary filter-submit">Apply Filter</button>
        </div>
        <!-- Price End -->
        <!-- Category Start -->
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                Category</span></h5>
        <div class="bg-light p-4 mb-30">
            @if($categories->isNotEmpty())
                @php
                    $cat_filters = [];
                    if(request()->has('category')) {
                        $cat_filters = request()->category;
                    }
                @endphp
                @foreach($categories as $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between filter mb-1">
                        <input type="checkbox" class="custom-control-input" name="category[]" value="{{ $item->id ?? '' }}" {{ in_array($item->id, $cat_filters) ? 'checked' : '' }} id="category-{{ $item->id ?? '' }}">
                        <label class="custom-control-label" for="category-{{ $item->id ?? '' }}">{{ $item->title ?? '' }}</label>
                        <span class="badge border font-weight-normal">{{ $item->pr_count ?? '0' }}</span>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Category End -->
        <!-- Category Start -->
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
            Brand</span></h5>
        <div class="bg-light p-4 mb-30">
            @if($brands->isNotEmpty())
                @php
                    $brand_filters = [];
                    if(request()->has('brand')) {
                        $brand_filters = request()->brand;
                    }
                @endphp
                @foreach($brands as $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between filter mb-1">
                        <input type="checkbox" class="custom-control-input" name="brand[]" value="{{ $item->id ?? '' }}" {{ in_array($item->id, $brand_filters) ? 'checked' : '' }} id="brand-{{ $item->id ?? '' }}">
                        <label class="custom-control-label" for="brand-{{ $item->id ?? '' }}">{{ $item->title ?? '' }}</label>
                        <span class="badge border font-weight-normal">{{ $item->pr_count ?? '0' }}</span>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- Category End -->
    </form>
</div>