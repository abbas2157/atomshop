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
                    var status = $('#status').parsley();

                    if (
                        title.isValid() &&
                        categoryId.isValid() &&
                        brandId.isValid() &&
                        status.isValid()
                    ) {
                        return true;
                    } 
                    else {
                        title.validate();
                        categoryId.validate();
                        brandId.validate();
                        memoryId.validate();
                        colorId.validate();
                        status.validate();
                    }
                } 
                else if (currentIndex === 1) {
                    var price = $('#price').parsley();
                    var min_advance_price = $('#min_advance_price').parsley();
                    if (price.isValid() && min_advance_price.isValid()) {
                        return true;
                    } 
                    else {
                        price.validate();
                        min_advance_price.validate();
                    }
                }
                else if (currentIndex === 2) {
                    var short = $('#short_description').parsley();
                    if (short.isValid()) {
                        return true;
                    } 
                    else {
                        short.validate();
                    }
                    
                }
                else if (currentIndex === 3) { 
                    return true;
                    var picture = $('#picture').parsley();
                    if (picture.isValid()) {
                        return true;
                    } 
                    else {
                        picture.validate();
                    }
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
            var formData = new FormData(document.getElementById('product-form-name'));
            $.ajax({
                url: APP_URL + "/admin/products",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success == true) {
                        alert(response.message);
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

    // Add Parsley.js validations to form fields
    $('#title').attr('data-parsley-required', 'true');
    $('#category_id').attr('data-parsley-required', 'true');
    $('#brand_id').attr('data-parsley-required', 'true');
    $('#status').attr('data-parsley-required', 'true');

    // File upload validation
    $('#customFile').attr('data-parsley-required', 'true');

    // Initialize Parsley on the form
    $('#product-form form').parsley();

    $('#category_id').on('change', function(){
        var category_id = $(this).val();
        if(category_id == 1 || category_id == 2 || category_id == 3) {
            $('.color-div').removeClass('d-none');
        }
        else {
            $('.color-div').addClass('d-none');
        }
        if(category_id == 1 || category_id == 2) {
            $('.memory-price').removeClass('d-none');
        }
        else {
            $('.memory-price').addClass('d-none');
        }
        $('#brand_id').html('');
        $.ajax({
            url: API_URL + "/brands",
            type: "GET",
            data: {category_id : category_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    var brands = response.data;
                    if(brands.length > 0) {
                        brands.forEach(function(item) {
                            $('#brand_id').append('<option value="'+item.id+'">'+item.title+'</option>');
                        });
                    }
                    else  {
                        $('#brand_id').append('<option value="0">No Brand Found</option>');
                    }
                }
                else  {
                    $('#brand_id').append('<option value="0">No Brand Found</option>');
                }
            }
        });

    });

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
    quill.on('text-change', function () {
        var htmlContent = quill.root.innerHTML;
        $('#long').html(htmlContent);
    });

});