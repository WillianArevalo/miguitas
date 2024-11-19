$(document).ready(function () {
    $(".change-status-order").on("click", function () {
        let status = $(this).data("status");
        const form = $(this).closest("form");
        form.find("input[name=status]").val(status);
        form.submit();
    });

    $(".change-status-payment").on("click", function () {
        let status = $(this).data("status");
        const form = $("#form-change-payment-status");
        form.find("input[name=status]").val(status);
        form.submit();
    });
});
