<section>
    <p>The next and previous buttons help you to navigate through your content.</p>
    <div class="row row-sm">
        <div class="col-lg-6 mt-2">
            <label class="form-control-label">Product Price (Default) <span class="tx-danger">*</span></label>
            <input type="number" id="price" class="form-control" name="price" placeholder="Enter product price"
                value="{{ old('price', $product->price) }}" required>
            @if ($errors->has('price'))
                <span class="text-danger text-left">{{ $errors->first('price') }}</span>
            @endif
        </div>
        <div class="col-lg-6 mt-2">
            <label class="form-control-label">Minimum Advance Price <span class="tx-danger">*</span></label>
            <input type="number" id="min_advance_price" class="form-control" name="min_advance_price"
                placeholder="Minimum Advance Price" value="{{ old('min_advance_price', $product->min_advance_price) }}">
            @if ($errors->has('min_advance_price'))
                <span class="text-danger text-left">{{ $errors->first('min_advance_price') }}</span>
            @endif
        </div>
    </div>
    @if($memories->isNotEmpty())
    <h5 class="mt-2"><span class=" memory-price">Memory</span></h5>
    <div class="mt-3 memory-price">
        @foreach ($memories as $memory)
            <div class="row row-sm">
                <div class="col-lg-6 mt-2">
                    <label class="form-control-label">Variation Price ({{ $memory->title ?? '' }})</label>
                    <input type="number" class="form-control" name="memories[price_{{ $memory->id ?? '' }}]"
                        placeholder="Enter product price"
                        value="{{ old("memories.price.$memory->id", $product->memories()->where('memory_id', $memory->id)->first()->price ?? 0) }}">
                </div>
                <div class="col-lg-3 mt-2 pt-4">
                    <label class="ckbox mt-1">
                        <input type="checkbox" name="memories[name][]" value="{{ $memory->id ?? '' }}"
                            {{ in_array($memory->id, $product->memories()->pluck('memory_id')->toArray()) ? 'checked' : '' }}><span>
                            {{ $memory->title ?? '' }}</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @endif
    @if($sizes->isNotEmpty())
    <h5 class="mt-2"><span class=" size-price">Sizes</span></h5>
    <div class="mt-2 size-price">
        @foreach ($sizes as $size)
            <div class="row row-sm">
                <div class="col-lg-6 mt-2">
                    <label class="form-control-label">Variation Price ({{ $size->title ?? '' }})</label>
                    <input type="number" class="form-control" name="sizes[price_{{ $size->id ?? '' }}]" placeholder="Enter product price"
                        value="{{ old("sizes.price.$size->id", $product->sizes()->where('size_id', $size->id)->first()->price ?? 0) }}">
                </div>
                <div class="col-lg-3 mt-2 pt-4">
                    <label class="ckbox mt-1">
                        <input type="checkbox" name="sizes[name][]" value="{{ $size->id ?? '' }}"
                            {{ in_array($size->id, $productSize) ? 'checked' : '' }}><span> {{ $size->title ?? '' }}</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</section>
