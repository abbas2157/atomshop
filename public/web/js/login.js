(function ($) {
    "use strict";
    $(".login").click(function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        $(this).html('<img src="'+ASSET_URL+'/web/img/loader.gif" class="w-10" alt="Loader">');
        let guest_id = localStorage.getItem("guest_id");
        var formData = new FormData(document.getElementById('login-form'));
        formData.append('guest_id', guest_id); 
        $.ajax({
            url: APP_URL + "/login",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success == true) {
                    Toastify({
                        text: "<i class='fas fa-check-circle'></i> <b> Success </b>! You are redirecting.......",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
                    }).showToast();
                    window.location.href = APP_URL + '/home';
                } 
                else {
                    $(".login").prop('disabled', false);
                    $(".login").html('Login');
                    Toastify({
                        text: "<i class='fas fa-times-circle'></i> <b> Error </b>! " + response.message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        escapeMarkup: false,
                        backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
                    }).showToast();
                }
            },
            error: function() {
                Toastify({
                    text: "<i class='fas fa-times-circle'></i> <b> Error </b>! Something went wrong.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    escapeMarkup: false,
                    backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
                }).showToast();

                $(this).prop('disabled', false);
                $(this).html('Login');
            }
        });
    });
})(jQuery);