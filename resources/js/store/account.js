$(document).ready(function () {
    $(".tab-btn").click(function () {
        $(".tab-btn").removeClass("active-tab");
        $(this).addClass("active-tab");
        $(".tab-panel").addClass("hidden");
        const target = $(this).data("target");
        $(target).removeClass("hidden");
    });

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
