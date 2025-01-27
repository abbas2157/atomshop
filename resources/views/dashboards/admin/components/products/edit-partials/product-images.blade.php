<section>
    <div class="row row-sm">
        <div class="col-md-6">
            <label>Feature Image <span class="text-danger">*</span></label>
            <div class="custom-file">
                <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="picture" id="picture"
                    required>
                <label class="custom-file-label" for="customFile">Choose feature image</label>
            </div>
            @if ($errors->has('feature_image'))
                <span class="text-danger text-left">{{ $errors->first('feature_image') }}</span>
            @endif
            @if ($product->picture)
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <img src="{{ asset('images/categories/' . $product->picture) }}" alt="" class="img-fluid">
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-6" id="gallery-images-container">
            <label>Gallery Images:</label>
            <div class="custom-file">
                <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="gallery_images[]"
                    id="galleryImages" multiple>
                <label class="custom-file-label" for="galleryImages">Choose gallery images</label>
            </div>
            @if ($errors->has('gallery_images'))
                <span class="text-danger text-left">{{ $errors->first('gallery_images') }}</span>
            @endif
            <div class="row">
                @foreach ($galleryImages as $image)
                    <div class="col-md-3 mt-2">
                        <img src="{{ asset($image->url) }}" alt="" class="img-fluid">
                        <a href="#" class="btn btn-danger btn-sm" onclick="deleteGalleryImage({{ $product->id }}, {{ $image->id }})">Delete</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
