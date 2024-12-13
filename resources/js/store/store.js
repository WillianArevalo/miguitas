import { showToast } from "../store/toast";

$(document).ready(function () {
    const $wrapperHeadBands = $("#headbands-wrapper");
    const $headBands = $wrapperHeadBands.children();
    const headbandHeight = $headBands.first().outerHeight();

    function animateHeadBands() {
        $wrapperHeadBands.animate(
            {
                top: `-=${headbandHeight}px`,
            },
            1000,
            "linear",
            function () {
                $wrapperHeadBands.append($wrapperHeadBands.children().first());
                $wrapperHeadBands.css("top", "0px");
            }
        );
    }

    setInterval(animateHeadBands, 4000);

    $("#accept-all-cookies, #deny-all-cookies").click(function () {
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                if (response) {
                    $(".cookies").addClass("hidden");
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    const popups = $(".popup");
    if (popups.length > 0) {
        popups.each(function (index, popup) {
            const $popup = $(popup);
            const $popupClose = $popup.find("#buttonPopupPrimary");
            const id = $popupClose.data("reference");
            const form = $("#form-show-popup");
            $.ajax({
                url: form.attr("action"),
                method: "GET",
                data: {
                    reference_id: id,
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error);
                },
            });
        });
    }

    $("#buttonPopupPrimary").click(function () {
        const contentPopup = $(".popupContainer").html();
        let reference = $(this).data("reference");
        let action = $(this).data("action");
        let url = $(this).data("url");

        if (action === "redirect") {
            location.href = url;
        } else {
            const inputPopup = $("#inputPopup");

            if (inputPopup.val() === "") {
                showToast("Por favor rellena el campo requerido", "info");
                return;
            }

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    reference_id: reference,
                    content: inputPopup.val(),
                },
                success: function (response) {
                    showToast("Datos guardados correctamente", "success");
                    $("#container-popup").addClass("hidden");
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        $("#reference_id").val(reference);
        $("#content").val(contentPopup);
        $("#formPopup").submit();
    });

    $("#buttonPopupSecondary").click(function () {
        $("#container-popup").addClass("hidden");
    });
});
