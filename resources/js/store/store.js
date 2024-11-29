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
});
