$(document).ready(function () {
    $("#search-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: form.attr("method"),
            data: { search: value },
            success: function (response) {
                $("#results-search").html(response.html);
            },
        });
    });
});
