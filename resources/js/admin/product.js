import { list } from "postcss";
import { showToast } from "./toast-admin";

$(document).ready(function () {
    let checboxsProducts = $(".checkboxs-products");
    let idsProducts = [];
    const btnDeleteAllProducts = $("#btn-delete-all-products");

    $("#default-checkbox-products").on("click", function () {
        if ($(this).is(":checked")) {
            if ($(".checkboxs-products").length === 0) {
                btnDeleteAllProducts.addClass("hidden");
                showToast("No hay productos para eliminar", "info");
                return;
            }
        } else {
            btnDeleteAllProducts.addClass("hidden");
        }

        $(".checkboxs-products").prop("checked", $(this).prop("checked"));
        if ($(this).is(":checked")) {
            btnDeleteAllProducts.removeClass("hidden");
        }
    });

    $("#btn-delete-all-products").on("click", function () {
        const form = $("#formDeleteProducts");
        form.find("input[name='products_ids[]']").remove();
        idsProducts = $(".checkboxs-products:checked")
            .map(function () {
                return $(this).val();
            })
            .get();

        idsProducts.forEach(function (id) {
            form.append(
                "<input type='hidden' name='products_ids[]' value='" + id + "'>"
            );
        });
    });

    checboxsProducts.on("click", function () {
        if (checboxsProducts.is(":checked")) {
            btnDeleteAllProducts.removeClass("hidden");
        } else {
            btnDeleteAllProducts.addClass("hidden");
        }
    });

    $(document).on("click", ".selectedCategorie", function (e) {
        if (!e.target.closest(".removeSubcategorie")) {
            $(".optionsSubcategories").toggleClass("hidden");
        }
    });

    $(document).on("click", function (e) {
        if (
            !$(e.target).closest(".optionsSubcategories").length &&
            !$(e.target).closest(".selectedCategorie").length
        ) {
            $(".optionsSubcategories").addClass("hidden");
        }
    });

    const subcategoriesList = $(".itemsSelectedSubcategories");
    const subcategories = $("#subcategories_names").val()
        ? $("#subcategories_names").val().split(",")
        : [];

    let isFirstCheck = true;
    if (subcategories.length > 0) {
        isFirstCheck = false;
    }

    function marcarCheckboxesSeleccionados() {
        if (subcategories.length > 0) {
            subcategoriesList.html("");
            isFirstCheck = false;
            subcategories.forEach((name) => {
                subcategoriesList.append(
                    `<div class="flex items-center justify-between gap-2 bg-zinc-100 text-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 px-2 py-1 rounded-xl text-xs" data-name="${name}">
                    <span>${name}</span>
                    <button data-name="${name}" type="button" class="text-current hover:text-primary-600 removeSubcategorie">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 5L5 19" />
                            <path d="M5 5L19 19" />
                        </svg>
                    </button>
                </div>`
                );
            });
        }
    }

    //marcarCheckboxesSeleccionados();

    $(document).on("click", ".subcategories_checkbox", function () {
        if (
            isFirstCheck ||
            subcategoriesList.text() === "No hay subcategorías seleccionadas"
        ) {
            subcategoriesList.html("");
            isFirstCheck = false;
        }

        const name = $(this).data("name");
        if ($(this).is(":checked")) {
            subcategories.push(name);
            subcategoriesList.append(
                `<div class="flex items-center justify-between gap-2 bg-zinc-100 text-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 px-2 py-1 rounded-xl text-xs" data-name="${name}">
                <span>${name}</span>
                <button data-name="${name}" type="button" class="text-current hover:text-primary-600 removeSubcategorie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M19 5L5 19" /> <path d="M5 5L19 19" /> </svg>
                </button>
            </div>`
            );
        } else {
            const index = subcategories.indexOf(name);
            subcategories.splice(index, 1);
            subcategoriesList.find(`div[data-name="${name}"]`).remove();
        }
    });

    $(document).on("click", ".removeSubcategorie", function (e) {
        e.stopPropagation();
        const name = $(this).data("name");
        const index = subcategories.indexOf(name);
        subcategories.splice(index, 1);
        if (subcategories.length === 0) {
            subcategoriesList.text("No hay subcategorías seleccionadas");
        }

        $(this).closest("div").remove();
        $(document)
            .find(`.subcategories_checkbox[data-name="${name}"]`)
            .prop("checked", false);

        $(".optionsSubcategories").addClass("hidden");
    });

    const $selectedSubCategory = $("#selectedSubCategorie");
    const $parentSubCategory = $selectedSubCategory.parent();

    $("#categorie_id").on("Changed", function () {
        getSubcategories($(this).val());
        subcategoriesList.text("No hay subcategorías seleccionadas");
        subcategories.length = 0;
        isFirstCheck = true;
    });

    function getSubcategories(id) {
        const categorieId = id;
        $("#categorieIdSearch").val(categorieId);
        const action = $("#formSearchSubcategorie").attr("action");
        const data = $("#formSearchSubcategorie").serialize();
        $.ajax({
            type: "POST",
            url: action,
            data: data,
            success: function (response) {
                $("#listSubcategories").html(response.html);
                updateSubCategoryUI(response.subcategoria);
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    function updateSubCategoryUI(subcategoria) {
        if (subcategoria.name === "No tiene subcategorías") {
            $selectedSubCategory.text("No tiene subcategorías");
            $parentSubCategory.addClass("pointer-events-none");
            $parentSubCategory.find("svg").addClass("hidden");
            $("#subcategorie_id").val("").trigger("Changed");
        } else {
            $selectedSubCategory.text(subcategoria.name);
            $parentSubCategory.removeClass("pointer-events-none");
            $parentSubCategory.find("svg").removeClass("hidden");
            $("#subcategorie_id").val(subcategoria.id).trigger("Changed");
            marcarCheckboxesSeleccionados();
        }
    }

    function toggleElementVisibility(element, condition) {
        if (condition) {
            element.removeClass("hidden");
        } else {
            element.addClass("hidden");
        }
    }

    const $dateOffer = $("#dateOffer");
    toggleElementVisibility($dateOffer, $("#offer_price").val() != 0);

    $("#offer_price").on("keyup", function () {
        toggleElementVisibility($dateOffer, $(this).val() != 0);
    });

    $("#main_image").on("change", function () {
        $(this).prev().addClass("hidden");
        $("#previewImage").removeClass("hidden");
        let archive = this.files[0];
        if (archive) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let preview = document.getElementById("previewImage");
                preview.src = e.target.result;
            };
            reader.readAsDataURL(archive);
        }
    });

    let filesImages = [];
    let images = [];
    let isFirstClick = true;

    $("#gallery_image").on("change", imageUpload);
    const $previewImagesContainer = $("#previewImagesContainer");

    if (isFirstClick) {
        $previewImagesContainer.html("");
        isFirstClick = false;
    }

    function imageUpload(e) {
        $previewImagesContainer.removeClass("h-auto").addClass("h-20");
        images = [];
        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            filesImages.push(file);
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageUrl = e.target.result;
                images.push(imageUrl);
                addImagePreview(imageUrl, filesImages.length - 1);
            };
            reader.readAsDataURL(file);
        }
    }

    function addImagePreview(imageUrl, index) {
        $previewImagesContainer.removeClass("h-20").addClass("h-auto");

        const previewDiv = $("<div></div>").addClass(
            "flex items-center flex-col justify-center m-2"
        );
        const imageElement = $("<img />")
            .addClass("w-20 h-20 object-cover rounded-lg")
            .attr("src", imageUrl);

        const deleteButton = $("<button></button>")
            .addClass("bg-red-500 text-white px-2 py-1 rounded-lg mt-1 text-xs")
            .text("Eliminar")
            .attr("type", "button")
            .on("click", function () {
                // Remueve la imagen del contenedor y actualiza los arrays
                images.splice(index, 1);
                filesImages.splice(index, 1);
                previewDiv.remove(); // Elimina el elemento de la vista
                if (images.length === 0) {
                    $previewImagesContainer
                        .html(
                            '<p class="text-sm text-zinc-500 dark:text-zinc-300 m-auto">Sin imágenes seleccionadas</p>'
                        )
                        .removeClass("h-auto")
                        .addClass("h-20");
                }
            });

        previewDiv.append(imageElement, deleteButton);
        $previewImagesContainer.append(previewDiv);
    }

    $("#reloadImages").on("click", function () {
        $("#gallery_image").val("");
        $previewImagesContainer
            .html(
                '<p class="text-sm text-zinc-500 dark:text-zinc-300 m-auto">Sin imágenes seleccionadas</p>'
            )
            .removeClass("h-auto")
            .addClass("h-20");
    });

    let inputLabelsIds = $("#labels_ids");
    let labels = inputLabelsIds.val() ? inputLabelsIds.val().split(",") : [];

    function addLabel() {
        let labelValue = $("#label_id").val();
        if (labelValue && !labels.includes(labelValue)) {
            labels.push(labelValue);
            inputLabelsIds.val(labels);
            updateHiddenLabels();
            updatePreviewLabels();
        } else {
            showToast("La etiqueta ya ha sido seleccionada", "info");
        }
    }

    function updateHiddenLabels() {
        const hiddenLabelsContainer = $("#hiddenLabelsContainer");
        hiddenLabelsContainer.html("");
        labels.forEach((labelValue) => {
            hiddenLabelsContainer.append(
                $("<input>")
                    .attr({ type: "hidden", name: "labels[]" })
                    .val(labelValue)
            );
        });
    }

    $(".deleteImage").on("click", function () {
        const url = $(this).data("url");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                showToast("Imagen eliminada correctamente", "success");
                location.reload();
            },
            error: function (error) {
                console.log(error);
                showToast("Error al eliminar la imagen", "error");
            },
        });
    });

    function updatePreviewLabels() {
        const $previewLabelsContainer = $("#previewLabelsContainer");
        $previewLabelsContainer.html("");
        labels.forEach((labelValue, index) => {
            const previewDiv = $("<div></div>").addClass(
                "bg-white text-zinc-600 border-zinc-400 text-sm font-medium me-2 px-4 py-2 border dark:text-white dark:bg-black dark:border-zinc-800 rounded-lg flex items-center justify-between gap-2"
            );
            const labelElement = $("<span></span>").text(labelValue);
            const removeBtn = $("<button></button>")
                .html(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-current" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none"> <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>'
                )
                .attr("type", "button")
                .addClass("text-current hover:text-primary-600");
            removeBtn.on("click", () => removeLabel(index));
            previewDiv.append(labelElement).append(removeBtn);
            $previewLabelsContainer.append(previewDiv);
        });
        labelTextHide();
    }

    function removeLabel(index) {
        labels.splice(index, 1);
        inputLabelsIds.val(labels);
        updateHiddenLabels();
        updatePreviewLabels();
    }

    function labelTextHide() {
        if (labels.length === 0) {
            $("#previewLabelsContainer").html(
                '<p class="text-sm text-zinc-500 dark:text-zinc-300 p-4 m-auto">Sin etiquetas seleccionadas</p>'
            );
        }
    }

    $("#addLabelSelected").on("click", addLabel);
    $(".removeLabelEdit").on("click", function () {
        removeLabel($(this).data("index"));
    });

    labelTextHide();

    function resetFormAndHideInvalidFeedback(formId) {
        $(formId)[0].reset();
        $(formId).find("input").removeClass("is-invalid");
        $(formId).find(".invalid-feedback").addClass("hidden");
    }

    $("#showModalTax").on("click", function () {
        resetFormAndHideInvalidFeedback("#formAddTax");
    });

    $("#addTaxButton").on("click", function () {
        const taxName = $("#name_tax");
        const rate = $("#rate");
        const messageName = taxName.data("message");
        const messageRate = rate.data("message");

        let isValid = true;

        if (!taxName.val()) {
            taxName.addClass("is-invalid");
            $(messageName).removeClass("hidden").text("El nombre es requerido");
            isValid = false;
        } else {
            taxName.removeClass("is-invalid");
        }

        if (!rate.val()) {
            rate.addClass("is-invalid");
            $(messageRate)
                .removeClass("hidden")
                .text("La tasa de impuesto es requerida");
            isValid = false;
        } else {
            rate.removeClass("is-invalid");
        }

        if (isValid) {
            $.ajax({
                url: $("#formAddTax").attr("action"),
                method: "POST",
                data: $("#formAddTax").serialize(),
                success: function (response) {
                    $("#checkBoxTaxes").html(response.html);
                    $("#addTax").addClass("hidden");
                    $("body").removeClass("overflow-hidden");
                    showToast("Impuesto agregado correctamente", "success");
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    $("#showModalLabel").on("click", function () {
        resetFormAndHideInvalidFeedback("#formAddLabel");
    });

    $("#addLabelButton").on("click", function () {
        const labelName = $("#name_label");
        const messageName = labelName.data("message");

        if (labelName.val() === "") {
            labelName.addClass("is-invalid");
            $(messageName).removeClass("hidden").text("El nombre es requerido");
        } else {
            labelName.removeClass("is-invalid");
            $.ajax({
                url: $("#formAddLabel").attr("action"),
                method: "POST",
                data: $("#formAddLabel").serialize(),
                success: function (response) {
                    $("#labelsList").html(response.html);
                    $("#addLabel").addClass("hidden");
                    $("body").removeClass("overflow-hidden");
                    showToast("Etiqueta agregada correctamente", "success");
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    //! LOGICA PARA LOS ATRIBUTOS Y VARIANTES

    const options = [];
    const listOptions = $("#list-options");

    $("#option_id").on("Changed", function () {
        const value = $(this).val();
        const text = $("#option_id_selected").text().replace(/\s+/g, "");

        if (options.length === 0) {
            listOptions.empty();
        }

        if (!options.some((option) => option.id === value)) {
            options.push({
                id: value,
                name: text,
                values: [],
            });
            const optionHTML = `
            <div data-id="${value}">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-zinc-500 dark:text-zinc-300">${text}</p>
                    <div class="flex items-center gap-2">
                        <button data-id="${value}" type="button" class="delete-option border text-zinc-600 hover:bg-zinc-100 border-zinc-400 dark:border-zinc-800 dark:text-white dark:hover:bg-zinc-900 font-medium rounded-lg flex items-center justify-center gap-2 transition-colors duration-300 text-nowrap px-4 py-2">
                            <svg class="h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"></path>
                                <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"></path>
                            </svg>
                            <span class="text-xs">Eliminar</span>
                        </button>
                        <button data-id="${value}" data-modal-target="addOptionValue" type="button" class="add-option border text-zinc-600 hover:bg-zinc-100 border-zinc-400 dark:border-zinc-800 dark:text-white dark:hover:bg-zinc-900 font-medium rounded-lg flex items-center justify-center gap-2 transition-colors duration-300 text-nowrap px-4 py-2">
                            <svg class="h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            <span class="text-xs">Agregar opciones</span>
                        </button>
                    </div>
                </div>
                <div class="mt-4 rounded-xl flex items-center flex-wrap gap-2 border-2 border-dashed border-zinc-400 p-4 dark:border-zinc-800" id="container-options-${value}">
                    <p class="text-sm text-zinc-500 dark:text-zinc-300 mx-auto">Sin opciones seleccionadas</p>
                </div>
            </div>
        `;
            listOptions.append(optionHTML);
            updatePreviewOptions();
        } else {
            showToast("La opción ya ha sido seleccionada", "info");
        }
    });

    $(document).on("click", ".delete-option", function () {
        const id = $(this).data("id");
        const index = options.findIndex((option) => option.id == id);
        options.splice(index, 1);
        listOptions.find(`div[data-id="${id}"]`).remove();
        updatePreviewOptions();
    });

    function updatePreviewOptions() {
        if (options.length === 0) {
            listOptions.html(
                '<p class="text-sm text-zinc-500 dark:text-zinc-300 m-auto">Sin opciones seleccionadas</p>'
            );
        }
    }

    $(document).on("click", ".add-option", function () {
        const value = $(this).data("id");
        $.ajax({
            url: `/admin/options/search`,
            method: "GET",
            data: { option_id: value },
            success: function (response) {
                $("#option_value_id").val(value);
                $("#addOptionValue").removeClass("hidden").addClass("flex");
                $("body").addClass("overflow-hidden");
                $("#previewOptionsContainer").html(response.html);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $(".closeAddOptionValue").on("click", function () {
        $("#addOptionValue").addClass("hidden").removeClass("flex");
        $("body").removeClass("overflow-hidden");
    });

    $(document).on("click", "input[name='options_checkbox']", function () {
        if ($(this).is(":checked")) {
            const value = $(this).val();
            const text = $(this).data("name");
            const optionId = $(this).data("option-id");

            const existingOption = options.find(
                (option) => option.id == optionId
            );

            const valueExists = existingOption.values.some(
                (val) => val.id == value
            );

            if (!valueExists) {
                existingOption.values.push({
                    id: value,
                    name: text,
                });
            }
            console.log(options);
        } else {
            const value = $(this).val();
            const optionId = $(this).data("option-id");

            const existingOption = options.find(
                (option) => option.id == optionId
            );

            const index = existingOption.values.findIndex(
                (val) => val.id == value
            );

            if (index > -1) {
                existingOption.values.splice(index, 1);
            }
        }
    });

    $("#add-option-value-button").on("click", function () {
        const form = $(this).closest("form");
        $.ajax({
            url: form.attr("action"),
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                $("#previewOptionsContainer").html(response.html);
            },
        });
    });

    $("#addOptionValueButton").on("click", function () {
        const id = $("#option_value_id").val();
        updatePreviwOptionsValues(id);
        $("#addOptionValue").addClass("hidden").removeClass("flex");
        $("body").removeClass("overflow-hidden");
    });

    function updatePreviwOptionsValues(id) {
        const option = options.find((option) => option.id == id);
        const container = $(`#container-options-${id}`);
        container.html("");
        option.values.forEach((value) => {
            container.append(
                `<div class="flex items-center dark:bg-zinc-950 px-2 gap-2 py-1 rounded-full bg-zinc-200" data-id="${value.id}">
                    <p class="text-zinc-500 dark:text-zinc-300 text-xs">
                        ${value.name}
                    </p>
                    <button data-id="${value.id}" type="button" class="delete-option-value text-zinc-800 dark:text-zinc-400 dark:hover:text-white hover:text-zinc-900">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                    </button>
                </div>`
            );
        });

        if (option.values.length === 0) {
            container.html(
                '<p class="text-center text-sm text-zinc-500 dark:text-zinc-300 m-auto">Sin opciones seleccionadas</p>'
            );
        }
    }

    $(document).on("click", ".delete-option-value", function () {
        const id = $(this).data("id");
        const optionId = $("#option_value_id").val();
        const option = options.find((option) => option.id == optionId);
        const index = option.values.findIndex((value) => value.id == id);
        option.values.splice(index, 1);
        updatePreviwOptionsValues(optionId);
    });

    //! ----------------------------

    //Al agregar nuevas opciones a un atributo
    $(".showModalOptionValue").on("click", function () {
        const id = $(this).data("id");
        $("#option_parent_id").val(id);
    });

    //Al eliminar una opción de un atributo
    $(".buttonDeleteOption").on("click", function () {
        const url = $(this).data("url");
        const form = $("#formDeleteOption");
        form.attr("action", url);
    });

    //Confirmar la eliminación de una opción
    $(".confirmDeleteOption").on("click", function () {
        const form = $("#formDeleteOption");
        form.submit();
    });

    //Al eliminar un atributo
    $(".showModalRemoveOptions").on("click", function () {
        const url = $(this).data("url");
        const form = $("#formDeleteAttribute");
        form.attr("action", url);
    });

    //Confirmar la eliminación de un atributo
    $(".confirmDeleteAttribute").on("click", function () {
        const form = $("#formDeleteAttribute");
        form.submit();
    });

    $(".editVariation").on("click", function () {
        const url = $(this).data("url");
        const action = $(this).data("form");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $("#formEditVariation").attr("action", action);
                $("#price_variation").val(response.price);
                $("#stock_variation").val(response.stock);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    $("#addButtonProduct").on("click", function (e) {
        const name = $("#name");
        const shortDescription = $("#short_description");
        const description = $("#long_description");
        const mainImage = $("#main_image");
        const price = $("#price");
        const categorie = $("#categorie_id");
        const subcategorie = $("#subcategorie_id");

        if (!name.val().trim()) {
            name.addClass("is-invalid");
            showToast("El nombre del producto es requerido", "error");
            return;
        } else {
            name.removeClass("is-invalid");
        }

        if (!mainImage.val().trim()) {
            $("#container-main-image").addClass("is-invalid");
            showToast("La imagen principal es requerida", "error");
            return;
        } else {
            $("#container-main-image").removeClass("is-invalid");
        }

        if (!price.val().trim()) {
            price.addClass("is-invalid");
            showToast("El precio es requerido", "error");
            return;
        } else {
            price.removeClass("is-invalid");
        }

        if (!categorie.val().trim()) {
            categorie.addClass("is-invalid");
            showToast("La categoría es requerida", "error");
            return;
        } else {
            categorie.removeClass("is-invalid");
        }

        if (!subcategorie.val() === "") {
            subcategorie.addClass("is-invalid");
            showToast("La subcategoría es requerida", "error");
            return;
        } else {
            subcategorie.removeClass("is-invalid");
        }

        if (
            !name.val().trim() ||
            !mainImage.val().trim() ||
            !price.val().trim()
        ) {
            showToast("Todos los campos son requeridos", "error");
            return;
        }

        const formData = new FormData(
            document.getElementById("formAddProduct")
        );

        // Añadir las imágenes al FormData
        filesImages.forEach((file) => {
            formData.append("gallery_image[]", file);
        });

        formData.append("attributes", JSON.stringify(options));

        // Enviar los datos usando AJAX
        $.ajax({
            url: $("#formAddProduct").attr("action"), // la URL del formulario (o una URL personalizada)
            type: "POST",
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer encabezados de contenido
            success: function (response) {
                if (response.success) {
                    showToast(response.success, "success");
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                } else {
                    showToast(response.error, "error");
                }
                console.log(response);
            },
            error: function (xhr, status, error) {
                showToast("Error al enviar el formulario", "error");
                console.error("Error al enviar el formulario:", error);
            },
        });
    });

    $("#editButtonProduct").on("click", function (e) {
        const name = $("#name");
        const shortDescription = $("#short_description");
        const description = $("#long_description");
        const mainImage = $("#main_image");
        const price = $("#price");
        const categorie = $("#categorie_id");
        const subcategorie = $("#subcategorie_id");

        if (!name.val().trim()) {
            name.addClass("is-invalid");
            showToast("El nombre del producto es requerido", "error");
            return;
        } else {
            name.removeClass("is-invalid");
        }

        if (!price.val().trim()) {
            price.addClass("is-invalid");
            showToast("El precio es requerido", "error");
            return;
        } else {
            price.removeClass("is-invalid");
        }

        if (!categorie.val().trim()) {
            categorie.addClass("is-invalid");
            showToast("La categoría es requerida", "error");
            return;
        } else {
            categorie.removeClass("is-invalid");
        }

        if (!subcategorie.val() === "") {
            subcategorie.addClass("is-invalid");
            showToast("La subcategoría es requerida", "error");
            return;
        } else {
            subcategorie.removeClass("is-invalid");
        }

        if (!name.val().trim() || !price.val().trim()) {
            showToast("Todos los campos son requeridos", "error");
            return;
        }

        const formData = new FormData(
            document.getElementById("formEditProduct")
        );

        // Añadir las imágenes al FormData
        filesImages.forEach((file) => {
            formData.append("gallery_image[]", file);
        });

        // Enviar los datos usando AJAX
        $.ajax({
            url: $("#formEditProduct").attr("action"), // la URL del formulario (o una URL personalizada)
            type: "POST",
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer encabezados de contenido
            success: function (response) {
                if (response.success) {
                    showToast(response.success, "success");
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                } else {
                    showToast(response.error, "error");
                }
            },
            error: function (xhr, status, error) {
                showToast("Error al enviar el formulario", "error");
                console.error("Error al enviar el formulario:", error);
            },
        });
    });

    //Import products
    const fileInput = $("#document");
    const fileLabel = $("#document-label");

    fileInput.on("change", function (event) {
        const fileName = event.target.files[0]?.name || "Seleccionar archivo";
        fileLabel.text(fileName);
    });

    //Export products
    $("#export-products-btn").on("click", function () {
        if (idsProducts.length === 0) {
            showToast("No hay productos seleccionados", "info");
            return;
        }
    });
});
