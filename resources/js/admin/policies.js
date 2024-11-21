import { showToast } from "./toast-admin";

$(document).ready(function () {
    $("#file-policie").on("change", function () {
        showPreviewImages(this, "#preview-images");
    });
    function showPreviewImages(input, previewContainer) {
        const $previewContainer = $(previewContainer);
        $previewContainer.empty();
        $(input).prev().addClass("hidden");
        const files = input.files;
        if (files && files.length > 0) {
            Array.from(files).forEach((file) => {
                if (file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = $("<img>")
                            .attr("src", e.target.result)
                            .addClass(
                                "h-32 w-32 object-cover rounded-lg border border-gray-300"
                            );
                        $previewContainer.append(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }
});
