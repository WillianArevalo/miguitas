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

    $("#btn-change-password").on("click", function () {
        const $newPassword = $("#new-password");
        const $confirmPassword = $("#confirm-password");

        if ($newPassword.val() !== $confirmPassword.val()) {
            showToast("Las contraseñas no coinciden", "error");
            $newPassword.addClass("is-invalid");
            $confirmPassword.addClass("is-invalid");
            return;
        }
        $("#formChangePassword").submit();
    });
});
