$(function () {
    "use strict";
    $("#change_status").on("change", function () {
        var status = $(this).val();
        var message = 'You cannot change status '+CURRENT_STATUS+' to '+status
        if((CURRENT_STATUS == 'Pending') && ($.inArray(status, ['Processing','Delivered', 'Instalments', 'Completed'])  !== -1)) {
            showErrorModal(message);
            return false;
        }
        if((CURRENT_STATUS == 'Varification') && ($.inArray(status, ['Delivered', 'Instalments', 'Completed'])   !== -1)) {
            showErrorModal(message);
            return false;
        }
        if((CURRENT_STATUS == 'Processing') && ($.inArray(status, ['Instalments', 'Completed'])   !== -1)) {
            showErrorModal(message);
            return false;
        }
        if((CURRENT_STATUS == 'Delivered') && ($.inArray(status, ['Completed'])   !== -1)) {
            showErrorModal(message);
            return false;
        }
        if ($.inArray(status, ['Pending', 'Varification', 'Processing']) !== -1) {
            change_only_status();
        }
        if ($.inArray(status, ['Delivered']) !== -1) {
            $('#delivered-status').modal({
                backdrop: 'static', 
                keyboard: false 
            });
            $(".status").val(status);
        }
        if ($.inArray(status, ['Instalments']) !== -1) {
            $('#instalment-status').modal({
                backdrop: 'static', 
                keyboard: false 
            });
            $(".status").val(status);
        }
    });
    function change_only_status() {
        var status = $("#change_status").val();
        $.ajax({
            url: APP_URL + "/seller/orders/status/"+ORDER_ID,
            type: "GET",
            data: { status: status },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success == true) {
                    showSuccessModal(response.message);
                } 
                else {
                    
                }
            },
        });
    }
    $(".delivered-btn").on("click", function () {
        var formData = new FormData(document.getElementById('delivered-form'));
        $.ajax({
            url: APP_URL + "/seller/orders/status/"+ORDER_ID,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.success == true) {
                    $('#delivered-status').fadeOut();
                    showSuccessModal(response.message);
                } else {
                    $('#delivered-status').fadeOut();
                    showErrorModal(response.message);
                }
            },
            error: function (xhr, status, error) {
                
            }
        });
    });
    $(".instalment-btn").on("click", function () {
        var advance_price = $("#advance_price").val();
        if(advance_price.length == 0) {
            $('#instalment-status').fadeOut();
            showErrorModal('Please add advance price. This is required.');
            return false;
        }
        var formData = new FormData(document.getElementById('instalment-form'));
        $.ajax({
            url: APP_URL + "/seller/orders/status/"+ORDER_ID,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.success == true) {
                    $('#instalment-status').fadeOut();
                    showSuccessModal(response.message);
                } else {
                    $('#instalment-status').fadeOut();
                    showErrorModal(response.message);
                }
            },
            error: function (xhr, status, error) {
                
            }
        });
    });
});

