@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="flex flex-col">
        <div class="flex justify-between py-2">
            <h2 class="text-3xl font-bold text-blue-store">
                Nueva dirección
            </h2>
            <x-button-store type="a" href="{{ Route('account.addresses.index') }}" typeButton="secondary" text="Regresar"
                icon="return" />
        </div>
        <div class="mt-4 border-t-2 border-zinc-200">
            <form action="{{ Route('account.addresses.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="flex flex-col gap-4">
                    <div class="flex w-full flex-col gap-4 sm:flex-row">
                        <div class="flex flex-[2] flex-col gap-2">
                            <x-select-store type="text" label="País" id="country" name="country" :options="$countries"
                                required />
                        </div>
                        <div class="flex flex-[2] flex-col gap-2">
                            <x-select-store label="Tipo de dirección" id="type" name="type" :options="$addresses"
                                required value="{{ old('type') }}" selected="{{ old('type') }}" />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" name="address_line_1" label="Dirección (línea 1)"
                                value="{{ old('address_line_1') }}" required />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" name="address_line_2" label="Dirección (línea 2)"
                                value="{{ old('address_line_2') }}" />
                        </div>
                    </div>
                    <div class="flex w-full flex-col gap-4 sm:flex-row">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" placeholder="Ingresa el estado" label="Estado" name="state"
                                value="{{ old('state') }}" />
                        </div>
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" placeholder="Ingresa la ciudad" label="Ciudad" name="city"
                                value="{{ old('city') }}" />
                        </div>
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="text" placeholder="Ingresa el código postal" label="Código postal"
                                name="zip_code" required value="{{ old('zip_code') }}" />
                        </div>
                    </div>
                </div>
                <div class="my-4 flex items-center justify-center">
                    <x-button-store type="submit" text="Guardar dirección" icon="check" class="w-max"
                        typeButton="primary" />
                </div>
            </form>
        </div>
    @endsection
