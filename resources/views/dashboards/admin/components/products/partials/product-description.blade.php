<section>
    <p>Short description is summaries of your content.</p>
    <div class="row">
        <div class="col-12 mb-3">
            <label class="form-control-label mb-1">Short Description <span class="tx-danger">*</span></label>
            <textarea id="short_description" class="form-control" required name="short" placeholder="Enter short description" rows="5">{{ old('short') ?? 'Short Description' }}</textarea>
            @if ($errors->has('short'))
                <span class="text-danger text-left">{{ $errors->first('short') }}</span>
            @endif
        </div>
        <div class="col-12">
            <label class="form-control-label mb-1">Long Description <span class="tx-danger">*</span></label>
            <div id="londDescription" style="height: 200px"></div>
            <textarea id="long" class="form-control" name="long" style="display: none"></textarea>
        </div>
    </div>
</section>