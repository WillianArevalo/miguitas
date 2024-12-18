@if ($orders->count() > 0)
    @foreach ($orders as $order)
        <tr class="hover:bg-zinc-50">
            <td class="whitespace-nowrap px-4 py-4">
                <span class="font-secondary w-max rounded-full bg-purple-100 px-2 py-1 text-sm text-blue-store">
                    {{ $order->number_order }}
                </span>
            </td>
            <td class="whitespace-nowrap px-4 py-4">
                <span class="rounded-full bg-blue-100 px-4 py-1 font-pluto-r text-xs font-medium text-blue-700">
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
                            class="flex w-max items-center justify-center gap-1 rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
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
                            <x-icon icon="check-circle" class="h-4 w-4 text-red-700" />
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
                @switch($order->payment_status)
                    @case('pending')
                        <span class="rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                            Pendiente
                        </span>
                    @break

                    @case('refunded')
                        <span class="rounded-full bg-blue-100 px-2 py-1 font-dine-b text-xs font-medium text-blue-700">
                            Reembolsado
                        </span>
                    @break

                    @case('paid')
                        <span class="rounded-full bg-green-100 px-2 py-1 font-dine-b text-xs font-medium text-green-700">
                            Pagado
                        </span>
                    @break

                    @case('failed')
                        <span class="rounded-full bg-red-100 px-2 py-1 font-dine-b text-xs font-medium text-red-700">
                            Fallido
                        </span>
                    @break

                    @default
                        <span class="rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                            Pendiente
                        </span>
                    @break
                @endswitch
            </td>
            <td class="whitespace-nowrap px-4 py-4 text-sm">
                <div class="flex items-center gap-2">
                    <x-button-store icon="eye" type="a"
                        href="{{ Route('orders.show', $order->number_order) }}" typeButton="secondary" onlyIcon="true"
                        class="w-max" />
                    @if (
                        $order->status !== 'completed' &&
                            $order->status !== 'canceled' &&
                            $order->status !== 'sent' &&
                            $order->payment_status !== 'paid')
                        <div>
                            <form action="{{ Route('order.cancel', $order->id) }}" method="POST"
                                id="formCancelOrder-{{ $order->id }}">
                                @csrf
                                <x-button-store icon="delete" type="button"
                                    href="{{ Route('account.tickets.show', $order->id) }}" typeButton="danger"
                                    onlyIcon="true" class="buttonDelete w-max"
                                    data-tooltip-target="tooltip-cancel-ticket-{{ $order->id }}"
                                    data-form="formCancelOrder-{{ $order->id }}" />
                            </form>
                            <div id="tooltip-cancel-ticket-{{ $order->id }}" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-red-500 px-3 py-2 font-dine-r text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                Cancelar pedido
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" class="p-4 text-center">
            No se encontraron resultados
        </td>
    </tr>
@endif
