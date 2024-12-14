$(document).ready(function () {
    $("#state").on("Changed", function () {
        const value = $(this).val();
        const url = $(this).data("url");
        $(".itemSelectedMunicipio").html("Seleccione un municipio");
        $(".itemSelectedDistrito").html("Seleccione un distrito");
        $.ajax({
            url: url,
            method: "GET",
            data: { state: value },
            success: function (response) {
                if (response.status === "success") {
                    $("#list-municipios").html(response.html);
                }
                console.log(response);
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                    console.log(response);
                }
                console.log(response);
            },
        });
    });

    $(document).on("click", ".itemOptionMunicipio", function () {
        $(".itemSelectedMunicipio").html($(this).html());
        $("#municipio").val($(this).data("value")).trigger("Changed");
    });

    $(document).on("click", ".itemOptionDistrito", function () {
        $(".itemSelectedDistrito").html($(this).html());
        $("#distrito").val($(this).data("value")).trigger("Changed");
    });

    $("#municipio").on("Changed", function () {
        const value = $(this).val();
        const url = $(this).data("url");
        const state = $("#state").val();
        $(".itemSelectedDistrito").html("Seleccione un distrito");
        $.ajax({
            url: url,
            method: "GET",
            data: { state: state, city: value },
            success: function (response) {
                if (response.status === "success") {
                    $("#list-distritos").html(response.html);
                }
                console.log(response);
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                    console.log(response);
                }
                console.log(response);
            },
        });
    });
});
