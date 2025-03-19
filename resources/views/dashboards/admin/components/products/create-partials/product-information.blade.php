<section>
    <p class="mg-b-20">Try the keyboard navigation by clicking arrow left or right!</p>
    <div class="row row-sm">
        <div class="col-lg-4 mt-2">
            <label class="form-control-label">Product Title (Listing Page) <span class="tx-danger">*</span></label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Enter product title" required>
            @if ($errors->has('title'))
                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="col-lg-8 mt-2">
            <label class="form-control-label">Product Title (Detail Page) </label>
            <input type="text" id="detail_page_title" class="form-control" name="detail_page_title" placeholder="Enter product title for detail page" required>
            @if ($errors->has('detail_page_title'))
                <span class="text-danger text-left">{{ $errors->first('detail_page_title') }}</span>
            @endif
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-md mt-2">
            <label class="form-control-label">Category <span class="tx-danger">*</span></label>
            <select id="category_id" class="form-control" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id ?? '' }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title ?? '' }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
            @endif
        </div>
        <div class="col-md mt-2">
            <label class="form-control-label">Brand <span class="tx-danger">*</span></label>
            <select id="brand_id" class="form-control" name="brand_id" required>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id ?? '' }}"
                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->title ?? '' }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('brand_id'))
                <span class="text-danger text-left">{{ $errors->first('brand_id') }}</span>
            @endif
        </div>
    </div>
    <div class="row row-sm color-div">
        <div class="col-md mt-2">
            <label class="form-control-label">Colors </label>
            <select id="color_id" class="form-control select2" name="colors[]" multiple="multiple">
                {{-- <option value="" selected disabled>Select color</option> --}}
                @foreach ($colors as $color)
                    <option value="{{ $color->id ?? '' }}" {{ old('colors[]') == $color->id ? 'selected' : '' }}>
                        {{ $color->title ?? '' }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('colors'))
                <span class="text-danger text-left">{{ $errors->first('colors') }}</span>
            @endif
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label class="form-control-label">Status <span class="tx-danger">*</span></label>
            <select id="status" class="form-control" name="status" required>
                <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                <option value="On hold" {{ old('status') == 'On hold' ? 'selected' : '' }}>On hold</option>
                <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @if ($errors->has('status'))
                <span class="text-danger text-left">{{ $errors->first('status') }}</span>
            @endif
        </div>
        <div class="col-lg mt-2">
            <label class="form-control-label">Feature <span class="tx-danger">*</span></label>
            <select id="feature" class="form-control" name="feature" required>
                <option value="1" {{ old('feature') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('feature') == 0 ? 'selected' : '' }}>No</option>
            </select>
            @if ($errors->has('feature'))
                <span class="text-danger text-left">{{ $errors->first('feature') }}</span>
            @endif
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg mt-2">
            <label class="form-control-label">App Home <span class="tx-danger">*</span></label>
            <select id="app_home" class="form-control" name="app_home" required>
                <option value="1" {{ old('app_home') == 1 ? 'selected' : '' }}>Yes, Show on app homepage</option>
                <option value="0" {{ old('app_home') == 0 ? 'selected' : '' }}>No, Not show on app homepage</option>
            </select>
            @if ($errors->has('app_home'))
                <span class="text-danger text-left">{{ $errors->first('app_home') }}</span>
            @endif
        </div>
        <div class="col-lg mt-2">
            <label class="form-control-label">Web Home <span class="tx-danger">*</span></label>
            <select id="web_home" class="form-control" name="web_home" required>
                <option value="1" {{ old('web_home') == 1 ? 'selected' : '' }}>Yes, Show on web homepage</option>
                <option value="0" {{ old('web_home') == 0 ? 'selected' : '' }}>No, Not show on web homepage</option>
            </select>
            @if ($errors->has('web_home'))
                <span class="text-danger text-left">{{ $errors->first('web_home') }}</span>
            @endif
        </div>
    </div>
</section>