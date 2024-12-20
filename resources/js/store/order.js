import { showToast } from "../store/toast";

$(document).ready(function () {
    $(".form-paid").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: {
                number_order: $(this).find("input[name='number_order']").val(),
                _token: $(this).find("input[name='_token']").val(),
            },
            success: function (response) {
                if (response.link) {
                    // Wait 1 second before redirect, to ensure the dynamic link is created
                    showToast(response.message, "success");
                    setTimeout(function () {
                        window.location.href = response.link;
                    }, 1000);
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            },
        });
    });

    $("#search-order").on("keyup", function () {
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
                $("#orders-list").html(response.html);
                $("#order-list-mobile").html(response.html_mobile);
            },
        });
    });

    $("#order").on("Changed", function () {
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
                $("#orders-list").html(response.html);
                $("#order-list-mobile").html(response.html_mobile);
            },
        });
    });
});
