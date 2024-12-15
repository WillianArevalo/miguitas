<div class="flex flex-col gap-2">
    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
        Datos de facturación
    </h3>
    <div class="flex items-center gap-2">
        <h5 class="flex items-center gap-1 font-dine-r text-zinc-800">
            <x-icon-store icon="user" class="h-5 w-5 text-current" />
            Nombre completo:
        </h5>
        <p class="font-dine-r text-zinc-600">
            {{ $user->fullName }}
        </p>
    </div>
    <div class="flex flex-col items-start gap-y-2 sm:flex-row sm:items-center">
        <div class="flex flex-[2] items-center gap-2">
            <h5 class="flex items-center gap-1 font-dine-r text-zinc-800">
                <x-icon-store icon="email" class="h-5 w-5 text-current" />
                Correo electrónico:
            </h5>
            <p class="font-dine-r text-zinc-600">
                {{ $user->email }}
            </p>
        </div>
        <div class="flex flex-1 items-center gap-2">
            <h5 class="flex items-center gap-1 font-dine-r text-zinc-800">
                <x-icon-store icon="phone" class="h-5 w-5 text-current" />
                Teléfono:
            </h5>
            <p class="font-dine-r text-zinc-600">
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
        <h5 class="font-dine-r text-zinc-800">
            Dirección:
        </h5>
        <p class="font-dine-r text-zinc-600">
            {{ $address->address_line_1 }}@if ($address->address_line_2)
                {{ ', ' . $address->address_line_2 }}
            @endif
        </p>
    </div>
    <div class="flex flex-col items-start gap-y-2 sm:flex-row sm:items-center">
        <div class="flex flex-[2] items-center gap-2">
            <h5 class="font-dine-r text-zinc-800">
                Departamento:
            </h5>
            <p class="font-dine-r text-zinc-600">
                {{ $address->department }}
            </p>
        </div>
        <div class="flex flex-1 items-center gap-2">
            <h5 class="font-dine-r text-zinc-800">
                Municipio:
            </h5>
            <p class="font-dine-r text-zinc-600">
                {{ $address->municipality }}
            </p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <h5 class="font-dine-r text-zinc-800">
            Distrito:
        </h5>
        <p class="font-dine-r text-zinc-600">
            {{ $address->district }}
        </p>
    </div>
</div>
<div class="mt-8 flex flex-col gap-2">
    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
        Método de envío
    </h3>
    <div class="flex items-center">
        <p class="font-dine-r text-zinc-600">
            {{ $cart->shippingMethod->name }}
        </p>
    </div>
    <div class="flex items-center">
        <div class="flex items-center gap-2">
            <h5 class="font-dine-r text-zinc-800">
                Precio:
            </h5>
            <p class="font-dine-r text-zinc-600">
                ${{ $cart->shippingMethod->cost }}
            </p>
        </div>
    </div>
</div>
{{-- <div class="mt-8 flex flex-col gap-2">
    <h3 class="text-sm uppercase text-blue-store sm:text-base md:text-lg">
        Método de pago
    </h3>
    <div class="flex items-center">
        @if ($cart->paymentMethod)
            <p class="font-dine-r text-zinc-600">
                {{ $cart->paymentMethod->name }}
            </p>
        @else
            <p
                class="w-full rounded-xl border-2 border-dashed border-zinc-300 p-6 text-center font-dine-r text-zinc-600">
                Sin pagar
            </p>
        @endif
    </div> --}}
</div>
