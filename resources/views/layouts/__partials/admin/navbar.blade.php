<!-- Top header -->
<header>
    <nav class="fixed top-0 z-[60] w-full border-b border-zinc-400 bg-white dark:border-zinc-800 dark:bg-black 2xl:z-30">
        <div class="py-3">
            <div class="flex items-center justify-between">
                <div class="flex w-72 items-center justify-start ps-4 rtl:justify-end">
                    <button type="button" id="btn-sidebar-toggle"
                        class="inline-flex items-center rounded-lg p-2 text-sm text-zinc-500 hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-950 dark:focus:ring-zinc-600 xl:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <x-icon icon="menu" class="h-6 w-6 text-zinc-500 dark:text-zinc-400" />
                    </button>
                    <div class="hidden items-center gap-8 sm:flex">
                        <a href="{{ route('admin.index') }}" class="flex items-center">
                            <img src="{{ asset('img/logo.png') }}" alt="logo" class="me-4 h-8 w-8">
                            <span
                                class="font-league-spartan self-center whitespace-nowrap text-xl font-bold text-primary-600 sm:text-2xl">
                                {{ config('app.name') }}
                            </span>
                        </a>
                        <a href="{{ Route('home') }}" data-tooltip-target="tooltip-default" target="_blank">
                            <x-icon icon="external-link" class="h-6 w-6 text-zinc-700 dark:text-white" />
                        </a>
                        <div id="tooltip-default" role="tooltip"
                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-zinc-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-zinc-900">
                            Visitar sitio
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>
                <div class="flex w-auto items-center justify-end pe-4 md:w-full">
                    <div class="flex items-center gap-2">
                        <!-- Search -->
                        <div class="flex items-center justify-center">
                            <button id="search-toggle"
                                class="relative flex h-10 w-10 items-center justify-center rounded-lg p-3 hover:bg-zinc-100 focus:ring-4 focus:ring-zinc-300 dark:hover:bg-zinc-950 dark:focus:ring-zinc-800">
                                <span class="pointer-events-none absolute dark:pointer-events-auto dark:opacity-100">
                                    <x-icon icon="search" class="h-6 w-6 text-zinc-700 dark:text-white" />
                                </span>
                            </button>
                        </div>
                        <!-- Notifications -->
                        <div class="flex items-center justify-center">
                            <button type="button" data-dropdown-toggle="dropdown-alerts"
                                class="relative inline-flex items-center rounded-lg p-2 text-center text-sm font-medium text-white hover:bg-zinc-100 focus:outline-none focus:ring-4 focus:ring-zinc-300 dark:hover:bg-zinc-950 dark:focus:ring-zinc-800">
                                <x-icon icon="notification" class="h-6 w-6 text-zinc-700 dark:text-white" />
                                <span class="sr-only">Notifications</span>
                                <div
                                    class="absolute -end-1 -top-1 inline-flex h-6 w-6 items-center justify-center rounded-full border-2 border-white bg-primary-600 text-xs font-bold text-white dark:border-black">
                                    {{ $countNotRead }}
                                </div>
                            </button>
                            <div class="z-50 my-4 hidden w-full animate-fade list-none divide-y divide-zinc-200 rounded-lg bg-white text-base shadow dark:divide-zinc-900 dark:bg-zinc-950 sm:w-80"
                                id="dropdown-alerts">
                                <span class="block p-3 text-center text-zinc-700 dark:text-zinc-300">
                                    Notificaciones
                                </span>
                                <ul role="none" class="flex flex-col gap-2 p-2">
                                    @if ($notifications->count() > 0)
                                        @foreach ($notifications as $notification)
                                            <li>
                                                <a href="{{ $notification->url }}"
                                                    class="@if (!$notification->read) bg-zinc-100 dark:bg-zinc-900 @endif relative flex items-start gap-4 rounded-lg px-4 py-3 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white"
                                                    role="menuitem">
                                                    @if (!$notification->read)
                                                        <span
                                                            class="size-2 pulse-ring absolute -left-0 -top-0 inline-flex rounded-full bg-primary-600">
                                                        </span>
                                                    @endif
                                                    <span
                                                        class="flex items-center justify-center rounded-full bg-primary-100 p-2 text-primary-500 dark:bg-primary-950 dark:text-primary-400">
                                                        <x-icon icon="{{ $notification->icon }}"
                                                            class="size-5 min-w-5 min-h-5 max-w-5 max-h-5 text-current" />
                                                    </span>
                                                    <div class="flex flex-col gap-2">
                                                        {{ $notification->message }}
                                                        @if (!$notification->read)
                                                            <span class="text-xs text-blue-500">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <span
                                                class="block p-3 text-center text-sm text-zinc-700 dark:text-zinc-300">
                                                Vacío
                                            </span>
                                        </li>
                                    @endif
                                    <li>
                                        <x-button type="a" href="" typeButton="secondary" text="Ver todas"
                                            icon="eye" size="small" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Theme toggle -->
                        <div
                            class="ms-2 hidden rounded-full border border-zinc-400 px-2 py-1 dark:border-zinc-800 sm:block">
                            <form action="{{ Route('admin.settings.change-theme') }}" method="POST"
                                class="flex items-center justify-center gap-2">
                                @csrf
                                <button type="button" data-theme="light"
                                    class="theme-toggle theme-light flex items-center rounded-full p-2 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                    <x-icon icon="sun" class="h-4 w-4 text-zinc-700 dark:text-white" />
                                </button>
                                <button type="button" data-theme="system"
                                    class="theme-toggle theme-system flex items-center rounded-full p-2 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                    <x-icon icon="device-desktop" class="h-4 w-4 text-zinc-700 dark:text-white" />
                                </button>
                                <button type="button" data-theme="dark"
                                    class="theme-toggle theme-dark flex items-center rounded-full p-2 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                    <x-icon icon="moon" class="h-4 w-4 text-zinc-700 dark:text-white" />
                                </button>
                            </form>
                        </div>
                        <!--Information -->

                        {{--
                        <div class="flex items-center justify-center">
                            <button
                                class="relative flex h-10 w-10 items-center justify-center rounded-lg p-3 hover:bg-zinc-100 focus:ring-4 focus:ring-zinc-300 dark:hover:bg-zinc-950 dark:focus:ring-zinc-800">
                                <span class="pointer-events-none absolute dark:pointer-events-auto dark:opacity-100">
                                    <x-icon icon="information-circle" class="h-6 w-6 text-zinc-700 dark:text-white" />
                                </span>
                            </button>
                        </div>
 --}}

                        <div class="relative">
                            <div class="flex items-center gap-2">
                                <button type="button" class="flex items-center gap-2" id="profile-admin">
                                    <div id="container-profile-photo" class="h-8 w-8">
                                        <img class="h-full w-full rounded-full object-cover"
                                            src="{{ Storage::url(auth()->user()->profile) }}" alt="user photo">
                                    </div>
                                    <span class="hidden flex-col text-sm font-bold text-primary-500 lg:flex">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-zinc-400" />
                                </button>
                            </div>
                            <div class="absolute right-0 top-10 z-50 hidden list-none divide-y divide-zinc-400 overflow-hidden rounded-lg border border-zinc-200 bg-white p-2 text-base shadow dark:divide-zinc-800 dark:border-zinc-900 dark:bg-zinc-950"
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-zinc-900 dark:text-white" role="none">
                                        {{ auth()->user()->username }}
                                    </p>
                                    <p class="truncate text-sm font-bold text-primary-500" role="none">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                                <ul role="none">
                                    <li class="mt-2">
                                        <a href="{{ route('admin.index') }}"
                                            class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white"
                                            role="menuitem">
                                            <x-icon icon="dashboard-square" class="h-4 w-4 text-current" />
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="mb-0 sm:mb-2">
                                        <a href="{{ route('admin.settings.index') }}"
                                            class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900 dark:hover:text-white"
                                            role="menuitem">
                                            <x-icon icon="settings" class="h-4 w-4 text-current" />
                                            Configuración
                                        </a>
                                    </li>
                                    <li class="mb-2 mt-2 block sm:hidden">
                                        <div
                                            class="w-full rounded-lg border border-zinc-400 px-1.5 py-0.5 dark:border-zinc-800">
                                            <form action="{{ Route('admin.settings.change-theme') }}" method="POST"
                                                class="flex items-center justify-center gap-2">
                                                @csrf
                                                <button type="button" data-theme="light"
                                                    class="theme-toggle theme-light flex items-center rounded-lg p-1.5 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                                    <x-icon icon="sun"
                                                        class="h-3.5 w-3.5 text-zinc-700 dark:text-white" />
                                                </button>
                                                <button type="button" data-theme="system"
                                                    class="theme-toggle theme-system flex items-center rounded-lg p-1.5 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                                    <x-icon icon="device-desktop"
                                                        class="h-3.5 w-3.5 text-zinc-700 dark:text-white" />
                                                </button>
                                                <button type="button" data-theme="dark"
                                                    class="theme-toggle theme-dark flex items-center rounded-lg p-1.5 hover:bg-zinc-200 dark:hover:bg-zinc-900">
                                                    <x-icon icon="moon"
                                                        class="h-3.5 w-3.5 text-zinc-700 dark:text-white" />
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="border-t border-zinc-400 pt-2 dark:border-zinc-800">
                                        <x-button type="a" href="{{ Route('home') }}" target="_blank"
                                            typeButton="secondary" text="Ver tienda" icon="external-link"
                                            size="small" class="mb-2 block w-full sm:hidden" />
                                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                                            @csrf
                                            <x-button type="submit" size="small" text="Cerrar sesión"
                                                icon="logout" typeButton="secondary" class="w-full text-center" />
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Sidebar -->
<aside id="sidebar"
    class="fixed left-0 top-0 z-50 mt-2 h-screen w-72 -translate-x-full border-e border-zinc-400 pt-12 transition-transform dark:border-zinc-800 2xl:z-20 2xl:translate-x-0"
    aria-label="Sidebar">
    <div class="mt-2 h-full overflow-y-auto bg-white px-3 py-4 dark:bg-black">
        <ul class="space-y-2 font-medium">
            <li class="{{ \App\Helpers\RouteHelper::isActive(['admin.index']) }} rounded-lg dark:text-white">
                <a href="{{ route('admin.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current">
                    <x-icon icon="dashboard-square"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li
                class="{{ \App\Helpers\RouteHelper::isActive([
                    'admin.categories',
                    'admin.brands',
                    'admin.products.index',
                    'admin.products.create',
                    'admin.products.edit',
                    'admin.products.show',
                ]) }} rounded-lg dark:text-white">
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-ecommerce">
                    <x-icon icon="shopping-cart"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">E-commerce</span>
                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-zinc-400" />
                </button>
                <ul id="dropdown-ecommerce" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            {{ __('messages.categories') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            {{ __('messages.products') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="{{ \App\Helpers\RouteHelper::isActive([
                    'admin.popups.index',
                    'admin.flash-offers.index',
                    'admin.sales-strategies.index',
                    'admin.sales-strategies.coupon.create',
                    'admin.sales-strategies.coupon.edit',
                    'admin.sales-strategies.shipping-methods.index',
                    'admin.reviews.index',
                ]) }} rounded-lg dark:text-white">
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current"
                    aria-controls="dropdown-store" data-collapse-toggle="dropdown-store">
                    <x-icon icon="store"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">
                        {{ __('messages.store') }}
                    </span>
                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-zinc-400" />
                </button>
                <ul id="dropdown-store" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('admin.popups.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            {{ __('messages.popups') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.flash-offers.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            {{ __('messages.flash_offers') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sales-strategies.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            Estrategia de ventas
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route('admin.reviews.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            Administrar reseñas
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ \App\Helpers\RouteHelper::isActive(['admin.orders.index']) }} rounded-lg dark:text-white">
                <a href="{{ Route('admin.orders.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current">
                    <x-icon icon="orders"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap">Pedidos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contact-messages.index') }}"
                    class="group flex items-center rounded-lg p-2 text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-950">
                    <x-icon icon="wechat"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap">
                        Mensajes
                    </span>
                    <span
                        class="ms-3 inline-flex h-3 w-3 items-center justify-center rounded-full bg-blue-700 p-3 text-sm font-medium text-blue-100 dark:bg-primary-600 dark:text-white">
                        {{ $messages->count() }}
                    </span>
                </a>
            </li>
            <li
                class="{{ \App\Helpers\RouteHelper::isActive([
                    'admin.users.index',
                    'admin.users.create',
                    'admin.users.edit',
                    'admin.users.show',
                ]) }} rounded-lg dark:text-white">
                <a href="{{ route('admin.users.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current">
                    <x-icon icon="user"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap">Usuarios</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-base text-zinc-900 transition duration-75 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-950"
                    aria-controls="dropdown-customers" data-collapse-toggle="dropdown-customers">
                    <x-icon icon="user-group"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">Clientes</span>
                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-zinc-400" />
                </button>
                <ul id="dropdown-customers" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('admin.customers.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-950">
                            Clientes registrados
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.support-tickets.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-950">
                            Tickets de soporte
                        </a>
                    </li>
                    {{--        <li>
                        <a href="#"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-950">
                            Suscripciones
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li
                class="{{ \App\Helpers\RouteHelper::isActive([
                    'admin.general-settings.index',
                    'admin.policies.index',
                    'admin.faq.index',
                ]) }} rounded-lg dark:text-white">
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-base transition duration-75 dark:text-current"
                    aria-controls="dropdown-settings" data-collapse-toggle="dropdown-settings">
                    <x-icon icon="settings"
                        class="h-5 w-5 flex-shrink-0 text-zinc-500 transition duration-75 group-hover:text-zinc-900 dark:text-zinc-400 dark:group-hover:text-white" />
                    <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">
                        Configuración
                    </span>
                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-zinc-400" />
                </button>
                <ul id="dropdown-settings" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('admin.general-settings.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            Ajustes generales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.policies.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            Políticas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.faq.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-zinc-900 transition duration-75 dark:text-white">
                            Preguntas frecuentes
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
