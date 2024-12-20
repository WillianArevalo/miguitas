@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div>
        <div class="py-1">
            <h2 class="text-xl font-bold text-blue-store sm:text-2xl md:text-3xl">
                Devoluciones y cancelaciones
            </h2>
            <div class="mt-4">
                <div class="flex w-full flex-col flex-wrap gap-4 sm:flex-row sm:gap-8">
                    <div class="flex w-full flex-[2]">
                        <x-input-store type="search" icon="search" name="search-order" id="inputSearchOrders"
                            placeholder="Buscar pedido..." value="{{ old('search-order') }}" />
                    </div>
                    <div class="font-secondary flex w-full flex-1 flex-col gap-2 sm:w-80">
                        <x-select-store label="" id="filter-status-orders" name="order" :options="[
                            'Cancelado' => 'Cancelado',
                            'Reembolsado' => 'Reembolsado',
                        ]"
                            tex="Seleccionar estado" />
                    </div>
                </div>
            </div>
        </div>
        @if ($orders->count() === 0)
            <div class="my-4 flex h-full items-center justify-center gap-4 rounded-2xl p-20">
                <x-icon-store icon="alert" class="size-5 text-blue-store" />
                <div class="flex flex-col items-center gap-1">
                    <p class="font-dine-r text-sm text-zinc-500">
                        No tienes ningún pedido registrado
                    </p>
                </div>
            </div>
        @else
            <div
                class="my-4 hidden flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 px-4 shadow-sm lg:flex">
                <div class="w-full overflow-x-auto">
                    <table class="w-full table-auto font-dine-r" id="tableOrders">
                        <thead>
                            <tr class="border-b border-zinc-200">
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    N° de pedido
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    N° de seguimiento
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Total
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Fecha de compra
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Fecha de cancelación
                                </th>
                                <th scope="col"
                                    class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 bg-white" id="orders-list">
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-zinc-50">
                                        <td class="whitespace-nowrap px-4 py-4">
                                            <span
                                                class="font-secondary rounded-full bg-purple-100 px-4 py-1 text-sm text-blue-store">
                                                {{ $order->number_order }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4">
                                            <span class="font-secondary font-pluto-r text-sm text-zinc-500">
                                                {{ $order->tracking_number }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4">
                                            <span
                                                class="rounded-full bg-blue-100 px-4 py-1 font-pluto-r text-xs font-medium text-blue-700">
                                                ${{ $order->total }}
                                            </span>
                                        </td>
                                        <td class="whitespace nowrap px-4 py-4 font-pluto-r text-sm text-zinc-500">
                                            {{ $order->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-zinc-500">
                                            @switch($order->status)
                                                @case('pending')
                                                    <span
                                                        class="flex items-center justify-center gap-1 rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                        <x-icon-store icon="clock" class="h-4 w-4 text-yellow-700" />
                                                        Pendiente
                                                    </span>
                                                @break

                                                @case('sent')
                                                    <span
                                                        class="flex w-max items-center justify-center gap-1 rounded-full bg-blue-100 px-2 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                        <x-icon icon="truck" class="h-4 w-4 text-blue-700" />
                                                        Enviado
                                                    </span>
                                                @break

                                                @case('completed')
                                                    <span
                                                        class="flex w-max items-center justify-center gap-1 rounded-full bg-green-100 px-2 py-1 font-dine-b text-xs font-medium text-green-700">
                                                        <x-icon icon="check-circle" class="h-4 w-4 text-green-700" />
                                                        Completado
                                                    </span>
                                                @break

                                                @case('canceled')
                                                    <span
                                                        class="flex w-max items-center justify-center gap-1 rounded-full bg-red-100 px-2 py-1 font-dine-b text-xs font-medium text-red-700">
                                                        <x-icon icon="circle-x" class="h-4 w-4 text-red-700" />
                                                        Cancelado
                                                    </span>
                                                @break

                                                @case('pending')
                                                    <span
                                                        class="flex w-max items-center justify-center gap-1 rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                        <x-icon-store icon="clock" class="h-4 w-4 text-yellow-700" />
                                                        Pendiente
                                                    </span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm">
                                            <span class="font-pluto-r text-sm text-zinc-500">
                                                {{ $order->cancelled_at ? $order->cancelled_at->toFormattedDateString() : 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm">

                                            <div class="flex items-center gap-2">
                                                <x-button-store icon="eye" type="a"
                                                    href="{{ Route('orders.show', $order->number_order) }}"
                                                    typeButton="secondary" onlyIcon="true" class="w-max" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="p-4 text-center">
                                        No se encontraron resultados
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cards mobile -->
            <div class="my-4 flex flex-col gap-4 lg:hidden" id="order-list-mobile">
                @foreach ($orders as $order)
                    <x-order-card :order="$order" />
                @endforeach
            </div>
        @endif
    </div>

    <div class="deleteModal fixed inset-0 z-50 hidden items-center justify-center bg-zinc-800 bg-opacity-75 transition-opacity"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div class="inline-block transform animate-jump-in overflow-hidden rounded-xl bg-white text-left align-bottom shadow-xl transition-all animate-duration-300 animate-once sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <x-icon-store icon="alert" class="h-6 w-6 text-red-600" />
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-red-500" id="modal-headline">
                                Cancelar pedido
                            </h3>
                            <div class="mt-2">
                                <p class="font-dine-r text-sm text-gray-500">
                                    ¿Estás seguro de que deseas cancelar este pedido? Esta acción no se puede deshacer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <x-button-store type="button" text="Cerrar" icon="cancel" class="closeModal w-max text-sm"
                        typeButton="secondary" />
                    <x-button-store type="button" text="Sí, cancelar" icon="delete"
                        class="confirmDelete w-max text-sm" typeButton="danger" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/order.js')
    @vite('resources/js/admin/order-table.js')
@endpush
