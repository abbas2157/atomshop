$(function () {
    "use strict";
    $("#change_status").on("change", function () {
        var status = $(this).val();
        if((CURRENT_STATUS == 'Pending') && ($.inArray(status, ['Processing','Delivered', 'Instalments', 'Completed'])  !== -1)) {
            return false;
        }
        if((CURRENT_STATUS == 'Varification') && ($.inArray(status, ['Delivered', 'Instalments', 'Completed'])   !== -1)) {
            return false;
        }
        if((CURRENT_STATUS == 'Processing') && ($.inArray(status, ['Instalments', 'Completed'])   !== -1)) {
            return false;
        }
        if((CURRENT_STATUS == 'Delivered') && ($.inArray(status, ['Completed'])   !== -1)) {
            return false;
        }
        if ($.inArray(status, ['Pending', 'Varification', 'Processing']) !== -1) {
            change_only_status()
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
                    window.location.reload();
                } else {
                    
                }
            },
        });
    }
});

