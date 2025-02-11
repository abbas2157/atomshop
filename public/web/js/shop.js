(function ($) {
    "use strict";
    $(".filter").click(function(e) {
        $(".filter-submit").trigger('click');
    });
    $("#min_advance_price").on('paste change keyup', function(e) {
        makeInstallments();
    });
    $(".make-installment").click(function(e) {
        makeInstallments();
    });

    $('.installment-calculator-detail button').on('click', function () {
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
    $('input[name="memory"]').change(function() {
        var memory_id = $('input[name="memory"]:checked').val();
        memories.forEach(function(item) {
            if(item.id == memory_id){
                $('.variation-price').text(item.variation_price.toLocaleString());
            }
        });
        makeInstallments();
    });
    function makeInstallments() {
        var memory_id = $('input[name="memory"]:checked').val();
        var total = 0;
        memories.forEach(function(item) {
            if(item.id == memory_id){
                total = parseInt(item.variation_price);
            }
        });
        var advance = parseInt($('#min_advance_price').val());
        var tenure_months = parseInt($('#tenure_months').val());
        console.log(total);
        var remaining_amount = total - advance;
        var total_percentage_amount = (total_tenure_percentage / 100) * remaining_amount;
        var total_amount_with_percentage = total_percentage_amount + remaining_amount;
        var per_installment_price   =  (total_amount_with_percentage / tenure_months).toFixed(0);
        per_installment_price = per_installment_price.toLocaleString()
        var months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];

        $('#installment-rows').html('');
        var rows = '';
        for(var i = 0; i < tenure_months; i++) {
            rows += '<tr><td>'+ (i+1) +'</td><td>'+ (months[i]) +' Month</td><td>Rs. '+ (per_installment_price) +'</td></tr>';
        }
        $('#installment-rows').html(rows);
    }
})(jQuery);