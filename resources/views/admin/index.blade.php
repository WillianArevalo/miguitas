@extends('layouts.admin-template')
@section('title', 'Admin | Dashboard')
@section('content')
    <div class="border-t border-zinc-400 dark:border-zinc-800">
        <div class="flex items-center gap-2 p-4">
            <x-icon icon="dashboard-square" class="ml-2 h-6 w-6 text-primary-600 md:h-8 md:w-8" />
            <h1 class="text-xl font-bold text-primary-600 sm:text-2xl md:text-3xl">
                Panel de Administración
            </h1>
        </div>
        <!-- Content dashboard -->
        <div class="flex flex-col gap-4 px-4 min-[1170px]:flex-row">
            <div class="flex-1">
                <!-- Cards -->
                <div class="flex gap-4">
                    <div class="h-full flex-1 rounded-xl border border-zinc-400 p-4 dark:border-zinc-800">
                        <div class="flex items-center gap-1">
                            <span
                                class="m-1 rounded-full border border-zinc-400 bg-zinc-100 p-2 dark:border-zinc-800 dark:bg-zinc-950">
                                <x-icon icon="user-plus"
                                    class="dark:text-primary-dark h-4 w-4 text-primary-600 sm:h-6 sm:w-6 md:h-8 md:w-8" />
                            </span>
                            <span
                                class="dark:text-primary-dark text-2xl font-bold text-primary-600 sm:text-3xl md:text-5xl">
                                {{ $customer->count() }}
                            </span>
                        </div>
                        <span
                            class="font-league-spartan text-base font-semibold text-zinc-600 dark:text-zinc-300 sm:text-lg md:text-xl">
                            Nuevos clientes
                        </span>
                    </div>
                    <div class="h-full flex-1 rounded-xl border border-zinc-400 dark:border-zinc-800">
                        <div class="flex flex-col">
                            <div
                                class="flex items-center justify-between rounded-t-xl border-b border-zinc-400 bg-zinc-100 px-4 py-1 dark:border-zinc-800 dark:bg-zinc-950 md:py-2">
                                <h2 class="text-base font-semibold text-zinc-500 dark:text-zinc-300">
                                    Pedidos
                                </h2>
                                <div class="relative">
                                    <button type="button" class="show-options" data-target="#options-orders">
                                        <x-icon icon="more-hortizontal" class="h-6 w-6 text-zinc-500 dark:text-zinc-300" />
                                    </button>
                                    <div class="options absolute right-0 hidden w-40 rounded-lg border border-zinc-400 bg-white p-2 dark:border-zinc-800 dark:bg-zinc-950 lg:left-0"
                                        id="options-orders">
                                        <ul class="flex flex-col text-sm">
                                            <li>
                                                <a href="{{ Route('admin.orders.index') }}"
                                                    class="block w-full rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900">
                                                    Ver todos
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-start gap-2 p-4">
                                <div class="flex items-center gap-1 text-zinc-900 dark:text-zinc-300">
                                    <x-icon icon="truck-loading" class="h-4 w-4 text-current sm:h-6 sm:w-6 md:h-8 md:w-8" />
                                    <span class="text-lg font-bold sm:text-2xl md:text-3xl">
                                        {{ $ordersPending }}
                                    </span>
                                    <span class="text-sm">
                                        Pendientes
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cards -->

                <!-- Chart -->
                <div class="mt-4 h-max flex-1 rounded-xl border border-zinc-400 dark:border-zinc-800">
                    <div class="flex flex-col rounded-t-xl border-b border-zinc-400 pb-4 dark:border-zinc-800">
                        <div class="flex justify-between p-4">
                            <h2 class="text-base font-medium text-zinc-500 dark:text-zinc-300">
                                Resumen de Ventas
                            </h2>
                            {{--   <div class="relative">
                                <button type="button" class="show-options" data-target="#optiones-sales">
                                    <x-icon icon="more-hortizontal" class="h-6 w-6 text-zinc-500 dark:text-zinc-300" />
                                </button>
                                <div class="options absolute right-0 hidden w-40 rounded-lg border border-zinc-400 bg-white p-2 dark:border-zinc-800 dark:bg-zinc-950 lg:left-0"
                                    id="optiones-sales">
                                    <ul class="flex flex-col text-sm">
                                        <li>
                                            <a href="#"
                                                class="flex w-full items-center gap-1 rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900">
                                                <x-icon icon="plus" class="h-4 w-4" />
                                                Nuevo pedido
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="block w-full rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900">
                                                Ver todo
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                        <span class="font-secondary px-4 text-3xl font-bold text-primary-600 sm:text-4xl md:text-5xl">
                            ${{ $salesTotal }}
                        </span>
                    </div>
                    <div class="h-max p-6">
                        <canvas id="salesChart" class="p-4"></canvas>
                    </div>
                </div>
                <!-- End Chart -->
            </div>

            <!-- Users and orders chart -->
            <div class="flex-1">
                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="h-max flex-1 overflow-hidden rounded-xl border border-zinc-400 dark:border-zinc-800">
                        <div class="bg-zinc-100 p-4 dark:bg-zinc-950">
                            <p class="font-semibold text-zinc-600 dark:text-zinc-300">Usuarios</p>
                            <p class="text-xl font-bold text-primary-600 sm:text-2xl md:text-3xl">4.890</p>
                            <p class="text-xs uppercase text-zinc-500 dark:text-zinc-600">
                                En el último mes
                            </p>
                        </div>
                        <div class="flex items-center justify-center border-t border-zinc-400 pt-4 dark:border-zinc-800">
                            <div class="h-60 w-60">
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                        <div
                            class="mt-6 flex flex-col gap-1 border-t border-zinc-400 bg-zinc-100 p-4 dark:border-zinc-800 dark:bg-zinc-950">
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-[#f2d410]"></span>
                                <span class="text-zinc-600 dark:text-zinc-300">
                                    {{ $users->count() }} Usuarios en total
                                </span>
                            </p>
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-[#f6e36b]"></span>
                                <span class="text-zinc-600 dark:text-zinc-300">
                                    {{ $usersActives }} Usuarios activos
                                </span>
                            </p>
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-[#eee7b9]"></span>
                                <span class="text-zinc-600 dark:text-zinc-300">
                                    {{ $usersInactives }} Usuarios inactivos
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="h-max flex-1 overflow-hidden rounded-xl border border-zinc-400 dark:border-zinc-800">
                        <div class="bg-zinc-100 p-4 dark:bg-zinc-950">
                            <p class="font-semibold text-zinc-600 dark:text-zinc-300">Pedidos</p>
                            <p class="text-xl font-bold text-primary-600 sm:text-2xl md:text-3xl">400</p>
                            <p class="text-xs uppercase text-zinc-500 dark:text-zinc-600">
                                Todos los pedidos
                            </p>
                        </div>
                        <div class="flex items-center justify-center border-t border-zinc-400 pt-4 dark:border-zinc-800">
                            <div class="h-60 w-60">
                                <canvas id="orderChart"></canvas>
                            </div>
                        </div>
                        <div
                            class="mt-6 flex flex-col gap-1 border-t border-zinc-400 bg-zinc-100 p-4 dark:border-zinc-800 dark:bg-zinc-950">
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-[#38c172]"></span>
                                <span class="text-[#38c172] dark:text-[#38c172]">
                                    {{ $ordersCompleted }} Completados
                                </span>
                            </p>
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-[#f2d410]"></span>
                                <span class="text-green-500 dark:text-[#f2d410]">
                                    {{ $ordersPending }} Pendientes
                                </span>
                            </p>
                            <p class="flex items-center gap-2 text-xs uppercase">
                                <span class="block h-3 w-8 rounded-full bg-red-500"></span>
                                <span class="text-green-500 dark:text-red-500">
                                    {{ $ordersCanceled }} Cancelados
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Users and orders chart -->
        </div>

        <!-- Orders -->
        <div class="mt-4">
            <div class="m-4 overflow-hidden rounded-lg border border-zinc-400 dark:border-zinc-800">
                <div
                    class="flex flex-col items-center justify-between rounded-t-lg bg-zinc-100 dark:bg-zinc-950 sm:flex-row">
                    <h2 class="p-4 text-lg font-bold uppercase text-primary-600 sm:text-xl md:text-2xl">
                        Últimos pedidos
                    </h2>
                    <div
                        class="flex w-full flex-1 flex-col items-center gap-2 px-4 pb-4 sm:mx-0 sm:w-auto sm:flex-row sm:pb-0">

                        <x-input type="search" placeholder="Buscar" class="w-full" icon="search"
                            id="inputOrdersDashboard" />

                        <x-button text="Ver todos" icon="orders" type="a" href="{{ Route('admin.orders.index') }}"
                            typeButton="primary" class="w-full sm:w-40" />
                    </div>
                </div>
            </div>
            <!-- Table order desktop -->
            <div class="mx-4 mb-4 block">
                <x-table id="tableOrdersDashboard">
                    <x-slot name="thead">
                        <x-tr>
                            <x-th>Cliente</x-th>
                            <x-th>N° orden</x-th>
                            <x-th>Total</x-th>
                            <x-th>Fecha creado</x-th>
                            <x-th>Estado</x-th>
                            <x-th>Pago</x-th>
                            <x-th :last="true">Acciones</x-th>
                        </x-tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @if ($orders->count() > 0)
                            @foreach ($orders as $order)
                                <x-tr section="body">
                                    <x-td>
                                        <div class="flex gap-4">
                                            <div>
                                                <img src="{{ Storage::url($order->customer->user->profile) }}"
                                                    alt="{{ $order->customer->user->name }} profile"
                                                    class="h-10 w-10 rounded-full object-cover">
                                            </div>
                                            <div class="flex flex-col items-start justify-center gap-1 text-sm">
                                                <p>{{ $order->customer->user->name }}</p>
                                                <p>{{ $order->customer->user->email }}</p>
                                            </div>
                                        </div>
                                    </x-td>
                                    <x-td>{{ $order->number_order }}</x-td>
                                    <x-td>${{ $order->total }}</x-td>
                                    <x-td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</x-td>
                                    <x-td>
                                        <x-status-badge status="{{ $order->status }}" />
                                    </x-td>
                                    <x-td>
                                        <x-status-badge status="{{ $order->payment_status }}" />
                                    </x-td>
                                    <x-td>
                                        <div class="items center hidden justify-center gap-2 xl:flex">
                                            <x-button type="a" icon="edit" typeButton="success" onlyIcon="true"
                                                href="{{ route('admin.orders.edit', $order->id) }}" />
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                id="formDeleteOrder-{{ $order->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="button" data-form="formDeleteOrder-{{ $order->id }}"
                                                    class="buttonDelete" onlyIcon="true" icon="delete"
                                                    typeButton="danger" data-modal-target="deleteModal" />
                                            </form>
                                            <x-button type="a" icon="view" typeButton="secondary"
                                                onlyIcon="true" href="{{ route('admin.orders.show', $order->id) }}" />
                                            <x-button type="button" icon="printer" typeButton="secondary"
                                                onlyIcon="true" />
                                        </div>
                                        <div class="relative block w-max xl:hidden">
                                            <button type="button" class="show-options"
                                                data-target="#options-{{ $order->id }}">
                                                <x-icon icon="more-hortizontal"
                                                    class="h-6 w-6 text-zinc-500 dark:text-zinc-300" />
                                            </button>
                                            <div id="options-{{ $order->id }}"
                                                class="options absolute right-0 z-50 hidden w-48 rounded-lg border border-zinc-400 bg-white p-2 dark:border-zinc-800 dark:bg-zinc-950">
                                                <ul class="flex flex-col text-sm">
                                                    <li>
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                            class="flex w-full items-center gap-1 rounded-lg px-2 py-2 text-emerald-700 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:bg-emerald-950 dark:hover:bg-opacity-20">
                                                            <x-icon icon="edit" class="h-4 w-4" />
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                            id="formDeleteOrder-{{ $order->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" href="#"
                                                                class="buttonDelete flex w-full items-center gap-1 rounded-lg px-2 py-2 text-red-700 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-950 dark:hover:bg-opacity-20"
                                                                data-form="formDeleteOrder-{{ $order->id }}"
                                                                data-modal-target="deleteModal">
                                                                <x-icon icon="delete" class="h-4 w-4" />
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="flex w-full items-center gap-1 rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900">
                                                            <x-icon icon="view" class="h-4 w-4" />
                                                            Ver
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="flex w-full items-center gap-1 rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900">
                                                            <x-icon icon="printer" class="h-4 w-4" />
                                                            Imprimir
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="relative">
                                                            <button type="button"
                                                                class="show-options flex w-full items-center gap-1 rounded-lg px-2 py-2 text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-900"
                                                                data-target="#status-change-{{ $order->id }}">
                                                                <x-icon icon="refresh" class="h-4 w-4" />
                                                                Cambiar estado
                                                            </button>
                                                            <div class="options absolute right-full top-0 z-10 hidden w-40 rounded-lg border border-zinc-400 bg-white p-2 dark:border-zinc-800 dark:bg-zinc-950"
                                                                id="status-change-{{ $order->id }}">
                                                                <p class="font-semibold text-zinc-800 dark:text-zinc-300">
                                                                    Cambiar estado
                                                                </p>
                                                                <form
                                                                    action="{{ Route('admin.orders.status', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="status">
                                                                    <ul class="mt-2 flex flex-col text-sm">
                                                                        <li>
                                                                            <button type="button"
                                                                                class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-emerald-700 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:bg-emerald-950 dark:hover:bg-opacity-20"
                                                                                data-status="completed">
                                                                                <x-icon icon="check" class="h-4 w-4" />
                                                                                Completado
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <button type="button"
                                                                                class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-blue-700 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-950 dark:hover:bg-opacity-20"
                                                                                data-status="sent">
                                                                                <x-icon icon="package-import"
                                                                                    class="h-4 w-4" />
                                                                                Enviado
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <button type="button"
                                                                                class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-yellow-700 hover:bg-yellow-100 dark:text-yellow-400 dark:hover:bg-yellow-950 dark:hover:bg-opacity-20"
                                                                                data-status="pending">
                                                                                <x-icon icon="reload" class="h-4 w-4" />
                                                                                Pendiente
                                                                            </button>
                                                                        </li>
                                                                        <li>
                                                                            <button type="button" href="#"
                                                                                class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-red-700 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-950 dark:hover:bg-opacity-20"
                                                                                data-status="canceled">
                                                                                <x-icon icon="x" class="h-4 w-4" />
                                                                                Cancelado
                                                                            </button>
                                                                        </li>
                                                                    </ul>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </x-td>
                                </x-tr>
                            @endforeach
                        @else
                            <x-tr section="body">
                                <x-td class="text-center" :colspan="7">
                                    No se encontraron registros
                                </x-td>
                            </x-tr>
                        @endif
                    </x-slot>
                </x-table>
            </div>
            <!-- End Table order desktop -->

            {{--      <!-- Cards order mobile -->
            <div class="lg:hidden">
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <div class="m-4 rounded-lg border border-zinc-400 dark:border-zinc-800">
                            <div class="items center flex justify-between p-4">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <img src="{{ Storage::url($order->customer->user->profile) }}"
                                            alt="{{ $order->customer->user->name }} profile"
                                            class="h-10 w-10 rounded-full object-cover">
                                    </div>
                                    <div class="flex flex-col items-start justify-center gap-1">
                                        <x-paragraph>{{ $order->customer->user->name }}</x-paragraph>
                                        <x-paragraph>{{ $order->customer->user->email }}</x-paragraph>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-status-badge size="small" status="{{ $order->status }}" />
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4">
                                <div class="flex flex-col gap-2">
                                    <p class="text-sm text-zinc-500 dark:text-zinc-300">N° orden</p>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-300">
                                        {{ $order->number_order }}</p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-sm text-zinc-500 dark:text-zinc-300">Total</p>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-300">${{ $order->total }}
                                    </p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p class="text-sm text-zinc-500 dark:text-zinc-300">Fecha creado</p>
                                    <p
                                        class="rounded-xl bg-blue-100 px-2 py-0.5 text-center text-xs font-semibold text-blue-600 dark:bg-blue-900 dark:bg-opacity-90 dark:text-blue-300">
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between p-4">
                                <div class="items center flex gap-2">
                                    <x-button type="a" icon="edit" typeButton="success" onlyIcon="true"
                                        href="{{ route('admin.orders.edit', $order->id) }}" />
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                        id="formDeleteOrder-{{ $order->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="button" data-form="formDeleteOrder-{{ $order->id }}"
                                            class="buttonDelete" onlyIcon="true" icon="delete" typeButton="danger"
                                            data-modal-target="deleteModal" />
                                    </form>
                                    <x-button type="a" icon="view" typeButton="secondary" onlyIcon="true"
                                        href="{{ route('admin.orders.show', $order->id) }}" />
                                    <x-button type="button" icon="printer" typeButton="secondary" onlyIcon="true" />
                                    <div class="relative">
                                        <x-button type="button" icon="refresh" typeButton="secondary" onlyIcon="true"
                                            class="show-options" data-target="#options-mobile-{{ $order->id }}" />
                                        <div class="options absolute right-0 top-11 z-10 hidden w-40 rounded-lg border border-zinc-400 bg-white p-2 dark:border-zinc-800 dark:bg-zinc-950"
                                            id="options-mobile-{{ $order->id }}">
                                            <p class="font-semibold text-zinc-800 dark:text-zinc-300">
                                                Cambiar estado
                                            </p>
                                            <form action="{{ Route('admin.orders.status', $order->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status">
                                                <ul class="mt-2 flex flex-col text-sm">
                                                    <li>
                                                        <button type="button"
                                                            class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-emerald-700 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:bg-emerald-950 dark:hover:bg-opacity-20"
                                                            data-status="completed">
                                                            <x-icon icon="check" class="h-4 w-4" />
                                                            Completado
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-blue-700 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-950 dark:hover:bg-opacity-20"
                                                            data-status="sent">
                                                            <x-icon icon="package-import" class="h-4 w-4" />
                                                            Enviado
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-yellow-700 hover:bg-yellow-100 dark:text-yellow-400 dark:hover:bg-yellow-950 dark:hover:bg-opacity-20"
                                                            data-status="pending">
                                                            <x-icon icon="reload" class="h-4 w-4" />
                                                            Pendiente
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button" href="#"
                                                            class="change-status-order flex w-full items-center gap-1 rounded-lg px-2 py-2 text-red-700 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-950 dark:hover:bg-opacity-20"
                                                            data-status="canceled">
                                                            <x-icon icon="x" class="h-4 w-4" />
                                                            Cancelado
                                                        </button>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- End Cards order mobile --> --}}
        </div>
        <!-- End Orders -->

        <!-- End Content dashboard -->
    </div>
    <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar la orden?"
        message="No podrás recuperar este registro" action="" />
@endsection

@push('scripts')
    @vite('resources/js/admin/chart.js')
    @vite('resources/js/admin/order-table.js')
    <script>
        const usersCount = @json($users->count());
        const userActives = @json($usersActives);
        const userInactives = @json($usersInactives);

        const ordersCanceledCount = @json($ordersCanceled);
        const ordersCompletedCount = @json($ordersCompleted);
        const ordersPendingCount = @json($ordersPending);

        const sales = @json($sales);
    </script>
@endpush
