@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div>
        <div class="py-1">
            <h2 class="text-3xl font-bold text-blue-store">
                Devoluciones y cancelaciones
            </h2>
            <div class="mt-4 flex w-full flex-col flex-wrap gap-4 sm:flex-row sm:gap-8">
                <div class="flex w-full flex-[2]">
                    <x-input-store type="search" icon="search" name="search-order" id="search-order"
                        placeholder="Buscar pedido..." />
                </div>
                <div class="font-secondary flex w-full flex-1 flex-col gap-2 sm:w-80">
                    <x-select-store label="" id="status-order" name="status-order" :options="[
                        'mas_reciente' => 'Más reciente',
                        'mas_antiguo' => 'Más antiguo',
                        'ultimo_mes' => 'Último mes',
                        'ultimo_año' => 'Último año',
                    ]"
                        value="{{ old('status-order') }}" selected="{{ old('status-order') }}" />
                </div>
            </div>
        </div>
        <div class="mt-4 flex flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 px-4 shadow-sm">
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto font-dine-r">
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
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 bg-white">
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
                                                class="rounded-full bg-yellow-100 px-4 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @break

                                        @case('sent')
                                            <span
                                                class="rounded-full bg-blue-100 px-4 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @break

                                        @case('completed')
                                            <span
                                                class="rounded-full bg-green-100 px-4 py-1 font-dine-b text-xs font-medium text-green-700">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @break

                                        @case('canceled')
                                            <span
                                                class="rounded-full bg-red-100 px-4 py-1 font-dine-b text-xs font-medium text-red-700">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @break

                                        @default
                                    @endswitch
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <x-button-store icon="eye" type="a"
                                            href="{{ Route('orders.show', $order->number_order) }}" typeButton="secondary"
                                            onlyIcon="true" class="w-max" />
                                        @if ($order->status !== 'completed' && $order->status !== 'canceled' && $order->status !== 'sent')
                                            <div>
                                                <form action="{{ Route('order.cancel', $order->id) }}" method="POST"
                                                    id="formCancelOrder-{{ $order->id }}">
                                                    @csrf
                                                    <x-button-store icon="delete" type="button"
                                                        href="{{ Route('account.tickets.show', $order->id) }}"
                                                        typeButton="danger" onlyIcon="true" class="buttonDelete w-max"
                                                        data-tooltip-target="tooltip-cancel-ticket-{{ $order->id }}"
                                                        data-form="formCancelOrder-{{ $order->id }}" />
                                                </form>
                                                <div id="tooltip-cancel-ticket-{{ $order->id }}" role="tooltip"
                                                    class="tooltip invisible absolute z-10 inline-block rounded-lg bg-red-500 px-3 py-2 font-pluto-r text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                    Cancelar pedido
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
                    <x-button-store type="button" text="Sí, cancelar" icon="delete" class="confirmDelete w-max text-sm"
                        typeButton="danger" />
                </div>
            </div>
        </div>
    </div>
@endsection
