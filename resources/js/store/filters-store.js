$(document).ready(function () {
    var $filterCheckboxes = $(".filter-check");
    var selectedFilters = {};
    const $form = $("#form-filters");
    const $resetButton = $("#reset-filters");
    const $minInput = $("#min");
    const $maxInput = $("#max");

    $minInput.on("input", updatePriceRange);
    $maxInput.on("input", updatePriceRange);

    function updatePriceRange() {
        var min = $minInput.val();
        var max = $maxInput.val();
        if (min || max) {
            selectedFilters["price_range"] = { min: min, max: max };
        } else {
            delete selectedFilters["price_range"];
        }
        addFiltersToForm(selectedFilters);
        toggleResetButton();
    }

    $filterCheckboxes.on("change", function () {
        var name = $(this).attr("name");
        if (!selectedFilters[name]) {
            selectedFilters[name] = [];
        }

        selectedFilters[name] = $filterCheckboxes
            .filter(`[name="${name}"]:checked`)
            .map(function () {
                return $(this).val();
            })
            .get();

        if (selectedFilters[name].length === 0) {
            delete selectedFilters[name];
        }

        addFiltersToForm(selectedFilters);
        toggleResetButton();
    });

    function addFiltersToForm(filters) {
        $form.find('input[name="filters"]').remove();
        var filtersString = JSON.stringify(filters);
        console.log(filtersString);
        $form.append(
            '<input type="hidden" name="filters" value=\'' +
                filtersString +
                "' >"
        );
        sendFilters();
    }

    function sendFilters() {
        $.ajax({
            url: $form.attr("action"),
            type: "POST",
            data: $form.serialize(),
            success: function (response) {
                $("#products-list").html(response.html);
            },
            error: function (response) {
                console.error(
                    "Error al obtener los productos filtrados:",
                    response
                );
            },
        });
    }

    function toggleResetButton() {
        if (Object.keys(selectedFilters).length > 0) {
            $resetButton.removeClass("hidden");
        } else {
            $resetButton.addClass("hidden");
        }
    }

    $("#order").on("Changed", function () {
        var selectedOrder = $(this).val();
        delete selectedFilters["order"];
        selectedFilters["order"] = selectedOrder;
        addFiltersToForm(selectedFilters);
        toggleResetButton();
    });

    $resetButton.on("click", function () {
        $filterCheckboxes.prop("checked", false);
        $("#order").val("");
        $("#search").val("");
        selectedFilters = {};
        addFiltersToForm(selectedFilters);
        toggleResetButton();
    });

    $(".accordion-header-filter").click(function () {
        const target = $(this).data("target");
        $(this).find("svg:last").toggleClass("rotate-180");
        if ($(target).hasClass("open")) {
            $(target).removeClass("open").css("max-height", "0px");
        } else {
            const panelHeight = $(target)[0].scrollHeight;
            $(target)
                .addClass("open")
                .css("max-height", panelHeight + "px");
        }
    });

    $("#search").on("input", function () {
        var $form = $("#form-search-product");

        /* if ($(this).val()) {
            $resetButton.removeClass("hidden");
        } */
        console.log($(this).val());
        $.ajax({
            url: $form.attr("action"),
            method: "POST",
            data: $form.serialize(),
            success: function (response) {
                $("#products-list").html(response.html);
            },
        });
    });
});
