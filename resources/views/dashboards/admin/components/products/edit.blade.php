@extends('dashboards.admin.layout.app')
@section('title')
<title>Products - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('css')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/quill/quill.snow.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/quill/quill.bubble.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/line-awesome/css/line-awesome.min.css') !!}" rel="stylesheet">
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
                <div class="az-content-label mg-b-5">Edit Product</div>
                <p class="mg-b-20">Using this form you can edit product</p>
                <form id="product-form-name" method="POST" action="{{ route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="product-form">
                        <h3>Product Information</h3>
                        @include('dashboards/admin/components/products/edit-partials/product-information')
                        <h3>Product Description</h3>
                        @include('dashboards/admin/components/products/edit-partials/product-description')
                        <h3>Product Images</h3>
                        @include('dashboards/admin/components/products/edit-partials/product-images')
                        <h3>Publish Product</h3>
                        <section>
                            <p>The next and previous buttons help you to navigate through your content.</p>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{!! asset('assets/lib/jquery-steps/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('assets/lib/parsleyjs/parsley.min.js') !!}"></script>
<script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
<script src="{!! asset('assets/lib/quill/quill.min.js') !!}"></script>
<script>
    $(function() {
        'use strict';
        let isSubmitting = false; 

        $('#product-form').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            labels: {
                finish: "Publish Product",
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex < newIndex) {
                    if (currentIndex === 0) {
                        var title = $('#title').parsley();
                        var categoryId = $('#category_id').parsley();
                        var brandId = $('#brand_id').parsley();
                        var memoryId = $('#memory_id').parsley();
                        var colorId = $('#color_id').parsley();
                        var status = $('#status').parsley();

                            if (
                                title.isValid() &&
                                categoryId.isValid() &&
                                brandId.isValid() &&
                                memoryId.isValid() &&
                                colorId.isValid() &&
                                status.isValid()
                            ) {
                                return true;
                            } else {
                                title.validate();
                                categoryId.validate();
                                brandId.validate();
                                memoryId.validate();
                                colorId.validate();
                                status.validate();
                            }
                        } else if (currentIndex === 1) {
                            var short = $('#short_description').parsley();
                            if (short.isValid()) {
                                return true;
                            } else {
                                short.validate();
                            }
                        } else if (currentIndex === 2) {
                            return true;
                            var picture = $('#picture').parsley();
                            if (picture.isValid()) {
                                return true;
                            } else {
                                picture.validate();
                            }
                        }
                    } else {
                        return true;
                    }
                } 
                else {
                    return true;
                }
            },
            onFinishing: function (event, currentIndex) {
                if (isSubmitting) {
                        return false;
                    }
                    isSubmitting = true;

                $('.actions a[href="#finish"]').text('Publishing...').addClass('disabled').css('pointer-events', 'none');
                console.log('Finishing... Current Index:', currentIndex);

                    var productId = '{{ $product->id }}';
                    var formData = new FormData(document.getElementById('product-form-name'));

                    $.ajax({
                        url: "{{ route('admin.products.update', $product->id) }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        success: function(response) {
                            console.log(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred. Please try again.');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $('#title').attr('data-parsley-required', 'true');
            $('#category_id').attr('data-parsley-required', 'true');
            $('#brand_id').attr('data-parsley-required', 'true');
            $('#memory_id').attr('data-parsley-required', 'true');
            $('#color_id').attr('data-parsley-required', 'true');
            $('#status').attr('data-parsley-required', 'true');
            $('#customFile').attr('data-parsley-required', 'true');
            $('#product-form form').parsley();

            $('.select2').select2({
                placeholder: 'Choose items',
                searchInputPlaceholder: 'Search'
            });

            var icons = Quill.import('ui/icons');
            icons['bold'] = '<i class="la la-bold" aria-hidden="true"></i>';
            icons['italic'] = '<i class="la la-italic" aria-hidden="true"></i>';
            icons['underline'] = '<i class="la la-underline" aria-hidden="true"></i>';
            icons['strike'] = '<i class="la la-strikethrough" aria-hidden="true"></i>';
            icons['list']['ordered'] = '<i class="la la-list-ol" aria-hidden="true"></i>';
            icons['list']['bullet'] = '<i class="la la-list-ul" aria-hidden="true"></i>';
            icons['link'] = '<i class="la la-link" aria-hidden="true"></i>';
            icons['image'] = '<i class="la la-image" aria-hidden="true"></i>';
            icons['video'] = '<i class="la la-film" aria-hidden="true"></i>';
            icons['code-block'] = '<i class="la la-code" aria-hidden="true"></i>';

            var toolbarOptions = [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['link', 'image', 'video']
            ];

            var quill = new Quill('#londDescription', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            var initialContent = @json(old('long', $productdescription->long));
            quill.clipboard.dangerouslyPasteHTML(initialContent);

            quill.on('text-change', function() {
                var htmlContent = quill.root.innerHTML;
                document.getElementById('long').value = htmlContent;
            });
            var toolbarInlineOptions = [
                ['bold', 'italic', 'underline'],
                [{
                    'header': 1
                }, {
                    'header': 2
                }, 'blockquote'],
                ['link', 'image', 'code-block'],
            ];
        });

        function deleteGalleryImage(productId, imageId) {
            if (confirm('Are you sure you want to delete this gallery image?')) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route('products.gallery-image', [$product->id, ':imageId']) }}'.replace(
                        ':imageId', imageId),
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: imageId
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                        isSubmitting = false;
                        
                        $('.actions a[href="#finish"]').text('Publish Product').removeClass('disabled').css('pointer-events', 'auto');
                    }
                });
            }
        });
        
        $('#title').attr('data-parsley-required', 'true');
        $('#category_id').attr('data-parsley-required', 'true');
        $('#brand_id').attr('data-parsley-required', 'true');
        $('#memory_id').attr('data-parsley-required', 'true');
        $('#color_id').attr('data-parsley-required', 'true');
        $('#status').attr('data-parsley-required', 'true');
        $('#customFile').attr('data-parsley-required', 'true');
        $('#product-form form').parsley();

        $('.select2').select2({
            placeholder: 'Choose items',
            searchInputPlaceholder: 'Search'
        });

        var icons = Quill.import('ui/icons');
        icons['bold'] = '<i class="la la-bold" aria-hidden="true"></i>';
        icons['italic'] = '<i class="la la-italic" aria-hidden="true"></i>';
        icons['underline'] = '<i class="la la-underline" aria-hidden="true"></i>';
        icons['strike'] = '<i class="la la-strikethrough" aria-hidden="true"></i>';
        icons['list']['ordered'] = '<i class="la la-list-ol" aria-hidden="true"></i>';
        icons['list']['bullet'] = '<i class="la la-list-ul" aria-hidden="true"></i>';
        icons['link'] = '<i class="la la-link" aria-hidden="true"></i>';
        icons['image'] = '<i class="la la-image" aria-hidden="true"></i>';
        icons['video'] = '<i class="la la-film" aria-hidden="true"></i>';
        icons['code-block'] = '<i class="la la-code" aria-hidden="true"></i>';

        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image', 'video']
        ];

        var quill = new Quill('#londDescription', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        var initialContent = @json(old('long', $productdescription->long));
        quill.clipboard.dangerouslyPasteHTML(initialContent);

        quill.on('text-change', function () {
            var htmlContent = quill.root.innerHTML;
            document.getElementById('long').value = htmlContent;
        });
        var toolbarInlineOptions = [
            ['bold', 'italic', 'underline'],
            [{ 'header': 1 }, { 'header': 2 }, 'blockquote'],
            ['link', 'image', 'code-block'],
        ];
    });
</script>

<script>
    $(document).ready(function() {
    $(document).on('click', '.update-product', function() {
        var productId = '{{ $product->id }}';
        var formData = new FormData(document.getElementById('product-form-name'));

        $.ajax({
            url: "{{ route('admin.products.update', $product->id) }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PUT'
            },
            success: function(response) {
                toastr.success('Product updated successfully!', 'Success', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000
                });

                // Update product information on the page without refreshing
                // For example, update the product title
                $('#title').val(response.title);
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while updating the product. Please try again.', 'Error', {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 5000
                });

                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
