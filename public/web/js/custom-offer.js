(function ($) {
    "use strict";
    $("#category_id").on("change", function () {
        var category_id = $(this).val();
        if (category_id == "other") {
          $("#category_title").prop('disabled',false);
          $("#brand_title").prop('disabled',false);
          $("#brand_id").html('<option value="other" selected>Other</option>');
        } 
        else {
            $("#category_title").prop('disabled',true);
            $("#brand_title").prop('disabled',true);
            $.ajax({
                url: APP_URL + "/installment-calculator/brands",
                type: "GET",
                data: { category_id: category_id },
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                success: function (response) {
                    populateBrands(response.data);
                },
            });
        }
    });
    function populateBrands(brands) {
        $("#brand_id").html('');
        if (brands.length > 0) {
            $("#brand_id").append('<option selected disabled value="0">Select brand</option>');
            brands.forEach(function (item) {
                $("#brand_id").append('<option value="' + item.id + '">' + item.title + "</option>");
            });
            $("#brand_id").append('<option value="other">Custom Order</option>');
        } 
        else {
            $("#brand_title").prop('disabled',false);
            $("#brand_id").append('<option value="other">Custom Order</option>');
        }
    }
    $("#brand_id").on("change", function () {
        var brand_id = $(this).val();
        if (brand_id == "other") {
            $("#brand_title").prop('disabled',false);
        } else {
            $("#brand_title").prop('disabled',true);
        }
    });
    $(document).ready(function () {
        $("#area_id").select2();
        var allAreaOptions = $("#area_id option").clone();
        $("#city_id").on("change", function () {
            var cityId = $(this).val();
            $("#area_id").empty();
            var filteredOptions = allAreaOptions.filter(function () {
                return $(this).data("city-id") == cityId;
            });
            if (filteredOptions.length > 0) {
                $("#area_id").append(filteredOptions);
            } else {
                $("#area_id").append('<option value="">No Area Found</option>');
            }
            $("#area_id").val($("#area_id option:first").val()).trigger("change");
            $("#area_id").select2();
        });
        $("#city_id").trigger("change");
    });
    $("#advance_price").on('paste change keyup', function(e) {
        if($(this).val() > 0)
          makeInstallments();
    });
    $("#product_price").on('paste change keyup', function(e) {
        if($(this).val() > 0)
          makeInstallments();
    });
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
    function makeInstallments() {
        var total = parseInt($('#product_price').val());
        var advance = parseInt($('#advance_price').val());
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
        $('#total_deal_price').val(total_deal_amount);
        
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
