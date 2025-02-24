$(document).ready(function() {
    // Initalize Cart
    getCart();
});

function getCart() {
    $('.cart-table').html('<tr><td colspan="5"><img src="'+ASSET_URL+'/web/img/loader.gif" class="w-10" alt="Loader"></td></tr>');

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
                var cartCount = 0;
                cart.forEach(function(item, index) {
                    cartCount += item.quantity;
                    var row = '<tr>\
                        <td class="align-middle text-center">'+index+1+'</td>\
                        <td class="align-middle">\
                            <div class="row"><div class="col-md-2"><img src="'+item.product.picture+'" alt="" style="width: 50px;"></div>\
                            <div class="col-md-10">'+item.product.title +'</div></div>\
                        </td>\
                        <td class="align-middle text-center">Rs. '+item.product_advance_price+'</td>\
                        <td class="align-middle text-center">Rs. '+item.product_price+'</td>\
                        <td class="align-middle text-center">\
                            <button class="btn btn-sm btn-danger remove-item" data-id="'+item.id+'">\
                                <i class="fa fa-times"></i>\
                            </button>\
                        </td>\
                    <tr>';
                    $('.cart-table').append(row);
                });
                $('#sub-total').text(response.data.sub_total);
                $('#total').text(response.data.total);
                $(".cart-count").text(cartCount);
            }
            else {
                var row = '<tr><td class="align-middle" colspan="5">Cart is empty.</td></tr>';
                $('.cart-table').append(row);
                $('#sub-total').text('00.00');
                $('#total').text('00.00');
                $(".cart-count").text("0");
            }
        }
    });
}

$(document).on('click', ".remove-item", function(event) {
    event.preventDefault();
    var cart_id = $(this).data("id");
    $.ajax({
        url: API_URL + "/cart/remove",
        type: "POST",
        data: {cart_id : cart_id},
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            getCart();
        }
    });
});
