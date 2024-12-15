@extends('layouts.admin-template')
@section('title', 'Tarifas de envío')
@section('content')
    <div>
        <div class="lg:ms-60">
            @include('layouts.__partials.admin.header-page', [
                'title' => 'Tarifas de envío',
                'description' =>
                    'Administra las tarifas de envío de tu tienda, crea nuevas tarifas, edita o elimina las existentes.',
            ])
        </div>
        <div class="flex bg-zinc-50 dark:bg-black">
            @include('layouts.__partials.admin.nav-sales-strategies')
            <div class="mx-auto w-full lg:ms-60">
                <div class="mb-4">
                    <h2 class="font-secondary px-4 pt-4 text-lg font-medium text-zinc-600 dark:text-zinc-200 md:text-xl">
                        Tarifas de envío
                    </h2>
                </div>
                <div class="mx-auto w-full border-t border-zinc-400 dark:border-zinc-800">
                    <div class="relative overflow-hidden bg-white dark:bg-black">
                        <div
                            class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                            <div class="w-full md:w-1/2">
                                <div class="flex items-center">
                                    <x-input type="text" id="inputRates" placeholder="Buscar" icon="search" />
                                </div>
                            </div>
                            <div
                                class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                                <x-button type="button" class="open-drawer" data-drawer="#drawer-new-rate"
                                    typeButton="primary" text="Nueva tarifa" icon="plus" />
                            </div>
                        </div>
                        <div class="mx-4 mb-4">
                            <x-table id="tableRates">
                                <x-slot name="thead">
                                    <x-tr>
                                        <x-th class="w-10">
                                            <x-icon icon="hash" class="size-4" />
                                        </x-th>
                                        <x-th>
                                            Departamento
                                        </x-th>
                                        <x-th>
                                            Municipio
                                        </x-th>
                                        <x-th>
                                            Distrito
                                        </x-th>
                                        <x-th>
                                            Costo
                                        </x-th>
                                        <x-th>
                                            Estado
                                        </x-th>
                                        <x-th>
                                            Descripción
                                        </x-th>
                                        <x-th :last="true">
                                            Acciones
                                        </x-th>
                                    </x-tr>
                                </x-slot>
                                <x-slot name="tbody">
                                    @if ($rates->count() == 0)
                                        <x-tr last="true">
                                            <x-td colspan="8" class="py-8 text-center">
                                                No hay tarifas de envío registradas
                                            </x-td>
                                        </x-tr>
                                    @else
                                        @foreach ($rates as $rate)
                                            <x-tr last="{{ $loop->last }}">
                                                <x-td>
                                                    {{ $loop->iteration }}
                                                </x-td>
                                                <x-td>
                                                    {{ $rate->department }}
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    {{ $rate->municipality }}
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    {{ $rate->district }}
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    ${{ $rate->cost }}
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    <x-badge-status :status="$rate->active" />
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    {{ $rate->description }}
                                                </x-td>
                                                <x-td class="px-4 py-3">
                                                    <div class="flex gap-2">
                                                        <x-button type="button" class="btnEditRate"
                                                            data-href="{{ route('admin.sales-strategies.rates.edit', $rate->id) }}"
                                                            data-action="{{ route('admin.sales-strategies.rates.update', $rate->id) }}"
                                                            typeButton="success" icon="edit" onlyIcon="true" />
                                                        <form
                                                            action="{{ route('admin.sales-strategies.rates.destroy', $rate->id) }}"
                                                            id="rate-{{ $rate->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-button type="button" data-form="rate-{{ $rate->id }}"
                                                                class="buttonDelete" onlyIcon="true" icon="delete"
                                                                typeButton="danger" data-modal-target="deleteModal"
                                                                data-modal-toggle="deleteModal" />
                                                        </form>
                                                    </div>
                                                </x-td>
                                            </x-tr>
                                        @endforeach
                                    @endif
                                </x-slot>
                            </x-table>
                            {{ $rates->links('vendor.pagination.pagination-custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete modal -->
        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar la tarifa de pago?"
            message="No podrás recuperar este registro" />
        <!-- End Delete modal -->

        <!-- Drawer new currency  -->
        <div id="drawer-new-rate"
            class="drawer fixed right-0 top-0 z-[70] h-screen w-full translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black sm:w-[500px]"
            tabindex="-1" aria-labelledby="drawer-new-rate">
            <h5 id="drawer-new-rate-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Nueva tarifa
            </h5>
            <button type="button" data-drawer="#drawer-new-rate"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <form action="{{ route('admin.sales-strategies.rates.store') }}" class="flex flex-col gap-4"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="flex flex-col gap-4">
                        <div class="flex w-full flex-1 flex-col gap-2">
                            <x-select name="department" label="Departamento" id="state"
                                value="{{ $address->state ?? '' }}" data-url="{{ Route('departamentos.search') }}"
                                selected="{{ $address->state ?? '' }}" :options="$departamentos" />
                        </div>
                        <div class="w-full flex-1">
                            <label class="mb-2 block text-sm font-medium text-zinc-500 dark:text-zinc-300">
                                Municipio
                            </label>
                            <input type="hidden" id="municipio" name="municipality" value="{{ $address->city ?? '' }}"
                                data-url="{{ Route('distritos') }}">
                            <div class="relative">
                                <div
                                    class="selected @error('municipio') is-invalid @enderror flex w-full items-center justify-between rounded-lg border border-zinc-400 bg-zinc-50 px-4 py-3 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-white">
                                    <span class="itemSelectedMunicipio truncate" id="municipio_selected">
                                        Seleccione un departamento
                                    </span>
                                    <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-white" />
                                </div>
                                <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden w-full rounded-lg border border-zinc-400 bg-white p-2 shadow-lg dark:border-zinc-800 dark:bg-zinc-950"
                                    id="list-municipios">
                                    <li class="itemOption cursor-default truncate rounded-lg px-4 py-3 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
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
                        <label class="mb-2 block text-sm font-medium text-zinc-500 dark:text-zinc-300">
                            Distrito
                        </label>
                        <input type="hidden" id="distrito" name="district">
                        <div class="relative">
                            <div
                                class="selected @error('distrito') is-invalid @enderror flex w-full items-center justify-between rounded-lg border border-zinc-400 bg-zinc-50 px-4 py-3 text-sm dark:border-zinc-800 dark:bg-zinc-950 dark:text-white">
                                <span class="itemSelectedDistrito truncate" id="municipio_selected">
                                    Seleccione un distrito
                                </span>
                                <x-icon icon="arrow-down" class="h-5 w-5 text-zinc-500 dark:text-white" />
                            </div>
                            <ul class="selectOptions absolute z-10 mb-8 mt-2 hidden w-full rounded-lg border border-zinc-400 bg-white p-2 shadow-lg dark:border-zinc-800 dark:bg-zinc-950"
                                id="list-distritos">
                                <li class="itemOptionDistrito cursor-default truncate rounded-lg px-4 py-3 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
                                    data-input="#municipio">
                                    Selecciona un municipio
                                </li>
                            </ul>
                        </div>
                        @error('distrito')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-input type="number" step="0.01" name="cost" required
                            placeholder="Ingresa el costo de envío" label="Costo" value="{{ old('cost') }}" />
                    </div>
                    <div>
                        <x-input type="textarea" name="description" required
                            placeholder="Ingresa una descripción de la tarifa" label="Descripción"
                            value="{{ old('description') }}" />
                    </div>
                    <div class="flex w-full flex-wrap items-center gap-4">
                        <div>
                            <x-input type="checkbox" label="Activa" name="active" value="0" />
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <x-button type="submit" text="Agregar tarifa" icon="plus" typeButton="primary" />
                        <x-button type="button" data-drawer="#drawer-new-rate" class="close-drawer" text="Cancelar"
                            typeButton="secondary" icon="cancel" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End Drawer new currency -->

        <!-- Drawer edit currency -->
        <div id="drawer-edit-rate"
            class="drawer fixed right-0 top-0 z-[70] h-screen w-full translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black sm:w-[500px]"
            tabindex="-1" aria-labelledby="drawer-edit-rate">
            <h5 id="drawer-edit-rate-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Editar moneda
            </h5>
            <button type="button" data-drawer="#drawer-edit-rate"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <form action="" class="flex flex-col gap-4" method="POST" id="formEditRate">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input type="text" id="department" name="department" readonly label="Departamento" />
                    </div>
                    <div>
                        <x-input type="text" id="municipality" name="municipality" readonly label="Municipio" />
                    </div>
                    <div>
                        <x-input type="text" id="district" name="district" readonly label="Distrito" />
                    </div>
                    <div>
                        <x-input type="number" step="0.01" id="cost" name="cost" required
                            placeholder="Ingresa el costo de envío" label="Costo" value="{{ old('cost') }}" />
                    </div>
                    <div>
                        <x-input type="textarea" name="description" id="description" required
                            placeholder="Ingresa una descripción de la tarifa" label="Descripción"
                            value="{{ old('description') }}" />
                    </div>
                    <div class="flex w-full flex-wrap items-center gap-4">
                        <div>
                            <x-input type="checkbox" label="Activa" name="active" id="active" value="0" />
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <x-button type="submit" text="Editar moneda" icon="edit" typeButton="primary" />
                        <x-button type="button" data-drawer="#drawer-edit-rate" class="close-drawer" text="Cancelar"
                            typeButton="secondary" icon="cancel" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End Drawer edit currency -->

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comprueba si hay errores de validación en la sesión
            @if ($errors->any())
                @if (old('_method') === 'POST')
                    $("#drawer-new-rate").removeClass("translate-x-full");
                @elseif (old('method') === 'UPDATE')
                    $("#drawer-edit-method").removeClass("translate-x-full");
                @endif
                $("#overlay").removeClass("hidden");
            @endif
        });
    </script>
@endsection

@push('scripts')
    @vite('resources/js/select-address.js')
    @vite('resources/js/admin/sales-strategies.js')
    @vite('resources/js/admin/order-table.js')
@endpush
