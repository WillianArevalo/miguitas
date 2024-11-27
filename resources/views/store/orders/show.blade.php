@extends('layouts.__partials.store.template-profile ')
@section('profile-content')
    <div class="mx-auto my-8 flex w-full flex-col px-4">
        <div class="gap flex flex-col-reverse justify-between gap-4 py-2 sm:flex-row sm:items-center">
            <h2 class="font-pluto-r text-3xl font-bold text-blue-store">
                Detalles del pedido
            </h2>
            <div class="flex items-center justify-end gap-4">
                <div class="w-max">
                    <x-button-store type="a" href="{{ Route('orders.index') }}" typeButton="secondary" text="Regresar"
                        icon="return" />
                </div>
                <div class="hidden lg:block">
                    @if ($order->status != 'canceled')
                        <form action="{{ Route('order.cancel', $order->id) }}" id="formCancelOrder" method="POST">
                            @csrf
                            <x-button-store type="button" data-form="formCancelOrder" class="buttonDelete"
                                typeButton="danger" icon="cancel-circle" text="Cancelar pedido" />
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-2 flex flex-col gap-4 lg:flex-row">
            <div class="flex flex-[2] flex-col gap-4">
                <div
                    class="flex h-max w-full flex-col gap-2 rounded-xl border border-zinc-200 p-4 text-sm shadow sm:flex-row sm:text-base">
                    <div class="flex flex-1 flex-col justify-between gap-2">
                        <h2 class="text-2xl font-bold text-zinc-800">
                            <span class="">
                                <x-icon-store icon="hash" class="inline-block h-5 w-5 text-current" />
                            </span>
                            {{ $order->number_order }}
                        </h2>
                        <h2 class="font-dine-r text-xl font-semibold text-zinc-600">
                            <span>
                                <x-icon-store icon="truck-delivery" class="inline-block h-5 w-5 text-current" />
                            </span>
                            {{ $order->tracking_number }}
                        </h2>
                    </div>
                    <div class="flex flex-1 justify-end">
                        <div>
                            @switch($order->status)
                                @case('pending')
                                    <span
                                        class="rounded-xl bg-yellow-100 px-4 py-2 font-dine-b text-sm font-medium text-yellow-700">
                                        <x-icon-store icon="clock" class="inline-block h-4 w-4 text-current" />
                                        Pedido pendiente
                                    </span>
                                @break

                                @case('completed')
                                    <span class="rounded-xl bg-green-100 px-4 py-1 font-dine-b text-sm font-medium text-green-700">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                @break

                                @case('sent')
                                    <span class="rounded-xl bg-blue-100 px-4 py-2 font-dine-b text-sm font-medium text-blue-700">
                                        <x-icon-store icon="truck-delivery" class="inline-block h-4 w-4 text-current" />
                                        Pedido enviado
                                    </span>
                                @break

                                @case('canceled')
                                    <span class="rounded-xl bg-red-100 px-4 py-2 font-dine-b text-sm font-medium text-red-700">
                                        <x-icon-store icon="cancel" class="inline-block h-4 w-4 text-current" />
                                        Pedido cancelado
                                    </span>
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 text-sm sm:flex-row sm:text-base">
                    <div class="flex-[2] rounded-xl border border-zinc-200 p-4 shadow">
                        <div>
                            <span class="font-dine-r font-bold text-zinc-900">Método de envío:</span>
                            <span class="font-dine-r text-zinc-600">
                                @if ($order->shipping_method)
                                    {{ $order->shipping_method->name }}
                                @else
                                    Sin especificar
                                @endif
                            </span>
                        </div>
                        <div class="mt-2">
                            <span class="font-dine-r font-bold text-zinc-900">Dirección de envío:</span>
                            <span class="font-dine-r text-zinc-600">
                                @if ($shippingAdress)
                                    {{ $shippingAdress }}
                                @else
                                    Sin especificar
                                @endif
                            </span>
                        </div>
                        <div class="mt-2">
                            <span class="font-dine-r font-bold text-zinc-900">Fecha de envío:</span>
                            <span class="font-dine-r text-zinc-600">
                                {{ $order->shipping_date ? $order->shipping_date->toFormattedDateString() : 'Sin especificar' }}
                            </span>
                        </div>

                    </div>
                    <div class="flex-1 rounded-xl border border-zinc-200 p-4 shadow">
                        <div>
                            <span class="font-dine-r font-bold text-zinc-900">Método de pago:</span>
                            <span class="font-dine-r text-zinc-600">
                                @if ($order->payment_method)
                                    {{ $order->payment_method->name }}
                                @endif
                            </span>
                        </div>
                        <div class="mt-2 flex items-center justify-start p-2 sm:justify-center">
                            @if ($order->payment_method)
                                <img src="{{ Storage::url($order->payment_method->image) }}" alt=""
                                    class="h-24 w-40 object-cover">
                            @else
                                <p class="font-dine-r text-zinc-600">
                                    Sin especificar
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Products desktop -->
                <div class="hidden rounded-xl border border-zinc-200 p-4 shadow sm:block">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-zinc-200">
                                <th scope="col"
                                    class="px-4 py-3 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Producto
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-center font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Cantidad
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-center font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Precio
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-center font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-300 bg-white">
                            @foreach ($order->items as $item)
                                <tr class="hover:bg-zinc-50">
                                    <td class="whitespace-nowrap px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="h-14 w-14 flex-shrink-0 border border-zinc-100">
                                                <img class="h-full w-full rounded-lg"
                                                    src="{{ Storage::url($item->product->main_image) }}"
                                                    alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-din-r text-sm font-medium text-zinc-600">
                                                    {{ $item->product->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        <div class="font-din-r text-sm text-zinc-600">
                                            {{ $item->quantity }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-center">
                                        <div class="font-din-r text-sm text-zinc-600">
                                            ${{ $item->price }}
                                        </div>
                                    </td>
                                    <td class="whitespace nowrap px-4 py-4 text-sm text-zinc-500">
                                        <div class="text-center font-din-r text-sm text-zinc-600">
                                            ${{ number_format($item->price * $item->quantity, 2) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Products desktop -->

                <!-- Products mobile -->
                <div class="flex flex-col gap-4 rounded-xl border border-zinc-200 p-4 shadow sm:hidden">
                    <h3 class="text-base font-bold text-zinc-800">
                        Productos
                    </h3>
                    @foreach ($order->items as $item)
                        <div class="flex gap-4">
                            <div class="h-24 w-24 flex-shrink-0 rounded-lg border border-zinc-100">
                                <img class="h-full w-full rounded-lg" src="{{ Storage::url($item->product->main_image) }}"
                                    alt="{{ $item->product->name }}">
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <div>
                                    <div class="text-secondary font-dine-b text-base font-bold">
                                        {{ $item->product->name }}
                                    </div>
                                    <div class="font-dine-r text-sm text-zinc-600">
                                        Cantidad: {{ $item->quantity }}
                                    </div>
                                </div>
                                <div class="font-dine-r text-base font-bold text-primary">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Products mobile -->
            </div>

            <div class="flex flex-1 flex-col-reverse text-sm sm:text-base lg:block">
                <div class="mb-4 mt-4 overflow-hidden rounded-xl border border-zinc-200 shadow lg:mb-0 lg:mt-0">
                    <div class="flex flex-col gap-4 p-4">
                        <h3 class="text-xl font-bold text-zinc-800">
                            Resumen
                        </h3>
                        <div class="flex justify-between">
                            <div class="font-dine-r text-zinc-800">
                                Subtotal de artículos
                            </div>
                            <div class="font-dine-r text-zinc-600">
                                ${{ $order->subtotal }}
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="font-dine-r text-zinc-800">
                                Descuento
                            </div>
                            <div class="font-dine-r text-red-500">
                                -${{ $order->discount }}
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="font-dine-r text-zinc-800">
                                Impuesto
                            </div>
                            <div class="font-dine-r text-zinc-600">
                                ${{ $order->tax }}
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="font-dine-r text-zinc-800">
                                Monto de envío
                            </div>
                            <div class="font-dine-r text-zinc-600">
                                ${{ $order->shipping_method->cost }}
                            </div>
                        </div>

                        <div class="flex justify-between border-t border-dashed border-zinc-200 pt-4 font-semibold">
                            <div class="font-dine-b text-xl uppercase text-zinc-800">
                                Total
                            </div>
                            <div class="font-dine-b text-xl text-zinc-800">
                                ${{ $order->total }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 rounded-xl border border-zinc-200 p-4 shadow">
                    <span class="font-bold text-zinc-800">Fecha de pedido:</span>
                    <p class="font-dine-r text-zinc-600">
                        {{ $order->created_at->toFormattedDateString() }}
                    </p>
                </div>

                <div class="mt-4 rounded-xl border border-zinc-200 p-4 shadow">
                    <span class="font-bold text-zinc-800">
                        Comentarios:
                    </span>
                    @if ($order->customer_notes)
                        <div class="mt-2">
                            <p class="font-dine-r text-sm text-zinc-600">
                                Tu comentario:
                            </p>
                            <p class="font-dine-r text-zinc-600">
                                {{ $order->customer_notes }}
                            </p>
                            <form action="{{ Route('order.remove-comment', $order->id) }}" method="POST">
                                @csrf
                                <x-button-store type="submit" text="Eliminar" icon="delete" typeButton="danger"
                                    class="mt-2" size="small" />
                            </form>
                        </div>
                    @else
                        <div>
                            <p class="py-2 font-dine-r text-zinc-600">
                                Sin comentarios
                            </p>
                            <div>
                                <x-button-store type="button" text="Agregar comentario"
                                    class="btn-add-comment w-max text-sm" typeButton="secondary" size="small"
                                    icon="plus" />
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    @if ($order->status === 'canceled')
                        <div
                            class="mt-0 flex items-center justify-between rounded-xl border border-red-200 bg-red-50 p-4 text-red-500 shadow-md lg:mt-4">
                            <div>
                                <span class="font-bold">Cancelado el:</span>
                                <p>
                                    {{ $order->cancelled_at->toFormattedDateString() }}
                                </p>
                            </div>
                            <span>
                                <x-icon-store icon="cancel-circle" class="h-8 w-8 text-red-600" />
                            </span>
                        </div>
                    @endif

                    @if ($order->status === 'sent')
                        <div
                            class="mt-0 flex items-center justify-between rounded-xl border border-blue-200 bg-blue-50 p-4 text-blue-500 shadow-md lg:mt-4">
                            <div>
                                <span class="font-bold">Enviado el:</span>
                                <p>
                                    {{ $order->shipped_at->toFormattedDateString() }}
                                </p>
                            </div>
                            <span>
                                <x-icon-store icon="checkmark-circle" class="h-8 w-8 text-blue-600" />
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-8 block lg:hidden">
                @if ($order->status != 'canceled')
                    <form action="{{ Route('order.cancel', $order->id) }}" id="formCancelOrder-02" method="POST">
                        <x-button-store type="button" data-form="formCancelOrder-02" class="buttonDelete w-full"
                            typeButton="danger" icon="cancel-circle" text="Cancelar pedido" />
                    </form>
                @endif
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
                                <h3 class="text-lg font-medium leading-6 text-zinc-800" id="modal-headline">
                                    Cancelar pedido
                                </h3>
                                <div class="mt-2">
                                    <p class="font-font-dine-r text-sm text-zinc-600">
                                        ¿Estás seguro de que deseas cancelar el pedido? Esta acción no se puede deshacer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                        <x-button-store type="button" text="Cerrar" class="closeModal w-max text-sm"
                            typeButton="secondary" />
                        <x-button-store type="button" text="Si, cancelar pedido" icon="cancel-circle"
                            class="confirmDelete w-max text-sm" typeButton="danger" />
                    </div>
                </div>
            </div>
        </div>

        <div class="addComment fixed inset-0 z-50 hidden items-center justify-center bg-zinc-800 bg-opacity-75 transition-opacity"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div class="inline-block transform animate-jump-in overflow-hidden rounded-xl bg-white p-6 text-left align-bottom shadow-xl transition-all animate-duration-300 animate-once sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form action="{{ Route('order.add-comment', $order->id) }}" method="POST">
                        @csrf
                        <div class="bg-white text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                Agregar comentario
                            </h3>
                            <div class="mt-4 w-96">
                                <x-input-store type="textarea" name="customer_notes" id="customer_notes"
                                    placeholder="Escribe un comentario" class="w-full" />
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end gap-4 bg-gray-50">
                            <x-button-store type="button" text="Cancelar" icon="cancel"
                                class="closeModalAddComment w-max text-sm" typeButton="secondary" />
                            <x-button-store type="submit" text="Agregar comentario" icon="comment-add"
                                class="confirmAddComment w-max text-sm" typeButton="primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/order.js')
@endpush
