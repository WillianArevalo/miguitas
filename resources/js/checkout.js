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
        if (currentTab > 0) {
            currentTab--;
            showTab(currentTab);
            updateSteps(currentTab);
        }
    });

    btnNext.on("click", function () {
        if (currentTab < tabs.length - 1) {
            currentTab++;
            showTab(currentTab);
            updateSteps(currentTab);
        }
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

    $(".shipping-method").on("click", function () {
        $(".shipping-method").removeClass("shipping-method-selected");
        $(this).addClass("shipping-method-selected");
    });

    $(".payment-method").on("click", function () {
        $(".payment-method").removeClass("method-payment-selected");
        $(this).addClass("method-payment-selected");
    });

    /*  $("input[name='payment_method']").on("change", function () {
        $(".payment-methods").removeClass("method-payment-selected");

        $(".payment-method").hide();
        const name = $(this).data("name");
        const form = $(this).closest("form");
        if (name == "Tarjeta de crédito") {
            $(".credit-card").show();
        }

        $(this).parent().addClass("method-payment-selected");

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                if (response.success) {
                    showToast(response.success, "success");
                    $("#payment-method-selected").html(response.html);
                }
            },
        });
    }); */
});
