(function ($) {
    "use strict";
    // Dropdown on mouse hover
    $(document).ready(function () {
        $(".search-click").click(function (e) {
            $(".search-form").submit();
        });
        getFavoriteCount();
        getFavorites();
        getCartCount();
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $(".navbar .dropdown")
                    .on("mouseover", function () {
                        $(".dropdown-toggle", this).trigger("click");
                    })
                    .on("mouseout", function () {
                        $(".dropdown-toggle", this).trigger("click").blur();
                    });
            } else {
                $(".navbar .dropdown").off("mouseover").off("mouseout");
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });

    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $(".back-to-top").fadeIn("slow");
        } else {
            $(".back-to-top").fadeOut("slow");
        }
    });
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Vendor carousel
    $(".vendor-carousel").owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2,
            },
            576: {
                items: 3,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1200: {
                items: 8,
            },
        },
    });

    // Related carousel
    $(".related-carousel").owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
        },
    });

    // Product Quantity
    $(".quantity button").on("click", function () {
        var button = $(this);
        var oldValue = button.parent().parent().find("input").val();
        if (button.hasClass("btn-plus")) {
            if (oldValue < 1) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                var newVal = parseFloat(oldValue);
            }
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find("input").val(newVal);
    });

    //installment-calculator
    $(".installment-calculator button").on("click", function () {
        var button = $(this);
        var oldValue = button.parent().parent().find("input").val();
        if (button.hasClass("btn-plus")) {
            if (oldValue < 12) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                var newVal = parseFloat(oldValue);
            }
        } else {
            if (oldValue > 3) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 3;
            }
        }
        button.parent().parent().find("input").val(newVal);
    });

    // Get or create Guest ID
    function generateGuestId() {
        let guestId = localStorage.getItem("guest_id");
        if (!guestId) {
            guestId = "guest-" + crypto.randomUUID();
            localStorage.setItem("guest_id", guestId);
        }
        return guestId;
    }
    const guestId = generateGuestId();
    function getCartCount() {
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");

        var data =
            user_id && user_id.value
                ? { user_type: user_type, user_id: user_id.value }
                : { user_type: user_type, guest_id: guest_id };

        $.ajax({
            url: API_URL + "/cart/count",
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $(".cart-count").text(response.count);
                } else {
                    $(".cart-count").text("0");
                }
            },
        });
    }
    //  Add to Favorites
    $(document).on("click", ".add-to-favorites", function (event) {
        event.preventDefault();
        var productId = $(this).data("id");
        addToFavorites(productId);
    });
    function addToFavorites(productId) {
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");

        var data =
            user_id && user_id.value
                ? {
                      user_type: user_type,
                      user_id: user_id.value,
                      product_id: productId,
                  }
                : {
                      user_type: user_type,
                      guest_id: guest_id,
                      product_id: productId,
                  };

        $.ajax({
            url: API_URL + "/favorites/add",
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    getFavoriteCount();
                    Toastify({
                        text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! Product added to favorites.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor:
                            "linear-gradient(to right, #FFD333, #3D464D)",
                    }).showToast();
                } else {
                    Toastify({
                        text: "<i class='fas fa-times-circle'></i> <b> Error </b> ! Product not added to favorites.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor:
                            "linear-gradient(to right, #FF0000, #000000)",
                    }).showToast();
                }
            },
            error: function () {
                Toastify({
                    text: "<i class='fas fa-times-circle'></i> <b> Error </b> ! Product not added to favorites.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    escapeMarkup: false,
                    backgroundColor:
                        "linear-gradient(to right, #FF0000, #000000)",
                }).showToast();
            },
        });
    }
    function getFavoriteCount() {
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");

        var data =
            user_id && user_id.value
                ? { user_type: user_type, user_id: user_id.value }
                : { user_type: user_type, guest_id: guest_id };

        $.ajax({
            url: API_URL + "/favorites/count",
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $(".favorite-count").text(response.count);
                } else {
                    $(".favorite-count").text("0");
                }
            },
        });
    }
    function getFavorites() {
        $(".favorites-table").html(
            '<tr><td colspan="5" class="align-middle text-center"><img src="' +
                ASSET_URL +
                '/web/img/loader.gif" class="w-10" alt="Loader"></td></tr>'
        );

        $(".favorites-table").html("");
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");
        if (user_id && user_id.value) {
            var data = { user_type: user_type, user_id: user_id.value };
        } else {
            var data = { user_type: user_type, guest_id: guest_id };
        }
        $.ajax({
            url: API_URL + "/favorites",
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success == true) {
                    var favorites = response.data;
                    favorites.forEach(function (item, index) {
                        var row =
                        '<tr>' +
                        '<td class="align-middle text-center">' + (index + 1) + '</td>' +
                        '<td class="align-middle"><div class="row"><div class="col-md-2"><img src="' + item.picture + '" alt="" style="width: 50px;"></div><div class="col-md-10">' + item.title + ' - '+item.brand+'</div></div></td>' +
                        '<td class="align-middle ">Rs. ' + item.price + '</td>' +
                        '<td class="align-middle text-center"><button class="btn btn-sm btn-danger remove-favorite" data-id="' + item.id + '"><i class="fa fa-times"></i></button></td>' +
                        '<td class="align-middle text-center"><a href="'+APP_URL+'/'+item.slug+'" class="btn btn-sm btn-primary p-2"><i class="fa fa-shopping-cart mr-1"> </i> View Detail</a></td>' +
                        '</tr>';
                        $(".favorites-table").append(row);
                    });
                } else {
                    var row =
                        '<tr><td class="align-middle text-center" colspan="5"><div class="text-center py-3">No product found. Please add some products.</div></td></tr>';
                    $(".favorites-table").append(row);
                }
            },
        });
    }
    $(document).on("click", ".remove-favorite", function (event) {
        event.preventDefault();
        var productId = $(this).data("id");
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");

        var data =
            user_id && user_id.value
                ? {
                      user_type: user_type,
                      user_id: user_id.value,
                      product_id: productId,
                  }
                : {
                      user_type: user_type,
                      guest_id: guest_id,
                      product_id: productId,
                  };
        $.ajax({
            url: API_URL + "/favorites/remove",
            type: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                getFavorites();
                getFavoriteCount();
                Toastify({
                    text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! Product removed from favorites.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    escapeMarkup: false,
                    backgroundColor:
                        "linear-gradient(to right, #FFD333, #3D464D)",
                }).showToast();
            },
            error: function () {
                Toastify({
                    text: "<i class='fas fa-times-circle'></i> <b> Error </b> ! Product not removed from favorites.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    escapeMarkup: false,
                    backgroundColor:
                        "linear-gradient(to right, #FF0000, #000000)",
                }).showToast();
            },
        });
    });
    
     //  Add to Cart Favorites
    $(document).on("click", ".add-to-cart-favorite", function (e) {
        e.preventDefault();

        $(".cart-btn").addClass("d-none");
        $(".loader-btn").removeClass("d-none");

        var product_id = $(this).data("id");
        var price = $(this).data("price");
        var memory_id = $(this).data("memory-id");
        var color_id = $(this).data("color-id");
        var min_advance_price = $(this).data("advance-price");
        var user_type = $("#user-type").val();
        let guest_id = localStorage.getItem("guest_id");
        const user_id = document.getElementById("user_id");
        if (user_id && user_id.value) {
            var data = {
                product_id: product_id,
                memory_id: memory_id,
                color_id: color_id,
                price: price,
                min_advance_price: min_advance_price,
                user_type: user_type,
                user_id: user_id.value,
            };
        } else {
            var data = {
                product_id: product_id,
                memory_id: memory_id,
                color_id: color_id,
                price: price,
                min_advance_price: min_advance_price,
                user_type: user_type,
                guest_id: guest_id,
            };
        }
        $.ajax({
            url: API_URL + "/cart/add",
            method: "POST",
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    $(".loader-btn").addClass("d-none");
                    $(".checkout-btn").html(
                        '<a href="' +
                            APP_URL +
                            '/checkout" class="btn btn-block btn-primary px-3">Proceed To Checkout</a>'
                    );
                    Toastify({
                        text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! Product added into cart.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor:
                            "linear-gradient(to right, #FFD333, #3D464D)",
                    }).showToast();
                    getCartCount();
                } else {
                    $(".loader-btn").addClass("d-none");
                    $(".cart-btn").removeClass("d-none");
                    Toastify({
                        text: "<i class='fas fa-times-circle'></i> <b> Error </b> ! Product not added into cart.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor:
                            "linear-gradient(to right, #FF0000, #000000)",
                    }).showToast();
                }
            },
            error: function () {
                $(".loader-btn").addClass("d-none");
                $(".cart-btn").removeClass("d-none");
                Toastify({
                    text: "<i class='fas fa-times-circle'></i> <b> Error </b> ! Product not added into cart.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    escapeMarkup: false,
                    backgroundColor:
                        "linear-gradient(to right, #FF0000, #000000)",
                }).showToast();
            },
        });
    });
})(jQuery);
