@extends('dashboards.admin.layout.app')
@section('title')
    <title>Categories - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('css')
<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Products</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Products</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new product</p>
                <div id="wizard2">
                    <h3>Product Information</h3>
                    <section>
                        <p class="mg-b-20">Try the keyboard navigation by clicking arrow left or right!</p>
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                <input id="title" class="form-control" name="title" placeholder="Enter title"
                                    type="text" value="{{ old('title') }}" required>
                                @if ($errors->has('title'))
                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Slug <span class="tx-danger">*</span></label>
                                <input id="slug" class="form-control" name="slug" placeholder="Enter slug"
                                    type="text" value="{{ old('slug') }}" required>
                                @if ($errors->has('slug'))
                                    <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">PR Number <span class="tx-danger">*</span></label>
                                <input id="pr_number" class="form-control" name="pr_number" placeholder="Enter PR number"
                                    type="text" value="{{ old('pr_number') }}" required>
                                @if ($errors->has('pr_number'))
                                    <span class="text-danger text-left">{{ $errors->first('pr_number') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">Category <span class="tx-danger">*</span></label>
                                <select id="category_id" class="form-control" name="category_id" required>
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">Brand <span class="tx-danger">*</span></label>
                                <select id="brand_id" class="form-control" name="brand_id" required>
                                    <option value="">Select brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <span class="text-danger text-left">{{ $errors->first('brand_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">Memory <span class="tx-danger">*</label>
                                <select id="memory_id" class="form-control" name="memory_id">
                                    <option value="">Select memory</option>
                                    @foreach ($memories as $memory)
                                        <option value="{{ $memory->id }}"
                                            {{ old('memory_id') == $memory->id ? 'selected' : '' }}>
                                            {{ $memory->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('memory_id'))
                                    <span class="text-danger text-left">{{ $errors->first('memory_id') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">Color <span class="tx-danger">*</label>
                                <select id="color_id" class="form-control" name="color_id">
                                    <option value="">Select color</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                            {{ $color->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('color_id'))
                                    <span class="text-danger text-left">{{ $errors->first('color_id') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="">Select status</option>
                                    <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Out of Stock" {{ old('status') == 'Out of Stock' ? 'selected' : '' }}>
                                        Out of Stock</option>
                                    <option value="On hold" {{ old('status') == 'On hold' ? 'selected' : '' }}>On hold
                                    </option>
                                    <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                    </section>
                    <h3>Product Description</h3>
                    <section>
                        <p>Wonderful Product Description.</p>
                        <div class="row">
                            <!-- Short Description -->
                            <div class="col-12 col-md-12 mb-3">
                                <label class="form-control-label">Short Description:</label>
                                <textarea id="short" class="form-control" name="short" placeholder="Enter short description" rows="2"
                                    data-parsley-required="true" data-parsley-maxlength="255">{{ old('short') }}</textarea>
                                @if ($errors->has('short'))
                                    <span class="text-danger text-left">{{ $errors->first('short') }}</span>
                                @endif
                            </div>
                            <!-- Long Description -->
                            <div class="col-12 col-md-12">
                                <label class="form-control-label">Long Description:</label>
                                <textarea id="long" class="form-control" name="long" placeholder="Enter long description" rows="5"></textarea>
                            </div>
                        </div>
                    </section>
                    <h3>Product Images</h3>
                    <section>
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <label>Feature Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input"
                                        name="feature_image" id="customFile" required>
                                    <label class="custom-file-label" for="customFile">Choose feature image</label>
                                </div>
                                @if ($errors->has('feature_image'))
                                    <span class="text-danger text-left">{{ $errors->first('feature_image') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6" id="gallery-images-container">
                                <label>Gallery Images:</label>
                                <div class="custom-file">
                                    <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input"
                                        name="gallery_images[]" id="galleryImages" multiple>
                                    <label class="custom-file-label" for="galleryImages">Choose gallery images</label>
                                </div>
                                @if ($errors->has('gallery_images'))
                                    <span class="text-danger text-left">{{ $errors->first('gallery_images') }}</span>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('assets/lib/jquery-steps/jquery.steps.min.js') !!}"></script>
    <script src="{!! asset('assets/lib/parsleyjs/parsley.min.js') !!}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#long'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(function() {
            'use strict';

            $('#wizard2').steps({
                headerTag: 'h3',
                bodyTag: 'section',
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                onStepChanging: function(event, currentIndex, newIndex) {
                    if (currentIndex < newIndex) {
                        if (currentIndex === 0) {
                            // Validate fields in the first step
                            var title = $('#title').parsley();
                            var slug = $('#slug').parsley();
                            var prNumber = $('#pr_number').parsley();
                            var categoryId = $('#category_id').parsley();
                            var brandId = $('#brand_id').parsley();
                            var memoryId = $('#memory_id').parsley();
                            var colorId = $('#color_id').parsley();
                            var status = $('#status').parsley();

                            if (
                                title.isValid() &&
                                slug.isValid() &&
                                prNumber.isValid() &&
                                categoryId.isValid() &&
                                brandId.isValid() &&
                                memoryId.isValid() &&
                                colorId.isValid() &&
                                status.isValid()
                            ) {
                                return true;
                            } else {
                                title.validate();
                                slug.validate();
                                prNumber.validate();
                                categoryId.validate();
                                brandId.validate();
                                memoryId.validate();
                                colorId.validate();
                                status.validate();
                            }
                        } else if (currentIndex === 1) {
                            // Validate fields in the second step
                            var short = $('#short').parsley();

                            if (short.isValid()) {
                                return true;
                            } else {
                                short.validate();
                            }
                        }
                    } else {
                        return true;
                    }
                }
            });

            // Add Parsley.js validations to form fields
            $('#title').attr('data-parsley-required', 'true');
            $('#slug').attr('data-parsley-required', 'true');
            $('#pr_number').attr('data-parsley-required', 'true');
            $('#category_id').attr('data-parsley-required', 'true');
            $('#brand_id').attr('data-parsley-required', 'true');
            $('#memory_id').attr('data-parsley-required', 'true');
            $('#color_id').attr('data-parsley-required', 'true');
            $('#status').attr('data-parsley-required', 'true');

            // Description validations
            $('#short').attr({
                'data-parsley-required': 'true',
                'data-parsley-maxlength': '255',
                'data-parsley-errors-container': '#short-error'
            });
            // File upload validation
            $('#customFile').attr('data-parsley-required', 'true');

            // Initialize Parsley on the form
            $('#wizard2 form').parsley();
        });
    </script>
@endsection
