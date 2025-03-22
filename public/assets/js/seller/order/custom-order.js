(function ($) {
    "use strict";
    $("#category_id").on("change", function () {
        var category_id = $(this).val();
        if (category_id == "other") {
          $("#other-category-table").show();
          $("#brand_id").html('<option value="other" selected>Other</option>');
        } else {
          $("#other-category-table").hide();
          $.ajax({
            url: APP_URL + "/installment-calculator/brands",
            type: "GET",
            data: { category_id: category_id },
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
              populateBrands(response.data);
            },
          });
        }
      });

      function populateBrands(brands) {
        $("#brand_id").html('');
        if (brands.length > 0) {
          $("#brand_id").append('<option selected disabled value="0">Select Brand</option>');
          brands.forEach(function (item) {
            $("#brand_id").append('<option value="' + item.id + '">' + item.title + "</option>");
          });
        } else {
          $("#brand_id").append('<option value="0">No Brand Found</option>');
        }
      }

      $("#brand_id").on("change", function () {
        var brand_id = $(this).val();
        if (brand_id == "other") {
          $("#other-brand-table").show();
        } else {
          $("#other-brand-table").hide();
        }
      });
    $(document).ready(function () {
        $("#area_id").select2();
        var allAreaOptions = $("#area_id option").clone();
        $("#city_id").on("change", function () {
            var cityId = $(this).val();
            $("#area_id").empty();
            var filteredOptions = allAreaOptions.filter(function () {
                return $(this).data("city-id") == cityId;
            });
            if (filteredOptions.length > 0) {
                $("#area_id").append(filteredOptions);
            } else {
                $("#area_id").append('<option value="">No Area Found</option>');
            }
            $("#area_id")
                .val($("#area_id option:first").val())
                .trigger("change");
            $("#area_id").select2();
        });
        $("#city_id").trigger("change");
    });
})(jQuery);
