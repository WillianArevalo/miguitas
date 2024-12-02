@extends('layouts.admin-template')
@section('title', 'Agregar anuncio')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-crud-page', [
            'title' => 'Nuevo anuncio',
            'text' => 'Regresar a la lista de anuncios',
            'url' => route('admin.popups.index'),
        ])
        <div class="ms-4 mt-4 flex flex-col gap-1">
            <h2 class="text-lg uppercase text-zinc-700 dark:text-zinc-300">Información del anuncio</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                Los campos marcados con <span class="text-red-500">*</span> son obligatorios
            </p>
        </div>

        <div class="p-4">
            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                Tipo de anuncio
            </p>

            <div class="mt-2 flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <input type="radio" name="type_alert"
                        class="border-zinc-400 bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-950" value="popup" checked>
                    <label for="type" class="block text-sm font-medium text-zinc-500 dark:text-zinc-300">
                        Alerta emergente
                    </label>
                </div>

                <div class="my-4 flex items-center justify-center border-y border-zinc-400 py-8 dark:border-zinc-800"
                    id="skeleton-popup">
                    <div role="status"
                        class="w-96 animate-pulse rounded-xl border border-zinc-400 p-4 shadow dark:border-zinc-800 md:p-6">
                        <div class="flex items-center justify-center">
                            <div class="mb-4 h-4 w-48 rounded-full bg-zinc-200 dark:bg-zinc-900"></div>
                        </div>
                        <div class="mb-4 flex h-48 items-center justify-center rounded-xl bg-gray-300 dark:bg-zinc-900">
                            <x-icon icon="image" class="size-10 text-zinc-500 dark:text-zinc-600" />
                        </div>
                        <div>
                            <div class="mb-4 h-2.5 w-48 rounded-full bg-zinc-200 dark:bg-zinc-900"></div>
                            <div class="mb-2.5 h-2 rounded-full bg-zinc-200 dark:dark:bg-zinc-900"></div>
                            <div class="mb-2.5 h-2 rounded-full bg-zinc-200 dark:dark:bg-zinc-900"></div>
                            <div class="h-2 rounded-full bg-zinc-200 dark:dark:bg-zinc-900"></div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <div class="flex items-center gap-4">
                                <div class="mb-2 h-5 w-20 rounded-full bg-zinc-200 dark:bg-zinc-900"></div>
                                <div class="mb-2 h-5 w-20 rounded-full bg-zinc-200 dark:bg-zinc-900"></div>
                            </div>
                        </div>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="radio" name="type_alert"
                        class="border-zinc-400 bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-950" value="headband">
                    <label for="type" class="block text-sm font-medium text-zinc-500 dark:text-zinc-300">
                        Cabecera
                    </label>
                </div>


                <div id="skeleton-headband" class="hidden">
                    <div class="my-4 flex items-center justify-center border-y border-zinc-400 py-8 dark:border-zinc-800">
                        <div class="flex w-full items-center justify-center">
                            <div
                                class="flex w-full animate-pulse items-center justify-center bg-zinc-200 px-4 py-5 dark:bg-zinc-950">
                                <div class="h-4 w-[500px] animate-pulse rounded-full bg-zinc-400 dark:bg-zinc-900"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="popup-container">
            <form action="{{ route('admin.popups.store') }}" method="POST" id="formPopup">
                @csrf
                <input type="hidden" name="reference_id" id="reference_id">
                <div class="bg-white p-4 text-sm dark:bg-black">
                    <div class="mt-2">
                        <div class="flex flex-1 gap-4">
                            <div class="flex-[2]">
                                <x-input label="Nombre" type="text" name="name" id="name"
                                    placeholder="Ingresa el nombre del anuncio" required />
                            </div>
                            <div class="hidden">
                                <input type="hidden" name="content" id="content" />
                            </div>
                            <div class="flex-1">
                                <x-select label="Tipo" :options="[
                                    'redirect' => 'Redireccionar',
                                    'store' => 'Almacenar datos',
                                ]" id="type" name="type" selected="store"
                                    value="store" />
                            </div>
                        </div>
                        <div id="redirect-link" class="mt-4 hidden">
                            <x-input label="Redireccionar a" type="text" name="link" id="link"
                                placeholder="Ingresa la URL de redireccionamiento" icon="link" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col gap-4 lg:flex-row">
                        <div class="flex-[1.5]">
                            <h5 class="mb-2 font-bold text-zinc-700 dark:text-white">Previsualización</h5>
                            <!-- Preview Popup -->
                            <div
                                class="popupContainer popup relative flex h-max w-full items-center justify-center overflow-auto rounded-lg border-2 border-dashed border-zinc-600 bg-zinc-300 py-32 dark:border-zinc-800 dark:bg-black">
                                <div class="relative w-[500px] animate-jump-in rounded-xl bg-white animate-duration-300"
                                    id="popup">
                                    <button type="button"
                                        class="closePopup absolute right-0 top-0 m-2 rounded-full p-1.5 hover:bg-zinc-200">
                                        <x-icon icon="x" class="h-5 w-5 text-black" />
                                    </button>
                                    <div
                                        class="headerPopup mx-auto flex w-4/5 items-center justify-center rounded p-4 px-4 text-center">
                                        <h2 class="headingPopup text-wrap text-3xl font-bold uppercase text-black"
                                            id="textHeader">
                                            Encabezado
                                        </h2>
                                    </div>
                                    <div class="bodyPopup">
                                        <form action="">
                                            <div class="flex gap-2">
                                                <div class="flex flex-1 flex-col items-center justify-center">
                                                    <div class="imagePoup w-full">
                                                        <img src="{{ asset('img/photo.jpg') }}" alt=""
                                                            class="h-60 w-full object-contain" id="imagePoup">
                                                    </div>
                                                    <p id="descriptionPoupText" class="text-wrap mt-4 w-3/4 text-center">
                                                        Este es la descripción del anuncio
                                                    </p>
                                                    <div
                                                        class="inputPopup mt-4 flex w-4/5 flex-col items-center justify-center">
                                                        <x-input-store type="text" name="inputPopup" id="inputPopup"
                                                            placeholder="Ingresa el nombre del campo"
                                                            class="mb-4 hidden" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="footerPopup flex items-center justify-end gap-2 p-4">
                                        <x-button-store id="buttonPopupSecondary" type="button" typeButton="secondary"
                                            text="Botón 2" />
                                        <x-button-store id="buttonPopupPrimary" type="button" typeButton="primary"
                                            text="Botón 1" />
                                    </div>
                                </div>
                            </div>
                            <!-- End Preview Popup -->
                        </div>
                        <div class="flex-1">
                            <div class="mt-4">
                                <div class="relative mx-auto mb-12 w-11/12">
                                    <label for="width" class="text-sm font-medium text-zinc-500 dark:text-zinc-300">
                                        Ancho del anuncio
                                    </label>
                                    <input type="range" min="1" max="3" value="2" step="1"
                                        name="width" id="width"
                                        class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-zinc-200 dark:bg-zinc-900">
                                    <span class="absolute -bottom-6 start-0 text-sm text-zinc-500 dark:text-zinc-400">
                                        Small
                                    </span>
                                    <span
                                        class="absolute -bottom-6 start-1/2 -translate-x-1/2 text-sm text-zinc-500 rtl:translate-x-1/2 dark:text-zinc-400">
                                        Medium
                                    </span>
                                    <span
                                        class="absolute -bottom-6 start-full -translate-x-1/2 text-sm text-zinc-500 rtl:translate-x-1/2 dark:text-zinc-400">
                                        Large
                                    </span>
                                </div>
                            </div>
                            <!-- Encabezado -->
                            <div class="mt-4">
                                <h3 class="font-medium text-zinc-900 dark:text-zinc-200">Encabezado</h3>
                                <div class="mt-2">
                                    <x-input label="" type="text" name="header" id="header"
                                        placeholder="Ingresa el texto del encabezado del anuncio" icon="heading" />
                                </div>
                                <div class="mt-4 flex gap-2">
                                    <div class="flex-[4]">
                                        <x-select label="" :options="[
                                            'pluto-m' => 'Pluto Bold',
                                            'dine-r' => 'Dine',
                                            'dinc-r' => 'Dinc',
                                        ]" id="ff" name="ff"
                                            selected="primary" value="bold" />
                                    </div>
                                    <div class="flex-[3]">
                                        <x-select label="" :options="[
                                            'bold' => 'Bold',
                                            'semibold' => 'Semibold',
                                            'medium' => 'Medium',
                                            'normal' => 'Normal',
                                        ]" id="fw" name="fw"
                                            selected="bold" value="bold" />
                                    </div>
                                    <div class="flex-[2]">
                                        <x-select label="" :options="[
                                            'xl' => 'XL',
                                            '2xl' => '2XL',
                                            '3xl' => '3XL',
                                            '4xl' => '4XL',
                                            '5xl' => '5XL',
                                            '6xl' => '6XL',
                                        ]" id="fs" name="fs"
                                            selected="xl" value="xl" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="color" name="color" id="color"
                                            class="h-10 w-full bg-transparent">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <!-- Cuerpo -->
                                <h3 class="font-medium text-zinc-900 dark:text-zinc-200">Cuerpo</h3>
                                <div class="mt-2">
                                    <x-input type="textarea" name="descriptionPopup" id="descriptionPopup"
                                        placeholder="Ingresa el texto del cuerpo" />
                                </div>
                                <div class="mt-4 flex gap-2">
                                    <div class="flex-[4]">
                                        <x-select label="" :options="[
                                            'pluto-m' => 'Pluto Bold',
                                            'dine-r' => 'Dine',
                                            'dinc-r' => 'Dinc',
                                        ]" id="ffText" name="ffText"
                                            selected="secondary" value="bold" />
                                    </div>
                                    <div class="flex-[3]">
                                        <x-select label="" :options="[
                                            'bold' => 'Bold',
                                            'semibold' => 'Semibold',
                                            'medium' => 'Medium',
                                            'normal' => 'Normal',
                                        ]" id="fwText" name="fwText"
                                            selected="bold" value="bold" />
                                    </div>
                                    <div class="flex-[2]">
                                        <x-select label="" :options="[
                                            'xs' => 'XS',
                                            'sm' => 'SM',
                                            'base' => 'BASE',
                                            'lg' => 'LG',
                                            'xl' => 'XL',
                                        ]" id="fsText" name="fsText"
                                            selected="xl" value="xl" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="color" name="colorText" id="colorText"
                                            class="h-10 w-full bg-transparent">
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center gap-4">
                                    <label for="addImagePopup"
                                        class="flex cursor-pointer items-center gap-2 rounded-lg border border-zinc-400 px-5 py-3 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:text-white dark:hover:bg-zinc-900">
                                        <x-icon icon="image-add" class="h-4 w-4 text-current" />
                                        Agregar imagen
                                    </label>
                                    <input type="file" name="" id="addImagePopup" class="hidden">
                                    <x-button type="button" text="Eliminar imagen" id="removeImagePoup"
                                        typeButton="danger" icon="image-remove" />
                                </div>
                                <div class="mt-4 flex items-center gap-4">
                                    <x-button type="button" id="addInputPopup" typeButton="secondary"
                                        text="Agregar campo" icon="plus" />
                                    <x-button type="button" icon="delete" text="Eliminar campo" id="removeInputPoup"
                                        typeButton="danger" />
                                </div>
                                <div id="optionsInput" class="mt-4 hidden">
                                    <x-input label="" type="text" name="placeholder_input"
                                        id="placeholderInput" placeholder="Placeholder del campo" />
                                </div>
                                <!-- Footer -->
                                <div>
                                    <h3 class="mt-4 font-medium text-zinc-900 dark:text-zinc-200">Footer</h3>
                                    <div class="mt-2">
                                        <div>
                                            <x-input label="Texto botón principal" type="text" name="textButton"
                                                id="textButtonPrimary"
                                                placeholder="Ingresa el texto del botón principal" />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <x-input label="Texto botón secundario" type="text" name="placeholder_input"
                                            id="textButtonSecondary"
                                            placeholder="Ingresa el texto del botón secundario" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mx-4 mb-4 flex justify-center gap-4">
                        <x-button type="submit" text="Guardar" icon="save" typeButton="primary" id="addPopup" />
                        <x-button type="a" href="{{ route('admin.popups.index') }}" text="Regresar"
                            icon="arrow-left-02" typeButton="secondary" />
                    </div>
                </div>
            </form>
        </div>

        <div class="hidden" id="headband-container">
            <form action="{{ route('admin.headbands.store') }}" method="POST" id="formHeadband">
                @csrf
                <div class="p-4">
                    <div>
                        <x-input label="Título" type="text" name="title" id="title"
                            placeholder="Ingresa el título del anuncio" required />
                    </div>
                    <div class="mt-4 flex items-center gap-4">
                        <div class="flex-1">
                            <x-input label="URL" type="text" name="link" icon="link" id="url"
                                placeholder="Ingresa la URL del anuncio" required />
                        </div>
                        <div class="flex-1">
                            <x-input label="Texto del enlace" type="text" name="link_text" id="link_text"
                                placeholder="Ingresa el texto del enlace" />
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <x-input label="Activo" type="checkbox" name="active" id="active" />
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-4">
                        <x-button type="submit" text="Guardar" icon="save" typeButton="primary" id="addHeadband" />
                        <x-button type="a" href="{{ route('admin.popups.index') }}" text="Regresar"
                            icon="arrow-left-02" typeButton="secondary" />
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    @vite('resources/js/admin/popup.js')
@endpush
