@extends('layouts.template')
@section('title', 'Miguitas | Productos')
@section('content')
    <div class="mb-10">
        <div class="bg-light-blue py-20 text-center">
            <h1 class="text-5xl font-bold text-white">
                Categoría de productos
            </h1>
        </div>
        <div class="mt-8 p-2 sm:p-4 md:p-6">
            <div class="flex flex-wrap items-center gap-2 md:gap-4">
                @foreach ($subcategories as $subcategory)
                    <x-button-store type="a" class="uppercase" href="{!! Route('store.products', ['filter' => 'subcategory', 'search' => $subcategory->slug]) !!}" typeButton="primary"
                        text="{!! $subcategory->name !!}" />
                @endforeach
            </div>
        </div>
        <div class="mt-8 flex flex-col xl:flex-row">
            <div class="flex-1 p-4">
                <!-- Filtrer -->
                <aside>
                    <form action="{{ Route('products.filter') }}" method="POST" id="form-filters" class="hidden">
                        @csrf
                    </form>
                    <div>
                        <form action="{{ Route('products.search') }}" method="POST" id="form-search-product"
                            class="flex flex-col gap-2 uppercase">
                            @csrf
                            <x-input-store type="search" name="search" placeholder="Buscar producto" icon="search"
                                label="Buscar" id="search" />
                        </form>
                    </div>
                    <div class="mt-4 border-t-2 border-zinc-200 px-2 pt-4 sm:px-4">
                        <div class="accordion-item">
                            <button
                                class="accordion-header-filter flex w-full items-center justify-between md:pointer-events-none"
                                data-target="#filters">
                                <span class="flex items-center gap-2 text-2xl font-bold uppercase text-blue-store">
                                    <x-icon-store icon="filter" class="h-6 w-6 text-blue-store" />
                                    Filtros
                                </span>
                                <x-icon-store icon="arrow-down"
                                    class="block h-4 w-4 text-zinc-500 transition-transform md:hidden" />
                            </button>
                        </div>
                        <div class="accordion-content-filter max-h-0 overflow-y-auto transition-all duration-500 ease-in-out md:max-h-max xl:overflow-hidden"
                            id="filters">
                            <div class="mt-4">
                                <h2 class="text-lg font-bold uppercase text-blue-store">
                                    Categorías
                                </h2>
                                <div class="accordion-item mt-4">
                                    <button
                                        class="accordion-header-filter flex w-full items-center justify-between rounded-xl px-4 py-2 hover:bg-zinc-100"
                                        data-target="#panel1">
                                        <p class="text-sm font-semibold text-zinc-600 md:text-base">
                                            Ofertas
                                        </p>
                                        <x-icon-store icon="arrow-down"
                                            class="h-4 w-4 text-zinc-500 transition-transform" />
                                    </button>
                                    <div id="panel1"
                                        class="accordion-content-filter max-h-0 overflow-hidden px-4 transition-all duration-500 ease-in-out">
                                        <div class="mt-4 flex flex-col gap-2">
                                            <div class="flex items-center gap-4">
                                                <div class="checkbox-wrapper-19">
                                                    <input id="offers" type="checkbox" class="filter-check"
                                                        value="offers" name="offert_type">
                                                    <label class="check-box" for="offers">
                                                    </label>
                                                </div>
                                                <label for="offers"
                                                    class="font-dine-r text-sm font-medium text-zinc-500 md:text-base">
                                                    Ofertas
                                                </label>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <div class="checkbox-wrapper-19">
                                                    <input id="flash-offers" type="checkbox" class="filter-check"
                                                        value="flash_offers" name="offert_type">
                                                    <label class="check-box" for="flash-offers">
                                                    </label>
                                                </div>
                                                <label for="flash-offers"
                                                    class="font-dine-r text-sm font-medium text-zinc-500 md:text-base">
                                                    Ofertas relámpago
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mt-4">
                                    <button
                                        class="accordion-header-filter flex w-full items-center justify-between rounded-xl px-4 py-2 hover:bg-zinc-100"
                                        data-target="#panel2">
                                        <p class="text-sm font-semibold text-zinc-600 md:text-base">
                                            Categorías
                                        </p>
                                        <x-icon-store icon="arrow-down"
                                            class="h-4 w-4 text-zinc-500 transition-transform" />
                                    </button>
                                    <div id="panel2"
                                        class="accordion-content-filter max-h-0 overflow-hidden px-4 transition-all duration-500 ease-in-out">
                                        <div class="mt-4 flex flex-col gap-2">
                                            @foreach ($categories as $category)
                                                <div class="flex items-center gap-4">
                                                    <div class="checkbox-wrapper-19">
                                                        <input id="category-{{ $category->id }}" type="checkbox"
                                                            value="{{ $category->id }}" class="filter-check"
                                                            name="category">
                                                        <label class="check-box" for="category-{{ $category->id }}">
                                                        </label>
                                                    </div>
                                                    <label for="category-1"
                                                        class="font-dine-r text-sm font-medium text-zinc-500 md:text-base">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <h2 class="text-lg font-bold uppercase text-blue-store">
                                    Rango de precio
                                </h2>
                                <div class="mt-4">
                                    <div class="flex justify-between gap-4">
                                        <div class="flex flex-col gap-2">
                                            <x-input-store type="number" id="min" name="min" step="5"
                                                min="5" icon="dollar" placeholder="$0" label="Desde" />
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <x-input-store type="number" id="max" name="max" step="5"
                                                min="5" placeholder="$100" label="Hasta" icon="dollar" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-16 flex items-center justify-center">
                                <x-button-store type="a" href="{{ Route('store.products') }}"
                                    typeButton="secondary" icon="circle-refresh" text="Recargar filtros"
                                    size="small" />
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="flex-[3] px-4">
                <div class="flex items-center justify-end gap-4">
                    <div class="mt-3 flex items-center justify-center">
                        <x-button-store type="button" typeButton="secondary" icon="undo-left" onlyIcon="true"
                            class="px-4" id="reset-filters" class="hidden" />
                    </div>
                    <div class="font-secondary mb-4 flex w-full flex-col gap-2 sm:mt-6 sm:w-80">
                        <x-select-store label="" name="order" id="order" :options="[
                            'recent' => 'Más recientes',
                            'older' => 'Más antiguos',
                            'price_asc' => 'Precio: Menor a mayor',
                            'price_desc' => 'Precio: Mayor a menor',
                            'offer' => 'Descuento',
                        ]" />
                    </div>
                </div>
                <div id="products-list">
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-3 gap-4 px-2 max-[840px]:grid-cols-2 xl:grid-cols-3">
                            @foreach ($products as $product)
                                <x-card-product :product="$product" />
                            @endforeach
                        </div>
                        {{ $products->links('vendor.pagination.pagination-store') }}
                    @else
                        <div
                            class="flex h-screen flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-300 p-10 px-4">
                            <x-icon-store icon="sad" class="mb-4 h-12 w-12 text-zinc-500" />
                            <p class="flex items-center gap-2 text-center text-base text-zinc-500">
                                No se encontraron productos con los filtros aplicados, <br> intenta con otros filtros.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/filters-store.js')
@endpush
