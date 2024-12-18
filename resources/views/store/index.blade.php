@extends('layouts.template')
@section('title', 'Miguitas | Tienda')
@section('content')
    <div class="main-container mt-4">
        <div class="mx-auto flex w-full items-center justify-center md:w-4/5 lg:w-3/4">
            <img src="{{ asset('img/shop.png') }}" alt="Shop image">
        </div>
        <section class="mt-20">
            <h1 class="mb-10 text-center font-pluto-m text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">
                CATEGORÍAS
            </h1>
            <div
                class="flex w-full flex-col items-center justify-center gap-5 bg-blue-store p-10 sm:flex-row sm:gap-10 md:gap-20">
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <a href="{{ route('store.products', ['search' => $category->slug, 'filter' => 'category']) }}"
                            class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                            <div
                                class="mx-auto flex h-20 w-20 items-center justify-center overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                                <img src="{{ Storage::url($category->image) }}" class="h-full w-full"
                                    alt="{{ $category->name }}">
                            </div>
                            <div class="flex items-center justify-center">
                                <h1 class="font-pluto-r text-base font-bold text-white sm:text-lg md:text-xl">
                                    {{ $category->name }}
                                </h1>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="mt-20">
            <h1 class="mb-10 text-center font-pluto-m text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">
                PRODUCTOS DESTACADOS
            </h1>

            <!-- Contenedor donde se mostrarán las cards de productos destacados 2 (featured2-card) -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-3 gap-4 px-4 max-[840px]:grid-cols-2 xl:grid-cols-4">
                    @foreach ($products as $product)
                        <x-card-product :product="$product" />
                    @endforeach
                </div>
                {{ $products->links('vendor.pagination.pagination-store') }}
            @endif

            <div class="mt-4 flex items-center justify-center">
                <x-button-store text="Ver más" type="a" href="{{ Route('store.products') }}" typeButton="primary" />
            </div>

        </section>

        <section class="flex items-center justify-center">
            <div
                class="relative my-14 flex w-full flex-col items-center justify-center gap-8 bg-light-pink p-20 text-zinc-800 sm:rounded-3xl md:w-3/4 lg:w-1/2">
                <p class="font-dine-r text-base md:text-lg">
                    Programa tu Pedido mínimo 1 día antes y máximo con 3 semanas de anticipación considerando que DOM y
                    LUNES
                    estamos CERRADOS.
                </p>
                <p class="font-dine-r text-base md:text-lg">
                    Medios de Pago: tarjeta (en línea), transferencia bancaria o QR Banco Agrícola (enviando comprobante
                    antes
                    de 10 am del día de la entrega).
                </p>
                <span class="absolute left-0 top-0 m-4">
                    <x-icon-store icon="circle-info" class="h-10 w-10 text-blue-store" />
                </span>

            </div>
        </section>
    </div>
@endsection
