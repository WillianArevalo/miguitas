$(document).ready(function () {
    $(".add-address").on("click", function () {
        $("#container-address-empty").hide();
        $("#container-address-list").hide();
        $("#container-form-add-address").show();
    });

    $("#cancel-address").on("click", function () {
        $("#container-address-empty").show();
        $("#container-address-list").show();
        $("#container-form-add-address").hide();
    });
});
