@extends('layouts.template')
@section('title', 'Detalles del producto')
@section('content')
    <div class="my-4">
        <div class="flex flex-col gap-8 px-4 lg:flex-row lg:px-10">
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <div class="main-image relative">
                    <img src="{{ asset('img/image.jpg') }}" alt=""
                        class="h-80 w-full max-w-xl rounded-2xl object-cover">

                    <button class="absolute right-0 top-0 m-4 rounded-full bg-white p-2">
                        <x-icon-store icon="heart" class="h-4 w-4 fill-rose-400 sm:w-6 md:h-6" />
                    </button>

                </div>
                <div class="flex h-20 w-max items-center justify-center gap-2 overflow-hidden py-20">
                    <button class="button-prev-images cursor-pointer rounded-full fill-dark-blue p-1">
                        <x-icon-store icon="arrow-left" class="h-5 w-5" />
                    </button>
                    <div class="swiper swiper-images-secondarys w-[230px] sm:w-[250px] md:w-[350px] lg:w-[450px]">
                        <div class="swiper-wrapper">
                            @for ($i = 0; $i < 5; $i++)
                                <div
                                    class="swiper-slide container-secondary-image {{ $i === 1 ? 'selected' : '' }} cursor-pointer overflow-hidden rounded-lg">
                                    <img src="{{ asset('img/image.jpg') }}" alt="Imagen secundaria"
                                        class="secondary-image mx-auto h-20 w-40 object-cover sm:w-60 lg:w-full">
                                </div>
                            @endfor
                        </div>
                    </div>
                    <button class="button-next-images cursor-pointer rounded-full fill-dark-blue p-1">
                        <x-icon-store icon="arrow-right" class="h-5 w-5" />
                    </button>
                </div>
            </div>
            <div class="lg:flex-[3] xl:flex-[4]">
                <div>
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text2xl font-bold text-light-blue sm:text-3xl md:text-4xl">
                                Bandanas
                            </h1>
                        </div>
                        <div class="flex items-center gap-2">
                            @for ($i = 0; $i < 5; $i++)
                                <x-icon-store icon="star" class="h-6 w-6 fill-yellow-400" />
                            @endfor
                        </div>
                    </div>
                    <div>
                        <p class="dine-r text-xl text-gray-500 sm:text-2xl md:text-3xl">
                            $ 10.00
                        </p>
                        <p class="din-r mt-2 text-sm text-gray-400 sm:text-base md:text-lg">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente quidem quo nobis eum, odit
                            soluta
                            aspernatur eaque fugit ad? Optio obcaecati atque iste eius nobis maxime suscipit est iusto qui.
                        </p>
                    </div>
                    <div class="mt-4 flex items-center">
                        <h2 class="text-lg font-semibold text-light-blue sm:text-xl md:text-2xl">
                            Categoría:
                        </h2>
                        <p class="dine-r ml-2 text-sm uppercase text-gray-400 sm:text-base md:text-lg">
                            Accesorios
                        </p>
                    </div>
                    <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                        <div class="mt-4 flex gap-4">
                            <button
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 p-2 text-lg text-blue-store hover:bg-blue-200 sm:h-12 sm:w-12 sm:text-xl md:h-14 md:w-14 md:text-2xl">
                                S
                            </button>
                            <button
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 p-2 text-lg text-blue-store hover:bg-blue-200 sm:h-12 sm:w-12 sm:text-xl md:h-14 md:w-14 md:text-2xl">
                                M
                            </button>
                            <button
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 p-2 text-lg text-blue-store hover:bg-blue-200 sm:h-12 sm:w-12 sm:text-xl md:h-14 md:w-14 md:text-2xl">
                                L
                            </button>
                        </div>
                        <div class="w-60">
                            <x-select-store :options="['red' => 'Rojo', 'blue' => 'Azul', 'green' => 'Verde']" id="color" name="color" label="Color"
                                text="Selecciona un color" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-between gap-4 md:flex-row">
                        <div class="flex h-10 w-max items-center overflow-hidden rounded-xl border-2 border-blue-store">
                            <button
                                class="flex h-10 items-center justify-center border-e-2 border-blue-store px-3 text-blue-store hover:bg-blue-store hover:text-white"
                                id="btn-minus">
                                <x-icon-store icon="minus" class="h-4 w-4 fill-current" />
                            </button>
                            <input readonly
                                class="h-full w-20 border-none ps-6 text-center text-base font-bold text-blue-store outline-none"
                                id="quantity" name="quantity" type="number" value="1" max="5" />
                            <button
                                class="h-10 border-s-2 border-blue-store px-3 text-blue-store hover:bg-blue-store hover:text-white"
                                id="btn-plus">
                                <x-icon-store icon="plus" class="h-4 w-4 fill-current" />
                            </button>
                        </div>
                        <x-button-store type="button" class="w-full sm:w-auto" text="Añadir al carrito" icon="cart-plus"
                            typeButton="secondary" size="large" />
                        <x-button-store type="button" class="w-full sm:w-auto" text="Comprar ahora" typeButton="primary"
                            size="large" />
                    </div>
                    <div class="mt-8">
                        <div class="mx-auto mt-8 w-full">
                            <!-- Tabs Header -->
                            <div class="tabs-header flex justify-start gap-4 overflow-x-auto rounded-t-lg">
                                <button
                                    class="tab-btn active-tab text-nowrap px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                                    data-target="#tab-description">
                                    Descripción
                                </button>
                                <button
                                    class="tab-btn text-nowrap px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                                    data-target="#tab-information">
                                    Información adicional
                                </button>
                                <button
                                    class="tab-btn text-nowrap px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                                    data-target="#tab-reviews">
                                    Valoraciones
                                </button>
                            </div>

                            <!-- Tabs Content -->
                            <div class="tabs-content rounded-b-lg bg-white p-2 sm:p-4 md:p-6">
                                <div id="tab-description" class="tab-panel">
                                    <p class="dine-r text-sm text-zinc-500 md:text-base">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro maiores at magni
                                        quod. Exercitationem necessitatibus provident omnis ducimus ullam libero nobis magni
                                        quo! Porro, cumque nisi. Illo necessitatibus veniam repellat.
                                    </p>
                                </div>
                                <div id="tab-information" class="tab-panel hidden">
                                    <p class="text-gray-700">Este es el contenido de la pestaña 2.</p>
                                </div>
                                <div id="tab-reviews" class="tab-panel hidden">
                                    <div class="flex flex-col gap-4">
                                        @for ($i = 0; $i < 4; $i++)
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-2">
                                                    <img src="{{ asset('img/image.jpg') }}"
                                                        alt="Imagen de perfil del usuario"
                                                        class="h-12 w-12 rounded-full object-cover">
                                                    <div class="flex w-full flex-col justify-between gap-2 sm:flex-row">
                                                        <div class="flex flex-col">
                                                            <p
                                                                class="text-secondary pluto-r text-base font-bold text-zinc-600 md:text-lg">
                                                                Nombre de usuario
                                                            </p>
                                                            <p
                                                                class="font-secondary dine-r text-xs text-zinc-600 sm:text-sm">
                                                                12 de septiembre de 2022
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center gap-1 sm:gap-2">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < 3)
                                                                    <x-icon-store icon="star-fill"
                                                                        class="h-5 w-5 fill-yellow-300" />
                                                                @else
                                                                    <x-icon-store icon="star"
                                                                        class="h-5 w-5 fill-zinc-300" />
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <p
                                                    class="font-secondary md::text-base text-secondary dine-r ms-14 text-sm text-zinc-500">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro maiores
                                                    at
                                                    magni
                                                </p>
                                                <div>
                                                    @if (auth()->check())
                                                        <div class="ms-14 mt-2 flex items-center gap-2">
                                                            <button id="btn-edit-review" type="button"
                                                                class="flex items-center justify-center rounded-xl border border-zinc-300 p-2 text-green-500 hover:bg-zinc-50">
                                                                <x-icon-store icon="edit"
                                                                    class="h-4 w-4 fill-current" />
                                                            </button>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="flex items-center justify-center rounded-xl border border-red-300 p-2 text-red-400 hover:bg-red-50">
                                                                    <x-icon-store icon="delete"
                                                                        class="h-4 w-4 fill-current" />
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
                        @for ($i = 0; $i < 8; $i++)
                            <div class="swiper-slide relative rounded-3xl border border-zinc-200 p-2 shadow-xl sm:p-6">
                                <div class="ribbon"><span>10%</span></div>
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
