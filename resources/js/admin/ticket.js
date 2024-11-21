$(document).ready(function () {
    $(".assign-ticket").on("click", function () {
        const form = $(this).closest("form");
        const asigne = $(this).data("user");
        form.append(
            `<input type="hidden" name="assigned_to" value="${asigne}">`
        );
        form.submit();
    });
});
