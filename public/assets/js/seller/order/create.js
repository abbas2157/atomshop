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
        $('#memory_id').html('');
        $('#color_id').html('');
        $.ajax({
            url: APP_URL + "/installment-calculator/products/detail",
            type: "GET",
            data: {product_id : product_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    $('#min_advance_price').val(response.data.min_advance_price);
                    $('#variation_price').val(response.data.variation_price);
                    var memories = response.data.memories;
                    if(memories.length > 0) {
                        memories.forEach(function(item) {
                            $('#memory_id').append('<option value="'+item.id+'" data-price="'+item.variation_price+'">'+item.title+'</option>');
                        });
                    }
                    else  {
                        $('#memory_id').append('<option selected disabled value="0">No storage Found</option>');
                    }
                    var colors = response.data.colors;
                    if(colors.length > 0) {
                        colors.forEach(function(item) {
                            $('#color_id').append('<option value="'+item.id+'">'+item.title+'</option>');
                        });
                    }
                    else  {
                        $('#color_id').append('<option selected disabled value="0">No color Found</option>');
                    }
                    makeInstallments();
                    $('.loader-btn').addClass('d-none');
                    $('.cart-btn').removeClass('d-none');
                }
                else  {
                    $('#memory_id').append('<option selected disabled value="0">No storage Found</option>');
                    $('#color_id').append('<option selected disabled value="0">No color Found</option>');
                }
            }
        });
    });
    $('#product_id').select2();
    $('.installment-calculator-page button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            if (oldValue < 12) {
                var newVal = parseFloat(oldValue) + 1;
            }
            else {
                var newVal = parseFloat(oldValue);
            }
        } else {
            if (oldValue > 3) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 3;
            }
        }
        button.parent().parent().find('input').val(newVal);
        makeInstallments();
    });
    $("#min_advance_price").on('paste change keyup', function(e) {
        makeInstallments();
    });
    $('#memory_id').change(function() {
        var variation_price_option = $("#memory_id option:selected");
        $('#variation_price').val(variation_price_option.data("price"));
        makeInstallments();
    });
    function makeInstallments() {
        var total = parseInt($('#variation_price').val());
        var advance = parseInt($('#min_advance_price').val());
        var tenure_months = parseInt($('#tenure_months').val());
        var total_tenure_percentage = tenure_percentage * tenure_months;
        var remaining_amount = total - advance;
        var total_percentage_amount = (total_tenure_percentage / 100) * remaining_amount;
        var total_amount_with_percentage = total_percentage_amount + remaining_amount;
        var per_installment_price   =  (total_amount_with_percentage / tenure_months).toFixed(0);
        per_installment_price = per_installment_price.toLocaleString();
        var months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];
        var total_deal_amount = (total +  total_percentage_amount);
        $('.variation-price').text(total.toLocaleString());
        if(isNaN(total)) {
            $('.variation-price').text('00.00');
        }
        $('.variation-price-calculator').text(total_deal_amount.toLocaleString());
        if(isNaN(total_deal_amount)) {
            $('.variation-price-calculator').text('00.00');
        }
        if(isNaN(per_installment_price)) {
            per_installment_price = '00.00';
        }
        $('#installment-rows').html('');
        var rows = '';
        for(var i = 0; i < tenure_months; i++) {
            rows += '<tr><td>'+ (i+1) +'</td><td>'+ (months[i]) +' Month</td><td>Rs. '+ (per_installment_price) +'</td></tr>';
        }
        $('#installment-rows').html(rows);
    }
    
})(jQuery);