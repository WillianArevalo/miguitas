<header class="p-2 sm:p-4">
    <div class="flex w-full items-center">
        <!-- Btn hamburger -->
        <div class="flex items-center justify-center lg:hidden">
            <button data-drawer-target="nav-mobile" data-drawer-show="nav-mobile" aria-controls="nav-mobile"
                class="flex h-12 w-12 items-center justify-center text-light-blue hover:bg-white hover:text-blue-store">
                <x-icon-store icon="bars" class="h-8 w-8 fill-current"></x-icon-store>
            </button>
        </div>
        <!-- Logo -->
        <div class="flex-1 px-2 sm:px-4">
            <img src="{{ $logo ? Storage::url($logo) : asset('img/logo.png') }}" alt="Logo"
                class="min-h-12 min-w-12 h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 lg:h-24 lg:w-24">
        </div>

        <div class="flex-[10]">
            <div class="flex items-center justify-end gap-4">
                <!-- Input search -->
                <div class="relative hidden h-14 flex-1 overflow-hidden rounded-2xl border border-zinc-400 sm:block">
                    <input type="search" placeholder="Buscar productos..."
                        class="h-full w-full border-none px-6 py-2 font-din-r outline-none" id="search-input">
                    <button
                        class="group absolute right-0 top-0 flex h-full w-14 items-center justify-center border-s border-zinc-400 text-blue-store hover:bg-blue-store hover:text-white sm:w-20"
                        id="search-btn">
                        <x-icon-store icon="search" class="h-4 w-4 text-current sm:h-6 sm:w-6"></x-icon-store>
                    </button>
                </div>

                <!-- Icons -->
                <div class="hidden h-14 items-center justify-center lg:flex">
                    <ul class="flex items-center gap-4 px-4 py-2">
                        <li>
                            <a href="{{ Route('cart') }}" class="group relative">
                                <x-icon-store icon="cart"
                                    class="h-8 w-8 text-light-blue transition-transform group-hover:scale-110"></x-icon-store>
                                <span
                                    class="absolute -right-2 -top-2 rounded-full bg-dark-pink px-1.5 py-0.5 text-xs text-white"
                                    id="cart-count">
                                    {{ \App\Helpers\Cart::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('favorites') }}" class="group relative">
                                <x-icon-store icon="heart"
                                    class="h-8 w-8 text-light-blue transition-transform group-hover:scale-110"></x-icon-store>
                                <span
                                    class="absolute -right-2 -top-2 rounded-full bg-dark-pink px-1.5 py-0.5 text-xs text-white"
                                    id="favorite-count">
                                    {{ \App\Helpers\Favorites::count() }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $location }}" target="_blank" class="group">
                                <x-icon-store icon="location"
                                    class="h-8 w-8 text-light-blue transition-transform group-hover:scale-110">
                                </x-icon-store>
                            </a>
                        </li>
                        <li class="relative flex items-center">
                            @if ($user = auth()->user())
                                <button type="button" class="profile flex items-center justify-center gap-1">
                                    @if (auth()->user()->google_id && !auth()->user()->profile)
                                        <img src="{{ auth()->user()->google_profile }}" alt="User image"
                                            class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <img src="{{ Storage::url(auth()->user()->profile) }}" alt="User image"
                                            class="h-10 w-10 rounded-full object-cover">
                                    @endif
                                </button>
                                <div class="font-secondary absolute right-0 top-10 z-50 hidden w-52 overflow-hidden rounded-lg bg-white text-sm shadow-md"
                                    id="profile-options">
                                    <ul class="flex flex-col p-2 font-medium">
                                        <li class="w-full">
                                            <a href="{{ Route('account.index') }}"
                                                class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-blue-store hover:bg-purple-100">
                                                <x-icon-store icon="user"
                                                    class="mr-2 inline-block h-4 w-4 text-current" />
                                                Mi cuenta
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a href="{{ Route('orders.index') }}"
                                                class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                <x-icon-store icon="bag"
                                                    class="mr-2 inline-block h-4 w-4 text-current" />
                                                Mis pedidos
                                            </a>
                                        </li>
                                        <li class="mb-2 w-full">
                                            <a href="{{ Route('favorites') }}"
                                                class="group flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-rose-50 hover:text-rose-500">
                                                <x-icon-store icon="heart"
                                                    class="mr-2 inline-block h-4 w-4 text-current group-hover:fill-rose-500" />
                                                Favoritos
                                            </a>
                                        </li>
                                        <hr class="border-t border-zinc-200">
                                        @if (auth()->user()->role === 'admin')
                                            <li class="mt-2 w-full">
                                                <a href="{{ Route('admin.index') }}" target="_blank"
                                                    class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                    <x-icon-store icon="user"
                                                        class="mr-2 inline-block h-4 w-4 text-current" />
                                                    Administrador
                                                </a>
                                            </li>
                                        @endif
                                        <li class="@if (auth()->user()->role !== 'admin') mt-2 @endif mb-2 w-full">
                                            <a href="{{ Route('account.index') }}"
                                                class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                <x-icon-store icon="settings"
                                                    class="mr-2 inline-block h-4 w-4 text-current" />
                                                Configuración
                                            </a>
                                        </li>
                                        <hr class="border-t border-zinc-200">
                                        <li class="mt-2 w-full">
                                            <form action="{{ Route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                    <x-icon-store icon="logout"
                                                        class="mr-2 inline-block h-4 w-4 text-current" />
                                                    Cerrar sesión
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ Route('login') }}"
                                    class="font-font-din-b text-sm text-blue-store hover:underline">
                                    <x-icon-store icon="user" class="h-8 w-8 text-light-blue"></x-icon-store>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>

                <!-- Icons mobile -->
                <div class="flex items-center justify-center gap-4 lg:hidden">
                    <button class="size-12 flex items-center justify-center sm:hidden"
                        data-drawer-target="nav-mobile-search" data-drawer-show="nav-mobile-search">
                        <x-icon-store icon="search" class="h-6 w-6 text-light-blue"></x-icon-store>
                    </button>
                    <a href="{{ Route('cart') }}" class="group relative">
                        <x-icon-store icon="cart"
                            class="h-8 w-8 text-light-blue transition-transform group-hover:scale-110"></x-icon-store>
                        <span
                            class="absolute -right-2 -top-2 rounded-full bg-dark-pink px-1.5 py-0.5 text-xs text-white"
                            id="cart-count-mobile">
                            {{ \App\Helpers\Cart::count() }}
                        </span>
                    </a>
                    <a href="{{ Route('favorites') }}" class="group relative">
                        <x-icon-store icon="heart"
                            class="h-8 w-8 text-light-blue transition-transform group-hover:scale-110"></x-icon-store>
                        <span
                            class="absolute -right-2 -top-2 rounded-full bg-dark-pink px-1.5 py-0.5 text-xs text-white"
                            id="favorite-count">
                            {{ \App\Helpers\Favorites::count() }}
                        </span>
                    </a>
                    <div class="relative">
                        @if ($user = auth()->user())
                            <button type="button" class="profile-user flex items-center justify-center gap-1">
                                @if (auth()->user()->google_id)
                                    <img src="{{ auth()->user()->google_profile }}" alt="User image"
                                        class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <img src="{{ Storage::url(auth()->user()->profile) }}" alt="User image"
                                        class="h-10 w-10 rounded-full object-cover">
                                @endif
                            </button>
                            <div
                                class="profile-options-user font-secondary absolute right-0 top-10 z-50 hidden w-52 overflow-hidden rounded-lg bg-white text-sm shadow-md">
                                <ul class="flex flex-col p-2 font-medium">
                                    <li class="w-full">
                                        <a href="{{ Route('account.index') }}"
                                            class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-blue-store hover:bg-purple-100">
                                            <x-icon-store icon="user"
                                                class="mr-2 inline-block h-4 w-4 text-current" />
                                            Mi cuenta
                                        </a>
                                    </li>
                                    <li class="w-full">
                                        <a href="{{ Route('orders.index') }}"
                                            class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                            <x-icon-store icon="bag"
                                                class="mr-2 inline-block h-4 w-4 text-current" />
                                            Mis pedidos
                                        </a>
                                    </li>
                                    <li class="mb-2 w-full">
                                        <a href="{{ Route('favorites') }}"
                                            class="group flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-rose-50 hover:text-rose-500">
                                            <x-icon-store icon="heart"
                                                class="mr-2 inline-block h-4 w-4 text-current group-hover:fill-rose-500" />
                                            Favoritos
                                        </a>
                                    </li>
                                    <hr class="border-t border-zinc-200">
                                    @if (auth()->user()->role === 'admin')
                                        <li class="mt-2 w-full">
                                            <a href="{{ Route('admin.index') }}" target="_blank"
                                                class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                <x-icon-store icon="user"
                                                    class="mr-2 inline-block h-4 w-4 text-current" />
                                                Administrador
                                            </a>
                                        </li>
                                    @endif
                                    <li class="@if (auth()->user()->role !== 'admin') mt-2 @endif mb-2 w-full">
                                        <a href="{{ Route('account.index') }}"
                                            class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                            <x-icon-store icon="settings"
                                                class="mr-2 inline-block h-4 w-4 text-current" />
                                            Configuración
                                        </a>
                                    </li>
                                    <hr class="border-t border-zinc-200">
                                    <li class="mt-2 w-full">
                                        <form action="{{ Route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="flex w-full items-center justify-start rounded-xl px-4 py-2 font-dine-r text-zinc-700 hover:bg-purple-50 hover:text-blue-store">
                                                <x-icon-store icon="logout"
                                                    class="mr-2 inline-block h-4 w-4 text-current" />
                                                Cerrar sesión
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ Route('login') }}"
                                class="font-font-din-b text-sm text-blue-store hover:underline">
                                <x-icon-store icon="user" class="h-8 w-8 text-light-blue"></x-icon-store>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Nav -->
            <div class="mt-4 hidden lg:block">
                <nav>
                    <ul class="flex items-center justify-center gap-8 uppercase text-blue-store">
                        <li>
                            <a href="{{ Route('home') }}"
                                class="{{ Route::is('home') ? 'bg-blue-store text-white' : '' }} rounded-xl px-4 py-2 hover:bg-blue-store hover:text-white">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('store') }}"
                                class="{{ Route::is('store') ? 'bg-blue-store text-white' : '' }} rounded-xl px-4 py-2 hover:bg-blue-store hover:text-white">
                                Tienda
                            </a>
                        </li>
                        <li class="group relative">
                            <button type="button"
                                class="order-link {{ Route::is('store.products') ? 'bg-blue-store text-white' : '' }} flex items-center gap-2 rounded-xl px-4 py-2 uppercase hover:bg-blue-store hover:text-white">
                                Ordenar
                                <x-icon-store icon="arrow-down" class="h-4 w-4 text-current"></x-icon-store>
                            </button>
                            <div
                                class="content-nav absolute z-50 hidden animate-fade-down rounded-3xl border border-zinc-50 bg-white p-10 shadow-2xl animate-duration-300 group-hover:block">
                                <div class="flex w-60 gap-8">
                                    <div class="flex flex-1 flex-col gap-4">
                                        @foreach ($categories as $category)
                                            <div class="relative">
                                                <!-- Categoría -->
                                                <a href="{{ Route('store.products', ['filter' => 'category', 'search' => $category->slug]) }}"
                                                    class="text-nowrap link-category flex items-center gap-2 transition-transform hover:scale-110 hover:text-blue-store"
                                                    data-target="#subcategories-{{ $category->id }}">
                                                    <img src="{{ Storage::url($category->image) }}"
                                                        alt="Category image"
                                                        class="h-5 w-5 rounded-full object-cover">
                                                    {{ $category->name }}
                                                </a>
                                                <!-- Subcategorías -->
                                                @if ($category->subcategories->count() > 0)
                                                    <div id="subcategories-{{ $category->id }}"
                                                        class="subcategories absolute left-full top-0 z-50 hidden w-96 animate-fade-right rounded-xl bg-white p-4 shadow-lg animate-duration-300">
                                                        <ul class="columns-1 gap-4 sm:columns-2">
                                                            @foreach ($category->subcategories as $subcategory)
                                                                <li class="break-inside-avoid">
                                                                    <a href="{{ Route('store.products', ['filter' => 'subcategory', 'search' => $subcategory->slug]) }}"
                                                                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm hover:bg-blue-store hover:text-white">
                                                                        <img src="{{ Storage::url($subcategory->image) }}"
                                                                            alt="Category image"
                                                                            class="h-6 w-6 rounded-full object-cover">
                                                                        {{ $subcategory->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{ Route('faq') }}"
                                class="{{ Route::is('faq') ? 'bg-blue-store text-white' : '' }} group flex items-center gap-2 rounded-xl px-4 py-2 hover:bg-blue-store hover:text-white">
                                Preguntas frecuentes
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('about') }}"
                                class="{{ Route::is('about') ? 'bg-blue-store text-white' : '' }} group rounded-xl px-4 py-2 hover:bg-blue-store hover:text-white">
                                Conócenos
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Nav mobile -->
    <div id="nav-mobile"
        class="fixed left-0 top-0 z-40 h-screen w-full -translate-x-full overflow-y-auto bg-white p-4 transition-transform"
        tabindex="-1" aria-labelledby="drawer-label">
        <button type="button" data-drawer-hide="nav-mobile" aria-controls="nav-mobile"
            class="absolute end-2.5 top-2.5 flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-blue-store hover:bg-zinc-200 hover:text-zinc-900">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="mt-8">
            <div class="mt-4 flex items-center justify-center gap-4">
                <img src="{{ $logo ? Storage::url($logo) : asset('img/logo.png') }}" alt="Logo"
                    class="min-h-12 min-w-12 h-12 w-12 sm:h-16 sm:w-16 md:h-20 md:w-20 lg:h-24 lg:w-24">
                <h1 class="font-secondary text-2xl text-blue-store">Miguitas</h1>
            </div>
            <nav class="mt-4">
                <ul class="flex flex-col gap-4 text-blue-store">
                    <li>
                        <a href="{{ Route('home') }}"
                            class="group flex items-center gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('store') }}"
                            class="group flex items-center gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white">
                            Tienda
                        </a>
                    </li>
                    <li>
                        <button type="button"
                            class="btn-nav-accordion flex w-full items-center justify-between gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white"
                            data-target="#options">
                            Ordenar
                            <x-icon-store icon="arrow-down" class="h-4 w-4 fill-current"></x-icon-store>
                        </button>
                        <div class="mt-2 hidden animate-fade-down animate-duration-300" id="options">
                            @foreach ($categories as $category)
                                <button type="button"
                                    href="{{ Route('store.products', ['filter' => 'category', 'search' => $category->slug]) }}"
                                    class="btn-nav-accordion flex w-full items-center justify-between gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white"
                                    data-target="#subcategories-mobile-{{ $category->id }}">
                                    {{ $category->name }}
                                    @if ($category->subcategories->count() > 0)
                                        <x-icon-store icon="arrow-down" class="h-4 w-4 fill-current"></x-icon-store>
                                    @endif
                                </button>
                                @if ($category->subcategories->count() > 0)
                                    <div id="subcategories-mobile-{{ $category->id }}"
                                        class="hidden w-full animate-fade-down gap-4 p-4 animate-duration-300">
                                        <ul class="grid grid-cols-2">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li class="break-inside-avoid">
                                                    <a href="{{ Route('store.products', ['filter' => 'subcategory', 'search' => $subcategory->slug]) }}"
                                                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm hover:bg-blue-store hover:text-white">
                                                        <img src="{{ Storage::url($subcategory->image) }}"
                                                            alt="Category image"
                                                            class="h-6 w-6 rounded-full object-cover">
                                                        {{ $subcategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    <li>
                        <a href=""
                            class="group flex items-center gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white">
                            Preguntas frecuentes
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="group flex items-center gap-2 rounded-xl px-4 py-2 hover:bg-light-blue hover:text-white">
                            Conócenos
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="mt-10 flex items-center justify-center rounded-2xl">
                <ul class="flex justify-center gap-4 px-4 py-2">
                    <li>
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="group">
                            <x-icon-store icon="whatsapp"
                                class="size-8 text-light-blue transition-transform group-hover:scale-110"></x-icon-store>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $location }}" target="_blank"class="group">
                            <x-icon-store icon="location"
                                class="size-8 text-light-blue transition-transform group-hover:scale-110">
                            </x-icon-store>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="nav-mobile-search"
        class="fixed left-0 right-0 top-0 z-40 w-full -translate-y-full overflow-y-auto bg-white p-4 transition-transform"
        tabindex="-1" aria-labelledby="drawer-label">
        <button type="button" data-drawer-hide="nav-mobile-search" aria-controls="nav-mobile-search "
            class="absolute end-2.5 top-2.5 flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-blue-store hover:bg-zinc-200 hover:text-zinc-900">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="mt-8 flex flex-col items-center justify-center gap-y-2">
            <x-input-store id="search-input-mobile" icon="search" placeholder="Buscar producto" name="search" />
            <x-button-store icon="search" text="Buscar" typeButton="primary" id="search-btn-mobile"
                type="button" />
        </div>
    </div>
</header>
