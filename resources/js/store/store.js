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

    $("#accept-all-cookies").click(function () {
        const form = $(this).closest("form");

        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                if (response) {
                    $(".cookies").addClass("hidden");
                }
                console.log(response);
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
            const form = $popup.closest("form");
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
});
