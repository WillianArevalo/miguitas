 @extends('layouts.__partials.store.template-profile')
 @section('title', 'Miguitas | Mis pagos')
 @section('profile-content')
     <div>
         <div class="py-1">
             <h2 class="text-3xl font-bold text-blue-store">
                 Mis pagos
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
         @if ($payments->count() === 0)
             <div class="my-4 flex h-full items-center justify-center gap-4 rounded-2xl p-20">
                 <x-icon-store icon="alert" class="size-5 text-blue-store" />
                 <div class="flex flex-col items-center gap-1">
                     <p class="font-dine-r text-sm text-zinc-500">
                         No tienes ningún pago realizado
                     </p>
                 </div>
             </div>
         @else
             <div
                 class="mt-4 flex flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 px-4 shadow-sm">
                 <div class="w-full overflow-x-auto">
                     <table class="w-full table-auto font-dine-r">
                         <thead>
                             <tr class="border-b border-zinc-200">
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Orden
                                 </th>
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Monto
                                 </th>
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Fecha
                                 </th>
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Estado
                                 </th>
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Método de pago
                                 </th>
                                 <th scope="col"
                                     class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                     Acciones
                                 </th>
                             </tr>
                         </thead>
                         <tbody class="divide-y divide-zinc-200 bg-white">
                             @foreach ($payments as $payment)
                                 <tr class="hover:bg-zinc-50">
                                     <td class="whitespace-nowrap px-4 py-4">
                                         <span class="font-secondary font-pluto-r text-sm text-zinc-500">
                                             {{ $payment->order->number_order }}
                                         </span>
                                     </td>
                                     <td class="whitespace-nowrap px-4 py-4">
                                         <span
                                             class="rounded-full bg-blue-100 px-4 py-1 font-pluto-r text-xs font-medium text-blue-700">
                                             ${{ $payment->amount }}
                                         </span>
                                     </td>
                                     <td class="whitespace nowrap px-4 py-4 font-pluto-r text-sm text-zinc-500">
                                         {{ $payment->paid_at->format('d/m/Y') }}
                                     </td>
                                     <td class="whitespace-nowrap px-4 py-4 text-sm text-zinc-500">
                                         @switch($payment->status)
                                             @case('pending')
                                                 <span
                                                     class="flex w-max items-center justify-center gap-1 rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                     <x-icon-store icon="clock" class="h-4 w-4 text-yellow-700" />
                                                     Pendiente
                                                 </span>
                                             @break

                                             @case('approved')
                                                 <span
                                                     class="flex w-max items-center justify-center gap-1 rounded-full bg-green-100 px-2 py-1 font-dine-b text-xs font-medium text-green-700">
                                                     <x-icon icon="check-circle" class="h-4 w-4 text-green-700" />
                                                     Aprobado
                                                 </span>
                                             @break

                                             @case('rejected')
                                                 <span
                                                     class="flex w-max items-center justify-center gap-1 rounded-full bg-red-100 px-2 py-1 font-dine-b text-xs font-medium text-red-700">
                                                     <x-icon icon="check-circle" class="h-4 w-4 text-red-700" />
                                                     Rechazado
                                                 </span>
                                             @break
                                         @endswitch
                                     </td>
                                     <td class="whitespace-nowrap px-4 py-4 text-sm">
                                         {{ $payment->paymentMethod->name }}
                                     </td>
                                     <td class="whitespace-nowrap px-4 py-4 text-sm">
                                         <div class="flex items-center gap-2">
                                             @if ($payment->status === 'pending')
                                                 <div>
                                                     <form action="{{ Route('link.wompi') }}" method="POST"
                                                         class="form-paid">
                                                         @csrf
                                                         <input type="hidden" name="number_order"
                                                             value="{{ $order->number_order }}">
                                                         <button type="submit"
                                                             data-tooltip-target="tooltip-pay-wompi-{{ $order->id }}"
                                                             class="flex h-12 items-center justify-center gap-2 rounded-full bg-transparent px-2 text-white">
                                                             <x-icon-store icon="wompi"
                                                                 class="h-full w-14 text-current" />
                                                         </button>
                                                         <div id="tooltip-pay-wompi-{{ $order->id }}" role="tooltip"
                                                             class="tooltip invisible absolute z-10 inline-block rounded-lg bg-[#4865ff] px-3 py-2 font-dine-r text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                             Pagar con Wompi
                                                             <div class="tooltip-arrow" data-popper-arrow></div>
                                                         </div>
                                                     </form>
                                                 </div>
                                             @endif

                                             <x-button-store icon="eye" type="a"
                                                 href="{{ Route('orders.show', $payment->order->number_order) }}"
                                                 typeButton="secondary" onlyIcon="true" class="w-max" />

                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         @endif
     </div>
 @endsection
