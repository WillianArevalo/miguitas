@extends('layouts.template')
@section('title', 'Miguitas | Carrito de compras')
@section('content')
    <div>
        <div class="py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-5xl font-bold text-white">Carrito de compras</h1>
        </div>

        <div class="my-10 flex flex-col gap-8 lg:flex-row lg:gap-0">
            <div class="flex-[2] border-blue-store px-4 lg:border-e-2">
                <!-- Header -->
                <div class="hidden gap-4 md:flex">
                    <div class="flex-[3]">
                        <h2 class="text-2xl font-bold text-dark-pink">Producto</h2>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-dark-pink">Cantidad</h2>
                    </div>
                    <div class="flex-1 text-center">
                        <h2 class="text-2xl font-bold text-dark-pink">Total</h2>
                    </div>
                    <div class="flex-1">
                    </div>
                </div>
                <!-- Products -->
                @for ($i = 0; $i < 3; $i++)
                    <div
                        class="mt-4 flex flex-col items-center gap-4 rounded-2xl border border-zinc-200 p-4 md:flex-row md:border-none">
                        <div class="flex-[3]">
                            <div class="flex gap-4">
                                <div>
                                    <img src="{{ asset('img/image.jpg') }}" alt="Producto"
                                        class="h-20 w-20 rounded-xl object-cover">
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-dark-pink">Producto 1</h3>
                                    <p class="dine-r text-sm text-zinc-700">Descripción del producto</p>
                                    <p class="dine-r text-sm text-zinc-700">
                                        $100.00
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 text-blue-store">
                            <div
                                class="flex h-10 w-max items-center gap-6 overflow-hidden rounded-xl border-2 border-dark-pink">
                                <button
                                    class="flex h-10 items-center justify-center border-e-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                                    <x-icon-store icon="minus" class="h-4 w-4 fill-current" />
                                </button>
                                <span class="text-base font-bold">1</span>
                                <button class="h-10 border-s-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                                    <x-icon-store icon="plus" class="h-4 w-4 fill-current" />
                                </button>
                            </div>
                        </div>
                        <div class="flex-1 text-center">
                            <h3 class="dine-r text-xl font-bold text-blue-store">$ 100.00</h3>
                        </div>
                        <div class="flex flex-1 items-center justify-center">
                            <x-button-store type="button" icon="trash" onlyIcon="true" typeButton="secondary"
                                size="small" />
                        </div>
                    </div>
                @endfor
            </div>
            <div class="h-max flex-1 px-4">
                <div class="flex justify-center border-b-2 border-blue-store pb-2 lg:justify-start">
                    <h2 class="pluto-m text-xl font-bold text-dark-pink sm:text-2xl md:text-3xl">
                        Resumen del pedido
                    </h2>
                </div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between">
                        <p class="text-sm text-light-blue sm:text-base md:text-lg">
                            Subtotal
                        </p>
                        <p class="text-sm text-blue-store sm:text-base md:text-lg">
                            $300.00
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm text-light-blue sm:text-base md:text-lg">
                            Impuestos
                        </p>
                        <p class="text-sm text-blue-store sm:text-base md:text-lg">
                            ---
                        </p>
                    </div>
                    <div class="flex justify-between border-b-2 border-blue-store pb-4">
                        <p class="text-sm text-light-blue sm:text-base md:text-lg">
                            Envío
                        </p>
                        <p class="text-sm text-light-blue sm:text-base md:text-lg">
                            ---
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-xl text-light-blue">
                            Total del pedido
                        </p>
                        <p class="text-xl text-blue-store">
                            $300.00
                        </p>
                    </div>
                </div>
                <div class="mt-10 flex items-center justify-center">
                    <x-button-store text="Finalizar compra" type="a" href="{{ Route('checkout') }}"
                        typeButton="primary" />
                </div>
            </div>
        </div>

        <div class="mt-4 px-0 sm:px-4 md:px-10">
            <h2
                class="my-4 border-b-4 border-blue-store text-center text-xl text-blue-store sm:text-2xl md:text-4xl lg:text-left">
                ¡Tu peludo tiene que probarlos!
            </h2>
            <div class="">
                <div class="swiper mySwiper w-100 h-full px-4">
                    <div class="swiper-wrapper pb-10">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="swiper-slide relative rounded-3xl border border-zinc-200 p-2 shadow-xl sm:p-6">
                                <div class="card-image">
                                    <img src="{{ asset('img/image.jpg') }}" alt="Featured2 image"
                                        class="h-48 w-full rounded-xl object-cover md:h-60">
                                </div>
                                <div class="card-body mt-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <a href="">
                                                <x-icon-store icon="heart"
                                                    class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                            </a>
                                            <a href="">
                                                <x-icon-store icon="comment"
                                                    class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                            </a>
                                            <a href="">
                                                <x-icon-store icon="send"
                                                    class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
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
                                        <h2
                                            class="pluto-r text-start text-sm font-semibold text-blue-store sm:text-base md:text-lg">
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
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
