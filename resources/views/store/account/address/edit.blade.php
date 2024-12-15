@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="mx-auto flex w-full flex-col px-4">
        <div class="py-2">
            <h2 class="text-3xl font-bold text-blue-store">
                Editar dirección
            </h2>
        </div>
        <div>
            <form action="{{ Route('account.addresses.update', $address->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-4">
                    <div class="flex w-full flex-col gap-4 sm:flex-row">
                        <input type="hidden" name="country" value="El Salvador">
                        <div class="flex flex-[2] flex-col gap-2">
                            <x-select-store label="Tipo de dirección" id="type" name="type" :options="$addresses"
                                required value="{{ $address->type }}" selected="{{ $address->type }}" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 sm:flex-row">
                        <div class="flex w-full flex-1 flex-col gap-2">
                            <x-select-store name="department" label="Departamento" id="department"
                                value="{{ $address->department ?? '' }}" data-url="{{ Route('departamentos.search') }}"
                                selected="{{ $address->department ?? '' }}" :options="$departamentos" />
                        </div>
                        <div class="w-full flex-1">
                            <label class="mb-2 block text-start text-sm font-medium text-zinc-600 md:text-base">
                                Municipio
                            </label>
                            <input type="hidden" id="municipio" name="municipality"
                                value="{{ $address->municipality ?? '' }}" data-url="{{ Route('distritos') }}">
                            <div class="relative">
                                <div
                                    class="selected @error('municipio') is-invalid @enderror flex w-full items-center justify-between rounded-xl border-2 border-blue-store bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                    <span class="itemSelectedMunicipio truncate font-pluto-r" id="municipio_selected">
                                        {{ $address->municipality ?? 'Seleccione un departamento' }}
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
                    <div class="flex gap-4">
                        <div class="flex-[2]">
                            <label class="mb-2 block text-start text-sm font-medium text-zinc-600 md:text-base">
                                Distrito
                            </label>
                            <input type="hidden" id="distrito" name="district">
                            <div class="relative">
                                <div
                                    class="selected @error('distrito') is-invalid @enderror flex w-full items-center justify-between rounded-xl border-2 border-blue-store bg-white px-6 py-3 text-sm text-zinc-700 md:text-base">
                                    <span class="itemSelectedDistrito truncate font-pluto-r" id="municipio_selected">
                                        {{ $address->district ?? 'Seleccione un distrito' }}
                                    </span>
                                    <x-icon icon="arrow-down" class="ms-4 h-5 w-5 text-zinc-500" />
                                </div>
                                <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden h-auto w-full overflow-auto rounded-xl border-2 border-blue-store bg-white p-2 shadow-lg"
                                    id="list-distritos">
                                    <li class="itemOptionDistrito cursor-default truncate rounded-xl px-4 py-2.5 font-pluto-r text-sm text-zinc-700 hover:bg-zinc-100 md:text-base"
                                        data-input="#state">
                                        Selecciona un municipio
                                    </li>
                                </ul>
                            </div>
                            @error('distrito')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" placeholder="Ingresa el código postal" label="Código postal"
                                name="zip_code" required value="{{ $address->zip_code }}" />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" name="address_line_1" label="Dirección (línea 1)"
                                value="{{ $address->address_line_1 }}" required />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" name="address_line_2" label="Dirección (línea 2)"
                                value="{{ $address->address_line_2 ?? old('address_line_2') }}" />
                        </div>
                    </div>
                </div>
                <div class="my-4 flex items-center justify-center gap-4">
                    <x-button-store type="submit" text="Editar dirección" icon="edit-01" class="w-max text-sm"
                        typeButton="primary" />
                    <x-button-store type="a" href="{{ Route('account.addresses.index') }}" text="Regresar"
                        icon="return" class="w-max text-sm" typeButton="secondary" />
                </div>
            </form>
        </div>
    @endsection
