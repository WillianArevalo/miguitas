$(document).ready(function () {
    $(".assign-ticket").on("click", function () {
        const form = $(this).closest("form");
        const asigne = $(this).data("user");
        form.append(
            `<input type="hidden" name="assigned_to" value="${asigne}">`
        );
        form.submit();
    });

    const $previewImages = $("#preview-images");
    const $inputImages = $("#attachments");
    const $btnRemoveImages = $("#btn-remove-attachments");

    $inputImages.on("change", function () {
        $("#container-preview-images").removeClass("hidden");
        $previewImages.html("");
        const files = Array.from($inputImages.prop("files"));
        $btnRemoveImages.removeClass("hidden");
        files.forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                $previewImages.append(
                    `<img src="${e.target.result}" class="rounded-lg size-32 object-cover" width="100">`
                );
            };
            reader.readAsDataURL(file);
        });
    });

    $btnRemoveImages.on("click", function () {
        $inputImages.val("");
        $previewImages.html("");
        $btnRemoveImages.addClass("hidden");
        $("#container-preview-images").addClass("hidden");
    });

    $(".change-status-ticket").on("click", function () {
        let status = $(this).data("status");
        const form = $(this).closest("form");
        form.find("input[name=status]").val(status);
        form.submit();
    });
});
