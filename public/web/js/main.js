(function ($) {
    "use strict";
    // Dropdown on mouse hover
    $(document).ready(function () {
        getCartCount();
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:8
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

    //installment-calculator
    $('.installment-calculator button').on('click', function () {
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
    });

    //Add to Cart
    $(".add-to-cart").click(function(e) {
        e.preventDefault();
        var product_id = $(this).data("id");
        var user_type = $('#user-type').val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");
        if (user_id && user_id.value) {
            var data = { product_id: product_id, user_type : user_type, user_id : user_id.value };
        } else {
            var data = { product_id: product_id, user_type : user_type, guest_id : guest_id };
        }
        $.ajax({
            url: API_URL + "/cart/add",
            method: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    getCartCount();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function() {
                alert("Something went wrong! Please try again.");
            }
        });
    });
    // Get or create Guest ID
    function generateGuestId() {
        let guestId = localStorage.getItem("guest_id");
        if (!guestId) {
            guestId = 'guest-' + crypto.randomUUID();
            localStorage.setItem("guest_id", guestId);
        }
        return guestId;
    }
    const guestId = generateGuestId();
    function getCartCount() {
        var user_type = $('#user-type').val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");

        var data = user_id && user_id.value
            ? { user_type: user_type, user_id: user_id.value }
            : { user_type: user_type, guest_id: guest_id };

        $.ajax({
            url: API_URL + "/cart/count",
            type: "POST",
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success) {
                    $(".cart-count").text(response.count);
                } else {
                    $(".cart-count").text("0");
                }
            }
        });
    }
})(jQuery);

