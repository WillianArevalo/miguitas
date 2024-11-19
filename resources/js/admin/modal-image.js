$(document).ready(function () {
    const body = $("body");
    const modal = $("#modal-image");
    const imageModal = $("#image-modal");

    $(document).on("click", function (e) {
        if (e.target.classList.contains("main-image")) {
            const mainImage = e.target;
            modal.css("display", "block");
            body.addClass("overflow-hidden");
            imageModal.attr("src", mainImage.src);
        }
    });

    $("#close-modal").on("click", function () {
        closeModal();
    });

    $(document).on("keydown", function (e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });

    function closeModal() {
        modal.css("display", "none");
        body.removeClass("overflow-hidden");
    }
});
