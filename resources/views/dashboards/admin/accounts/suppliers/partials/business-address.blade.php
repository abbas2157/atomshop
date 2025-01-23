<section>
    <p class="mg-b-20"> To get registered, kindly fill out the form below with supplier's details</p>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Supplier city <span class="text-danger">*</span></label>
            <select class="form-control" name="city_id" id="city_id">
                @if($cities->isNotEmpty())
                    @foreach($cities as $item)
                        <option value="{{ $item->id ?? '' }}" {{ ($item->id == old('city_id')) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-lg mt-2">
            <label>Supplier area <span class="text-danger">*</span></label>
            <select class="form-control" name="area_id" id="area_id">
                @if($areas->isNotEmpty())
                    @foreach($areas as $item)
                        <option value="{{ $item->id ?? '' }}" {{ ($item->id == old('area_id')) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label>Street Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="business_address" id="business_address" placeholder="Enter Street Address" value="{{ old('business_address') }}" required>
        </div>
    </div>
</section>