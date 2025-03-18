(function ($) {
    "use strict";

    $(document).ready(function () {
        // Initialize jQuery Validation
        $("#login-form").validate({
            rules: {
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
            onkeyup: function (element) {
                $(element).valid();
            },
            submitHandler: function (form) {
                $(".login").prop('disabled', true);
                $(".login").html('<img src="' + ASSET_URL + '/web/img/loader.gif" class="w-10" alt="Loader">');

                let guest_id = localStorage.getItem("guest_id");
                var formData = new FormData(form);
                formData.append('guest_id', guest_id);

                $.ajax({
                    url: APP_URL + "/login",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        
                        if (response.success == true) {
                            if("user_id" in response.data) {
                                // console.log(response);/
                                Toastify({
                                    text: "<i class='fas fa-check-circle'></i> <b> Success </b>! Redirecting...",
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    escapeMarkup: false,
                                    backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
                                }).showToast();
                                window.location.href = APP_URL + '/register/verification?user=' + response.data.user_id;
                            }
                            else {
                                Toastify({
                                    text: "<i class='fas fa-check-circle'></i> <b> Success </b>! Redirecting...",
                                    duration: 3000,
                                    gravity: "top",
                                    position: "right",
                                    escapeMarkup: false,
                                    backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
                                }).showToast();
                                window.location.href = response.data.back;
                            }
                            
                        } else {
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
                    error: function () {
                        Toastify({
                            text: "<i class='fas fa-times-circle'></i> <b> Error </b>! Something went wrong.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            escapeMarkup: false,
                            backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
                        }).showToast();

                        $(".login").prop('disabled', false);
                        $(".login").html('Login');
                    }
                });
            }
        });
        $(".login").click(function () {
            $("#login-form").submit();
        });
    });
})(jQuery);
