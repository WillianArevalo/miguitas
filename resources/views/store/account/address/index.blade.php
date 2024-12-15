@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="mt-4 pb-4">
        <h2 class="mb-4 text-3xl font-bold text-blue-store">
            Mis direcciones
        </h2>
        @if (!$user->customer || $addresses->count() === 0)
            <div id="container-address-empty">
                <div class="flex items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-zinc-200 p-10">
                    <x-icon-store icon="map-point" class="h-8 w-8 text-blue-store" />
                    <div class="flex flex-col items-center gap-1">
                        <p class="font-pluto-r text-sm text-zinc-500">
                            No tienes ninguna dirección registrada
                        </p>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center">
                    <x-button-store type="a" href="{{ Route('account.addresses.create') }}" icon="map-point-add"
                        typeButton="secondary" text="Agregar dirección" class="add-address" />
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 xl:grid-cols-2" id="container-address-list">
                @foreach ($addresses as $address)
                    <div class="relative flex flex-col gap-4 rounded-2xl border border-zinc-200 p-6 shadow-md">
                        <div>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <x-icon-store icon="location" class="h-6 w-6 text-blue-store" />
                                    <p class="text-lg font-semibold text-blue-store">
                                        {{ App\Utils\Addresses::getAddress($address->type) }}
                                    </p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Línea 1:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->address_line_1 ?? '---' }}
                                        </p>
                                    </div>
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Línea 2:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->address_line_2 ?? '---' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Departamento:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->department ?? '---' }}
                                        </p>
                                    </div>
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Municipio:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->municipality ?? '---' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row">
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Distrito:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->district ?? '---' }}
                                        </p>
                                    </div>
                                    <div class="flex flex-1 items-center gap-2">
                                        <p class="font-din-b text-base text-zinc-800">
                                            Código postal:
                                        </p>
                                        <p class="font-din-r text-base text-zinc-600">
                                            {{ $address->zip_code ?? '---' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute right-0 top-0 m-4 flex items-center gap-2">
                                <a href="{{ Route('account.addresses.edit', $address->slug) }}"
                                    class="flex items-center justify-center text-green-500">
                                    <x-icon-store icon="edit" class="h-6 w-6" />
                                </a>
                                <form action="{{ Route('account.addresses.destroy', $address->id) }}" method="POST"
                                    id="formDeleteAddress-{{ $address->id }}">
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
                @if ($addresses->count() < 4)
                    <a href="{{ Route('account.addresses.create') }}"
                        class="add-address flex h-full items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-zinc-200 p-10 hover:bg-zinc-50">
                        <x-icon-store icon="map-point-add" class="h-8 w-8 text-blue-store" />
                        Agregar dirección
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!--Modal -->
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
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
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
                    <x-button-store type="button" text="Sí, eliminar" icon="delete" class="confirmDelete w-max text-sm"
                        typeButton="danger" />
                </div>
            </div>
        </div>
    </div>
@endsection
