@extends('layouts.admin-template')
@section('title', 'Productos')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Productos',
            'description' => 'Administrar los productos registrados.',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative overflow-hidden bg-white dark:bg-black">
                    <div class="mt-4 flex w-full flex-col items-center justify-between gap-2 px-4 sm:flex-row">
                        <div class="flex items-center">
                            <span
                                class="font-secondary text-sm font-semibold uppercase text-zinc-600 dark:text-zinc-200 sm:text-lg md:text-xl">
                                {{ $count }} productos
                            </span>
                        </div>
                        <div class="mt-2 flex w-full items-center gap-2 sm:mt-0 sm:w-auto">
                            <x-button type="button" icon="delete" text="Eliminar productos seleccionados"
                                data-modal-target="deleteProducts" data-modal-toggle="deleteProducts" typeButton="danger"
                                class="hidden w-full sm:w-auto" id="btn-delete-all-products" />
                            <x-button type="button" data-modal-target="importProducts" data-modal-toggle="importProducts"
                                icon="import" class="w-full sm:w-auto" typeButton="secondary" text="Importar" />
                            <x-button type="button" icon="export" class="w-full sm:w-auto" typeButton="secondary"
                                text="Exportar" />
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center" action="{{ route('admin.categories.search') }}"
                                id="formSearchProduct">
                                @csrf
                                <x-input type="text" id="inputSearch" name="inputSearch" data-form="#formSearchProduct"
                                    data-table="#tableProduct" placeholder="Buscar" icon="search" />
                            </form>
                        </div>
                        <div class="h flex w-full flex-row flex-wrap items-center justify-end gap-4 md:w-auto">
                            <div>
                                <x-button type="button" icon="reload" class="w-max" typeButton="secondary"
                                    onlyIcon="true" />
                            </div>
                            <div class="flex md:w-auto">
                                <x-button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" type="button"
                                    icon="filter" typeButton="secondary" text="Filtros" />
                                <div id="filterDropdown"
                                    class="z-10 hidden w-48 rounded-lg bg-white p-3 shadow dark:bg-zinc-950">
                                    <form action="{{ route('admin.categories.search') }}" method="POST"
                                        id="formSearchCategorieCheck">
                                        @csrf
                                        <h6 class="mb-3 text-sm font-medium text-zinc-900 dark:text-white">
                                            Filtros
                                        </h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                            <li class="flex items-center">
                                                <input id="offers" name="filter[]" type="checkbox" value="offers"
                                                    class="h-4 w-4 rounded border-zinc-400 bg-zinc-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-500 dark:bg-zinc-950 dark:ring-offset-zinc-700 dark:focus:ring-blue-600">
                                                <label for="offers"
                                                    class="ml-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    Con ofertas
                                                </label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="flash_offers" name="filter[]" type="checkbox"
                                                    value="flash_offers"
                                                    class="h-4 w-4 rounded border-zinc-400 bg-zinc-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-500 dark:bg-white dark:ring-offset-zinc-700 dark:focus:ring-blue-600">
                                                <label for="flash_offers"
                                                    class="ml-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    Con ofertas flash
                                                </label>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <x-button type="button" id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                    typeButton="secondary" text="Acciones" icon="arrow-down" />
                                <div id="actionsDropdown" class="z-10 hidden w-60 rounded bg-white shadow dark:bg-zinc-950">
                                    <ul class="p-2 text-sm text-zinc-700 dark:text-zinc-200"
                                        aria-labelledby="actionsDropdownButton">
                                        <li>
                                            <a href="#"
                                                class="block rounded px-4 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-900 dark:hover:text-white">
                                                Importar seleccionados
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block rounded px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-900 dark:hover:text-white">
                                                Eliminar seleccionados
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto">
                                <x-button type="a" href="{{ route('admin.products.create') }}"
                                    text-="Agregar producto" icon="plus" typeButton="primary" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 mb-4">
                        <x-table>
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        <input id="default-checkbox-products" type="checkbox" value=""
                                            class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                    </x-th>
                                    <x-th>
                                        Producto
                                    </x-th>
                                    <x-th>
                                        Imagen
                                    </x-th>
                                    <x-th>
                                        Precio
                                    </x-th>
                                    <x-th>
                                        SKU
                                    </x-th>
                                    <x-th>
                                        Inventario
                                    </x-th>
                                    <x-th>
                                        Categoría
                                    </x-th>
                                    <x-th>
                                        Estado
                                    </x-th>
                                    <x-th>
                                        Acciones
                                    </x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody" id="tableProduct">
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                        <x-tr section="body">
                                            <x-td>
                                                <input type="checkbox" value="{{ $product->id }}" name="products_ids[]"
                                                    class="checkboxs-products h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                            </x-td>
                                            <x-td>
                                                <div class="flex flex-col gap-1">
                                                    @if ($product->is_top)
                                                        <span
                                                            class="text-nowrap flex w-max items-center gap-2 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:bg-opacity-20 dark:text-green-300">
                                                            <x-icon icon="star" class="h-3 w-3" />
                                                            Top
                                                        </span>
                                                    @endif
                                                    <span>{{ $product->name }}</span>
                                                </div>
                                            </x-td>
                                            <x-td>
                                                <img src="{{ Storage::url($product->main_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="min-w-16 h-16 w-16 rounded-lg object-cover">
                                            </x-td>
                                            <x-td>
                                                <span>
                                                    ${{ $product->price }}
                                                    {{ $product->max_price ? ' - $' . $product->max_price : '' }}
                                                </span>
                                            </x-td>
                                            <x-td>
                                                <span>{{ $product->sku }}</span>
                                            </x-td>
                                            <x-td>
                                                <span>{{ $product->stock }} en stock</span>
                                            </x-td>
                                            <x-td>
                                                <div class="flex flex-col gap-1">
                                                    <span
                                                        class="text-nowrap w-max rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:bg-opacity-20 dark:text-green-300">
                                                        {{ $product->categories->name }}
                                                    </span>
                                                    <span
                                                        class="text-nowrap w-max rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:bg-opacity-20 dark:text-blue-300">
                                                        @foreach ($product->subcategories as $subcategory)
                                                            {{ $subcategory->name }}
                                                            @if (!$loop->last)
                                                                /
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </x-td>
                                            <x-td>
                                                <x-badge-status :status="$product->is_active" />
                                            </x-td>
                                            <x-td>
                                                <div class="flex items-center space-x-2">
                                                    <x-button type="a" icon="edit" typeButton="success"
                                                        href="{{ route('admin.products.edit', $product->id) }}"
                                                        onlyIcon="true" />
                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        id="formDeleteProduct-{{ $product->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button type="button"
                                                            data-form="formDeleteProduct-{{ $product->id }}"
                                                            icon="delete" typeButton="danger" class="buttonDelete"
                                                            onlyIcon="true" data-modal-target="deleteModal"
                                                            data-modal-toggle="deleteModal" />
                                                    </form>
                                                    <x-button type="a" icon="view" typeButton="secondary"
                                                        href="{{ route('admin.products.show', $product->id) }}"
                                                        onlyIcon="true" />
                                                    <form action="{{ route('admin.flash-offers.add-flash-offer') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <x-button type="submit" icon="flash" typeButton="secondary"
                                                            data-tooltip-target="tooltip-default-{{ $product->id }}"
                                                            onlyIcon="true" />
                                                        <div id="tooltip-default-{{ $product->id }}" role="tooltip"
                                                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-violet-500 px-3 py-2 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-violet-700">
                                                            Oferta flash
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="px-4 py-3 text-center" colspan="8">
                                            <span>No hay productos registrados</span>
                                        </td>
                                    </tr>
                                @endif
                            </x-slot>
                        </x-table>
                        {{ $products->links('vendor.pagination.pagination-custom') }}
                    </div>
                </div>
            </div>
        </div>

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar el producto?"
            message="No podrás recuperar este registro" action="" />

        <div id="deleteProducts" tabindex="-1" aria-hidden="true"
            class="deleteModal fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-full animate-jump-in rounded-lg bg-white text-center shadow animate-duration-300 animate-once dark:bg-zinc-950">
                    <div class="p-4">
                        <button type="button"
                            class="closeModal absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="deleteProducts">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <svg class="mx-auto mb-3.5 h-11 w-11 text-zinc-400 dark:text-zinc-500" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="mb-4 text-zinc-500 dark:text-zinc-300">
                            ¿Estás seguro de eliminar los productos seleccionados?
                        </p>
                        <p class="mb-6 text-sm text-zinc-500 dark:text-zinc-400">
                            No podrás recuperar estos registros.
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center space-x-4 border-t border-zinc-300 py-4 dark:border-zinc-900">
                        <x-button type="button" data-modal-toggle="deleteProducts" class="closeModal"
                            text="No, cancelar" icon="cancel" typeButton="secondary" />
                        <form method="POST" id="formDeleteProducts"
                            action="{{ Route('admin.products.deleteSelected') }}">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" text="Sí, eliminar" icon="delete" typeButton="danger" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="importProducts" tabindex="-1" aria-hidden="true"
            class="deleteModal fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-full animate-jump-in rounded-lg bg-white text-center shadow animate-duration-300 animate-once dark:bg-zinc-950">
                    <div class="p-4">
                        <button type="button"
                            class="closeModal absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="importProducts">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <h4 class="mb-4 font-medium text-zinc-500 dark:text-zinc-300">
                            Importar productos
                        </h4>
                    </div>
                    <div
                        class="flex items-center justify-center space-x-4 border-t border-zinc-300 py-4 dark:border-zinc-900">
                        <form method="POST" id="formDeleteProducts" action="{{ Route('admin.products.import') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="px-4">
                                <input type="file" name="document" id="file" accept=".csv, .xlsx" />
                                @if ($errors->has('document'))
                                    <span class="text-xs text-red-500">{{ $errors->first('document') }}</span>
                                @endif
                            </div>
                            <div class="mt-4 flex items-center justify-center gap-4">
                                <x-button type="submit" text="Import" icon="import" typeButton="primary" />
                                <x-button type="button" data-modal-toggle="importProducts" class="closeModal"
                                    text="No, cancelar" icon="cancel" typeButton="secondary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
