@extends('layouts.template')
@section('title', 'Miguitas | Facturación')
@section('content')
    <div class="my-10">
        <div class="pe-4 ps-8 lg:pe-0 lg:ps-0">
            <div
                class="schedule mx-auto flex w-full flex-col items-center justify-center rounded-2xl border-[3px] border-blue-store p-4 text-center md:p-6 lg:w-1/2">
                <h2 class="text-xl text-blue-store sm:text-2xl md:text-3xl">
                    Horarios de entrega
                </h2>
                <p class="mt-2 font-pluto-r text-sm text-zinc-500 sm:text-base md:text-lg">
                    A domicilio:
                </p>
                <p class="mt-2 font-pluto-r text-sm text-zinc-500 sm:text-base md:text-lg">
                    Martes a Viernes 10:00 a.m. a 3:00 p.m. y Sábados de 9:00 a.m. a 4:00 p.m.
                </p>
                <p class="mt-2 font-pluto-r text-sm text-zinc-500 sm:text-base md:text-lg">
                    En PAWstry en La Sultana Martes a Viernes 1100 a.m. a 6:00 p.m. y Sábados de 10:00 a.m. a 4:00 p.m.
                </p>
            </div>
        </div>
        <div class="mx-auto mt-20 w-full px-4 sm:px-6 xl:w-4/5">
            <div class="flex flex-col gap-8 lg:flex-row">
                <div class="flex-1 gap-4 lg:flex-[2] xl:flex-[3]">
                    <form action="{{ Route('checkout.update') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="tab-content" id="tab-user-info">
                            <div class="flex flex-col gap-4">
                                <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                    Detalles de facturación
                                </h3>
                                <div class="flex w-full flex-col gap-4">
                                    <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="name" label="Nombre" placeholder="Nombre"
                                                value="{{ $user->name }}" />
                                        </div>
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="last_name" label="Apellido"
                                                placeholder="Apellido" value="{{ $user->last_name }}" />
                                        </div>
                                    </div>
                                    <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                        <div class="flex w-full flex-1 flex-col gap-2 sm:flex-[2]">
                                            <x-input-store type="email" name="email" label="Correo electrónico"
                                                placeholder="example@example.com" icon="email"
                                                value="{{ $user->email }}" />
                                        </div>
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="phone" label="Teléfono"
                                                placeholder="XXXX XXXX" icon="phone"
                                                value="{{ $user->customer ? $user->customer->phone : '' }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                                    <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                        Dirección de envío
                                    </h3>
                                    <x-button-store type="a" typeButton="secondary" size="small"
                                        href="{{ Route('account.index') }}" icon="location" text="Editar dirección" />
                                </div>
                                <div class="mt-4">
                                    <div class="flex flex-col gap-4">
                                        <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                            Metodo de envío
                                        </h3>
                                        @if ($shipping_methods->count() > 0)
                                            @foreach ($shipping_methods as $method)
                                                <div
                                                    class="flex items-center gap-4 rounded-2xl border border-zinc-300 p-4 font-pluto-r text-sm text-zinc-600 shadow-sm sm:text-base">
                                                    <input type="radio" name="shipping_method" id="{{ $method->id }}"
                                                        value="{{ $method->id }}"
                                                        @if ($method->id == $cart->shipping_method_id) checked @endif
                                                        data-url="{{ Route('cart.apply-shipping-method', $method->id) }}">
                                                    {{ $method->name }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex flex-col gap-4">
                                        @if (!$address)
                                            <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                                Agregar dirección de envío
                                            </h3>
                                        @endif
                                        <div class="flex flex-col gap-4 sm:flex-row">
                                            <div class="flex w-full flex-1 flex-col gap-2">
                                                <x-select-store name="state" label="Departamento" id="state"
                                                    value="{{ $address->state ?? '' }}"
                                                    data-url="{{ Route('departamentos.search') }}"
                                                    selected="{{ $address->state ?? '' }}" :options="$departamentos" />
                                            </div>
                                            <div class="w-full flex-1">
                                                <label
                                                    class="mb-2 block text-start text-sm font-medium text-zinc-600 md:text-base">
                                                    Municipio
                                                </label>
                                                <input type="hidden" id="municipio" name="municipio"
                                                    value="{{ $address->city ?? '' }}"
                                                    data-url="{{ Route('distritos') }}">
                                                <div class="relative">
                                                    <div
                                                        class="selected @error('municipio') is-invalid @enderror flex w-full items-center justify-between rounded-xl border-2 border-blue-store bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                                        <span class="itemSelectedMunicipio truncate font-pluto-r"
                                                            id="municipio_selected">
                                                            Seleccione un departamento
                                                        </span>
                                                        <x-icon icon="arrow-down" class="ms-4 h-5 w-5 text-zinc-500" />
                                                    </div>
                                                    <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden h-auto w-full overflow-auto rounded-xl border-2 border-blue-store bg-white p-2 shadow-lg"
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
                                                class="mb-2 block text-start text-sm font-medium text-zinc-600 md:text-base">
                                                Distrito
                                            </label>
                                            <input type="hidden" id="distrito" name="distrito">
                                            <div class="relative">
                                                <div
                                                    class="selected @error('distrito') is-invalid @enderror flex w-full items-center justify-between rounded-xl border-2 border-blue-store bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                                    <span class="itemSelectedDistrito truncate font-pluto-r"
                                                        id="municipio_selected">
                                                        Seleccione un distrito
                                                    </span>
                                                    <x-icon icon="arrow-down" class="ms-4 h-5 w-5 text-zinc-500" />
                                                </div>
                                                <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden h-auto w-full overflow-auto rounded-xl border-2 border-blue-store bg-white p-2 shadow-lg"
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
                                                label="Dirección"
                                                placeholder="Ingresa tu dirección (calle, colonia, N° de casa)"
                                                value="{{ $address->address_line_1 ?? '' }}" />
                                        </div>
                                        <div class="relative">
                                            <div class="flex flex-col gap-2">
                                                <x-input-store type="text" icon="calendar" name="date"
                                                    label="Fecha de entrega" id="date-input" placeholder="XXXX-XX-XX" />
                                            </div>
                                            <div id="calendar"
                                                class="absolute top-20 z-50 mt-2 hidden rounded-2xl border bg-white p-4 shadow-lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flex flex-col gap-4">
                                        <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                            Método de pago
                                        </h3>
                                        <div class="flex flex-col gap-4">
                                            <div
                                                class="flex items-center gap-4 p-4 font-pluto-r text-sm text-zinc-600 shadow-sm sm:text-base">
                                                <input type="radio" name="payment_method" value="0"
                                                    data-url="{{ Route('cart.apply-payment-method', 0) }}" />
                                                Marcar como pago pendiente
                                            </div>
                                            @if ($payment_methods->count() > 0)
                                                @foreach ($payment_methods as $method)
                                                    @if ($method->name === 'Wompi')
                                                        <div>
                                                            <form action="{{ Route('link.wompi') }}" method="POST"
                                                                class="form-paid">
                                                                @csrf
                                                                <input type="hidden" name="number_order" value="">
                                                                <x-button-store icon="credit-card" type="submit"
                                                                    typeButton="primary" onlyIcon="true" class="w-max"
                                                                    class="pay-order" />
                                                            </form>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm data -->
                        <div class="tab-content hidden" id="tab-payment">
                            <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                Confirmar datos
                            </h3>
                            <div class="mt-4" id="confirm-data">
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                        Datos de facturación
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <h5 class="flex items-center gap-1 text-zinc-800">
                                            <x-icon-store icon="user" class="h-5 w-5 text-current" />
                                            Nombre completo:
                                        </h5>
                                        <p class="font-pluto-r text-zinc-600">
                                            {{ $user->fullName }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex flex-[2] items-center gap-2">
                                            <h5 class="flex items-center gap-1 text-zinc-800">
                                                <x-icon-store icon="email" class="h-5 w-5 text-current" />
                                                Correo electrónico:
                                            </h5>
                                            <p class="font-pluto-r text-zinc-600">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                        <div class="flex flex-1 items-center gap-2">
                                            <h5 class="flex items-center gap-1 text-zinc-800">
                                                <x-icon-store icon="phone" class="h-5 w-5 text-current" />
                                                Teléfono:
                                            </h5>
                                            <p class="font-pluto-r text-zinc-600">
                                                {{ $user->customer ? $user->customer->phone : '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 flex flex-col gap-2">
                                    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                        Dirección de envío
                                    </h3>
                                    @if ($address)
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-zinc-800">
                                                Dirección:
                                            </h5>
                                            <p class="font-pluto-r text-zinc-600">
                                                {{ $address->address_line_1 }}
                                            </p>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="flex flex-[2] items-center gap-2">
                                                <h5 class="text-zinc-800">
                                                    Ciudad:
                                                </h5>
                                                <p class="font-pluto-r text-zinc-600">
                                                    {{ $address->city }}
                                                </p>
                                            </div>
                                            <div class="flex flex-1 items-center gap-2">
                                                <h5 class="text-zinc-800">
                                                    Departamento:
                                                </h5>
                                                <p class="font-pluto-r text-zinc-600">
                                                    {{ $address->state }}
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div
                                                class="flex items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-zinc-200 p-10">
                                                <x-icon-store icon="map-point" class="h-8 w-8 text-blue-store" />
                                                <div class="flex flex-col items-center gap-1">
                                                    <p class="font-pluto-r text-sm text-zinc-500">
                                                        No tienes ninguna dirección registrada
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex items-center justify-center">
                                                <x-button-store type="a" href="{{ Route('account.index') }}"
                                                    icon="map-point-add" typeButton="secondary"
                                                    text="Agregar dirección" />
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-8 flex flex-col gap-2">
                                    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                        Método de envío
                                    </h3>
                                    <div class="flex items-center">
                                        <p class="font-pluto-r text-zinc-600">
                                            {{ $cart->shippingMethod->name ?? 'Sin especificar' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-zinc-800">
                                                Precio:
                                            </h5>
                                            <p class="font-pluto-r text-zinc-600">
                                                ${{ $cart->shippingMethod->cost ?? '0.00' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 flex flex-col gap-2">
                                    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
                                        Método de pago
                                    </h3>
                                    <div class="flex items-center">
                                        <p class="font-pluto-r text-zinc-600">
                                            {{ $cart->paymentMethod->name ?? 'Sin especificar' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Confirm data -->
                        <div class="mt-4 flex flex-col items-center justify-between gap-4 pt-4 sm:flex-row">
                            <x-button-store type="a" href="{{ Route('cart') }}" text="Regresar al carrito"
                                typeButton="secondary" icon="cart" size="normal" class="h-max w-full sm:w-max" />
                            <div class="flex flex-wrap items-center justify-end gap-4">
                                <x-button-store type="button" text="Regresar" class="w-full sm:w-max"
                                    typeButton="secondary" id="prev-step" />
                                <x-button-store type="button" text="Continuar"
                                    class="w-full font-bold uppercase sm:w-max" typeButton="primary" id="next-step" />
                            </div>
                        </div>
                    </form>
                    <div class="mt-4 flex w-full items-center justify-center">
                        <form action="{{ Route('orders.store') }}" method="POST" class="w-full">
                            @csrf
                            <x-button-store id="btn-completed-order" class="hidden w-full sm:w-max" type="submit"
                                text="Realizar pedido" typeButton="primary" size="large" />
                        </form>
                    </div>
                </div>

                <!-- Order summary -->
                <div class="flex-[1.5]">
                    <div class="rounded-2xl border-2 border-zinc-200 p-4 shadow-md">
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
                        <div class="mt-4 border-t-2 border-zinc-200 pt-4 shadow-sm">
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
@endsection

@push('scripts')
    @vite('resources/js/store/checkout.js')
    {{--  <script src="https://pagos.wompi.sv/js/wompi.pagos.js"></script> --}}
@endpush
