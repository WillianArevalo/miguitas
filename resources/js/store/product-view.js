import { showToast } from "./toast";

$(document).ready(function () {
    $(".tab-btn").click(function () {
        $(".tab-btn").removeClass("active-tab");
        $(this).addClass("active-tab");
        $(".tab-panel").addClass("hidden");
        const target = $(this).data("target");
        $(target).removeClass("hidden");
    });

    $("#btn-plus").on("click", function () {
        var qty = parseInt($("#quantity").val());
        qty++;
        const max = parseInt($("#quantity").attr("max"));
        if (qty <= max) {
            $("#quantity").val(qty);
        }
    });

    $("#btn-minus").on("click", function () {
        var qty = parseInt($("#quantity").val());
        if (qty > 1) {
            qty--;
            $("#quantity").val(qty);
        }
    });

    const optionsValues = $(".options_values");
    const options = [];

    $(".options_values").on("Changed", function () {
        const optionValue = $(this).val();
        const optionName = $(this).attr("id");

        const index = options.findIndex((option) => option.type === optionName);

        if (index !== -1) {
            options[index].id = optionValue;
        } else {
            if (options.length < optionsValues.length) {
                options.push({ type: optionName, id: optionValue });
            }
        }

        const product_id = $("#product_id").val();
        const url = $(this).data("url");
        const container = $("#info-variation");

        if (options.length === optionsValues.length) {
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    product_id: product_id,
                    options: options.map((option) => option.id),
                },
                success: function (response) {
                    console.log(response);
                    const data = response.variation;
                    if (data) {
                        const price = parseFloat(data.price);
                        const stock = data.stock;
                        const formattedPrice = "$" + price.toFixed(2);
                        $("#add-to-cart").prop("disabled", false);
                        $("#buy-now").prop("disabled", false);
                        $("#price").val(price);
                        const html = `
                        <div class="flex items-center gap-4">
                            <span class="text-blue-store text-xl">${formattedPrice}</span>
                            <span class="text-gray-500 flex items-center gap-1 font-dine-r">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" class="size-5" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M15.493 6.935a.75.75 0 0 1 .072 1.058l-7.857 9a.75.75 0 0 1-1.13 0l-3.143-3.6a.75.75 0 0 1 1.13-.986l2.578 2.953l7.292-8.353a.75.75 0 0 1 1.058-.072m5.025.085c.3.285.311.76.025 1.06l-8.571 9a.75.75 0 0 1-1.14-.063l-.429-.563a.75.75 0 0 1 1.076-1.032l7.978-8.377a.75.75 0 0 1 1.06-.026" clip-rule="evenodd"/>
                                </svg>
                                ${stock} disponibles
                            </span>
                        </div>`;
                        container.html(html);
                    } else {
                        container.html(
                            `<span class="text-red-500 font-dine-r flex items-center gap-2 mb-4">
                                <svg class="size-5 text-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 5.75a.75.75 0 0 0 .75-.75v-6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75M12 7a1 1 0 1 1 0 2a1 1 0 0 1 0-2" clip-rule="evenodd"/></svg>
                                Sin existencias
                            </span>`
                        );
                        $("#add-to-cart").prop("disabled", true);
                        $("#buy-now").prop("disabled", true);
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    $("#add-to-cart, #buy-now").on("click", function () {
        const form = $("#form-add-to-cart");
        const id = $(this).attr("id");
        let options = [];
        const optionsValues = $(".options_values");
        if (optionsValues.length > 0) {
            $(".options_values").each(function () {
                const value = $(this).val();
                if (value) {
                    options.push(value);
                }
            });
        }

        if (options.length === 0 && optionsValues.length > 0) {
            showToast("Debes seleccionar una opción", "error");
        } else {
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                data: form.serialize(),
                success: function (response) {
                    showToast(response.message, "success");
                    $("#cart-count").text(response.total);
                    $("#cart-count-mobile").text(response.total);
                    if (id == "buy-now") {
                        window.location.href = "/facturacion";
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });
    /*
    $(".secondary-image").on("click", function () {
        $(".container-secondary-image").removeClass("selected");
        $(this).parent().addClass("selected");
        const newSrc = $(this).attr("src");
        $("#main-image").attr("src", newSrc);
    }); */

    /*
    $("#btn-review").on("click", function () {
        $("#review-container").toggleClass("hidden");
    });

    $("#btn-cancel-review").on("click", function () {
        $("#review-container").addClass("hidden");
    });

    $("#btn-edit-review").on("click", function () {
        $(".review-user-current").hide();
        $("#edit-review-container").toggleClass("hidden");
    });

    $("#btn-cancel-edit-review").on("click", function () {
        $(".review-user-current").show();
        $("#edit-review-container").toggleClass("hidden");
    }); */

    function updateStars(stars, ratingValue, starClass) {
        stars.each(function (index) {
            if (index < ratingValue) {
                $(this)
                    .removeClass("start-unselected")
                    .addClass("star-selected");
            } else {
                $(this)
                    .removeClass("star-selected")
                    .addClass("start-unselected");
            }
        });
    }

    /* updateStars(
        $("#star-rating-edit .star-edit"),
        $("#rating-value-edit").val()
    ); */

    $("#star-rating .star").on("click", function () {
        var value = $(this).data("value");
        $("#rating-value").val(value);
        updateStars($("#star-rating .star"), value);
    });

    $("#star-rating .star").on("mouseover", function () {
        var value = $(this).data("value");
        updateStars($("#star-rating .star"), value);
    });

    $("#star-rating .star").on("mouseout", function () {
        var value = $("#rating-value").val() || 0;
        updateStars($("#star-rating .star"), value);
    });

    var $review = $("#review");
    var $messageReview = $("#message-review");

    $("#form-review").on("submit", function (e) {
        e.preventDefault();

        if ($review.val() === "") {
            $review.addClass("is-invalid");
            $messageReview
                .removeClass("hidden")
                .text("El campo no puede estar vacío");
            return;
        }

        if ($review.val().length < 10) {
            $review.addClass("is-invalid");
            $messageReview
                .removeClass("hidden")
                .text("El campo debe tener al menos 10 caracteres");
            return;
        }

        if ($("#rating-value").val() === "") {
            showToast("Debes seleccionar una valoración", "error");
            return;
        }

        $(this).off("submit").submit();
    });

    $review.on("input", function () {
        if ($review.val() !== "") {
            $review.removeClass("is-invalid");
            $messageReview.addClass("hidden");
        }
    });

    /*
    $("#star-rating-edit .star-edit").on("click", function () {
        var value = $(this).data("value");
        $("#rating-value-edit").val(value);
        updateStars($("#star-rating-edit .star-edit"), value);
    });

    $("#star-rating-edit .star-edit").on("mouseover", function () {
        var value = $(this).data("value");
        updateStars($("#star-rating-edit .star-edit"), value);
    });

    $("#star-rating-edit .star-edit").on("mouseout", function () {
        var value = $("#rating-value-edit").val() || 0;
        updateStars($("#star-rating-edit .star-edit"), value);
    }); */
});
