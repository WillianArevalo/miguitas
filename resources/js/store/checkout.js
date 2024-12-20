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

        if (index === 1) {
            $("#next-step").text("Proceder al pago");
        } else {
            $("#next-step").text("Siguiente");
        }
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
            showToast("Seleccione un método de envío", "info");
            return;
        }

        const form = $("#checkout-form");

        ["department", "municipality", "district"].forEach((field) => {
            const input = form.find(`input[name='${field}']`);
            const select = $("." + input.data("content"));
            if (!input.val().trim()) {
                select.addClass("is-invalid");
            } else {
                select.removeClass("is-invalid");
            }
        });

        if (!validateForm("#checkout-form")) {
            showToast("Complete los campos requeridos", "error");
            return;
        }

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
                }
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                }
                console.log(response);
            },
        });
    });

    function validateForm(formId) {
        let isValid = true;
        $(formId)
            .find("input[required], textarea[required]")
            .each(function () {
                const input = $(this);
                const erroMsg = input.closest("div").find(".error-msg");

                if (!input.val().trim()) {
                    erroMsg.text("Este campo es requerido").show();
                    input.addClass("is-invalid");
                    isValid = false;
                } else {
                    erroMsg.hide();
                    input.removeClass("is-invalid");
                }
            });

        /*      $(formId)
            .find("input[type='hidden'][required][data-type='select']")
            .each(function () {
                const hiddenInput = $(this);
                const selectedItem = hiddenInput
                    .siblings(".relative")
                    .find(".itemSelected");

                const options = hiddenInput
                    .siblings(".relative")
                    .find(".selectOptions .itemOption");
                const errorMsg = hiddenInput.closest("div").find(".error-msg");

                if (!selectedItem.text().trim()) {
                    errorMsg.text("Este campo es requerido").show();
                    hiddenInput.addClass("is-invalid");
                    isValid = false;
                } else {
                    errorMsg.hide();
                    hiddenInput.removeClass("is-invalid");
                }
            }); */

        return isValid;
    }

    showTab(currentTab);

    // Formato de tarjeta de crédito
    /*   $("#card_number").on("input", function () {
        let input = $(this).val().replace(/\D/g, "");
        let cardType = "";
        for (let i = 0; i < input.length; i += 4) {
            cardType += input.substr(i, 4) + " ";
        }
        $(this).val(cardType.trim());
    }); */

    $("input[name='shipping_method']").on("change", function () {
        const id = $(this).val();
        const url = $(this).data("url");
        getCostShipping(id, url);
    });

    $("input[name='estimated_delivery']").on("change", function () {
        const delivery = $(this).val();
        const currentDate = new Date();

        const [year, month, day] = delivery.split("-").map(Number);
        const deliveryDate = new Date(year, month - 1, day);
        if (deliveryDate < currentDate) {
            showToast(
                "La fecha de entrega no puede ser menor a la fecha actual",
                "error"
            );
            $(this).val("");
        }
    });

    $("#municipio, #department, #distrito").on("Changed", function () {
        const shippingMethodSelected = $(
            "input[name='shipping_method']:checked"
        );
        const url = shippingMethodSelected.data("url");
        const nameShipping = shippingMethodSelected.data("name");
        const id = shippingMethodSelected.val();

        if (nameShipping === "Envío a domicilio") {
            getCostShipping(id, url);
        }
    });

    function getCostShipping(id, url) {
        const form = $("#checkout-form");
        $.ajax({
            url: url,
            method: "GET",
            data: { id: id, form: form.serialize() },
            success: function (response) {
                if (response.status === "success") {
                    $("#shipping-rate-info").addClass("hidden");
                    $("#price-shipping-method").text(response.price);
                    $("#checkout-total").text(response.total);
                    $("#checkbox-payment-method").addClass("hidden");
                }
            },
            error: function (response) {
                $("#shipping-rate-info").removeClass("hidden");
                $("#price-shipping-method").text(response.responseJSON.price);
            },
        });
    }

    $("#pending_payment").on("click", function () {
        if ($(this).is(":checked")) {
            $("#btn-completed-order").removeClass("hidden");
        } else {
            $("#btn-completed-order").addClass("hidden");
        }
    });

    $(".payment-cash").on("click", function () {
        const url = $(this).data("url");

        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                if (response.status === "success") {
                    $(".confirmModalPay")
                        .removeClass("hidden")
                        .addClass("flex");
                }
            },
        });
    });
});
