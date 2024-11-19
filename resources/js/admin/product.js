import { showToast } from "../toast-admin";
import Quill from "quill";

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
    console.log(subcategories);

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
            console.log("Add", subcategories);
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

        const previewDiv = $("<div></div>").addClass("inline-block m-2");
        const imageElement = $("<img />")
            .addClass("w-20 h-20 object-cover rounded-lg")
            .attr("src", imageUrl);

        const deleteButton = $("<button></button>")
            .addClass("bg-red-500 text-white px-2 py-1 rounded mt-1")
            .text("Eliminar")
            .attr("type", "button")
            .on("click", function () {
                // Remueve la imagen del contenedor y actualiza los arrays
                images.splice(index, 1);
                filesImages.splice(index, 1);
                previewDiv.remove(); // Elimina el elemento de la vista
                alert("Imagen eliminada");
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

    //Muestra el modal para agregar una opción padre
    $("#showModalOption").on("click", function () {
        resetFormAndHideInvalidFeedback("#formAddOption");
    });

    //Agrega una opción padre
    $("#addOptionButton").on("click", function () {
        const optionName = $("#name-option");
        const messageName = optionName.data("message");

        if (optionName.val() === "") {
            optionName.addClass("is-invalid");
            $(messageName).removeClass("hidden").text("El nombre es requerido");
        } else {
            optionName.removeClass("is-invalid");
            $.ajax({
                url: $("#formAddOption").attr("action"),
                method: "POST",
                data: $("#formAddOption").serialize(),
                success: function (response) {
                    $("body").removeClass("overflow-hidden");
                    showToast("Opción agregada correctamente", "success");
                    $("#list-options").html(response.html);
                    $("#addOption").addClass("hidden");
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    //Arreglo para los valores de una opción
    let options = [
        {
            id: "",
            option_id: "",
            value: "",
            stock: 0,
            price: 0,
        },
    ];

    let container;

    $("#add-option-value-button").on("click", addOption);

    $(document).on("click", ".showModalOptionValue", function () {
        resetFormAndHideInvalidFeedback("#formAddOptionValue");
        const id = $(this).data("id");
        container = $($(this).data("container"));
        $("#option_id").val(id);
        $("#addOptionValue").removeClass("hidden").addClass("flex");
        $("body").addClass("overflow-hidden");
        options = [];
        updatePreviewOptions();
    });

    function addOption() {
        let isValid = true;
        $("#formAddOptionValue input").each(function () {
            const input = $(this);
            const messageSelector = input.data("message");
            const message = $(messageSelector);
            if (!input.val().trim()) {
                message.removeClass("hidden").text("El valor es requerido");
                input.addClass("is-invalid");
                isValid = false;
            } else {
                message.addClass("hidden");
                input.removeClass("is-invalid");
            }
        });
        if (isValid) {
            const optionValue = $("#name-option-value").val();
            const stock = $("#stock-option-value").val();
            const price = $("#price-option-value").val();
            options.push({
                id: Date.now(),
                option_id: $("#option_id").val(),
                value: optionValue,
                stock: stock,
                price: price,
            });

            $("#name-option-value").val("");
            $("#stock-option-value").val("");
            $("#price-option-value").val("");
            updatePreviewOptions();
        }
    }

    function updatePreviewOptions() {
        const $previewOptionsContainer = $("#previewOptionsContainer");
        $previewOptionsContainer.html("");
        options.forEach((option, index) => {
            const previewDiv = $("<div></div>").addClass(
                "bg-white text-zinc-600 border-zinc-400 text-sm font-medium px-4 py-2 border dark:text-white dark:bg-black dark:border-zinc-800 rounded-lg flex items-center justify-between gap-2"
            );
            const optionElement = $("<span class='text-nowrap'></span>").text(
                option.value +
                    " - " +
                    "$" +
                    option.price +
                    "(" +
                    option.stock +
                    ")"
            );
            const removeBtn = $("<button></button>")
                .html(
                    '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-current" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none"> <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>'
                )
                .attr("type", "button")
                .addClass("text-current hover:text-primary-600");
            removeBtn.on("click", () => removeOption(index));
            previewDiv.append(optionElement).append(removeBtn);
            $previewOptionsContainer.append(previewDiv);
        });
    }

    //Elimina una opción del arreglo de opciones padre
    function removeOption(index) {
        options.splice(index, 1);
        updatePreviewOptions();
    }

    //Agrega la opción al arreglo de opciones y a los contenedores de preview e inputs
    $("#addOptionValueButton").on("click", function () {
        if (options.length === 0) {
            showToast("Debe agregar al menos una opción", "info");
        }
        updatePreviewAddedOptions(container, options);
        updateHiddenOptions(options);
        $("#addOptionValue").addClass("hidden").removeClass("flex");
        $("body").removeClass("overflow-hidden");
    });

    //Agrega el preview al contenedor de las opciones agregadas
    function updatePreviewAddedOptions(container, options) {
        options.forEach((option) => {
            if (!container.find(`[data-id-option="${option.id}"]`).length) {
                const optionItem = $("<div></div>")
                    .addClass(
                        "bg-zinc-100 flex justify-between items-center text-zinc-800 dark:bg-zinc-950  dark:text-zinc-300 px-4 py-2 mb-1 rounded-xl text-sm"
                    )
                    .attr("data-id-option", option.id);

                const optionElement = $(
                    "<span class='text-nowrap'></span>"
                ).text(
                    `${option.value} - $${option.price} (Stock: ${option.stock})`
                );

                const removeBtn = $("<button></button>")
                    .html(
                        '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-current" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none"> <path d="M19.0005 4.99988L5.00049 18.9999M5.00049 4.99988L19.0005 18.9999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" /></svg>'
                    )
                    .attr("type", "button")
                    .addClass("text-current hover:text-primary-600");
                removeBtn.on("click", () => {
                    removeOptionAdded(option.id);
                });
                optionItem.append(optionElement).append(removeBtn);
                container.append(optionItem);
            }
        });
    }

    //Elimina una opción del arreglo de opciones y del contenedor
    function removeOptionAdded(id) {
        const index = options.findIndex((option) => option.id === id);
        if (index !== -1) {
            options.splice(index, 1);
        }
        $(`[data-id-option="${id}"]`).remove();
        removeHiddenOption(id);
    }

    //Agrega al contenedor el input con los valores de las opciones
    function updateHiddenOptions(options) {
        const $hiddenOptionsContainer = $("#hiddenOptionsContainer");
        options.forEach((option) => {
            $hiddenOptionsContainer.append(
                $("<input>")
                    .attr({
                        type: "hidden",
                        name: "options[]",
                        "data-id-option": option.id,
                    })
                    .val(JSON.stringify(option))
            );
        });
    }

    //Elimina la opción del grupo de inpust ocultos
    function removeHiddenOption(id) {
        $(`#hiddenOptionsContainer [data-id-option="${id}"]`).remove();
    }

    //Eliminar opción
    $(".buttonDeleteOption").on("click", function () {
        const url = $(this).data("url");
        const form = $("#formDeleteOption");
        form.attr("action", url);
    });

    //Confirmar eliminación de la opción
    $(".confirmDeleteOption").on("click", function () {
        $("#formDeleteOption").submit();
    });

    //Mostrar modal de agregar opción en la edición del producto
    $(document).on("click", ".showModalOptionValueEdit", function () {
        resetFormAndHideInvalidFeedback("#formAddOptionEdit");
        const id = $(this).data("id");
        $("#option_id").val(id);
    });

    //Agregar opción en la edición del producto
    $("#addOptionValueButtonEdit").on("click", function () {
        let isValid = true;
        $("#formAddOptionEdit input").each(function () {
            const input = $(this);
            const messageSelector = input.data("message");
            const message = $(messageSelector);
            if (!input.val().trim()) {
                message.removeClass("hidden").text("El valor es requerido");
                input.addClass("is-invalid");
                isValid = false;
            } else {
                message.addClass("hidden");
                input.removeClass("is-invalid");
            }
        });

        if (isValid) {
            $("#formAddOptionEdit").submit();
        }
    });

    // Editar opción
    $(".btnEditOption").on("click", function () {
        const url = $(this).data("url");
        const id_product = $(this).data("id-product");
        const id_option = $(this).data("id-option");
        const action = $(this).data("action");
        $.ajax({
            url: url,
            method: "GET",
            data: { id_product: id_product, id_option: id_option },
            success: function (response) {
                $("#option_id_edit").val(response.option.id);
                $("#name_option_edit").val(response.option.value);
                $("#price_option_edit").val(
                    parseFloat(response.values.price).toFixed(2)
                );
                $("#stock_option_edit").val(response.values.stock);
                $("#option_value_id").val(response.values.id);
                $("#formEditOption").attr("action", action);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });

    //Confirmar edición de la opción
    $("#editOptionValueButton").on("click", function () {
        let isValid = true;
        $("#formEditOption input").each(function () {
            const input = $(this);
            const messageSelector = input.data("message");
            const message = $(messageSelector);
            if (!input.val().trim()) {
                message.removeClass("hidden").text("El valor es requerido");
                input.addClass("is-invalid");
                isValid = false;
            } else {
                message.addClass("hidden");
                input.removeClass("is-invalid");
            }
        });

        if (isValid) {
            $("#formEditOption").submit();
        }
    });

    const quill = new Quill("#editor-container", {
        theme: "snow",
        placeholder: "Descripción larga",
        modules: {
            toolbar: [
                [
                    { header: "1" },
                    { header: "2" },
                    { header: [3, 4, 5, 6] },
                    { font: [] },
                ],
                [
                    { list: "ordered" },
                    { list: "bullet" },
                    { indent: "-1" },
                    { indent: "+1" },
                ],
                [{ align: [] }],
                ["bold", "italic", "underline", "strike"],
                ["link", "image"],
                [{ color: [] }, { background: [] }],
                ["blockquote", "code-block"],
                ["clean"],
            ],
        },
    });

    const quill2 = new Quill("#editor-container-2", {
        theme: "snow",
        placeholder: "Descripción corta",
        modules: {
            toolbar: [
                [
                    { header: "1" },
                    { header: "2" },
                    { header: [3, 4, 5, 6] },
                    { font: [] },
                ],
                [
                    { list: "ordered" },
                    { list: "bullet" },
                    { indent: "-1" },
                    { indent: "+1" },
                ],
                [{ align: [] }],
                ["bold", "italic", "underline"],
                ["link", "image"],
                [{ color: [] }, { background: [] }],
                ["blockquote", "code-block"],
            ],
        },
    });

    $("#addButtonProduct").on("click", function (e) {
        const description = $("#long_description");
        const shortDescription = $("#short_description");
        description.val(quill.root.innerHTML);
        shortDescription.val(quill2.root.innerHTML);

        const formData = new FormData(
            document.getElementById("formAddProduct")
        );

        // Añadir las imágenes al FormData
        filesImages.forEach((file) => {
            formData.append("gallery_image[]", file);
        });

        // Para comprobar los datos en formData antes de enviarlos
        console.log("Archivos seleccionados:", filesImages);
        for (let pair of formData.entries()) {
            console.log(pair[0] + ", " + pair[1]);
        }

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
            },
            error: function (xhr, status, error) {
                console.error("Error al enviar el formulario:", error);
            },
        });
    });
});
