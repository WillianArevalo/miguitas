@extends('layouts.template')
@section('title', 'Miguitas | Facturación')
@section('content')
    <div class="mb-10">
        <div class="mx-auto w-full px-4 sm:px-6 xl:w-4/5">
            <div class="flex flex-col-reverse gap-8 lg:flex-row">
                <div class="flex-1 gap-4 lg:flex-[2] xl:flex-[3]">
                    <form action="{{ Route('checkout.update') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="tab-content" id="tab-user-info">
                            <div class="flex flex-col gap-4">
                                <h3 class="text-lg font-bold uppercase text-blue-store sm:text-xl md:text-2xl">
                                    Detalles de facturación
                                </h3>
                                <p class="font-dine-r text-sm font-normal text-zinc-600">
                                    Su información personal y crediticia no será compartida
                                </p>
                                <div class="flex w-full flex-col gap-4">
                                    <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="name" label="Nombre" placeholder="Nombre"
                                                value="{{ $user->name }}" required />
                                        </div>
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="last_name" label="Apellido"
                                                placeholder="Apellido" value="{{ $user->last_name }}" required />
                                        </div>
                                    </div>
                                    <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                        <div class="flex w-full flex-1 flex-col gap-2 sm:flex-[2]">
                                            <x-input-store type="email" name="email" label="Correo electrónico"
                                                placeholder="example@example.com" icon="email" value="{{ $user->email }}"
                                                required />
                                        </div>
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="phone" label="Teléfono"
                                                placeholder="XXXX XXXX" icon="phone"
                                                value="{{ $user->customer ? $user->customer->phone : '' }}" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                                    <h3 class="text-lg font-bold uppercase text-blue-store sm:text-xl md:text-2xl">
                                        Dirección de envío
                                    </h3>
                                    @if ($address)
                                        <x-button-store type="a" typeButton="secondary" size="small"
                                            href="{{ Route('account.addresses.edit', $address->slug) }}" icon="location"
                                            text="Editar dirección" />
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <div class="flex flex-col gap-4">
                                        <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                            Metodo de envío
                                        </h3>
                                        @if ($shipping_methods->count() > 0)
                                            @foreach ($shipping_methods as $method)
                                                <div
                                                    class="flex items-center gap-4 rounded-2xl border border-zinc-300 p-4 font-din-r text-sm text-zinc-600 shadow-sm sm:text-base">
                                                    <input type="radio" class="text-blue-store focus:ring-blue-store"
                                                        name="shipping_method" id="{{ $method->id }}" @
                                                        value="{{ $method->id }}" data-name="{{ $method->name }}"
                                                        @if ($method->id == $cart->shipping_method_id) checked @endif
                                                        data-url="{{ Route('cart.apply-shipping-method', $method->id) }}">
                                                    {{ $method->name }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                @if (!$existingRate)
                                    <div id="shipping-rate-info"
                                        class="mt-4 flex items-start gap-4 rounded-xl border-2 border-dashed border-blue-400 bg-blue-50 p-4 text-blue-500">
                                        <span>
                                            <x-icon-store icon="circle-info" class="size-8 text-blue-500" />
                                        </span>
                                        <p class="font-dine-r text-sm">
                                            No se encontró una tarifa de envío para tu dirección.
                                            Miguitas Pet Treats se reserva el derecho de de modificar la tarifa de envío
                                            y/o realizar el cobro diferencial pertinente. Mas información en nuestras
                                            <a href="{{ Route('terms-and-conditions', 'politicas-de-envio') }}"
                                                class="text-dark-pink underline">políticas de envío</a>.
                                        </p>
                                    </div>
                                @else
                                    <div class="hidden" id="shipping-rate-info">
                                        <div
                                            class="mt-4 flex items-start gap-4 rounded-xl border-2 border-dashed border-blue-400 bg-blue-50 p-4 text-blue-500">
                                            <span>
                                                <x-icon-store icon="circle-info" class="size-8 text-blue-500" />
                                            </span>
                                            <p class="font-dine-r text-sm">
                                                No se encontró una tarifa de envío para tu dirección.
                                                Miguitas Pet Treats se reserva el derecho de de modificar la tarifa de envío
                                                y/o realizar el cobro diferencial pertinente. Mas información en nuestras <a
                                                    href="{{ Route('terms-and-conditions', 'politicas-de-envio') }}"
                                                    class="text-dark-pink underline">políticas de envío</a>.
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <div class="flex flex-col gap-4">
                                        @if (!$address)
                                            <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                                Agregar dirección de envío
                                            </h3>
                                        @endif
                                        <div class="flex flex-col gap-4 sm:flex-row">
                                            <div class="flex w-full flex-1 flex-col gap-2">
                                                <x-select-store name="department" label="Departamento" id="department"
                                                    value="{{ $address->department ?? '' }}"
                                                    data-url="{{ Route('departamentos.search') }}" required
                                                    selected="{{ $address->department ?? '' }}" :options="$departamentos" />
                                            </div>
                                            <div class="w-full flex-1">
                                                <label
                                                    class="mb-2 block text-start font-dine-r text-sm font-medium text-zinc-600 after:ml-0.5 after:text-red-500 after:content-['*'] md:text-base">
                                                    Municipio
                                                </label>
                                                <input type="hidden" id="municipio" name="municipality"
                                                    value="{{ $address->municipality ?? '' }}" required
                                                    data-url="{{ Route('distritos') }}" data-content="select-municipality">
                                                <div class="relative">
                                                    <div
                                                        class="selected select-municipality @error('municipio') is-invalid @enderror flex w-full items-center justify-between rounded-xl border border-zinc-300 bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                                        <span class="itemSelectedMunicipio truncate font-din-r"
                                                            id="municipio_selected">
                                                            {{ $address->municipality ?? 'Seleccione un departamento' }}
                                                        </span>
                                                        <x-icon icon="arrow-down" class="ms-4 h-5 w-5 text-zinc-500" />
                                                    </div>
                                                    <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden h-auto w-full overflow-auto rounded-xl border border-zinc-300 bg-white p-2 shadow-lg"
                                                        id="list-municipios">
                                                        <li class="itemOption cursor-default truncate rounded-xl px-4 py-2.5 font-pluto-r text-sm text-zinc-700 hover:bg-zinc-100 md:text-base"
                                                            data-input="#municipio">
                                                            Selecciona un departamento
                                                        </li>
                                                    </ul>
                                                </div>
                                                @error('municipio')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="w-full flex-1">
                                            <label
                                                class="mb-2 block text-start font-dine-r text-sm font-medium text-zinc-600 after:ml-0.5 after:text-red-500 after:content-['*'] md:text-base">
                                                Distrito
                                            </label>
                                            <input type="hidden" id="distrito" name="district"
                                                value="{{ $address->district ?? '' }}" data-content="select-district"
                                                required>
                                            <div class="relative">
                                                <div
                                                    class="selected select-district @error('distrito') is-invalid @enderror flex w-full items-center justify-between rounded-xl border border-zinc-300 bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                                    <span class="itemSelectedDistrito truncate font-din-r"
                                                        id="municipio_selected">
                                                        {{ $address->district ?? 'Seleccione un distrito' }}
                                                    </span>
                                                    <x-icon icon="arrow-down" class="ms-4 h-5 w-5 text-zinc-500" />
                                                </div>
                                                <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden h-auto w-full overflow-auto rounded-xl border border-zinc-300 bg-white p-2 shadow-lg"
                                                    id="list-distritos">
                                                    <li class="itemOptionDistrito cursor-default truncate rounded-xl px-4 py-2.5 font-pluto-r text-sm text-zinc-700 hover:bg-zinc-100 md:text-base"
                                                        data-input="#municipio">
                                                        Selecciona un municipio
                                                    </li>
                                                </ul>
                                            </div>
                                            @error('distrito')
                                                <span class="text-sm text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col gap-2">
                                            <x-input-store icon="location" type="text" name="address"
                                                label="Dirección" required
                                                placeholder="Ingresa tu dirección (calle, colonia, N° de casa)"
                                                value="{{ $address->address_line_1 ?? '' }}" />
                                        </div>
                                        <div class="relative">
                                            <div class="flex flex-col gap-2">
                                                <x-input-store type="date" icon="calendar" name="estimated_delivery"
                                                    autocomplete="off" label="Fecha de entrega" id="date-input"
                                                    placeholder="XXXX-XX-XX" data-weekend="false" required />
                                            </div>
                                            <div id="calendar"
                                                class="absolute top-20 z-50 mt-2 hidden rounded-2xl border bg-white p-4 shadow-lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm data -->
                        <div class="tab-content hidden" id="tab-payment">
                            <h3 class="text-2xl font-bold uppercase text-blue-store sm:text-3xl md:text-4xl">
                                Confirmar datos
                            </h3>
                            <div class="mt-4 px-4" id="confirm-data">
                            </div>
                        </div>
                        <!-- End Confirm data -->

                        <div class="tab-content hidden" id="tab-payment">
                            <div class="flex flex-col gap-4">
                                <h3 class="text-lg font-bold uppercase text-blue-store sm:text-xl md:text-2xl">
                                    Selecciona un método de pago
                                </h3>
                                <div class="flex flex-col gap-4">
                                    @if (!$existingRate)
                                        <div class="ms-4 flex items-center gap-2" id="checkbox-payment-method">
                                            <input type="checkbox" name="pending_payment" id="pending_payment"
                                                value="1"
                                                class="rounded-md border-2 border-zinc-300 p-2 text-blue-store focus:ring-blue-store">
                                            <label
                                                class="block font-dine-r text-sm font-medium text-zinc-600 md:text-base">
                                                Pagar después de recibir el importe de la tarifa de envío
                                            </label>
                                        </div>
                                    @else
                                        <div class="ms-4 flex items-center gap-2" id="checkbox-payment-method">
                                            <input type="checkbox" name="pending_payment" id="pending_payment"
                                                value="1"
                                                class="rounded-md border-2 border-zinc-300 p-2 text-blue-store focus:ring-blue-store">
                                            <label
                                                class="block font-dine-r text-sm font-medium text-zinc-600 md:text-base">
                                                Pagar después de recibir el importe de la tarifa de envío
                                            </label>
                                        </div>
                                    @endif
                                    @if ($payment_methods->count() > 0)
                                        @foreach ($payment_methods as $method)
                                            @if ($method->name === 'Tarjeta de crédito')
                                                <a href="{{ Route('pay', ['id' => $method->id]) }}"
                                                    class="flex w-full items-center justify-center gap-4 rounded-full bg-[#f0f1eb] p-4 font-dine-r text-base text-blue-950 hover:bg-zinc-200 sm:w-96">
                                                    <x-icon-store icon="visa" class="h-8 w-8 fill-current" />
                                                    <x-icon-store icon="mastercard" class="h-8 w-8 fill-current" />
                                                    Pagar con tarjeta de crédito
                                                </a>
                                            @endif

                                            @if ($method->name === 'Wompi')
                                                <button data-url="{{ Route('cart.apply-payment-method', $method->id) }}"
                                                    class="flex w-full items-center justify-center rounded-full bg-[#4865ff] p-4 font-dine-r text-base text-white sm:w-96">
                                                    <img src="{{ Storage::url($method->image) }}" alt="Wompi"
                                                        class="h-8 w-20 object-cover">
                                                    Pagar con Wompi
                                                </button>
                                            @endif

                                            @if ($method->name === 'Pago en efectivo')
                                                <x-button-store type="button" text="Pagar en efectivo"
                                                    data-url="{{ Route('cart.apply-payment-method', $method->id) }}"
                                                    class="payment-cash w-full font-dine-r text-base sm:w-96"
                                                    typeButton="secondary" size="large" />
                                            @endif

                                            @if ($method->name === 'Transferencia bancaria')
                                                <x-button-store type="a"
                                                    href="{{ Route('pay', ['id' => $method->id]) }}"
                                                    text="Transferencia bancaria" class="w-full sm:w-96"
                                                    typeButton="secondary" size="large" />
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS OF ACTIONS -->
                        <div class="mt-4 flex flex-col items-center justify-between gap-4 pt-4 sm:flex-row">
                            <x-button-store type="a" href="{{ Route('cart') }}" text="Regresar al carrito"
                                typeButton="secondary" icon="cart" size="normal" class="h-max w-full sm:w-max" />
                            <div class="flex w-full flex-wrap items-center justify-end gap-4 sm:w-auto">
                                <x-button-store type="button" text="Regresar" class="w-full sm:w-max"
                                    typeButton="secondary" id="prev-step" />
                                <x-button-store type="button" text="Continuar" class="w-full uppercase sm:w-max"
                                    typeButton="primary" id="next-step" />
                            </div>
                        </div>
                        <!-- END BUTTONS OF ACTIONS -->

                    </form>
                    <div class="mt-4 flex w-full items-center justify-center">
                        <form action="{{ Route('orders.store') }}" method="POST"
                            class="flex w-full items-center justify-center">
                            @csrf
                            <x-button-store id="btn-completed-order" class="hidden w-full sm:w-max" type="submit"
                                text="Realizar pedido" typeButton="primary" size="large" />
                        </form>
                    </div>
                </div>

                <!-- Order summary -->
                <div class="flex-[1.5]">
                    <div class="sticky top-10 rounded-2xl border border-zinc-300 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="text-lg uppercase text-blue-store sm:text-xl md:text-2xl">Su pedido</h3>
                            <x-button-store type="a" href="{{ Route('cart') }}" text="Editar carrito"
                                icon="edit" size="small" typeButton="secondary" />
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-col gap-2">
                                @foreach ($cart->items as $item)
                                    <div class="flex gap-2 rounded-2xl border border-zinc-200 p-2">
                                        <div class="flex flex-1 flex-col items-center justify-center gap-2">
                                            <img src="{{ Storage::url($item->product->main_image) }}"
                                                alt="Imagen del producto" class="h-20 w-20 object-cover">
                                        </div>
                                        <div class="flex flex-[2] flex-col justify-start">
                                            <h3 class="font-pluto-r text-xs font-bold text-blue-store lg:text-sm">
                                                {{ $item->product->name }}
                                            </h3>
                                            <p class="font-dine-r text-sm text-zinc-600">
                                                ${{ $item->price }} x {{ $item->quantity }}
                                            </p>
                                            <a href="{{ route('products.details', $item->product->slug) }}"
                                                target="_blank"
                                                class="mt-1 w-max rounded-2xl bg-rose-50 px-2 py-1 font-dine-r text-xs text-dark-pink hover:bg-rose-100">
                                                Mostrar detalles
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4 border-t border-zinc-300 pt-4">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base">Subtotal</p>
                                    <p class="font-pluto-r text-sm text-zinc-600 sm:text-base">
                                        {{ $cart_totals['total'] }}
                                    </p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base">Impuestos</p>
                                    <p class="font-pluto-r text-sm text-zinc-600 sm:text-base">
                                        {{ $cart_totals['taxes'] }}
                                    </p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base">Envío</p>
                                    <p class="font-pluto-r text-sm text-zinc-600 sm:text-base" id="price-shipping-method">
                                        {{ $cart_totals['shipping'] }}
                                    </p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-base text-blue-store sm:text-lg md:text-xl">Total</p>
                                    <p class="text-base text-zinc-600 sm:text-lg md:text-xl" id="checkout-total">
                                        {{ $cart_totals['total_with_shipping'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Order summary -->
            </div>
        </div>
    </div>

    <!-- Modal confirm -->
    <div class="confirmModalPay fixed inset-0 z-50 hidden items-center justify-center bg-zinc-800 bg-opacity-75 transition-opacity"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div class="inline-block transform animate-jump-in overflow-hidden rounded-xl bg-white text-left align-bottom shadow-xl transition-all animate-duration-300 animate-once sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <x-icon-store icon="circle-check" class="h-6 w-6 text-green-600" />
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                Pago en efectivo
                            </h3>
                            <div class="mt-2">
                                <p class="font-dine-r text-sm text-gray-500">
                                    Asegurate que tus datos de facturación y envío sean correctos antes de continuar.
                                    Verifica que tu dirección de envío, y que tengas un telefono de contacto registrado.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <form action="{{ Route('orders.store') }}" method="POST"
                        class="flex w-full items-center justify-center">
                        @csrf
                        <x-button-store type="submit" text="Aceptar" icon="check" class="confirmDelete w-max text-sm"
                            typeButton="primary" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/checkout.js')
    @vite('resources/js/select-address.js')
@endpush
