import { info } from "autoprefixer";
import { showToast } from "./toast";

$(document).ready(function () {
    $(document).on(
        "click",
        ".btnMinusCart, .btnPlusCart, .btnRemoveCart, .add-to-cart",
        function () {
            var dataForm = $(this).data("form");
            const form = $(dataForm);
            const data = $(form).serialize();
            const url = $(form).attr("action");
            handleAjaxRequest(url, data);
        }
    );

    $(document).on("click", ".btn-add-favorite", function () {
        const form = $(this).closest("form");
        const favorite = $(this).data("is-favorite");
        const container = $(this).closest(".favorite-container");
        if (favorite === "favorite") {
            $(this).find("svg").remove();
            $(this).append(`
           <svg class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m8.962 18.91l.464-.588zM12 5.5l-.54.52a.75.75 0 0 0 1.08 0zm3.038 13.41l.465.59zm-5.612-.588C7.91 17.127 6.253 15.96 4.938 14.48C3.65 13.028 2.75 11.335 2.75 9.137h-1.5c0 2.666 1.11 4.7 2.567 6.339c1.43 1.61 3.254 2.9 4.68 4.024zM2.75 9.137c0-2.15 1.215-3.954 2.874-4.713c1.612-.737 3.778-.541 5.836 1.597l1.08-1.04C10.1 2.444 7.264 2.025 5 3.06C2.786 4.073 1.25 6.425 1.25 9.137zM8.497 19.5c.513.404 1.063.834 1.62 1.16s1.193.59 1.883.59v-1.5c-.31 0-.674-.12-1.126-.385c-.453-.264-.922-.628-1.448-1.043zm7.006 0c1.426-1.125 3.25-2.413 4.68-4.024c1.457-1.64 2.567-3.673 2.567-6.339h-1.5c0 2.198-.9 3.891-2.188 5.343c-1.315 1.48-2.972 2.647-4.488 3.842zM22.75 9.137c0-2.712-1.535-5.064-3.75-6.077c-2.264-1.035-5.098-.616-7.54 1.92l1.08 1.04c2.058-2.137 4.224-2.333 5.836-1.596c1.659.759 2.874 2.562 2.874 4.713zm-8.176 9.185c-.526.415-.995.779-1.448 1.043s-.816.385-1.126.385v1.5c.69 0 1.326-.265 1.883-.59c.558-.326 1.107-.756 1.62-1.16z"/></svg>
            `);
        } else {
            $(this).find("svg").remove();
            $(this).append(`
           <svg class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
            `);
        }

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (data) {
                console.log(data);
                if (data.status === "auth") window.location.href = "/login";
                if (data.status === "success" || data.status === "info") {
                    if (data.message) {
                        showToast(data.message, data.status);
                    }
                    $("#favorite-count").text(data.count);
                    $(container).html(data.html);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    function handleAjaxRequest(url, data) {
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            success: function (response) {
                console.log(response);
                if (response.status === "success") {
                    $("#tableCart").html(response.html); // Update table
                    $("#cart-mobile").html(response.html_mobile);
                    $("#cart-count").text(response.total); // Update cart count
                    $("#totalPriceCart").text(response.totalPrice); // Update total price
                    $("#totalTaxes").text(response.totalTaxes);
                    $("#totalWithTaxes").text(response.totalWithTaxes);
                    $("#discount").text(response.totalDiscount);
                    $("#subtotal").text(response.subtotal);
                    $("#totalWithShippingMethod").text(
                        response.totalWithShippingMethod
                    );
                }
                if (response.message) {
                    showToast(response.message, response.status);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    $("#code").on("input", function () {
        if ($(this).val() !== "") {
            $(this).removeClass("is-invalid");
        }
    });

    $(document).on("submit", "#formApplyCoupon", function (e) {
        e.preventDefault();
        if ($("#code").val() == "") {
            $("#code").addClass("is-invalid");
            showToast("Please enter a coupon code", "error");
            return;
        }
        var $form = $(this).closest("form");
        $.ajax({
            url: $form.attr("action"),
            data: $form.serialize(),
            method: "POST",
            success: function (response) {
                console.log(response);
                if (response.success !== undefined) {
                    showToast(response.success, "success");
                    $("#discount").text("-" + response.discount);
                    $("#subtotal").text(response.total);
                    $("#form-coupon").html(response.html);
                    $("#totalWithShippingMethod").text(
                        response.totalWithShippingMethod
                    );
                } else {
                    showToast(response.error, "error");
                }
            },
            error: function (error) {
                console.error(error);
            },
        });
    });

    $("input[name='shipping_method']").on("change", function () {
        $(".shipping-method")
            .removeClass("method-shipping-selected")
            .addClass("border-zinc-400");

        const id = $(this).val();
        $(".shipping-method-" + id)
            .removeClass("border-zinc-400")
            .addClass("method-shipping-selected");
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                console.log(response);
                if (response.status === "success") {
                    $("#totalWithShippingMethod").text(response.total);
                }
            },
        });
    });

    $("#remove-coupon").on("click", function () {
        window.location.reload();
    });
});
