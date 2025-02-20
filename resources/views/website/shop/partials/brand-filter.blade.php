<div class="col-lg-3 col-md-4">
    <form id="filterForm" action="{{ route('brand', $brand->slug) }}">
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
    </form>
</div>