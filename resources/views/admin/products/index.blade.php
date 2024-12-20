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
                <div class="relative bg-white dark:bg-black">
                    <div class="mt-4 flex w-full flex-col items-center justify-between gap-2 px-4 sm:flex-row">
                        <div class="flex items-center">
                            <span
                                class="font-secondary text-sm font-semibold uppercase text-zinc-600 dark:text-zinc-200 sm:text-lg md:text-xl">
                                {{ $count }} productos
                            </span>
                        </div>
                        <div class="mt-2 flex w-full items-center gap-2 sm:mt-0 sm:w-auto">
                            <x-button type="button" icon="delete" text="Eliminar seleccionados"
                                data-modal-target="deleteProducts" data-modal-toggle="deleteProducts" typeButton="danger"
                                class="hidden w-full sm:w-auto" id="btn-delete-all-products" />
                            <x-button type="button" icon="import" class="w-full sm:w-auto" typeButton="secondary"
                                text="Importar" data-modal-target="importProduct" data-modal-toggle="importProduct" />
                            <x-button type="a" href="{{ Route('admin.products.export') }}" icon="export"
                                class="w-full sm:w-auto" typeButton="secondary" text="Exportar" />
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputSearchProducts" name="inputSearchProducts"
                                    placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                        <div class="h flex w-full flex-row flex-wrap items-center justify-end gap-4 md:w-auto">

                            <div class="flex md:w-auto">
                                <x-button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" type="button"
                                    icon="filter" typeButton="secondary" text="Filtros" />
                                <div id="filterDropdown"
                                    class="z-10 hidden w-48 animate-fade rounded-lg bg-white p-3 shadow animate-duration-300 dark:bg-zinc-950">
                                    <div>
                                        <h6 class="mb-3 text-sm font-medium text-zinc-900 dark:text-white">
                                            Estado
                                        </h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                            <li class="flex items-center">
                                                <input id="filter-status-active" name="filter-status" type="checkbox"
                                                    value="Active"
                                                    class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                                <label for="filter-status-active"
                                                    class="ml-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    Activos
                                                </label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="filter-status-inactive" name="filter-status" type="checkbox"
                                                    value="Inactive"
                                                    class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                                <label for="filter-status-inactive"
                                                    class="ml-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                    Inactivos
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="mb-3 text-sm font-medium text-zinc-900 dark:text-white">
                                            Categoría
                                        </h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                            @foreach ($categories as $category)
                                                <li class="flex items-center">
                                                    <input id="filter-category-{{ $category->id }}" name="filter-category"
                                                        type="checkbox" value="{{ $category->id }}"
                                                        class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                                    <label for="filter-category-{{ $category->id }}"
                                                        class="ml-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                        {{ $category->name }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full sm:w-auto">
                                <x-button type="a" href="{{ route('admin.products.create') }}"
                                    text-="Agregar producto" icon="plus" typeButton="primary" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 mb-4">
                        <x-table id="tableProduct">
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
                                    <x-th last="true">
                                        Acciones
                                    </x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                        <x-tr section="body" :last="$loop->last">
                                            <x-td>
                                                <input type="checkbox" value="{{ $product->id }}" name="products_ids[]"
                                                    class="checkboxs-products h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                            </x-td>
                                            <x-td data-column="name">
                                                <div class="flex flex-col gap-1">
                                                    @if ($product->is_top)
                                                        <span
                                                            class="text-nowrap flex w-max items-center gap-2 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:bg-opacity-20 dark:text-green-300">
                                                            <x-icon icon="star" class="h-3 w-3" />
                                                            Top
                                                        </span>
                                                    @endif
                                                    @if ($product->is_the_month)
                                                        <span
                                                            class="text-nowrap flex w-max items-center gap-2 rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:bg-opacity-20 dark:text-blue-300">
                                                            <x-icon icon="calendar" class="h-3 w-3" />
                                                            Producto del mes
                                                        </span>
                                                    @endif
                                                    <span>{{ $product->name }}</span>
                                                </div>
                                            </x-td>
                                            <x-td data-column="image">
                                                <img src="{{ Storage::url($product->main_image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="min-w-16 h-16 w-16 rounded-lg object-cover">
                                            </x-td>
                                            <x-td data-column="price">
                                                <span>
                                                    ${{ $product->price }}
                                                    {{ $product->max_price ? ' - $' . $product->max_price : '' }}
                                                </span>
                                            </x-td>
                                            <x-td data-column="sku">
                                                <span>{{ $product->sku }}</span>
                                            </x-td>
                                            <x-td data-column="stock">
                                                <span>{{ $product->stock }} en stock</span>
                                            </x-td>
                                            <x-td data-column="category">
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
                                            <x-td data-column="status">
                                                <x-badge-status :status="$product->is_active" />
                                            </x-td>
                                            <x-td data-column="actions">
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
            class="fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
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

        <div id="importProduct" tabindex="-1" aria-hidden="true"
            class="fixed inset-0 left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-70">
            <div class="relative flex h-full w-full max-w-md items-center justify-center p-4 md:h-auto">
                <!-- Modal content -->
                <div
                    class="relative w-full animate-jump-in rounded-lg bg-white text-center shadow animate-duration-300 animate-once dark:bg-zinc-950">
                    <div class="flex items-center justify-start p-4">
                        <h5 id="drawer-new-categorie-label"
                            class="mb-4 inline-flex text-left text-base font-semibold text-zinc-500 dark:text-zinc-400">
                            Importar productos
                        </h5>
                        <button type="button"
                            class="closeModal absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                            data-modal-toggle="importProduct">
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="my-4">
                        <form action="" class="px-4">
                            <div class="w-full">
                                <label for="document" id="document-label"
                                    class="flex cursor-pointer items-center justify-center gap-2 rounded-xl border-2 border-dashed border-zinc-400 p-4 text-sm font-medium text-zinc-500 dark:border-zinc-800 dark:text-zinc-300 dark:hover:border-zinc-700 dark:hover:bg-zinc-900">
                                    <x-icon icon="import" class="size-4" />
                                    Seleccionar archivo
                                    <input type="file" name="document" id="document" class="hidden"
                                        accept=".csv,.xlxs" />
                                </label>
                            </div>
                        </form>
                    </div>
                    <div
                        class="flex items-center justify-center space-x-4 border-t border-zinc-300 py-4 dark:border-zinc-900">
                        <x-button type="button" data-modal-toggle="importProduct" class="closeModal"
                            text="No, cancelar" icon="cancel" typeButton="secondary" />
                        <form method="POST" action="">
                            @csrf
                            <x-button type="submit" text="Importar" typeButton="primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/admin/order-table.js')
    @vite('resources/js/admin/product.js')
@endpush
