@extends('layouts.admin-template')
@section('title', 'Editar producto')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-crud-page', [
            'title' => 'Editar producto',
            'text' => 'Regresar a la lista de productos',
            'url' => route('admin.products.index'),
        ])
        <div class="bg-white p-4 dark:bg-black">
            <div class="mx-auto w-full">
                <form action="{{ route('admin.products.update', $product->id) }}"" class="flex flex-col gap-4"
                    enctype="multipart/form-data" method="POST" id="formEditProduct">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="flex flex-col gap-1">
                            <h2 class="text-sm font-bold uppercase text-zinc-600 dark:text-zinc-300 sm:text-base md:text-lg">
                                Editar información del producto
                            </h2>
                            <x-paragraph>
                                Los campos marcados con <span class="text-red-500">*</span> son obligatorios
                            </x-paragraph>
                        </div>
                        <div class="mt-4 flex flex-col gap-4 lg:flex-row">
                            <!-- Column 1 -->
                            <div class="flex flex-1 flex-col gap-4">
                                <!-- General info -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        General
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent dark:border-zinc-800 dark:bg-black">
                                        <div class="flex flex-col gap-4 p-4">
                                            <div>
                                                <x-input label="Nombre" type="text" id="name" name="name"
                                                    placeholder="Escribe el nombre del producto aquí" required="required"
                                                    value="{{ $product->name }}" />
                                            </div>
                                            <div>
                                                <x-input label="Descripción corta" type="textarea" id="short_description"
                                                    name="short_description" value="{{ $product->short_description }}"
                                                    required="required"
                                                    placeholder="Escribe la descripción corta del producto aquí" />
                                            </div>
                                            <div>
                                                <x-input label="Descripción larga" type="textarea" name="long_description"
                                                    id="long_description"
                                                    placeholder="Escribe la descripción larga del producto aquí"
                                                    value="{{ $product->long_description }}" />
                                            </div>
                                            <div class="flex flex-col gap-4">
                                                <div>
                                                    <x-input label="Peso(KG)" required="required" name="weight"
                                                        id="weight" type="number" step="0.1" min="1"
                                                        placeholder="0.00" value="{{ $product->weight }}"
                                                        icon="weight-scale" />
                                                </div>
                                                <div>
                                                    <x-input type="checkbox" name="is_active" id="is_active"
                                                        label="Producto activo" value="{{ $product->is_active }}"
                                                        checked="{{ $product->is_active === 1 }}" />
                                                </div>
                                                <div>
                                                    <x-input type="checkbox" name="is_top" id="is_active"
                                                        label="Marcar como producto destacado"
                                                        value="{{ $product->is_top }}"
                                                        checked="{{ $product->is_top === 1 }}" />
                                                </div>
                                                <div>
                                                    <x-input type="checkbox" name="is_the_month" id="is_the_month"
                                                        label="Marcar como producto del mes"
                                                        value="{{ $product->is_the_month }}"
                                                        checked="{{ $product->is_the_month === 1 }}" />
                                                </div>
                                                <div>
                                                    <x-input type="checkbox" name="active_dedication" id="active_dedication"
                                                        label="Activar dedicatoria"
                                                        value="{{ $product->active_dedication }}"
                                                        checked="{{ $product->active_dedication === 1 }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div
                                                class="flex items-center justify-between border-y border-zinc-400 p-4 dark:border-zinc-800">
                                                <h4 class="text-base font-semibold text-black dark:text-white">
                                                    Atributos
                                                </h4>
                                                <div class="flex items-center gap-2">
                                                    <x-button type="button" typeButton="secondary" id="showModalOption"
                                                        data-modal-target="assignAttribute"
                                                        data-modal-toggle="assignAttribute"
                                                        text="Agregar atributo existente" icon="plus" />
                                                    <x-button type="button" typeButton="secondary" id="showModalOption"
                                                        data-modal-target="addAttributeModal"
                                                        data-modal-toggle="addAttributeModal" text="Nuevo atributo"
                                                        icon="plus" />
                                                </div>
                                            </div>
                                            <div class="mt-4 px-4 pb-4" id="list-options">
                                                @if ($groupedOptions->count() > 0)
                                                    <div class="flex w-full flex-col gap-4">
                                                        @foreach ($groupedOptions as $group)
                                                            <div
                                                                class="rounded-xl border-2 border-dashed border-zinc-400 p-4 dark:border-zinc-800">
                                                                <div class="flex items-center justify-between">
                                                                    <div class="flex flex-1 flex-col justify-center gap-2">
                                                                        <label for="{{ $group['name'] }}"
                                                                            class="flex items-center gap-2">
                                                                            <span
                                                                                class="text-sm font-medium text-zinc-500 dark:text-zinc-300">
                                                                                {{ $group['name'] }}
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="flex flex-1 items-center justify-end gap-2">
                                                                        <x-button type="button" typeButton="secondary"
                                                                            size="small" text="Nueva opción"
                                                                            icon="plus"
                                                                            data-modal-target="addOptionValue"
                                                                            class="showModalOptionValue"
                                                                            data-modal-toggle="addOptionValue"
                                                                            data-id="{{ $group['id'] }}" />
                                                                        <x-button type="button" typeButton="danger"
                                                                            size="small" text="Eliminar atributo"
                                                                            icon="delete"
                                                                            data-modal-target="removeOptions"
                                                                            data-url="{{ Route('admin.options.destroy', $group['id']) }}"
                                                                            class="showModalRemoveOptions"
                                                                            data-modal-toggle="removeOptions" />
                                                                    </div>
                                                                </div>
                                                                @if ($group['values'])
                                                                    <div class="mt-4 flex w-full flex-wrap gap-2">
                                                                        @foreach ($group['values'] as $optionValue)
                                                                            <div
                                                                                class="flex justify-between gap-4 rounded-full border border-zinc-400 bg-zinc-100 px-3 py-1 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300">
                                                                                <div class="font-medium">
                                                                                    <span
                                                                                        class="text-xs text-zinc-800 dark:text-zinc-400">
                                                                                        {{ $optionValue['value'] }}
                                                                                    </span>
                                                                                </div>
                                                                                <div class="flex items-center gap-1">
                                                                                    <button type="button"
                                                                                        class="buttonDeleteOption"
                                                                                        data-url="{{ Route('admin.options-values.destroy', $optionValue['id']) }}"
                                                                                        data-modal-target="deleteModalOption"
                                                                                        data-modal-toggle="deleteModalOption">
                                                                                        <x-icon icon="delete"
                                                                                            class="size-3 text-red-500" />
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <x-paragraph>
                                                        Sin opciones registradas
                                                    </x-paragraph>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End general info -->

                                <!-- Inventory -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        Inventario
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent p-4 dark:border-zinc-800 dark:bg-black">
                                        <div class="flex flex-col gap-4 sm:flex-row">
                                            <div class="flex-1">
                                                <x-input label="SKU" type="text" id="sku" name="sku"
                                                    value="{{ $product->sku }}" placeholder="XXXXXX"
                                                    required="required" />
                                            </div>
                                            <div class="flex-[2]">
                                                <x-input label="Código de barras" type="text" id="barcode"
                                                    name="barcode" value="{{ $product->barcode }}"
                                                    placeholder="Código de barras del producto" required="required" />
                                            </div>
                                        </div>
                                        <div class="mt-4 flex flex-col gap-4 sm:flex-row">
                                            <div class="flex-1">
                                                <x-input label="Cantidad" type="number" id="stock" name="stock"
                                                    value="{{ $product->stock }}" placeholder="#" required="required" />
                                            </div>
                                            <div class="flex-1">
                                                <x-input label="Cantidad máxima" type="number" id="max_stock"
                                                    name="max_stock" value="{{ $product->max_stock }}" placeholder="#"
                                                    required="required" />
                                            </div>
                                            <div class="flex-1">
                                                <x-input label="Cantidad mínima" type="number" id="min_stock"
                                                    name="min_stock" value="{{ $product->min_stock }}" placeholder="#"
                                                    required="required" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End inventory -->

                                <!-- SEO info -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        Categoría y subcategorías
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent p-4 dark:border-zinc-800 dark:bg-black">
                                        <div class="flex flex-col gap-4">
                                            <div class="flex flex-col gap-4">
                                                <div class="flex-1">
                                                    <x-select label="Categoría del producto" id="categorie_id"
                                                        name="categorie_id" :options="$categories->pluck('name', 'id')->toArray()"
                                                        value="{{ $product->categorie_id }}"
                                                        selected="{{ $product->categorie_id }}" />
                                                </div>
                                                <div class="flex-1">
                                                    <label
                                                        class="mb-2 block text-sm font-medium text-zinc-900 after:ml-0.5 after:text-red-500 after:content-['*'] dark:text-white">
                                                        Subcategoría del producto
                                                    </label>
                                                    <input type="hidden" name="subcategorie_id" id="subcategories_names"
                                                        value="{{ $product->subcategories->pluck('name')->implode(', ') }}">
                                                    <div class="relative">
                                                        <div
                                                            class="selectedCategorie @error('subcategorie_id') is-invalid @enderror flex w-full items-center justify-between rounded-lg border border-zinc-400 bg-zinc-50 px-4 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-white">
                                                            <span
                                                                class="itemsSelectedSubcategories flex w-full flex-wrap items-center gap-2">
                                                                @if ($product->subcategories->count() > 0)
                                                                    @foreach ($product->subcategories as $subcategorie)
                                                                        <div class="flex items-center justify-between gap-2 rounded-xl bg-zinc-100 px-2 py-1 text-xs text-zinc-800 dark:bg-zinc-900 dark:text-zinc-300"
                                                                            data-name="{{ $subcategorie->name }}">
                                                                            <span>{{ $subcategorie->name }}</span>
                                                                            <button data-name="{{ $subcategorie->name }}"
                                                                                type="button"
                                                                                class="removeSubcategorie text-current hover:text-primary-600">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="h-4 w-4" viewBox="0 0 24 24"
                                                                                    width="24" height="24"
                                                                                    fill="none" stroke="currentColor"
                                                                                    stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path d="M19 5L5 19" />
                                                                                    <path d="M5 5L19 19" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </span>
                                                            <x-icon icon="arrow-down"
                                                                class="h-5 w-5 text-zinc-500 dark:text-white" />
                                                        </div>
                                                        <ul class="optionsSubcategories absolute z-10 mt-2 hidden w-full rounded-lg border border-zinc-400 bg-white p-2 shadow-lg dark:border-zinc-800 dark:bg-zinc-950"
                                                            id="listSubcategories">
                                                            @if ($subcategories->count() > 0)
                                                                @foreach ($subcategories as $subcategorie)
                                                                    <li class="itemOptionSubcategorie flex gap-2 rounded-lg px-4 py-2.5 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
                                                                        data-value="{{ $subcategorie->id }}"
                                                                        data-input="#subcategorie_id">
                                                                        <div>
                                                                            <x-input type="checkbox"
                                                                                value="{{ $subcategorie->id }}"
                                                                                name="subcategories[]"
                                                                                class="subcategories_checkbox"
                                                                                data-name="{{ $subcategorie->name }}"
                                                                                checked="{{ $product->subcategories->contains($subcategorie->id) }}" />
                                                                        </div>
                                                                        {{ $subcategorie->name }}
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    @error('subcategorie_id')
                                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End SEO info -->
                            </div>
                            <!-- End column 1 -->

                            <!-- Column 2 -->
                            <div class="flex flex-1 flex-col gap-4">
                                <!-- Images -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        Etiquetas
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent p-4 dark:border-zinc-800 dark:bg-black">
                                        <div>
                                            <x-paragraph
                                                class="mb-2 after:ml-0.5 after:text-red-500 after:content-['*'] dark:text-zinc-400">
                                                Imagen principal
                                            </x-paragraph>
                                            <label for="main_image"
                                                class="dark:hover:bg-bray-800 @error('main_image') is-invalid  @enderror flex h-80 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-400 bg-zinc-50 hover:bg-zinc-100 dark:border-zinc-800 dark:bg-transparent dark:hover:border-zinc-800 dark:hover:bg-zinc-950">
                                                <div class="hidden flex-col items-center justify-center pb-6 pt-5">
                                                    <x-icon icon="cloud-upload"
                                                        class="h-12 w-12 text-zinc-400 dark:text-zinc-500" />
                                                    <p class="mb-2 text-sm text-zinc-500 dark:text-zinc-400">
                                                        <span class="font-semibold">
                                                            Clic para agregar
                                                        </span>
                                                        o desliza la imagen
                                                    </p>
                                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                                        PNG, JPG, WEBP
                                                    </p>
                                                </div>
                                                <input id="main_image" type="file" class="hidden"
                                                    name="main_image" />
                                                <img src="{{ Storage::url($product->main_image) }}"
                                                    alt="Preview Image {{ $product->name }}" id="previewImage"
                                                    class="m-10 h-64 w-56 object-cover">
                                            </label>
                                        </div>
                                        <div class="mt-4">
                                            @if ($product->images->count() > 0)
                                                <div
                                                    class="@php $product->images->count()>0 ? "h-auto": "h-24" @endphp mt-4 flex flex-wrap justify-start gap-2 rounded-lg border-2 border-dashed border-zinc-400 p-2 dark:border-zinc-800">
                                                    @foreach ($product->images as $image)
                                                        <div
                                                            class="flex flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 p-2 dark:border-zinc-800">
                                                            <img src="{{ Storage::url($image->image) }}"
                                                                alt="Galería de imágenes {{ $product->name }}"
                                                                class="h-24 w-full rounded-lg object-cover" />
                                                            <x-button type="button" typeButton="danger"
                                                                class="deleteImage" icon="delete" size="small"
                                                                text="Eliminar"
                                                                data-url="{{ Route('admin.products.delete-image', $image->id) }}" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="mb-2 mt-4 flex items-center justify-between">
                                                <div>
                                                    <x-paragraph>
                                                        Nuevas imágenes
                                                    </x-paragraph>
                                                    <x-paragraph class="w-48 text-xs">
                                                        Nota: Selecciona todas las imáges de una sola vez.
                                                    </x-paragraph>
                                                </div>
                                                <div class="flex gap-2 text-sm text-zinc-400">
                                                    <label for="gallery_image"
                                                        class="flex cursor-pointer items-center gap-2 rounded-lg border border-zinc-400 px-3.5 py-2.5 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:text-white dark:hover:bg-zinc-900">
                                                        <x-icon icon="image-add" class="h-4 w-4 text-current" />
                                                        <span class="hidden sm:block">
                                                            Seleccionar imágenes
                                                        </span>
                                                    </label>
                                                    <input type="file" name="images" id="gallery_image" multiple
                                                        class="hidden">
                                                    <x-button type="button" id="reloadImages" typeButton="secondary"
                                                        icon="reload" onlyIcon="true" />
                                                </div>
                                            </div>
                                            <div class="mt-4 flex h-24 flex-wrap justify-start gap-2 rounded-lg border-2 border-dashed border-zinc-400 dark:border-zinc-800"
                                                id="previewImagesContainer">
                                                <x-paragraph class="m-auto">Sin imágenes seleccionadas</x-paragraph>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Images -->

                                <!-- Shipping info -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        Información de ventas
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent dark:border-zinc-800 dark:bg-black">
                                        <div class="flex flex-col">
                                            <div class="p-4">
                                                <div class="flex gap-4">
                                                    <div class="flex-1">
                                                        <x-input label="Precio" icon="dollar" type="number"
                                                            id="price" name="price" step="0.01" min="0.01"
                                                            placeholder="0.00" value="{{ $product->price }}" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <x-input label="Precio máximo" icon="dollar" type="number"
                                                            id="max_price" name="max_price" step="0.01"
                                                            min="0.01" placeholder="0.00"
                                                            value="{{ $product->max_price }}" />
                                                    </div>

                                                </div>
                                                <div class="mt-4 flex">
                                                    <div class="flex-1">
                                                        <x-input label="Precio de oferta" icon="dollar" type="number"
                                                            id="offer_price" name="offer_price" step="0.01"
                                                            min="0.1" placeholder="0.00"
                                                            value="{{ $product->offer_price }}" />
                                                    </div>
                                                </div>
                                                <div class="mt-4 hidden" id="dateOffer">
                                                    <label
                                                        class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
                                                        Fecha de la oferta
                                                    </label>
                                                    <div class="mt-2 flex flex-col items-center gap-2 sm:mt-0 sm:flex-row">
                                                        <div class="w-full flex-1">
                                                            <x-input type="date" name="offer_start_date"
                                                                icon="calendar" value="{{ $product->offer_start_date }}"
                                                                placeholder="Seleccionar fecha de inicio" />
                                                        </div>
                                                        <span class="mx-4 text-zinc-500">a</span>
                                                        <div class="w-full flex-1">
                                                            <x-input type="date" name="offer_end_date" icon="calendar"
                                                                value="{{ $product->offer_end_date }}"
                                                                placeholder="Seleccionar fecha de fin" />
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col gap-1">
                                                        @error('offer_start_date')
                                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                                        @enderror
                                                        @error('offer_end_date')
                                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-4">
                                                        <x-input type="checkbox" name="offer_active" id="offer_active"
                                                            label="Activar oferta" value="{{ $product->offer_active }}"
                                                            checked="{{ $product->offer_active === 1 }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-t border-zinc-400 dark:border-zinc-800">
                                                <div
                                                    class="flex items-center justify-between border-b border-zinc-400 p-4 dark:border-zinc-800">
                                                    <h4 class="text-base font-semibold text-black dark:text-white">
                                                        Impuestos
                                                    </h4>
                                                    <x-button type="button" id="showModalTax" data-modal-target="addTax"
                                                        data-modal-toggle="addTax" text="Nuevo impuesto" icon="plus"
                                                        typeButton="secondary" />
                                                </div>
                                                <div class="mt-4 flex flex-col px-4 pb-4">
                                                    <x-paragraph>
                                                        Lista de impuestos asignados al producto
                                                    </x-paragraph>
                                                    <div class="flex flex-col" id="checkBoxTaxes">
                                                        @if ($taxes->count() > 0)
                                                            @foreach ($taxes as $tax)
                                                                <div class="flex items-center gap-2">
                                                                    <div>
                                                                        <x-input type="checkbox" name="tax_id[]"
                                                                            value="{{ $tax->id }}"
                                                                            id="{{ $tax->name }}"
                                                                            label="{{ $tax->name }}"
                                                                            checked="{{ $product->taxes->contains($tax->id) }}" />
                                                                    </div>
                                                                    <span
                                                                        class="flex items-center text-xs text-primary-600">
                                                                        ({{ $tax->rate }}%)
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End shipping info -->

                                <!-- Labels -->
                                <div>
                                    <h4
                                        class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                                        Etiquetas
                                    </h4>
                                    <div
                                        class="h-max rounded-lg border border-zinc-400 bg-transparent dark:border-zinc-800 dark:bg-black">
                                        <div
                                            class="mb-4 flex items-center justify-end border-b border-zinc-400 p-4 dark:border-zinc-800">
                                            <x-button type="button" id="showModalLabel" data-modal-target="addLabel"
                                                data-modal-toggle="addLabel" text="Nueva etiqueta" icon="plus"
                                                typeButton="secondary" />
                                        </div>
                                        <div class="flex gap-4 p-4">
                                            <div class="w-full">
                                                <label
                                                    class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
                                                    Seleccionar etiquetas para el producto
                                                </label>
                                                <input type="hidden" name="label_id[]" id="label_id">
                                                <div class="relative">
                                                    <div
                                                        class="selected flex w-full items-center justify-between rounded-lg border border-zinc-400 bg-zinc-50 px-4 py-2.5 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-white">
                                                        <span class="itemSelected">Seleccionar etiqueta</span>
                                                        <x-icon icon="arrow-down"
                                                            class="h-5 w-5 text-zinc-500 dark:text-white" />
                                                    </div>
                                                    <ul class="selectOptionsLabels absolute z-10 mt-2 hidden w-full rounded-lg border border-zinc-400 bg-white p-2 shadow-lg dark:border-zinc-800 dark:bg-zinc-950"
                                                        id="labelsList">
                                                        @if ($labels->count() > 0)
                                                            @foreach ($labels as $label)
                                                                <li class="itemOption rounded-lg px-4 py-2.5 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
                                                                    data-value="{{ $label->name }}"
                                                                    data-input="#label_id">
                                                                    {{ $label->name }}
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li
                                                                class="itemOption px-4 py-2.5 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-700">
                                                                Sin etiquetas registradas
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <x-button type="button" typeButton="secondary" icon="arrow-right-02"
                                                id="addLabelSelected" onlyIcon="true" class="mt-7" />
                                        </div>
                                        <input type="hidden" name="labels_ids[]" id="labels_ids"
                                            value="{{ $product->labels->pluck('name')->implode(',') }}">
                                        <div id="hiddenLabelsContainer">
                                            @if ($product->labels->count() > 0)
                                                @foreach ($product->labels as $label)
                                                    <input type="hidden" name="labels[]" value="{{ $label->name }}">
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="px-4 pb-4">
                                            <div class="flex h-auto w-full flex-wrap items-start gap-1 rounded-lg border-2 border-dashed border-zinc-400 bg-zinc-50 p-2 dark:border-zinc-800 dark:bg-transparent"
                                                id="previewLabelsContainer">
                                                @if ($product->labels->count() > 0)
                                                    @foreach ($product->labels as $label)
                                                        <div
                                                            class="me-2 flex items-center justify-between gap-2 rounded-lg border border-zinc-400 bg-white px-4 py-2 text-sm font-medium text-zinc-600 dark:border-zinc-800 dark:bg-black dark:text-white">
                                                            <span>{{ $label->name }}</span>
                                                            <button type="button" class="removeLabelEdit text-white"
                                                                data-label="{{ $label->name }}"
                                                                data-index="{{ $loop->iteration }}">
                                                                <x-icon icon="x"
                                                                    class="h-4 w-4 text-blue-800 dark:text-white" />
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End labels -->
                            </div>
                            <!-- End column 2 -->
                        </div>
                    </div>
                </form>

                <div class="mt-4">
                    <h4 class="mb-2 text-base font-semibold text-primary-800 dark:text-primary-500 md:text-lg">
                        Variaciones
                    </h4>
                    <div
                        class="h-max rounded-lg border border-zinc-400 bg-transparent p-4 dark:border-zinc-800 dark:bg-black">
                        <form action="{{ Route('admin.variants.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @if ($groupedOptions->count() > 0)
                                <div class="flex items-center gap-2">
                                    @foreach ($groupedOptions as $group)
                                        <div class="flex-1">
                                            <x-select label="{{ $group['name'] }}" id="{{ $group['name'] }}"
                                                name="options[]" :options="$group['values']->pluck('value', 'id')->toArray()" />
                                        </div>
                                        @error('options')
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                    @endforeach
                                    <div class="flex-1">
                                        <x-input type="number" label="Precio" name="price_variation"
                                            placeholder="0.00" />
                                    </div>
                                    <div class="flex-1">
                                        <x-input type="number" label="Cantidad" name="stock_variation"
                                            placeholder="#" />
                                    </div>
                                    <div class="mt-6 flex-1">
                                        <x-button type="submit" text="Agregar variación" typeButton="primary"
                                            icon="plus" />
                                    </div>
                                </div>
                            @endif
                        </form>
                        <div class="mt-4">
                            <x-table>
                                <x-slot name="thead">
                                    <x-tr>
                                        <x-th class="w-10">
                                            <x-icon icon="hash" class="size-4" />
                                        </x-th>
                                        <x-th>Opciones</x-th>
                                        <x-th>Precio</x-th>
                                        <x-th>Stock</x-th>
                                        <x-th last="true">Acciones</x-th>
                                    </x-tr>
                                </x-slot>
                                <x-slot name="tbody">
                                    @if ($product->variations->count() > 0)
                                        @foreach ($product->variations as $variation)
                                            <x-tr :last="$loop->last">
                                                <x-td>{{ $loop->iteration }}</x-td>
                                                <x-td>
                                                    <div class="flex items-center gap-x-2">
                                                        @foreach ($variation->values as $option)
                                                            <span
                                                                class="rounded-lg border border-zinc-400 bg-zinc-200 px-2 py-1 text-xs text-zinc-800 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400">
                                                                {{ $option->optionValue->value ?? 'N/A' }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </x-td>
                                                <x-td>
                                                    ${{ number_format($variation->price, 2) }}</x-td>
                                                <x-td>{{ $variation->stock }}</x-td>
                                                <x-td>
                                                    <div class="flex items-center gap-2">
                                                        <x-button type="button" data-modal-target="editVariation"
                                                            data-modal-toggle="editVariation" text="Editar"
                                                            icon="edit" typeButton="success" size="small"
                                                            data-form="{{ Route('admin.variants.update', $variation->id) }}"
                                                            data-url="{{ Route('admin.variants.edit', $variation->id) }}"
                                                            class="editVariation" />
                                                        <form
                                                            action="{{ route('admin.variants.destroy', $variation->id) }}"
                                                            method="POST" class="inline-block"
                                                            id="formDeleteVariant-{{ $variation->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-button type="button" class="buttonDelete"
                                                                data-form="formDeleteVariant-{{ $variation->id }}"
                                                                data-modal-target="deleteModal"
                                                                data-modal-toggle="deleteModal" typeButton="danger"
                                                                text="Eliminar" icon="delete" size="small" />
                                                        </form>
                                                    </div>
                                                </x-td>
                                            </x-tr>
                                        @endforeach
                                    @else
                                        <x-tr last="true">
                                            <x-td colspan="5">
                                                <x-paragraph class="p-10 text-center">
                                                    Sin variaciones registradas
                                                </x-paragraph>
                                            </x-td>
                                        </x-tr>
                                    @endif
                                </x-slot>
                            </x-table>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center gap-2">
                    <x-button type="button" id="editButtonProduct" text="Editar producto" icon="edit"
                        typeButton="primary" />
                    <x-button type="a" href="{{ route('admin.products.index') }}" text="Cancelar"
                        typeButton="secondary" />
                </div>
            </div>
        </div>

        <!-- Modal agregar nuevo atributo -->
        <div id="addAttributeModal" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-[70] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-96 animate-jump-in rounded-lg bg-white shadow animate-duration-300 dark:bg-zinc-950">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between rounded-t border-b border-zinc-400 p-4 pb-4 dark:border-zinc-800">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Agregar atributo
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="addAttributeModal">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ Route('admin.options.store') }}" method="POST" id="formAddOptionEdit"
                        class="p-4">
                        @csrf
                        <div class="flex flex-col">
                            <x-input label="Nombre" id="name-option-value" name="name"
                                data-message="#message-name-option-value" placeholder="Escribe el nombre de la opción"
                                required="required" type="text" />
                            <span class="invalid-feedback hidden text-sm text-red-500"
                                id="message-name-option-value"></span>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="submit" text="Agregar" icon="plus" typeButton="primary" />
                            <x-button type="button" data-modal-toggle="addAttributeModal" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal asignar atributo y una opción -->
        <div id="assignAttribute" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-96 animate-jump-in rounded-lg bg-white shadow animate-duration-300 dark:bg-zinc-950">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between rounded-t border-b border-zinc-400 p-4 dark:border-zinc-800">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Agregar atributo
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="assignAttribute">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ Route('admin.options-values.store') }}" id="assignAttribute" method="POST"
                        class="p-4">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <input type="text" name="product_id" class="hidden" value="{{ $product->id }}">
                            <div>
                                <x-select label="Atributos" id="option" name="option_id" :options="$unrelatedOptions->pluck('name', 'id')->toArray()"
                                    text="Añadir existente" value="{{ old('option_id') }}"
                                    selected="{{ old('option_id') }}" />
                            </div>
                            <div>
                                <x-input label="Nombre" id="value-option" name="value"
                                    data-message="#message-value-option" placeholder="Escribe el nombre de la opción"
                                    required="required" type="text" />
                                <span class="invalid-feedback hidden text-sm text-red-500"
                                    id="message-value-option"></span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="submit" id="assignAttributeButton" text="Agregar" icon="plus"
                                typeButton="primary" />
                            <x-button type="button" data-modal-toggle="assignAttribute" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal agregar valor de cada opción -->
        <div id="addOptionValue" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-[70] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-96 animate-jump-in rounded-lg bg-white shadow animate-duration-300 dark:bg-zinc-950">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between rounded-t border-b border-zinc-400 p-4 pb-4 dark:border-zinc-800">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Agregar opciones
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="addOptionValue">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ Route('admin.options-values.store') }}" method="POST" id="formAddOptionEdit"
                        class="p-4">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div>
                                <input type="text" id="option_parent_id" name="option_id" class="hidden">
                                <input type="text" id="product_id" name="product_id" class="hidden"
                                    value="{{ $product->id }}">
                                <div>
                                    <x-input label="Nombre" id="name-option-value" name="value"
                                        data-message="#message-name-option-value"
                                        placeholder="Escribe el nombre de la opción" required="required"
                                        type="text" />
                                    <span class="invalid-feedback hidden text-sm text-red-500"
                                        id="message-name-option-value"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="submit" text="Agregar" icon="plus" typeButton="primary" />
                            <x-button type="button" data-modal-toggle="addOptionValue" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editar valor de cada opción -->
        <div id="editOptionValue" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative animate-jump-in rounded-lg bg-white p-4 shadow animate-duration-300 dark:bg-zinc-950 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="mb-4 flex items-center justify-between rounded-t border-b pb-4 dark:border-zinc-800 sm:mb-5">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Editar opción
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="editOptionValue">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" id="formEditOption">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col gap-4">
                            <div>
                                <input type="text" id="option_id_edit" name="option_id" class="hidden">
                                <input type="text" id="product_id_edit" name="product_id" class="hidden"
                                    value="{{ $product->id }}">
                                <input type="text" id="option_value_id" name="option_value_id" class="hidden">
                                <div>
                                    <x-input label="Nombre" id="name_option_edit" name="value"
                                        data-message="#message-name_option_edit"
                                        placeholder="Escribe el nombre de la opción" required="required"
                                        type="text" />
                                    <span class="invalid-feedback hidden text-sm text-red-500"
                                        id="message-name_option_edit"></span>
                                </div>
                                <div class="mt-2">
                                    <x-input label="Precio" id="price_option_edit" name="price"
                                        data-message="#message-price_option_edit" icon="dollar" required="required"
                                        type="number" placeholder="0.00" step="0.01" min="0.01" />
                                    <span class="invalid-feedback hidden text-sm text-red-500"
                                        id="message-price_option_edit"></span>
                                </div>
                                <div class="mt-2">
                                    <x-input label="Stock" id="stock_option_edit" name="stock"
                                        data-message="#message-stock_option_edit" required="required" type="number"
                                        step="0.01" min="0.01" icon="cube" placeholder="#" />
                                    <span class="invalid-feedback hidden text-sm text-red-500"
                                        id="message-stock_option_edit"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="button" id="editOptionValueButton" text="Editar" icon="edit"
                                typeButton="primary" />
                            <x-button type="button" data-modal-toggle="editOptionValue" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal agregar impuesto -->
        <div id="addTax" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white p-4 shadow dark:bg-zinc-950 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="mb-4 flex items-center justify-between rounded-t border-b pb-4 dark:border-zinc-800 sm:mb-5">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Agregar impuesto
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="addTax">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('admin.taxes.store') }}" id="formAddTax" method="POST">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div>
                                <x-input label="Nombre" type="text" name="name" id="name_tax"
                                    placeholder="Escribe el nombre del impuesto" error="{{ false }}"
                                    data-message="#message-nameTax" required="required" />
                                <span class="invalid-feedback hidden text-sm text-red-500" id="message-nameTax"></span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <x-input label="Tasa de impuesto" type="number" name="rate" id="rate"
                                    placeholder="0" error="{{ false }}" step="0.1" min="0.1"
                                    icon="percent" data-message="#message-rate" required="required" />
                                <span class="invalid-feedback hidden text-sm text-red-500" id="message-rate"></span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="button" id="addTaxButton" text="Agregar" icon="plus"
                                typeButton="primary" />
                            <x-button type="button" data-modal-toggle="addTax" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editar varación -->
        <div id="editVariation" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative animate-jump-in rounded-lg bg-white shadow animate-duration-300 dark:bg-zinc-950">
                <!-- Modal content -->
                <div class="relative w-96 rounded-lg bg-white shadow dark:bg-zinc-950">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between rounded-t border-b p-4 pb-4 dark:border-zinc-800">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Editar variación
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="editVariation">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="" id="formEditVariation" method="POST" class="p-4">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col gap-4">
                            <div>
                                <x-input label="Precio" type="numeric" name="price" id="price_variation"
                                    placeholder="0.00" step="0.01" data-message="#message-price-variation"
                                    required="required" icon="dollar" />
                                <span class="invalid-feedback hidden text-sm text-red-500"
                                    id="message-price-variation"></span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <x-input label="Stock" type="number" name="stock" id="stock_variation"
                                    placeholder="#" step="1" min="0" icon="box"
                                    data-message="#message-stock-variation" required="required" />
                                <span class="invalid-feedback hidden text-sm text-red-500"
                                    id="message-stock-variation"></span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="submit" id="editVariationButton" text="Editar" icon="edit"
                                typeButton="primary" />
                            <x-button type="button" data-modal-toggle="editVariation" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal agregar etiqueta -->
        <div id="addLabel" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white p-4 shadow dark:bg-zinc-950 sm:p-5">
                    <!-- Modal header -->
                    <div
                        class="mb-4 flex items-center justify-between rounded-t border-b pb-4 dark:border-zinc-800 sm:mb-5">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Agregar etiqueta
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="addLabel">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('admin.labels.store') }}" id="formAddLabel" method="POST">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <div>
                                <x-input label="Nombre" id="name_label" name="name" data-message="#message-nameLabel"
                                    placeholder="Escribe el nombre de la etiqueta" icon="label" required="required"
                                    type="text" />
                                <span class="invalid-feedback hidden text-sm text-red-500" id="message-nameLabel"></span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-2">
                            <x-button type="button" id="addLabelButton" text="Agregar" icon="plus"
                                typeButton="primary" />
                            <x-button type="button" data-modal-toggle="addLabel" text="Cancelar"
                                typeButton="secondary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="deleteModalOption" tabindex="-1" aria-hidden="true"
            class="deleteModal fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-full animate-jump-in rounded-lg bg-white text-center shadow animate-duration-300 animate-once dark:bg-zinc-950">
                    <div class="p-4">
                        <button type="button"
                            class="closeModal absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="deleteModalOption">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <span
                            class="mx-auto mb-4 flex w-max items-center justify-center rounded-full bg-red-100 p-3 text-red-500 dark:bg-red-900/30">
                            <svg class="size-11 mx-auto text-current" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <p class="mb-4 text-zinc-500 dark:text-zinc-300">
                            ¿Estás seguro de eliminar esta opción?
                        </p>
                        <p class="mb-6 text-sm text-zinc-500 dark:text-zinc-400">
                            Esta acción no se puede deshacer.
                        </p>
                    </div>
                    <div class="flex items-center justify-center space-x-4 py-4">
                        <x-button type="button" data-modal-toggle="deleteModalOption" class="closeModal"
                            text="No, cancelar" icon="cancel" typeButton="secondary" />
                        <x-button type="button" class="confirmDeleteOption" text="Sí, eliminar" icon="delete"
                            typeButton="danger" />
                    </div>
                </div>
            </div>
        </div>

        <div id="removeOptions" tabindex="-1" aria-hidden="true"
            class="deleteModal fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-full animate-jump-in rounded-lg bg-white text-center shadow animate-duration-300 animate-once dark:bg-zinc-950">
                    <div class="p-4">
                        <button type="button"
                            class="closeModal absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="removeOptions">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <span
                            class="mx-auto mb-4 flex w-max items-center justify-center rounded-full bg-red-100 p-3 text-red-500 dark:bg-red-900/30">
                            <svg class="size-11 mx-auto text-current" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <p class="mb-4 text-zinc-500 dark:text-zinc-300">
                            ¿Estás seguro de eliminar este atributo?
                        </p>
                        <p class="mb-6 text-sm text-zinc-500 dark:text-zinc-400">
                            Se eliminarán todas las opciones asociadas a este atributo y se desvinculara del producto.
                        </p>
                    </div>
                    <div class="mb-4 flex items-center justify-center space-x-4">
                        <x-button type="button" data-modal-toggle="removeOptions" class="closeModal"
                            text="No, cancelar" icon="cancel" typeButton="secondary" />
                        <x-button type="button" class="confirmDeleteAttribute" text="Sí, eliminar" icon="delete"
                            typeButton="danger" />
                    </div>
                </div>
            </div>
        </div>

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro la variante del producto?"
            message="No podrás recuperar este registro" />

        <form action="{{ route('admin.subcategories.search') }}" id="formSearchSubcategorie" method="POST">
            @csrf
            <input type="hidden" name="categorie_id" id="categorieIdSearch">
        </form>

        <form method="POST" id="formDeleteOption">
            @csrf
            @method('DELETE')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </form>

        <form method="POST" id="formDeleteAttribute">
            @csrf
            @method('DELETE')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </form>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/admin/product.js')
@endpush
