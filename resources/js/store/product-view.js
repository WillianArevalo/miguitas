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

    $(".options_values").on("Changed", function () {
        const option_id = $(this).val();
        const product_id = $("#product_id").val();
        const url = $(this).data("url");
        const container = $(this).parent().parent().next();
        $.ajax({
            type: "GET",
            url: url,
            data: {
                product_id: product_id,
                option_id: option_id,
            },
            success: function (response) {
                const data = response.option;
                let price = data.pivot.price;
                let stock = data.pivot.stock;
                if (price !== 0.0) {
                    let formattedPrice = "$" + price;
                    let div = $("<div>").addClass("flex items-center gap-4");
                    let spanPrice = $("<span>").text(formattedPrice);
                    spanPrice.addClass("text-blue-store text-xl");
                    let spanStock = $("<span>");
                    spanStock.addClass(
                        "text-gray-500  flex items-center gap-1 din-r"
                    );
                    spanStock.append(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M15.493 6.935a.75.75 0 0 1 .072 1.058l-7.857 9a.75.75 0 0 1-1.13 0l-3.143-3.6a.75.75 0 0 1 1.13-.986l2.578 2.953l7.292-8.353a.75.75 0 0 1 1.058-.072m5.025.085c.3.285.311.76.025 1.06l-8.571 9a.75.75 0 0 1-1.14-.063l-.429-.563a.75.75 0 0 1 1.076-1.032l7.978-8.377a.75.75 0 0 1 1.06-.026" clip-rule="evenodd"/></svg>`
                    );
                    spanStock.append(stock + " disponibles");

                    div.append(spanPrice, spanStock);
                    container.html(div);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
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

                    if (id == "buy-now") {
                        window.location.href = "/facturación";
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    /*   $(".secondary-image").on("click", function () {
        $(".container-secondary-image").removeClass("selected");
        $(this).parent().addClass("selected");
        const newSrc = $(this).attr("src");
        $("#main-image").attr("src", newSrc);
    });

    var $review = $("#review");
    var $messageReview = $("#message-review");
    $("#add-review").on("click", function () {
        if ($review.val() === "") {
            $review.addClass("is-invalid");
            $messageReview
                .removeClass("hidden")
                .text("El campo no puede estar vacío");
        }
    });

    $review.on("input", function () {
        if ($review.val() !== "") {
            $review.removeClass("is-invalid");
            $messageReview.addClass("hidden");
        }
    });

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
    });

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

    updateStars(
        $("#star-rating-edit .star-edit"),
        $("#rating-value-edit").val()
    );

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
