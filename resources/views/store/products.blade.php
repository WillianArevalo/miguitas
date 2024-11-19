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
            <div class="flex flex-wrap items-center gap-2 uppercase md:gap-4">
                @foreach ($subcategories as $subcategory)
                    <x-button-store type="a" href="{{ route('store.products') }}" typeButton="primary"
                        text="{{ $subcategory->name }}" />
                @endforeach
            </div>
        </div>
        <div class="mt-8 flex flex-col xl:flex-row">
            <div class="flex-1 p-4">
                <!-- Filtrer -->
                <aside>
                    <div>
                        <form action="" method="POST" class="flex flex-col gap-2 uppercase">
                            <x-input-store type="search" name="search" placeholder="Buscar producto" icon="search"
                                label="Buscar" />
                        </form>
                    </div>
                    <div class="mt-4 border-t border-zinc-200 px-2 pt-4 sm:px-4">
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
                        <div class="accordion-content-filter max-h-0 overflow-hidden transition-all duration-500 ease-in-out md:max-h-max"
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
                                                    <input id="offers" type="checkbox">
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
                                                    <input id="flash-offers" type="checkbox">
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
                                                            value="{{ $category->id }}">
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
                                            <x-input-store type="number" name="min" step="5" min="5"
                                                icon="dollar" placeholder="$0" label="Desde" />
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <x-input-store type="number" name="max" step="5" min="5"
                                                placeholder="$100" label="Hasta" icon="dollar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="relative mb-6">
                                        <label for="labels-range-input" class="sr-only">Labels range</label>
                                        <input id="steps-range" type="range" min="0" max="3"
                                            value="1" step="1"
                                            class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200">
                                        <span class="absolute -bottom-6 start-0 font-dine-r text-sm text-gray-500">
                                            $5
                                        </span>
                                        <span
                                            class="absolute -bottom-6 start-1/3 -translate-x-1/2 font-dine-r text-sm text-gray-500 rtl:translate-x-1/2">
                                            $25
                                        </span>
                                        <span
                                            class="absolute -bottom-6 start-2/3 -translate-x-1/2 font-dine-r text-sm text-gray-500 rtl:translate-x-1/2">
                                            $50
                                        </span>
                                        <span class="absolute -bottom-6 end-0 font-dine-r text-sm text-gray-500">
                                            $100
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-16 flex items-center justify-center">
                                <x-button-store type="button" typeButton="secondary" icon="circle-refresh"
                                    text="Recargar filtros" size="small" />
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="flex-[3]">
                <div class="grid grid-cols-3 gap-4 px-2 max-[840px]:grid-cols-2 xl:grid-cols-3">
                    @foreach ($products as $product)
                        <x-card-product :product="$product" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
