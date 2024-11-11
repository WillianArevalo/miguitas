@extends('layouts.template')
@section('title', 'Miguitas | Favoritos')
@push('styles')
    @vite('resources/css/store/favorite.css')
@endpush
@section('content')
    <div>
        <div class="w-full py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-5xl font-bold text-white">
                Favoritos
            </h1>
        </div>

        <div class="mx-auto my-10 w-full md:w-3/4">
            @if ($favorites->count() > 0)
                <div class="relative grid grid-cols-3 gap-4 px-4 max-[840px]:grid-cols-2 xl:grid-cols-3">
                    @foreach ($favorites as $favorite)
                        <div class="card card-diagonal relative bg-light-gray p-2 sm:p-6">
                            <div class="card-image">
                                <img src="{{ Storage::url($favorite->main_image) }}" alt="Featured2 image"
                                    class="h-48 w-full rounded-xl object-cover md:h-60">
                            </div>
                            <div class="card-body mt-4 p-2 sm:p-0">
                                <div class="pb-6">
                                    <h2
                                        class="pluto-r text-start text-sm font-semibold text-blue-store sm:text-base md:text-lg">
                                        {{ $favorite->name }}
                                    </h2>
                                    <div class="flex items-center gap-2">
                                        <p class="text-start">
                                            <span class="dine-r text-lg text-gray-store">$</span>
                                            <span class="dine-r text-lg text-gray-store">
                                                {{ $favorite->price }}
                                            </span>
                                        </p>
                                        @if ($favorite->max_price)
                                            <span class="dine-r text-lg text-gray-store">-</span>
                                            <p class="text-start">
                                                <span class="dine-r text-lg text-gray-store">$</span>
                                                <span class="dine-r text-lg text-gray-store">
                                                    {{ $favorite->max_price }}
                                                </span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-start p-2 sm:p-0">
                                <div class="flex items-center gap-3">
                                    <form action="{{ Route('favorites.add', $favorite->id) }}" method="POST"
                                        class="flex items-center justify-center">
                                        @csrf
                                        <div class="favorite-container">
                                            <button type="button" class="btn-add-favorite flex items-center justify-center"
                                                data-is-favorite="{{ $favorite->is_favorite ? 'favorite' : 'no-favorite' }}">
                                                @if ($favorite->is_favorite)
                                                    <x-icon-store icon="heart-fill"
                                                        class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" data-heart="filled" />
                                                @else
                                                    <x-icon-store icon="heart"
                                                        class="h-5 w-5 text-blue-store sm:h-7 sm:w-7"
                                                        data-heart="outline" />
                                                @endif
                                            </button>
                                        </div>
                                    </form>
                                    <button>
                                        <x-icon-store icon="cart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mx-auto flex flex-col items-center justify-center p-20">
                    <h2 class="text-2xl text-gray-store">
                        ¡No tienes productos favoritos!
                    </h2>
                    <x-button-store type="a" href="{{ Route('store') }}" text="Ir a la tienda" typeButton="primary"
                        class="mt-4" icon="home" />
                </div>
            @endif
        </div>

        <div class="my-10 px-0 sm:px-4 md:px-10">
            <h2 class="my-4 border-b-4 border-blue-store text-4xl text-blue-store">
                ¡Encuentra aquí tus favoritos!
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


        <div class="mx-auto mb-10 w-full px-4 md:w-3/4">
            <img src="{{ asset('img/mango-discount.png') }}" alt="">
        </div>
    </div>
@endsection
