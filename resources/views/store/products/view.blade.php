@extends('layouts.template')
@section('title', 'Detalles del producto')
@section('content')
    <div class="my-4">
        <div class="flex flex-col gap-8 px-4 lg:flex-row lg:px-10">
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <div class="main-image flex w-full items-center justify-center">
                    <img src="{{ Storage::url($product->main_image) }}" alt="Imagen {{ $product->name }}"
                        class="h-96 w-full max-w-xl rounded-2xl object-cover">
                </div>
                <div class="flex h-20 w-max items-center justify-center gap-2 overflow-hidden py-20">
                    <button class="button-prev-images cursor-pointer rounded-full fill-dark-blue p-1">
                        <x-icon-store icon="arrow-left" class="h-5 w-5" />
                    </button>
                    <div class="swiper swiper-images-secondarys w-[230px] sm:w-[250px] md:w-[350px] lg:w-[450px]">
                        <div class="swiper-wrapper">
                            @if ($product->images->count() > 0)
                                @foreach ($product->images as $i => $image)
                                    <div
                                        class="swiper-slide container-secondary-image {{ $i === 1 ? 'selected' : '' }} cursor-pointer overflow-hidden rounded-lg border">
                                        <img src="{{ Storage::url($image->image) }}"
                                            alt="Imagen secundaria {{ $product->name }}"
                                            class="secondary-image mx-auto h-24 w-40 object-cover sm:w-60 lg:w-full">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <button class="button-next-images cursor-pointer rounded-full fill-dark-blue p-1">
                        <x-icon-store icon="arrow-right" class="h-5 w-5" />
                    </button>
                </div>
            </div>
            <div class="lg:flex-[3] xl:flex-[4]">
                <div class="w-full 2xl:w-3/4">
                    <div class="flex flex-col justify-between gap-y-2 sm:flex-row">
                        <div>
                            <h1 class="text-2xl font-bold text-light-blue sm:text-3xl md:text-4xl">
                                {{ $product->name }}
                            </h1>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="mt-1 text-lg font-semibold text-light-blue sm:text-xl md:text-2xl">
                                {{ number_format($product->rating, 1) }}
                            </p>
                            <div class="flex items-center gap-2">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < floor($product->rating))
                                        <x-icon-store icon="star" class="h-6 w-6 text-yellow-400" />
                                    @elseif ($i < $product->rating)
                                        <x-icon-store icon="star-half" class="h-6 w-6 text-yellow-400" />
                                    @else
                                        <x-icon-store icon="star" class="h-6 w-6 text-zinc-300" />
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex gap-4">
                            <p class="font-dine-r text-xl text-gray-500 sm:text-2xl md:text-3xl">
                                $ {{ $product->price }}
                            </p>
                            @if ($product->max_price)
                                <p class="font-dine-r text-xl text-gray-500 sm:text-2xl md:text-3xl">
                                    - $ {{ $product->max_price }}
                                </p>
                            @endif
                        </div>
                        <p class="mt-2 font-din-r text-sm text-gray-400 sm:text-base md:text-lg">
                            {!! $product->short_description !!}
                        </p>
                    </div>
                    <div class="mt-4 flex items-center">
                        <h2 class="font-din-r text-lg font-normal uppercase text-light-blue sm:text-xl md:text-2xl">
                            Categoría:
                        </h2>
                        <div class="flex items-center gap-2">
                            @foreach ($product->subcategories as $category)
                                <p class="ml-2 font-din-r text-sm uppercase text-gray-400 sm:text-base md:text-lg">
                                    {{ $category->name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <form action="{{ Route('cart.add', $product->id) }}" id="form-add-to-cart" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="price" id="price">
                        <div class="mt-4 flex flex-col items-center justify-center gap-4 sm:flex-row sm:justify-start">
                            <div class="w-full sm:w-72">
                                @if ($product->options->count() > 0)
                                    @php
                                        $groupedOptions = $product->options->groupBy(function ($item) {
                                            return $item->option->name;
                                        });
                                    @endphp
                                    <div class="flex flex-col gap-4">
                                        @foreach ($groupedOptions as $optionName => $optionValues)
                                            <div class="flex flex-col">
                                                <x-select-store :options="$optionValues->pluck('value', 'id')->toArray()" id="{{ $optionName }}"
                                                    class="options_values" name="options_values[]"
                                                    label="{{ $optionName }}"
                                                    text="Selecciona un {{ strtolower($optionName) }}"
                                                    data-url="{{ Route('product.get-option') }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="info-variation" class="mt-4">
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($product->active_dedication)
                            <div class="mt-2 flex flex-col gap-2">
                                <div>
                                    <x-input-store type="text" name="message" label="Dedicatoria" required
                                        placeholder="Escribe una frase corta" />
                                </div>
                                <div>
                                    <x-select-store id="color" label="Colores dedicatoria" name="color"
                                        text="Selecciona la combinación de colores" :options="[
                                            'Anaranjado y Café' => 'Anaranjado y Café',
                                            'Azul y Amarillo' => 'Azul y Amarillo',
                                            'Azul y Anaranjado' => 'Azul y Anaranjado',
                                            'Azul y Café' => 'Azul y Café',
                                            'Azul y Celesete' => 'Azul y Celesete',
                                            'Azul y Negro' => 'Azul y Negro',
                                            'Azul y Rojo' => 'Azul y Rojo',
                                            'Azul únicamente' => 'Azul únicamente',
                                            'Azul y Verde' => 'Azul y Verde',
                                            'Café y Verde' => 'Café y Verde',
                                            'Celeste y Rosado' => 'Celeste y Rosado',
                                            'Celeste y Negro' => 'Celeste y Negro',
                                            'Celeste y Verde' => 'Celeste y Verde',
                                            'Morado y Verde' => 'Morado y Verde',
                                            'Morado y Anaranjado' => 'Morado y Anaranjado',
                                            'Negro y Café' => 'Negro y Café',
                                            'Rojo y Negro' => 'Rojo y Negro',
                                            'Rojo y Rosado' => 'Rojo y Rosado',
                                            'Rojo y Verde' => 'Rojo y Verde',
                                            'Rosado y Amarillo' => 'Rosado y Amarillo',
                                            'Rosado y Anaranjado' => 'Rosado y Anaranjado',
                                            'Rosado y Blanco' => 'Rosado y Blanco',
                                            'Rosado y Cáfe' => 'Rosado y Cáfe',
                                            'Rosado y Morado-Azul' => 'Rosado y Morado-Azul',
                                            'Rosado y Negro' => 'Rosado y Negro',
                                            'Rosado únicamente' => 'Rosado únicamente',
                                            'Verde y Amarillo' => 'Verde y Amarillo',
                                            'Verde y Rosado' => 'Verde y Rosado',
                                        ]" />
                                </div>
                            </div>
                        @endif

                        <div
                            class="mt-8 flex w-full flex-col flex-wrap items-start justify-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div
                                class="mx-auto flex h-10 w-max items-center overflow-hidden rounded-xl border-2 border-blue-store sm:mx-0">
                                <button type="button"
                                    class="flex h-10 items-center justify-center border-e-2 border-blue-store px-3 text-blue-store hover:bg-blue-store hover:text-white"
                                    id="btn-minus">
                                    <x-icon-store icon="minus" class="h-4 w-4 fill-current" />
                                </button>
                                <input readonly
                                    class="h-full w-20 border-none ps-6 text-center text-base font-bold text-blue-store outline-none"
                                    id="quantity" name="quantity" type="number" value="1" max="5" />
                                <button type="button"
                                    class="h-10 border-s-2 border-blue-store px-3 text-blue-store hover:bg-blue-store hover:text-white"
                                    id="btn-plus">
                                    <x-icon-store icon="plus" class="h-4 w-4 fill-current" />
                                </button>
                            </div>
                            <x-button-store type="button" class="w-full sm:w-auto" text="Añadir al carrito"
                                icon="cart-plus" typeButton="secondary" size="large" id="add-to-cart" />
                            <x-button-store type="button" class="w-full sm:w-auto" text="Comprar ahora"
                                typeButton="primary" size="large" id="buy-now" />
                        </div>
                    </form>

                    <div class="mt-4">
                        <form action="{{ Route('favorites.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="favorite-container">
                                <button type="button"
                                    data-is-favorite="{{ $product->is_favorite ? 'favorite' : 'no-favorite' }}"
                                    class="btn-add-favorite-product flex items-center justify-center gap-2 font-din-r text-sm text-gray-500 hover:text-dark-pink sm:text-base">

                                    <span id="heart-icon-fill" class="{{ $product->is_favorite ? 'block' : 'hidden' }}">
                                        <x-icon-store icon="heart-fill" class="h-5 w-5 fill-dark-pink sm:h-7 sm:w-7"
                                            data-heart="filled" />
                                    </span>

                                    <span id="heart-icon-outline"
                                        class="{{ $product->is_favorite ? 'hidden' : 'block' }}">
                                        <x-icon-store icon="heart" class="h-5 w-5 text-current sm:h-7 sm:w-7"
                                            data-heart="outline" />
                                    </span>

                                    <span id="text-btn-favorite">
                                        {{ $product->is_favorite ? 'Quitar de favoritos' : 'Agregar a favoritos' }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-8">
                        <div class="mx-auto mt-8 w-full">
                            <!-- Tabs Header -->
                            <div class="tabs-header flex justify-start gap-4 overflow-x-auto rounded-t-lg">
                                <button
                                    class="tab-btn active-tab text-nowrap px-6 py-2 text-sm font-medium text-zinc-700 focus:outline-none sm:text-base md:text-lg"
                                    data-target="#tab-description">
                                    Descripción
                                </button>
                                {{--                                 <button
                                    class="tab-btn text-nowrap px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-md md:text-lg"
                                    data-target="#tab-information">
                                    Información adicional
                                </button> --}}
                                <button
                                    class="tab-btn text-nowrap px-6 py-2 text-sm font-medium text-zinc-700 focus:outline-none sm:text-base md:text-lg"
                                    data-target="#tab-reviews">
                                    Valoraciones
                                </button>
                            </div>

                            <!-- Tabs Content -->
                            <div class="tabs-content rounded-b-lg bg-white p-2 sm:p-4 md:p-6">
                                <div id="tab-description" class="tab-panel">
                                    <p class="font-dine-r text-sm text-zinc-500 md:text-base">
                                        {!! $product->long_description !!}
                                    </p>
                                </div>
                                {{--       <div id="tab-information" class="tab-panel hidden">
                                    <p class="text-gray-700">Este es el contenido de la pestaña 2.</p>
                                </div> --}}
                                <div id="tab-reviews" class="tab-panel hidden">
                                    @if (!$purchase)
                                        <p class="font-dine-r text-gray-700">Debes comprar el producto para poder
                                            valorarlo.</p>
                                    @else
                                        @if (!$userReview)
                                            <div class="flex items-center gap-4">
                                                <span
                                                    class="text-start font-dine-r text-sm font-medium text-zinc-600 md:text-base">
                                                    Calificación
                                                </span>
                                                <div class="my-2 flex items-center gap-1" id="star-rating">
                                                    <button data-value="1" class="star start-unselected">
                                                        <x-icon-store icon="star" class="h-7 w-7" />
                                                    </button>
                                                    <button data-value="2" class="star start-unselected">
                                                        <x-icon-store icon="star" class="h-7 w-7" />
                                                    </button>
                                                    <button data-value="3" class="star start-unselected">
                                                        <x-icon-store icon="star" class="h-7 w-7" />
                                                    </button>
                                                    <button data-value="4" class="star start-unselected">
                                                        <x-icon-store icon="star" class="h-7 w-7" />
                                                    </button>
                                                    <button data-value="5" class="star start-unselected">
                                                        <x-icon-store icon="star" class="h-7 w-7" />
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <form action="{{ Route('reviews.store') }}" method="POST"
                                                    id="form-review">
                                                    @csrf
                                                    <input type="hidden" name="rating" id="rating-value">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <x-input-store type="textarea" placeholder="Escribe tu valoración"
                                                        name="comment" id="review" label="Valoración" />
                                                    <span id="message-review" class="hidden text-xs text-red-600"></span>
                                                    <div class="mt-4 flex items-center justify-end gap-4">
                                                        <x-button-store type="submit" typeButton="primary"
                                                            text="Enviar reseña" icon="send" />
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="mt-4 flex flex-col gap-4">
                                        @if ($reviews->count() > 0)
                                            @foreach ($reviews as $review)
                                                @if ($review->user)
                                                    <div class="flex flex-col gap-2">
                                                        <div class="flex items-center gap-2">
                                                            @if ($review->user->profile)
                                                                <img src="{{ Storage::url($review->user->profile) }}"
                                                                    alt="Imagen de perfil del usuario"
                                                                    class="h-12 w-12 rounded-full object-cover">
                                                            @else
                                                                <x-icon-store icon="user" class="h-12 w-12" />
                                                            @endif
                                                            <div
                                                                class="flex w-full flex-col justify-between gap-2 sm:flex-row">
                                                                <div class="flex flex-col">
                                                                    <p
                                                                        class="text-secondary font-pluto-r text-base font-bold text-zinc-600 md:text-lg">
                                                                        @if ($review->user)
                                                                            {{ $review->user->name }}
                                                                        @endif
                                                                    </p>
                                                                    <p
                                                                        class="font-secondary font-dine-r text-xs text-zinc-600 sm:text-sm">
                                                                        {{ $review->created_at->timezone('America/El_Salvador')->format('d F Y h:i A') }}

                                                                    </p>
                                                                </div>
                                                                <div class="flex items-center gap-1 sm:gap-2">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @if ($i < $review->rating)
                                                                            <x-icon-store icon="star"
                                                                                class="h-5 w-5 text-yellow-300" />
                                                                        @else
                                                                            <x-icon-store icon="star"
                                                                                class="h-5 w-5 text-zinc-300" />
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p
                                                            class="font-secondary md::text-base text-secondary ms-14 font-dine-r text-sm text-zinc-500">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p
                                                class="rounded-xl border-2 border-dashed border-blue-500 bg-blue-50 p-10 text-center text-blue-500">
                                                No hay valoraciones para este producto.
                                            </p>
                                        @endif
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

@push('scripts')
    @vite('resources/js/store/product-view.js')
@endpush
