@extends('layouts.template')
@section('title', 'Miguitas | Carrito de compras')
@section('content')
    <div>
        <div class="py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl">Carrito de compras</h1>
        </div>

        <div class="bg-blue-store p-4">
            <div class="flex items-center justify-center gap-4">
                <x-icon-store icon="truck" class="h-8 w-8 fill-current text-white" />
                <p class="text-center font-dine-r text-xs text-white sm:text-sm md:text-base">
                    Tomamos órdenes con mínimo 1 día de anticipación. Domingo y Lunes cerrado. (no se realizan entregas)
                </p>
            </div>
        </div>

        <div class="mb-14 mt-8 pe-4 ps-8 lg:pe-0 lg:ps-0">
            <div
                class="schedule mx-auto flex w-full flex-col items-center justify-center rounded-2xl border-[3px] border-blue-store p-4 text-center md:p-6 lg:w-1/2">
                <h2 class="text-xl text-blue-store sm:text-2xl md:text-3xl">
                    Horarios de entrega
                </h2>
                <p class="mt-2 font-dine-r text-xs text-zinc-500 sm:text-sm md:text-base">
                    A domicilio:
                </p>
                <p class="mt-2 font-dine-r text-xs text-zinc-500 sm:text-sm md:text-base">
                    Martes a Viernes 10:00 a.m. a 3:00 p.m. y Sábados de 9:00 a.m. a 4:00 p.m.
                </p>
                <p class="mt-2 font-dine-r text-xs text-zinc-500 sm:text-sm md:text-base">
                    En PAWstry en La Sultana: Martes a Viernes 1100 a.m. a 6:00 p.m. y Sábados de 10:00 a.m. a 4:00 p.m.
                </p>
                <p class="mt-2 font-dine-r text-xs text-zinc-500 sm:text-sm md:text-base">
                    Martes 24 y 31 de Diciembre 10:00 a.m. a 4:00 p.m.
                </p>
            </div>
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
                <div id="cart">
                    @if ($cart && $cart->items->count() > 0)
                        @foreach ($cart->items as $item)
                            <div
                                class="mt-4 flex flex-col items-center gap-4 rounded-2xl border border-zinc-200 p-4 shadow-sm md:flex-row">
                                <div class="flex-[3]">
                                    <div class="flex gap-4">
                                        <div>
                                            <img src="{{ Storage::url($item->product->main_image) }}"
                                                alt="{{ $item->product->name }}" class="h-20 w-20 rounded-xl object-cover">
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-dark-pink">
                                                {{ $item->product->name }}
                                            </h3>
                                            <ul>
                                                @foreach ($item->options as $option)
                                                    <li class="font-dine-r text-sm text-zinc-500">
                                                        <span class="font-medium">
                                                            {{ $option->productOptionValue->option->name }}:
                                                        </span>
                                                        {{ $option->productOptionValue->value }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p class="font-dine-r text-sm font-semibold text-blue-store">
                                                $ {{ $item->price }}
                                            </p>
                                            @if ($item->message_dedication && $item->color_dedication)
                                                <span
                                                    class="mt-2 block rounded-xl bg-violet-100 px-2 py-1 font-dine-r text-xs text-violet-500">
                                                    Dedicatoria: {{ $item->message_dedication }}
                                                    ({{ $item->color_dedication }})
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 text-blue-store">
                                    <div
                                        class="flex h-10 w-max items-center gap-6 overflow-hidden rounded-xl border-2 border-dark-pink">
                                        <form action="{{ route('cart.update', $item->product->id) }}" method="POST"
                                            id="form-minus-cart-{{ $item->product->id }}">
                                            @csrf
                                            <input type="hidden" name="action" value="minus">
                                            <button type="button" data-form="#form-minus-cart-{{ $item->product->id }}"
                                                class="btnMinusCart flex h-10 items-center justify-center border-e-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                                                <x-icon-store icon="minus" class="h-4 w-4 fill-current" />
                                            </button>
                                        </form>
                                        <span class="text-base font-bold">
                                            {{ $item->quantity }}
                                        </span>
                                        <form action="{{ route('cart.update', $item->product->id) }}" method="POST"
                                            id="form-plus-cart-{{ $item->product->id }}">
                                            @csrf
                                            <input type="hidden" name="action" value="plus">
                                            <button type="button" data-form="#form-plus-cart-{{ $item->product->id }}"
                                                class="btnPlusCart flex h-10 items-center justify-center border-s-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                                                <x-icon-store icon="plus" class="h-4 w-4 fill-current" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="flex-1 text-center">
                                    <h3 class="font-dine-r text-xl font-bold text-blue-store">
                                        $ {{ number_format($item->sub_total, 2) }}
                                    </h3>
                                </div>
                                <div class="flex flex-1 items-center justify-center">
                                    <form action="{{ Route('cart.remove', $item->product->id) }}" method="POST"
                                        id="form-remove-cart-{{ $item->product->id }}">
                                        @csrf
                                        <x-button-store data-form="#form-remove-cart-{{ $item->product->id }}"
                                            type="button" icon="trash" class="btnRemoveCart" onlyIcon="true"
                                            typeButton="secondary" />
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex h-96 flex-col items-center justify-center">
                            <x-icon-store icon="cart" class="h-20 w-20 fill-current text-zinc-500" />
                            <p class="font-dine-r text-base text-zinc-500">
                                No hay productos en el carrito
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="h-max flex-1 px-4">
                <div class="flex justify-center border-b-2 border-blue-store pb-2 lg:justify-start">
                    <h2 class="font-pluto-m text-xl font-bold text-dark-pink sm:text-2xl md:text-3xl">
                        Resumen del pedido
                    </h2>
                </div>
                <div class="mt-4 flex flex-col gap-2">
                    <div class="flex justify-between">
                        <p class="font-dine-r text-sm text-blue-store sm:text-base md:text-lg">
                            Subtotal
                        </p>
                        <p class="text-sm text-blue-store sm:text-base md:text-lg" id="totalPriceCart">
                            {{ $carts_totals['total'] }}
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <p class="font-dine-r text-sm text-blue-store sm:text-base md:text-lg">
                            Impuestos
                        </p>
                        <p class="text-sm text-blue-store sm:text-base md:text-lg" id="totalTaxes">
                            {{ $carts_totals['taxes'] }}
                        </p>
                    </div>
                    <div class="flex justify-between border-b-2 border-blue-store pb-4">
                        <p class="font-dine-r text-sm text-blue-store sm:text-base md:text-lg">
                            Envío
                        </p>
                        <p class="text-sm text-blue-store sm:text-base md:text-lg">
                            ---
                        </p>
                    </div>
                    <div class="flex justify-between">
                        <p class="font-dine-r text-xl text-blue-store">
                            Total del pedido
                        </p>
                        <p class="text-xl text-blue-store" id="subtotal">
                            {{ $carts_totals['subtotal'] }}
                        </p>
                    </div>
                </div>
                @if ($cart && $cart->items->count() > 0)
                    <div class="mt-10 flex items-center justify-center">
                        <x-button-store text="Finalizar compra" type="a" href="{{ Route('checkout') }}"
                            typeButton="primary" />
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4 px-0 sm:px-4 md:px-10">
            <h2
                class="my-4 border-b-4 border-blue-store text-center text-xl text-blue-store sm:text-2xl md:text-4xl lg:text-left">
                ¡Tu peludo tiene que probarlos!
            </h2>
            <div>
                <div class="swiper mySwiper w-100 h-full px-4">
                    <div class="swiper-wrapper pb-10">
                        @foreach ($products as $product)
                            <x-card-product2 :product="$product" />
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
