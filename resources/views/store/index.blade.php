@extends('layouts.template')
@section('title', 'Miguitas | Tienda')
@section('content')
    @push('styles')
        @vite('resources/css/store/shop.css')
    @endpush
    <div class="main-container mt-4">
        <div class="flex w-full items-center justify-center md:w-4/5 lg:w-3/4">
            <img src="{{ asset('img/shop.png') }}" alt="Shop image">
        </div>

        <h1 class="pluto-m my-10 text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">CATEGORÍAS</h1>

        <div
            class="flex w-full flex-col items-center justify-center gap-5 bg-blue-store p-10 sm:flex-row sm:gap-10 md:gap-20">
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/giftcard.png') }}" class="h-full w-full" alt="GiftCard image">
                </div>
                <div>
                    <h1 class="pluto-r text-base font-bold text-white sm:text-lg md:text-xl">Gift Card</h1>
                </div>
            </a>
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/pups.png') }}" class="h-full w-full" alt="GiftCard image">
                </div>
                <div>
                    <h1 class="pluto-r text-base font-bold text-white sm:text-lg md:text-xl">For Pups</h1>
                </div>
            </a>
            <a href="#" class="flex flex-col justify-center gap-2 transition-transform hover:scale-110">
                <div class="h-20 w-20 overflow-hidden rounded-full border-4 border-white sm:h-28 sm:w-28">
                    <img src="{{ asset('img/kitties.png') }}" class="h-full w-full" alt="Kitties image">
                </div>
                <div>
                    <h1 class="pluto-r text-base font-bold text-white sm:text-lg md:text-xl">For Kitties</h1>
                </div>
            </a>
        </div>

        <h1 class="pluto-m my-10 text-xl text-light-blue md:text-2xl lg:text-4xl xl:text-5xl">PRODUCTOS DESTACADOS</h1>

        <!-- Contenedor donde se mostrarán las cards de productos destacados 2 (featured2-card) -->
        <div class="grid grid-cols-3 gap-4 px-4 max-[840px]:grid-cols-2 xl:grid-cols-4">
            @for ($i = 0; $i < 8; $i++)
                <div class="card relative rounded-3xl border-[3px] border-blue-store p-2 sm:p-6">
                    <div class="card-header flex items-center gap-2 md:gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                            class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
                        <div class="flex flex-col items-start">
                            <p class="pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                            <p class="pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
                        </div>
                    </div>
                    <div class="card-image mt-4">
                        <img src="{{ asset('img/image.jpg') }}" alt="Featured2 image"
                            class="h-48 w-full rounded-xl object-cover md:h-60">
                    </div>
                    <div class="card-body mt-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <a href="">
                                    <x-icon-store icon="heart" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="comment" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="send" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                </a>
                            </div>
                            <button>
                                <x-icon-store icon="cart" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                            </button>
                        </div>
                        <div class="pb-6">
                            <small class="mt-2 block text-start">
                                <p class="pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
                            </small>
                            <h2 class="pluto-r text-start text-sm font-semibold text-blue-store sm:text-base md:text-lg">
                                #Cake Corazón FurryLove
                            </h2>
                            <p class="text-start">
                                <span class="dine-r text-lg text-gray-store">$</span>
                                <span class="dine-r text-lg text-gray-store">25.00</span>
                            </p>
                        </div>
                    </div>
                    <a href=""
                        class="absolute bottom-0 right-0 m-2 rounded-full border-2 border-blue-store bg-pink-store p-2 sm:m-4">
                        <x-icon-store icon="arrow-right" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                    </a>
                </div>
            @endfor
        </div>

        <div
            class="relative my-14 flex w-full flex-col items-center justify-center gap-8 bg-pink-store p-20 text-zinc-800 sm:rounded-3xl md:w-3/4 lg:w-1/2">
            <p class="text-base md:text-lg">Programa tu Pedido mínimo 1 día antes y máximo con 3
                semanas de anticipación considerando que DOM y LUNES
                estamos CERRADOS.
            </p>

            <p class="text-base md:text-lg">Medios de Pago: tarjeta (en línea), transferencia bancaria o
                QR Banco Agrícola (enviando comprobante antes de 10 am
                del día de la entrega).
            </p>

            <span class="absolute left-0 top-0 m-4">
                <x-icon-store icon="circle-info" class="h-10 w-10 fill-blue-store" />
            </span>

        </div>
    </div>
@endsection
