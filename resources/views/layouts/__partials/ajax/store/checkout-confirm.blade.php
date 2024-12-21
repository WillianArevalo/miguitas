<div class="flex flex-col gap-2">
    <h3 class="text-lg font-medium uppercase text-blue-store sm:text-xl md:text-2xl">
        Datos de facturación
    </h3>
    <div class="flex flex-col items-start gap-2 sm:flex-row sm:items-center">
        <h5 class="flex items-center gap-1 font-dine-r text-sm text-zinc-800 sm:text-base">
            <x-icon-store icon="user" class="h-5 w-5 text-current" />
            Nombre completo:
        </h5>
        <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
            {{ $user->fullName }}
        </p>
    </div>
    <div class="flex flex-col items-start gap-y-2 sm:flex-row sm:items-center">
        <div class="flex flex-[2] flex-wrap items-center gap-2">
            <h5 class="flex items-center gap-1 font-dine-r text-sm text-zinc-800 sm:text-base">
                <x-icon-store icon="email" class="h-5 w-5 text-current" />
                Correo electrónico:
            </h5>
            <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
                {{ $user->email }}
            </p>
        </div>
        <div class="flex flex-1 flex-wrap items-center gap-2">
            <h5 class="flex items-center gap-1 font-dine-r text-sm text-zinc-800 sm:text-base">
                <x-icon-store icon="phone" class="h-5 w-5 text-current" />
                Teléfono:
            </h5>
            <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
                {{ $user->customer ? $user->customer->phone : '' }}
            </p>
        </div>
    </div>
</div>
<div class="mt-8 flex flex-col gap-2">
    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
        Dirección de envío
    </h3>
    <div class="flex items-center gap-2">
        <h5 class="font-dine-r text-sm text-zinc-800 sm:text-base">
            Dirección:
        </h5>
        <p class="text-wrap font-dine-r text-sm text-zinc-600 sm:text-base">
            {{ $address->address_line_1 }}@if ($address->address_line_2)
                {{ ', ' . $address->address_line_2 }}
            @endif
        </p>
    </div>
    <div class="flex flex-col items-start gap-y-2 sm:flex-row sm:items-center">
        <div class="flex flex-[2] items-center gap-2">
            <h5 class="font-dine-r text-sm text-zinc-800 sm:text-base">
                Departamento:
            </h5>
            <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
                {{ $address->department }}
            </p>
        </div>
        <div class="flex flex-1 items-center gap-2">
            <h5 class="font-dine-r text-sm text-zinc-800 sm:text-base">
                Municipio:
            </h5>
            <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
                {{ $address->municipality }}
            </p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <h5 class="font-dine-r text-sm text-zinc-800 sm:text-base">
            Distrito:
        </h5>
        <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
            {{ $address->district }}
        </p>
    </div>
</div>
<div class="mt-8 flex flex-col gap-2">
    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
        Método de envío
    </h3>
    <div class="flex items-center">
        <p class="font-dine-r text-sm text-zinc-600 sm:text-base">
            {{ $cart->shippingMethod ? $cart->shippingMethod->name : 'No se ha seleccionado un método de envío' }}
        </p>
    </div>
    @if (!$cart->shipping_cost || !$rate)
        <div id="shipping-rate-info">
            <div
                class="mt-4 flex items-start gap-4 rounded-xl border-2 border-dashed border-blue-400 bg-blue-50 p-4 text-blue-500">
                <span>
                    <x-icon-store icon="circle-info" class="size-8 text-blue-500" />
                </span>
                <p class="font-dine-r text-sm">
                    Tu precio de envío se calculará y se te enviará por correo electrónico una vez que tu pedido haya
                    sido procesado.
                    Si no estás de acuerdo con el precio de envío puedes contactarte con nosotros. <a
                        href="{{ route('contact') }}" class="text-blue-500 underline" target="_blank">Contáctanos</a>
                </p>
            </div>
        </div>
    @else
        <div
            class="mt-4 flex flex-col items-start gap-2 rounded-xl border-2 border-dashed border-blue-500 bg-blue-50 p-4 text-blue-500">
            <div class="flex items-center gap-2">
                <h5 class="font-dine-r text-current">
                    Tarifa de envío a:
                </h5>
                <p class="font-dine-r text-current">
                    {{ $rate->department . ', ' . $rate->district }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <h5 class="font-dine-r text-current">
                    Precio:
                </h5>
                <p class="font-dine-r text-current">
                    ${{ $rate->cost }}
                </p>
            </div>
        </div>
    @endif
</div>
