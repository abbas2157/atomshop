$(document).ready(function() {
    // Initalize Cart
    getCart();
});

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
                var cartCount = 0;
                cart.forEach(function(item) {
                    cartCount += item.quantity;
                    var row = '<tr>\
                        <td class="align-middle">\
                            <img src="'+item.product.picture+'" alt="" style="width: 50px;">\
                            '+item.product.title+'\
                        </td>\
                        <td class="align-middle">\
                            Rs. '+item.product.price+'\
                        </td>\
                        <td class="align-middle">'+item.quantity+'</td>\
                        <td class="align-middle">Rs. '+item.product.total+'</td>\
                        <td class="align-middle">\
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
