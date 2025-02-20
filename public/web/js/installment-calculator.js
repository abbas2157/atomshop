(function ($) {
    "use strict";
    $('#category_id').on('change', function(){
        var category_id = $(this).val();
        $('#brand_id').html('');
        if(category_id == 1 || category_id == 2 || category_id == 3) {
            $('.color-storage').removeClass('d-none');
        }
        else {
            $('.color-storage').addClass('d-none');
        }
        if(category_id == 4) {
            $('.size-price').removeClass('d-none');
        }
        else {
            $('.size-price').addClass('d-none');
        }
        $.ajax({
            url: APP_URL + "/installment-calculator/brands",
            type: "GET",
            data: {category_id : category_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    var brands = response.data;
                    if(brands.length > 0) {
                        $('#brand_id').append('<option selected disabled value="0">Select Brand</option>');
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
    $('#brand_id').on('change', function(){
        var brand_id = $(this).val();
        $('#product_id').html('');
        $.ajax({
            url: APP_URL + "/installment-calculator/brands/products",
            type: "GET",
            data: {brand_id : brand_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    var products = response.data;
                    if(products.length > 0) {
                        $('#product_id').append('<option selected disabled value="0">Select Product</option>');
                        products.forEach(function(item) {
                            $('#product_id').append('<option value="'+item.id+'">'+item.title+'</option>');
                        });
                    }
                    else  {
                        $('#product_id').append('<option selected disabled value="0">No Product Found</option>');
                    }
                }
                else  {
                    $('#product_id').append('<option selected disabled value="0">No Product Found</option>');
                }
            }
        });
    });
    $('#product_id').on('change', function(){
        var product_id = $(this).val();
        console.log(product_id);
    });
    $('#product_id').select2();
})(jQuery);