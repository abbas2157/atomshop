$(function () {
    "use strict";
    console.log(CURRENT_STATUS);
    $("#change_status").on("change", function () {
        console.log('hello');
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
        if ($.inArray(status, ['Pending', 'Varification', 'Processing', 'Completed']) !== -1) {
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
        if ($.inArray(status, ['Cancelled']) !== -1) {
            $('#cancelled-status').modal({
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
        $(this).prop('disabled',true);
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
                $(this).prop('disabled',false);
            }
        });
    });
    $(".instalment-modal").on("click", function () {
        $('#instalment-modal').modal({
            backdrop: 'static', 
            keyboard: false 
        });
        $('#instalment_price').val($(this).val());
    });
    $(".instalment-btn").on("click", function () {
        var advance_price = $("#advance_price").val();
        if(advance_price.length == 0) {
            $('#instalment-status').fadeOut();
            showErrorModal('Please add advance price. This is required.');
            return false;
        }
        $(this).prop('disabled',true);
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
                } 
                else {
                    $('#instalment-status').fadeOut();
                    showErrorModal(response.message);
                }
            },
            error: function (xhr, status, error) {
                $(this).prop('disabled',false);
            }
        });
    });
    $(".pay-instalment-btn").on("click", function () {
        $(this).prop('disabled',true);
        var formData = new FormData(document.getElementById('pay-instalment-form'));
        $.ajax({
            url: APP_URL + "/seller/instalment/pay",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.success == true) {
                    console.log(response.success,'true');
                    $('#instalment-modal').fadeOut();
                    showSuccessModal(response.message);
                } 
                else {
                    $('#instalment-modal').fadeOut();
                    showErrorModal(response.message);
                }
            },
            error: function (xhr, status, error) {
                $(this).prop('disabled',false);
            }
        });
    });
    $(".cancelled-btn").on("click", function () {
        $(this).prop('disabled',true);
        var formData = new FormData(document.getElementById('cancelled-form'));
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
                    $('#cancelled-status').fadeOut();
                    showSuccessModal(response.message);
                } 
                else {
                    $('#cancelled-status').fadeOut();
                    showErrorModal(response.message);
                }
            },
            error: function (xhr, status, error) {
                $(this).prop('disabled',false);
            }
        });
    });
});

