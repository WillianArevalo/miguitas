$(document).ready(function () {
    const $department = $("#department");
    const $municipio = $("#municipio");

    if ($department.val() !== "") {
        const value = $department.val();
        const url = $department.data("url");
        getMunicipios(value, url);
    }

    if ($municipio.val() !== "") {
        const value = $municipio.val();
        const url = $municipio.data("url");
        const department = $department.val();
        getDistritos(department, value, url);
    }

    $department.on("Changed", function () {
        const value = $(this).val();
        const url = $(this).data("url");
        $(".itemSelectedMunicipio").html("Seleccione un municipio");
        $(".itemSelectedDistrito").html("Seleccione un distrito");
        getMunicipios(value, url);
    });

    function getMunicipios(value, url) {
        $.ajax({
            url: url,
            method: "GET",
            data: { department: value },
            success: function (response) {
                if (response.status === "success") {
                    $("#list-municipios").html(response.html);
                }
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                }
            },
        });
    }

    $(document).on("click", ".itemOptionMunicipio", function () {
        $(".itemSelectedMunicipio").html($(this).html());
        $("#municipio").val($(this).data("value")).trigger("Changed");
    });

    $(document).on("click", ".itemOptionDistrito", function () {
        $(".itemSelectedDistrito").html($(this).html());
        $("#distrito").val($(this).data("value")).trigger("Changed");
    });

    function getDistritos(department, value, url) {
        $.ajax({
            url: url,
            method: "GET",
            data: { department: department, district: value },
            success: function (response) {
                if (response.status === "success") {
                    $("#list-distritos").html(response.html);
                }
            },
            error: function (response) {
                if (response.status === "error") {
                    showToast(response.message, "error");
                }
            },
        });
    }

    $("#municipio").on("Changed", function () {
        const value = $(this).val();
        const url = $(this).data("url");
        const department = $("#department").val();
        $(".itemSelectedDistrito").html("Seleccione un distrito");
        getDistritos(department, value, url);
    });
});
