$(document).ready(function () {
    //Store
    $(".btn-add-comment").on("click", function () {
        $(".addComment").removeClass("hidden").addClass("flex");
        $("body").addClass("overflow-hidden");
    });

    $(".closeModalAddComment").on("click", function () {
        $(".addComment").removeClass("flex").addClass("hidden");
        $("body").removeClass("overflow-hidden");
    });
});
