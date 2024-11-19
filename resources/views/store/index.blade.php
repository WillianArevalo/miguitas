@extends('layouts.template')
@section('title', 'Miguitas | Tienda')
@section('content')
    <div class="main-container mt-4">
        <div class="flex w-full items-center justify-center md:w-4/5 lg:w-3/4">
            <img src="{{ asset('img/shop.png') }}" alt="Shop image">
        </div>
        <h1 class="my-10 font-pluto-m text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">CATEGORÍAS</h1>
        <div
            class="flex w-full flex-col items-center justify-center gap-5 bg-blue-store p-10 sm:flex-row sm:gap-10 md:gap-20">
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/giftcard.png') }}" class="h-full w-full" alt="GiftCard image">
                </div>
                <div>
                    <h1 class="font-pluto-r text-base font-bold text-white sm:text-lg md:text-xl">Gift Card</h1>
                </div>
            </a>
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/pups.png') }}" class="h-full w-full" alt="GiftCard image">
                </div>
                <div>
                    <h1 class="font-pluto-r text-base font-bold text-white sm:text-lg md:text-xl">For Pups</h1>
                </div>
            </a>
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/kitties.png') }}" class="h-full w-full" alt="Kitties image">
                </div>
                <div>
                    <h1 class="font-pluto-r text-base font-bold text-white sm:text-lg md:text-xl">For Kitties</h1>
                </div>
            </a>
        </div>

        <h1 class="my-10 font-pluto-m text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">PRODUCTOS DESTACADOS</h1>

        <!-- Contenedor donde se mostrarán las cards de productos destacados 2 (featured2-card) -->
        <div class="grid grid-cols-3 gap-4 px-4 max-[840px]:grid-cols-2 xl:grid-cols-4">
            @foreach ($products as $product)
                <x-card-product :product="$product" />
            @endforeach
        </div>

        <div
            class="relative my-14 flex w-full flex-col items-center justify-center gap-8 bg-pink-store p-20 text-zinc-800 sm:rounded-3xl md:w-3/4 lg:w-1/2">
            <p class="text-base md:text-lg">
                Programa tu Pedido mínimo 1 día antes y máximo con 3 semanas de anticipación considerando que DOM y LUNES
                estamos CERRADOS.
            </p>
            <p class="text-base md:text-lg">
                Medios de Pago: tarjeta (en línea), transferencia bancaria o QR Banco Agrícola (enviando comprobante antes
                de 10 am del día de la entrega).
            </p>
            <span class="absolute left-0 top-0 m-4">
                <x-icon-store icon="circle-info" class="h-10 w-10 text-blue-store" />
            </span>

        </div>
    </div>
@endsection
