$(document).ready(function () {
    $(".accordion-header").click(function () {
        const target = $(this).data("target");

        $(this).find("svg").toggleClass("rotate-90");

        $(target).toggleClass("hidden");
    });
});
