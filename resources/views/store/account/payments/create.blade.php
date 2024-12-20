@extends('layouts.template')
@section('title', 'Miguitas | Facturación')
@section('content')
    <div class="mx-auto flex w-full flex-col-reverse items-start gap-4 px-4 pb-6 md:flex-row lg:w-3/4">
        <div class="flex-[1.5]">
            @if ($paymentMethod->name === 'Tarjeta de crédito')
                <h3 class="text-lg font-bold uppercase text-blue-store sm:text-xl md:text-2xl">
                    Información de pago
                </h3>
                <form id="payment-form" method="POST" action="{{ Route('payment.charge') }}" class="mt-4 flex flex-col gap-2">
                    @csrf <!-- Aquí se agrega el token CSRF -->
                    <div class="flex flex-col gap-2">
                        <x-input-store type="text" label="Nombre del titular de la tarjeta" name="name"
                            placeholder="Ingresa el nombre del titular de la tarjeta" id="name" />
                        <div id="error-message-name" class="font-dine-r text-red-400"></div>
                    </div>

                    <div id="card-element" class="rounded-xl border border-zinc-300 px-4 py-6 font-dinc-r">
                        <!-- Elemento donde se inserta el campo de la tarjeta -->
                    </div>
                    <div id="error-message" class="font-dine-r text-red-400"></div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="pending_payment" id="pending_payment" value="1"
                            class="rounded-md border-2 border-zinc-300 p-2 text-blue-store focus:ring-blue-store">
                        <label class="block font-dine-r text-sm font-medium text-zinc-600">
                            La transacción es realizada por el titular de la tarjeta de crédito/débito
                        </label>
                    </div>
                    <div>
                        <p class="font-dine-r text-sm font-normal text-zinc-600">
                            Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este
                            sitio
                            web y para los fines descritos en nuestra <a
                                href="{{ Route('terms-and-conditions', 'politicas-de-privacidad') }}"
                                class="text-dark-pink underline">política de privacidad</a>.Conoce
                            nuestra política de <a href="{{ Route('terms-and-conditions', 'garantias-y-cambios') }}"
                                class="text-dark-pink underline">garantía y cambios</a>.
                        </p>
                    </div>
                    <div class="mt-4 flex items-center justify-center">
                        <x-button-store type="submit" text="Pagar" typeButton="primary" />
                    </div>
                </form>
            @endif

            @if ($paymentMethod->name === 'Transferencia bancaria')
                <h3 class="text-lg font-bold uppercase text-blue-store sm:text-xl md:text-2xl">
                    Datos del banco
                </h3>
                <form action="{{ Route('bank-transfers.store') }}" method="POST" enctype="multipart/form-data"
                    id="form-file-payment">
                    @csrf
                    <input type="hidden" name="bank_detail_id" value="{{ $bank->id }}">
                    <div class="mt-4 flex flex-col gap-2">
                        <p class="font-dine-r text-sm text-zinc-600">
                            Por favor realiza una transferencia a la siguiente cuenta bancaria:
                        </p>
                        <div class="flex flex-col gap-2 rounded-xl border-2 border-dashed border-zinc-300 p-4">
                            <div class="flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Banco:</h4>
                                <p class="font-dine-r text-zinc-600">{{ $bank->bank_name }}</p>
                            </div>
                            <div class="flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Número de cuenta:</h4>
                                <p class="font-dine-r text-zinc-600">{{ $bank->account_number }}</p>
                            </div>
                            <div class="flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Nombre del titular de la cuenta:</h4>
                                <p class="font-dine-r text-zinc-600">{{ $bank->account_holder }}</p>
                            </div>
                            <div class="flex gap-2">
                                <h4 class="font-dine-r font-semibold text-zinc-800">Tipo de cuenta:</h4>
                                <p class="font-dine-r text-zinc-600">
                                    {{ $bank->account_type === 'savings' ? 'Cuenta de ahorro' : 'Cuenta corriente' }}</p>
                            </div>
                            <p class="font-dine-r text-sm text-zinc-600">
                                Realizada la transferencia, por favor adjunta el comprobante de pago:
                            </p>
                            <div class="flex items-center justify-between gap-2 rounded-full border border-zinc-300 p-1"
                                id="container-file">
                                <div class="flex items-center gap-2">
                                    <label
                                        class="disabled:text-zincaret-red-400 text-nowrap flex w-max cursor-pointer items-center justify-center gap-2 rounded-full border border-zinc-300 bg-white px-4 py-2 font-din-r text-xs text-zinc-600 transition-colors duration-300 hover:bg-zinc-200/50 disabled:cursor-not-allowed disabled:bg-zinc-100/50 sm:text-sm">
                                        <input type="file" name="file" id="proof-payment" class="hidden"
                                            accept=".jpg, .jpeg, .png, .pdf">
                                        Adjuntar archivo
                                    </label>
                                    <p id="file-name" class="font-dine-r text-[10px] text-zinc-600 sm:text-xs">
                                        Formatos permitidos: .jpg, .jpeg, .png,.pdf
                                    </p>
                                </div>
                                <button id="remove-file" class="me-2 hidden">
                                    <x-icon icon="x" class="h-4 w-4 text-red-500" />
                                </button>
                            </div>
                            @error('file')
                                <p class="font-dine-r text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <div class="mt-2 flex items-center justify-center">
                                <x-button-store id="addBankTransfer" text="Enviar comprobante" typeButton="primary"
                                    type="button" />
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="w-full flex-1">
            <div class="rounded-2xl border border-zinc-300 p-4">
                <div class="flex items-center justify-between gap-4">
                    <h3 class="text-lg uppercase text-blue-store sm:text-xl md:text-2xl">Su pedido</h3>
                </div>
                <div class="mt-2">
                    <div class="flex flex-col gap-2">
                        @foreach ($cart->items as $item)
                            <div class="flex gap-2 p-2">
                                <div class="flex flex-1 flex-col items-center justify-center gap-2">
                                    <img src="{{ Storage::url($item->product->main_image) }}" alt="Imagen del producto"
                                        class="h-20 w-20 object-cover">
                                </div>
                                <div class="flex flex-[2] flex-col justify-start">
                                    <h3 class="font-pluto-r text-xs font-bold text-blue-store lg:text-sm">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="font-dine-r text-sm text-zinc-600">
                                        ${{ $item->price }} x {{ $item->quantity }}
                                    </p>
                                    <a href="{{ route('products.details', $item->product->slug) }}" target="_blank"
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
                            <p class="font-dine-r text-sm text-blue-store sm:text-base">Subtotal</p>
                            <p class="font-pluto-r text-sm text-zinc-600 sm:text-base">
                                {{ $cart_totals['total'] }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-4">
                            <p class="font-dine-r text-sm text-blue-store sm:text-base">Impuestos</p>
                            <p class="font-pluto-r text-sm text-zinc-600 sm:text-base">
                                {{ $cart_totals['taxes'] }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-4">
                            <p class="font-dine-r text-sm text-blue-store sm:text-base">Envío</p>
                            <p class="font-pluto-r text-sm text-zinc-600 sm:text-base" id="price-shipping-method">
                                {{ $cart_totals['shipping'] }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-4">
                            <p class="font-dine-r text-base text-blue-store sm:text-lg md:text-xl">Total</p>
                            <p class="text-base text-zinc-600 sm:text-lg md:text-xl" id="checkout-total">
                                {{ $cart_totals['total_with_shipping'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/payment.js')
    <script>
        const key = @json($stripeKey)
    </script>
@endpush
