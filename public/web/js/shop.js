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
        per_installment_price = per_installment_price.toLocaleString();
        var months = ['1st','2nd','3rd','4th','5th','6th','7th','8th','9th','10th','11th','12th'];

        $('#installment-rows').html('');
        var rows = '';
        for(var i = 0; i < tenure_months; i++) {
            rows += '<tr><td>'+ (i+1) +'</td><td>'+ (months[i]) +' Month</td><td>Rs. '+ (per_installment_price) +'</td></tr>';
        }
        $('#installment-rows').html(rows);
    }
    //Add to Cart
    $(".add-to-cart").click(function(e) {
        e.preventDefault();
        var product_id = $(this).data("id");
        var memory_id = $('input[name="memory"]:checked').val();
        var color_id = $('input[name="color"]:checked').val();
        var user_type = $('#user-type').val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");
        if (user_id && user_id.value) {
            var data = { product_id: product_id, memory_id: memory_id, color_id: color_id, user_type : user_type, user_id : user_id.value };
        } else {
            var data = { product_id: product_id, memory_id: memory_id, color_id: color_id, user_type : user_type, guest_id : guest_id };
        }
        $.ajax({
            url: API_URL + "/cart/add",
            method: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success) {
                    Toastify({
                        text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! Product added into cart.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
                    }).showToast();
                    getCartCount();
                } else {
                    
                }
            },
            error: function() {
                
            }
        });
    });

    
    getCart();
    function getCart() {
        $('.cart-table').html('');
        $('#sub-total').text('00.00');
        $('#total').text('00.00');
        var user_type = $('#user-type').val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");
        if (user_id && user_id.value) {
            var data = {user_type : user_type, user_id : user_id.value };
        } else {
            var data = {user_type : user_type, guest_id : guest_id };
        }
        $.ajax({
            url: API_URL + "/cart",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    var cart = response.data.cart;
                    cart.forEach(function(item) {
                        console.log(item, product_id)
                        if(item.product.id == product_id) {
                            console.log('ss')
                            $('.loader-btn').addClass('d-none');
                            $('.cart-btn').addClass('d-none');
                            $('.checkout-btn').html('<a href="" class="btn btn-block btn-primary px-3">Proceed To Checkout</a>');
                        }
                        else {
                            $('.loader-btn').addClass('d-none');
                            $('.cart-btn').removeClass('d-none');
                            $('.checkout-btn').html('');
                        }
                    });
                }
                else {
                    $('.cart-btn').removeClass('d-none');
                    $('.loader-btn').addClass('d-none');
                }
            }
        });
    }
})(jQuery);