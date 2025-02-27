(function ($) {
    "use strict";

    $(document).ready(function () {
        // Initialize jQuery Validation
        $("#register-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 3 characters"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Password must be at least 6 characters long"
                }
            },
            errorElement: "div",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".input-floating-label").append(error);
            },
            highlight: function (element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element) {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function (form) {
                $(".register").prop('disabled', true);
                $(".register").html('<img src="' + ASSET_URL + '/web/img/loader.gif" class="w-10" alt="Loader">');

                var formData = new FormData(form);
                $.ajax({
                    url: APP_URL + "/register",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        if (response.success == true) {
                            Toastify({
                                text: "<i class='fas fa-check-circle'></i> <b> Success </b>! Redirecting...",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                escapeMarkup: false,
                                backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
                            }).showToast();
                            window.location.href = APP_URL + '/register/verification?user=' + response.data.user_id;
                        } else {
                            $(".register").prop('disabled', false);
                            $(".register").html('Sign up');
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
                    error: function () {
                        Toastify({
                            text: "<i class='fas fa-times-circle'></i> <b> Error </b>! Something went wrong.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            escapeMarkup: false,
                            backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
                        }).showToast();

                        $(".register").prop('disabled', false);
                        $(".register").html('Sign up');
                    }
                });
            }
        });

        $(".register").click(function () {
            $("#register-form").submit();
        });
    });
})(jQuery);
