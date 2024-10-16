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
                <p class="pluto-r mt-2 text-sm text-zinc-500 sm:text-base md:text-lg">
                    A domicilio:
                </p>

                <p class="pluto-r mt-2 text-sm text-zinc-500 sm:text-base md:text-lg">
                    Martes a Viernes 10:00 a.m. a 3:00 p.m. y Sábados de 9:00 a.m. a 4:00 p.m.
                </p>
                <p class="pluto-r mt-2 text-sm text-zinc-500 sm:text-base md:text-lg">
                    En PAWstry en La Sultana Martes a Viernes 1100 a.m. a 6:00 p.m. y Sábados de 10:00 a.m. a 4:00 p.m.
                </p>
            </div>
        </div>
        <div class="mt-20 px-6">
            <div class="flex flex-col gap-8 lg:flex-row">
                <div class="flex-1 lg:flex-[2] xl:flex-[3]">
                    <div class="tab-content" id="tab-user-info">
                        <div class="flex flex-col gap-4">
                            <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                Detalles de facturación
                            </h3>
                            <form action="" class="flex w-full flex-col gap-4">
                                <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                    <div class="flex w-full flex-1 flex-col gap-2">
                                        <x-input-store type="text" name="name" label="Nombre" placeholder="Nombre" />
                                    </div>
                                    <div class="flex w-full flex-1 flex-col gap-2">
                                        <x-input-store type="text" name="last_name" label="Apellido"
                                            placeholder="Apellido" />
                                    </div>
                                </div>
                                <div class="flex w-full flex-col items-center gap-4 sm:flex-row">
                                    <div class="flex w-full flex-1 flex-col gap-2 sm:flex-[2]">
                                        <x-input-store type="email" name="email" label="Correo electrónico"
                                            placeholder="example@example.com" icon="email" />
                                    </div>
                                    <div class="flex w-full flex-1 flex-col gap-2">
                                        <x-input-store type="text" name="last_name" label="Teléfono"
                                            placeholder="+ 503 XXXX XXXX" icon="phone" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-8">
                            <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                Dirección de envío
                            </h3>
                            <div class="mt-4">
                                <div class="flex flex-col gap-4 md:flex-row md:gap-6">
                                    <button
                                        class="shipping-method rounded-2xl border border-zinc-300 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                        Envío a domicilio
                                    </button>
                                    <button
                                        class="shipping-method rounded-2xl border border-zinc-200 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                        RETIRO en PAWstry Shop La Sultana desde 11.00 a.m.
                                    </button>
                                    <button
                                        class="shipping-method rounded-2xl border border-zinc-200 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                        RETIRO en PAWstry Shop La Sultana desde 2.00 pm
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4">
                                <form action="" class="flex flex-col gap-4">
                                    <div class="flex flex-col gap-2">
                                        <x-input-store icon="location" type="text" name="address" label="Dirección"
                                            placeholder="Ingresa tu dirección (calle, colonia, N° de casa)" />
                                    </div>
                                    <div class="flex flex-col gap-4 sm:flex-row">
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="city" label="Ciudad"
                                                placeholder="Ingresa tu ciudad" />
                                        </div>
                                        <div class="flex w-full flex-1 flex-col gap-2">
                                            <x-input-store type="text" name="state" label="Departamento"
                                                placeholder="Ingresa tu departamento" />
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
                                </form>
                            </div>
                            <div class="mt-8">
                                <div class="flex flex-col gap-4">
                                    <h3 class="text-2xl uppercase text-blue-store sm:text-3xl md:text-4xl">
                                        Método de pago
                                    </h3>
                                    <div class="flex flex-col gap-4 md:flex-row">
                                        <button
                                            class="payment-method rounded-2xl border border-zinc-300 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                            Tarjeta de crédito (VISA y MasterCard)
                                        </button>
                                        <button
                                            class="payment-method rounded-2xl border border-zinc-200 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                            Transferencia bancaria
                                        </button>
                                        <button
                                            class="payment-method rounded-2xl border border-zinc-200 p-4 text-sm text-zinc-600 shadow-md sm:text-base">
                                            Código QR Banco Agrícola
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content hidden" id="tab-payment">
                        Confirmar datos
                    </div>


                    <div class="mt-4 flex justify-between gap-4 pt-4">
                        <x-button-store type="a" href="{{ Route('cart') }}" text="Regresar al carrito"
                            typeButton="secondary" icon="cart" size="small" class="h-max" />
                        <div class="flex flex-wrap justify-end gap-4">
                            <x-button-store type="button" text="Regresar" typeButton="secondary" id="prev-step" />
                            <x-button-store type="button" text="Continuar" class="font-bold uppercase"
                                typeButton="primary" id="next-step" />
                        </div>
                    </div>

                </div>
                <div class="flex-1">
                    <div class="rounded-2xl border-2 border-blue-store p-4">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="text-lg uppercase text-blue-store sm:text-xl md:text-2xl">Su pedido</h3>
                            <x-button-store type="a" href="{{ Route('cart') }}" text="Editar carrito"
                                icon="edit" size="small" typeButton="secondary" />
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-col gap-2">
                                @for ($i = 0; $i < 2; $i++)
                                    <div class="flex gap-2">
                                        <div class="flex flex-1 flex-col items-center justify-center gap-2">
                                            <img src="{{ asset('img/image.jpg') }}" alt="Imagen del producto"
                                                class="h-20 w-20 rounded-xl border border-zinc-100 object-cover">
                                        </div>
                                        <div class="flex flex-[2] flex-col justify-start">
                                            <h3 class="pluto-r text-sm font-bold text-blue-store md:text-base lg:text-xl">
                                                Product name
                                            </h3>
                                            <p class="dine-r text-sm text-zinc-600">
                                                $ 100.00
                                            </p>
                                            <a href="{{ route('products.details', 123) }}"
                                                class="dine-r text-xs text-dark-pink">
                                                Mostrar detalles
                                            </a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="mt-4 border-t-2 border-blue-store pt-4">
                            <div class="flex flex-col gap-4">
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base md:text-lg">Subtotal</p>
                                    <p class="text-sm text-zinc-600 sm:text-base md:text-lg">$ 200.00</p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base md:text-lg">Impuestos</p>
                                    <p class="text-sm text-zinc-600 sm:text-base md:text-lg">---</p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base md:text-lg">Envío</p>
                                    <p class="text-sm text-zinc-600 sm:text-base md:text-lg">$ 10.00</p>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <p class="text-sm text-blue-store sm:text-base md:text-lg">Total</p>
                                    <p class="text-sm text-zinc-600 sm:text-base md:text-lg">$ 210.00</p>
                                </div>
                            </div>


                        </div>
                        <div class="mt-20 flex items-center justify-center">
                            <x-button-store type="button" text="Finalizar compra" typeButton="primary"
                                class="w-full font-bold uppercase" />
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
