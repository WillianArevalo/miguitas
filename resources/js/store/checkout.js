import { showToast } from "./toast";

$(document).ready(function () {
    const tabs = $(".tab-content");
    const step = $(".steps");
    const btnPrev = $("#prev-step");
    const btnNext = $("#next-step");
    let currentTab = 0;

    function showTab(index) {
        tabs.each(function (i) {
            $(this).toggleClass("hidden", i !== index);
        });

        step.each(function (i) {
            $(this).toggleClass("step-completed", i === index);
        });
        updateButtons(index);
        updateSteps(index);
    }

    function updateButtons(index) {
        btnPrev.toggleClass("hidden", index === 0);
        btnNext.toggleClass("hidden", index === tabs.length - 1);
    }

    function updateSteps(index) {
        step.each(function (i) {
            $(this).toggleClass("step-completed", i < index);
        });
    }

    btnPrev.on("click", function () {
        $("#btn-completed-order").addClass("hidden");
        if (currentTab > 0) {
            currentTab--;
            showTab(currentTab);
            updateSteps(currentTab);
        }
    });

    btnNext.on("click", function () {
        const shippingMethod = $("input[name='shipping_method']:checked").val();

        if (shippingMethod === undefined) {
            showToast("Seleccione un método de envío", "error");
            return;
        }

        const form = $("#checkout-form");

        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: form.serialize(),
            success: function (response) {
                if (response.status === "success") {
                    $("#confirm-data").html(response.html);
                    if (currentTab < tabs.length - 1) {
                        currentTab++;
                        showTab(currentTab);
                        updateSteps(currentTab);
                    }
                    $("#btn-completed-order").removeClass("hidden");
                }
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                    console.log(response);
                }
                console.log(response);
            },
        });
    });

    showTab(currentTab);

    // Formato de tarjeta de crédito
    $("#card_number").on("input", function () {
        let input = $(this).val().replace(/\D/g, "");
        let cardType = "";
        for (let i = 0; i < input.length; i += 4) {
            cardType += input.substr(i, 4) + " ";
        }
        $(this).val(cardType.trim());
    });

    $("input[name='shipping_method'], input[name='payment_method']").on(
        "change",
        function () {
            const id = $(this).val();
            const url = $(this).data("url");
            $.ajax({
                url: url,
                method: "GET",
                data: { id: id },
                success: function (response) {
                    if (response.status === "success") {
                        $("#price-shipping-method").text(response.price);
                        $("#checkout-total").text(response.total);
                    }
                    console.log(response);
                },
                error: function (response) {
                    if (response.status === "error") {
                        showToast(response.message, "error");
                        console.log(response);
                    }
                    console.log(error);
                },
            });
        }
    );
});
