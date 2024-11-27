import { showToast } from "../store/toast";

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

    $("#photo-profile").on("change", function () {
        const img = $("#image-profile");
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                img.attr("src", reader.result);
            };
            reader.readAsDataURL(file);
        }

        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: new FormData(form[0]),
            contentType: false,
            processData: false,
            success: function (response) {
                showToast(response.success, "success");

                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function (error) {
                console.error(error);
            },
        });
    });
});
