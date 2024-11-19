@extends('layouts.template')
@section('title', 'Miguitas | Mi cuenta')
@section('content')
    <div class="py-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-light-blue">Mi cuenta</h1>
        </div>
        <div class="mx-auto flex w-3/4 flex-col gap-8 py-4 sm:flex-row">
            <div class="flex items-center justify-center">
                @if ($user->google_id)
                    <img src="{{ $user->google_profile }}"
                        class="h-24 w-24 rounded-full object-cover sm:h-28 sm:w-28 md:h-48 md:w-48"
                        alt="Imagen {{ $user->name }}">
                @else
                    <img src="{{ Storage::url($user->profile) }}"
                        class="h-24 w-24 rounded-full object-cover sm:h-28 sm:w-28 md:h-48 md:w-48"
                        alt="Imagen {{ $user->name }}">
                @endif
            </div>
            <div class="text-center sm:text-left">
                <h2 class="text-2xl font-bold text-light-blue">{{ $user->full_name }}</h2>
                <p class="font-font-dine-b text-lg text-zinc-800">{{ $user->email }}</p>
            </div>
        </div>
        <div class="mx-auto mt-4 w-full px-4 md:w-4/5 lg:w-3/4">
            <div class="tabs-header flex justify-start gap-4 overflow-x-auto rounded-t-lg">
                <button
                    class="tab-btn active-tab text-nowrap font-font-din-b px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                    data-name="general" data-target="#tab-general">
                    Datos personales
                </button>
                <button
                    class="tab-btn text-nowrap font-font-din-b px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                    data-name="direction" data-target="#tab-direction">
                    Dirección
                </button>
                <button
                    class="tab-btn text-nowrap font-font-din-b px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                    data-name="orders" data-target="#tab-orders">
                    Pedidos
                </button>
                <button
                    class="tab-btn text-nowrap font-font-din-b px-6 py-2 text-base font-medium text-zinc-700 focus:outline-none sm:text-lg md:text-xl"
                    data-name="pet" data-target="#tab-pet">
                    Mascota
                </button>
            </div>
            <div class="tabs-content">
                <div id="tab-general" class="tab-panel">
                    <div class="mt-4">
                        <form action="{{ route('account.settings-update') }}" method="POST" class="mt-4">
                            @csrf
                            <div class="flex flex-col gap-4 md:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="text" label="Nombre" placeholder="Nombre"
                                        value="{{ $user->name }}" name="name" />
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="text" label="Apellido" placeholder="Apellido"
                                        value="{{ $user->last_name }}" name="last_name" />
                                </div>
                            </div>

                            <div class="mt-4 flex flex-col gap-4 md:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="text" label="Usuario" placeholder="Usuario"
                                        value="{{ $user->username }}" icon="user" name="username" />
                                </div>
                                <div class="flex flex-1 flex-col gap-4 sm:flex-row">
                                    <div class="flex flex-1 flex-col gap-2">
                                        <x-input-store type="text" placeholder="503" label="Código" icon="plus"
                                            name="area_code" value="{{ optional($user->customer)->area_code ?? '' }}" />
                                    </div>
                                    <div class="flex flex-[2] flex-col gap-2">
                                        <x-input-store type="text" placeholder="Teléfono" label="Teléfono" name="phone"
                                            value="{{ optional($user->customer)->phone ?? '' }}" icon="phone" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-4 md:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-select-store label="Género" id="gender" name="gender" :options="['male' => 'Masculino', 'female' => 'Femenino']"
                                        value="{{ optional($user->customer)->gender ?? '' }}"
                                        selected="{{ optional($user->customer)->gender ?? '' }}" />
                                </div>
                                <div class="relative flex flex-1 flex-col gap-2">
                                    <x-input-store type="text" label="Fecha de nacimiento"
                                        placeholder="Fecha de nacimiento"
                                        value="{{ optional($user->customer)->birthdate ?? '' }}" icon="calendar"
                                        id="date-input" autocomplete="off" name="birthdate" readonly />
                                    <div id="calendar"
                                        class="absolute top-20 z-50 mt-2 hidden rounded-md border bg-white p-4 shadow-lg">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center md:justify-start">
                                <x-button-store type="submit" text="Guardar cambios" typeButton="primary"
                                    class="mt-4 w-max font-semibold" />
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tab-direction" class="tab-panel hidden">
                    <div class="mt-4 pb-4">
                        @if (!$user->customer || $addressesCustomer->count() === 0)
                            <div id="container-address-empty">
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
                                    <x-button-store type="button" icon="map-point-add" typeButton="secondary"
                                        text="Agregar dirección" class="add-address" />
                                </div>
                            </div>
                        @else
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-2" id="container-address-list">
                                @foreach ($addressesCustomer as $address)
                                    <div class="relative flex flex-col gap-4 rounded-2xl border border-zinc-200 p-4">
                                        <div>
                                            <div class="flex flex-col gap-2">
                                                <div class="flex items-center gap-2">
                                                    <x-icon-store icon="location" class="h-6 w-6 text-blue-store" />
                                                    <p class="text-lg text-blue-store">
                                                        {{ App\Utils\Addresses::getAddress($address->type) }}
                                                    </p>
                                                </div>
                                                <div class="flex flex-col sm:flex-row">
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-dine-b text-base text-zinc-800">
                                                            Línea 1:
                                                        </p>
                                                        <p class="font-dine-r text-base text-zinc-600">
                                                            {{ $address->address_line_1 }}
                                                        </p>
                                                    </div>
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-dine-b text-base text-zinc-800">
                                                            Línea 2:
                                                        </p>
                                                        <p class="font-dine-r text-base text-zinc-600">
                                                            {{ $address->address_line_2 }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col sm:flex-row">
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-dine-b text-base text-zinc-800">
                                                            Ciudad:
                                                        </p>
                                                        <p class="font-dine-r text-base text-zinc-600">
                                                            {{ $address->city }}</p>
                                                    </div>
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-dine-b text-base text-zinc-800">
                                                            Estado:
                                                        </p>
                                                        <p class="font-dine-r text-base text-zinc-600">
                                                            {{ $address->state }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col sm:flex-row">
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-din-b text-base text-zinc-800">
                                                            País:
                                                        </p>
                                                        <p class="font-din-r text-base text-zinc-600">
                                                            {{ $address->country }}
                                                        </p>
                                                    </div>
                                                    <div class="flex flex-1 items-center gap-2">
                                                        <p class="font-din-b text-base text-zinc-800">
                                                            Código postal:
                                                        </p>
                                                        <p class="font-din-r text-base text-zinc-600">
                                                            {{ $address->zip_code }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absolute right-0 top-0 m-4 flex items-center gap-2">
                                                <a href="{{ Route('account.addresses.edit', $address->slug) }}"
                                                    class="flex items-center justify-center text-blue-store">
                                                    <x-icon-store icon="edit" class="h-6 w-6" />
                                                </a>
                                                <form action="{{ Route('account.addresses.destroy', $address->id) }}"
                                                    method="POST" id="formDeleteAddress-{{ $address->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="buttonDelete group flex items-center justify-center gap-1 text-sm font-medium text-red-500 transition-transform duration-300 ease-in-out hover:scale-105 hover:font-semibold hover:text-red-700"
                                                        data-form="formDeleteAddress-{{ $address->id }}">
                                                        <x-icon-store icon="delete" class="h-6 w-6 text-current" />
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($addressesCustomer->count() < 4)
                                    <button
                                        class="add-address flex h-full items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-zinc-200 p-10 hover:bg-zinc-50">
                                        <x-icon-store icon="map-point-add" class="h-8 w-8 text-blue-store" />
                                        Agregar dirección
                                    </button>
                                @endif
                            </div>
                        @endif
                        <!-- Form add address-->
                        <div class="hidden" id="container-form-add-address">
                            <form action="{{ Route('account.addresses.store') }}" class="flex flex-col gap-4"
                                method="POST">
                                @csrf
                                <div class="flex gap-4">
                                    <div class="flex flex-[2] flex-col gap-2">
                                        <x-input-store type="text" name="address_line_1"
                                            placeholder="Dirección línea 1" icon="location"
                                            label="Dirección (línea 1)" />
                                    </div>
                                    <div class="flex-1">
                                        <x-select-store label="Tipo de dirección" id="type" name="type"
                                            :options="$addresses" required value="{{ old('type') }}"
                                            selected="{{ old('type') }}" />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 sm:flex-row">
                                    <div class="flex flex-[3] flex-col gap-2">
                                        <x-input-store type="text" name="address_line_2"
                                            placeholder="Dirección línea 2" label="Dirección (línea 2)"
                                            icon="location" />
                                    </div>
                                    <div class="flex flex-1 flex-col gap-2">
                                        <x-input-store type="text" name="country" placeholder="País"
                                            label="País" />
                                    </div>
                                </div>
                                <div class="flex w-full flex-col gap-4 sm:flex-row">
                                    <div class="flex flex-1 flex-col gap-2">
                                        <x-input-store type="text" placeholder="Ingresa el estado" label="Estado"
                                            name="state" value="{{ old('state') }}" />
                                    </div>
                                    <div class="flex flex-1 flex-col gap-2">
                                        <x-input-store type="text" placeholder="Ingresa la ciudad" label="Ciudad"
                                            name="city" value="{{ old('city') }}" />
                                    </div>
                                    <div class="flex flex-1 flex-col gap-2">
                                        <x-input-store type="text" placeholder="Ingresa el código postal"
                                            label="Código postal" name="zip_code" required
                                            value="{{ old('zip_code') }}" />
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-center gap-4">
                                    <x-button-store type="button" text="Cancelar" typeButton="secondary"
                                        id="cancel-address" />
                                    <x-button-store type="submit" text="Guardar dirección" typeButton="primary"
                                        icon="save" />
                                </div>
                            </form>
                        </div>
                        <!-- End form add address-->
                    </div>
                </div>
                <div id="tab-orders" class="tab-panel hidden">
                    @if ($orders->count() > 0)
                        <div
                            class="mt-4 flex flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 px-4 shadow-sm">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full table-auto font-dine-r">
                                    <thead>
                                        <tr class="border-b border-zinc-200">
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                N° de pedido
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                N° de seguimiento
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                Total
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                Fecha de compra
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                Estado
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-zinc-200 bg-white">
                                        @foreach ($orders as $order)
                                            <tr class="hover:bg-zinc-50">
                                                <td class="whitespace-nowrap px-4 py-4">
                                                    <span
                                                        class="font-secondary rounded-full bg-purple-100 px-4 py-1 text-sm text-blue-store">
                                                        {{ $order->number_order }}
                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-4">
                                                    <span class="font-secondary font-pluto-r text-sm text-zinc-500">
                                                        {{ $order->tracking_number }}
                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-4">
                                                    <span
                                                        class="rounded-full bg-blue-100 px-4 py-1 font-pluto-r text-xs font-medium text-blue-700">
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
                                                                class="rounded-full bg-yellow-100 px-4 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        @break

                                                        @case('sent')
                                                            <span
                                                                class="rounded-full bg-blue-100 px-4 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        @break

                                                        @case('completed')
                                                            <span
                                                                class="rounded-full bg-green-100 px-4 py-1 font-dine-b text-xs font-medium text-green-700">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        @break

                                                        @case('canceled')
                                                            <span
                                                                class="rounded-full bg-red-100 px-4 py-1 font-dine-b text-xs font-medium text-red-700">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-4 text-sm">
                                                    <div class="flex items-center gap-2">
                                                        <x-button-store icon="eye" type="a"
                                                            href="{{ Route('orders.show', $order->number_order) }}"
                                                            typeButton="secondary" onlyIcon="true" class="w-max" />
                                                        @if ($order->status !== 'completed' && $order->status !== 'canceled' && $order->status !== 'sent')
                                                            <div>
                                                                <form action="{{ Route('order.cancel', $order->id) }}"
                                                                    method="POST"
                                                                    id="formCancelOrder-{{ $order->id }}">
                                                                    @csrf
                                                                    <x-button-store icon="delete" type="button"
                                                                        href="{{ Route('account.tickets.show', $order->id) }}"
                                                                        typeButton="danger" onlyIcon="true"
                                                                        class="buttonDelete w-max"
                                                                        data-tooltip-target="tooltip-cancel-ticket-{{ $order->id }}"
                                                                        data-form="formCancelOrder-{{ $order->id }}" />
                                                                </form>
                                                                <div id="tooltip-cancel-ticket-{{ $order->id }}"
                                                                    role="tooltip"
                                                                    class="tooltip invisible absolute z-10 inline-block rounded-lg bg-red-500 px-3 py-2 font-pluto-r text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                                    Cancelar pedido
                                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="mt-4">
                            <div
                                class="flex items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-zinc-200 p-10">
                                <x-icon-store icon="bag" class="h-8 w-8 text-blue-store" />
                                <div class="flex flex-col items-center gap-1">
                                    <p class="font-pluto-r text-sm text-zinc-500">
                                        No tienes ningún pedido registrado
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="tab-pet" class="tab-panel hidden">
                    <div class="mt-4">
                        <div class="text-left">
                            <h1 class="text-4xl font-bold text-light-blue">Datos de tu mascota</h1>
                        </div>
                        <form action="" class="mt-4 flex flex-col gap-4">
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex flex-[2] flex-col gap-2">
                                    <x-input-store type="text" name="name_pet" placeholder="Nombre" label="Nombre" />
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="number" name="year_pet" placeholder="Edad" label="Edad" />
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-select-store id="gender_pet" :options="['Macho' => 'Macho', 'Hembra' => 'Hembra']" name="gender_pet" label="Género" />
                                </div>
                            </div>
                            <div class="mt-2 flex items-center gap-8">
                                <div class="flex items-center gap-2">
                                    <label for=""
                                        class="text-start text-sm font-medium text-zinc-600 md:text-base">
                                        Gato
                                    </label>
                                    <input type="radio" name="pet" value="cat">
                                </div>
                                <div class="flex items-center gap-2">
                                    <label for=""
                                        class="text-start text-sm font-medium text-zinc-600 md:text-base">
                                        Perro
                                    </label>
                                    <input type="radio" name="pet" value="dog">
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 sm:flex-row">
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="textarea" name="info_pet"
                                        placeholder="Menciona si padece alguna enfermedad" />
                                </div>
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="textarea" name="color_pet"
                                        placeholder="Menciona algún requisito en tu pedido" />
                                </div>
                            </div>
                            <div class="mt-4 flex">
                                <div class="flex flex-1 flex-col gap-2">
                                    <x-input-store type="textarea" name="description_pet"
                                        placeholder="Cuentanos más acerca de tu mascota" />
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <x-button-store text="Guardar cambios" class="w-full sm:w-auto" icon="save"
                                    typeButton="primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                            <h3 class="text-lg font-medium leading-6 text-red-500" id="modal-headline">
                                Eliminar dirección
                            </h3>
                            <div class="mt-2">
                                <p class="font-dine-r text-sm text-gray-500">
                                    ¿Estás seguro de que deseas eliminar esta dirección? Todos los datos relacionados con
                                    esta dirección se eliminarán. Esta acción no se puede deshacer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <x-button-store type="button" text="Cancelar" icon="cancel" class="closeModal w-max text-sm"
                        typeButton="secondary" />
                    <x-button-store type="button" text="Sí, eliminar" icon="delete"
                        class="confirmDelete w-max text-sm" typeButton="danger" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/account.js')
@endpush
