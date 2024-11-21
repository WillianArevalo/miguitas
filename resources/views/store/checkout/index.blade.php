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
        <div class="mx-auto mt-20 w-full px-4 sm:w-4/5 sm:px-6">
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
                                        <div class="flex flex-col gap-2">
                                            <x-input-store icon="location" type="text" name="address" label="Dirección"
                                                placeholder="Ingresa tu dirección (calle, colonia, N° de casa)"
                                                value="{{ $address->address_line_1 ?? '' }}" />
                                        </div>
                                        <div class="flex flex-col gap-4 sm:flex-row">
                                            <div class="flex w-full flex-1 flex-col gap-2">
                                                <x-input-store type="text" name="city" label="Ciudad"
                                                    placeholder="Ingresa tu ciudad" value="{{ $address->city ?? '' }}" />
                                            </div>
                                            <div class="flex w-full flex-1 flex-col gap-2">
                                                <x-input-store type="text" name="state" label="Departamento"
                                                    placeholder="Ingresa tu departamento"
                                                    value="{{ $address->state ?? '' }}" />
                                            </div>
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
                                            @if ($payment_methods->count() > 0)
                                                @foreach ($payment_methods as $method)
                                                    <div
                                                        class="flex items-center gap-4 rounded-2xl border border-zinc-300 p-4 font-pluto-r text-sm text-zinc-600 shadow-sm sm:text-base">
                                                        <input type="radio" name="payment_method"
                                                            data-url="{{ Route('cart.apply-payment-method', $method->id) }}"
                                                            id="{{ $method->id }}" value="{{ $method->id }}"
                                                            @if ($method->id == $cart->payment_method_id) checked @endif>
                                                        <img src="{{ Storage::url($method->image) }}"
                                                            alt="Imagen del método de pago"
                                                            class="h-10 w-10 object-contain">
                                                        {{ $method->name }}
                                                    </div>
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
                                <x-button-store type="button" text="Regresar" typeButton="secondary" id="prev-step" />
                                <x-button-store type="button" text="Continuar"
                                    class="w-full font-bold uppercase sm:w-max" typeButton="primary" id="next-step" />
                            </div>
                        </div>
                    </form>

                    <div class="mt-8 flex items-center justify-center">
                        <form action="{{ Route('orders.store') }}" method="POST">
                            @csrf
                            <x-button-store id="btn-completed-order" class="hidden" type="submit"
                                text="Finalizar compra" typeButton="primary" size="large" />
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
@endpush
