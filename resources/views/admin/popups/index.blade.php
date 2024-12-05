@extends('layouts.admin-template')
@section('title', 'Anuncios')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Anuncios',
            'description' => 'Administrar los anuncios (popups) que se muestran al abrir la página.',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative overflow-hidden bg-white dark:bg-black">
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputSearchPopups" placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <x-button type="a" typeButton="primary" href="{{ route('admin.popups.create') }}"
                                text="Agregar anuncio" icon="plus" />
                        </div>
                    </div>
                    <div class="px-4">
                        <x-table id="tablePopups">
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        <x-icon icon="hash" class="h-4 w-4" />
                                    </x-th>
                                    <x-th>
                                        Nombre
                                    </x-th>
                                    <x-th>
                                        Estado
                                    </x-th>
                                    <x-th>
                                        Tipo
                                    </x-th>
                                    <x-th>
                                        Link
                                    </x-th>
                                    <x-th last="true">Acciones</x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($adversiments->count() > 0)
                                    @foreach ($adversiments as $adversiment)
                                        <x-tr :last="$loop->last">
                                            <x-td>
                                                <span>{{ $loop->iteration }}</span>
                                            </x-td>
                                            <x-td>
                                                <span>
                                                    @if ($adversiment->type === 'popup')
                                                        {{ $adversiment->name }}
                                                    @elseif ($adversiment->type === 'headband')
                                                        {{ $adversiment->title }}
                                                    @endif
                                                </span>
                                            </x-td>
                                            <x-td>
                                                <x-badge-status :status="$adversiment->active" />
                                            </x-td>
                                            <x-td>
                                                @if ($adversiment->type === 'popup')
                                                    Aviso emergente
                                                @elseif ($adversiment->type === 'headband')
                                                    Aviso de cabecera
                                                @endif
                                            </x-td>
                                            <x-td>
                                                @if ($adversiment->link_text)
                                                    <a href="{{ $adversiment->link }}"
                                                        class="px-4 text-sm text-primary-600 underline hover:underline dark:text-primary-400"
                                                        target="_blank">
                                                        {{ $adversiment->link_text }}
                                                    </a>
                                                @else
                                                    <a href="{{ $adversiment->link }}"
                                                        class="px-4 text-sm text-primary-600 underline hover:underline dark:text-primary-400"
                                                        target="_blank">
                                                        Ver link
                                                    </a>
                                                @endif
                                            </x-td>
                                            <x-td>
                                                <div class="flex gap-2">
                                                    <form
                                                        action="{{ $adversiment->type == 'popup'
                                                            ? route('admin.popups.destroy', $adversiment->id)
                                                            : route('admin.headbands.destroy', $adversiment->id) }}"
                                                        id="formDeletePopup-{{ $adversiment->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button type="button"
                                                            data-form="formDeletePopup-{{ $adversiment->id }}"
                                                            onlyIcon="true" icon="delete" typeButton="danger"
                                                            class="buttonDelete" />
                                                    </form>
                                                    @if ($adversiment->type === 'popup')
                                                        <x-button type="button" class="showPopup"
                                                            data-action="{{ route('admin.popups.show', $adversiment->id) }}"
                                                            onlyIcon="true" icon="view" typeButton="secondary" />
                                                    @endif
                                                    <div class="relative">
                                                        <x-button type="button" icon="refresh" typeButton="secondary"
                                                            onlyIcon="true" class="show-options"
                                                            data-target="#options-order-{{ $adversiment->id }}" />
                                                        <div class="options absolute right-0 top-11 z-10 mt-2 hidden w-40 animate-jump-in rounded-lg border border-zinc-400 bg-white p-2 animate-duration-200 dark:border-zinc-800 dark:bg-zinc-950"
                                                            id="options-order-{{ $adversiment->id }}">
                                                            <p class="font-semibold text-zinc-800 dark:text-zinc-300">
                                                                Cambiar estado
                                                            </p>
                                                            <form
                                                                action="{{ Route('admin.popups.change-status', $adversiment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="status">
                                                                <input type="hidden" name="type"
                                                                    value="{{ $adversiment->type }}">
                                                                <ul class="mt-2 flex flex-col text-sm">
                                                                    <li>
                                                                        <button type="button"
                                                                            class="change-status-popup flex w-full items-center gap-1 rounded-lg px-2 py-2 text-emerald-700 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:bg-emerald-950 dark:hover:bg-opacity-20"
                                                                            data-status="actived">
                                                                            <x-icon icon="check" class="h-4 w-4" />
                                                                            Activo
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button type="button" href="#"
                                                                            class="change-status-popup flex w-full items-center gap-1 rounded-lg px-2 py-2 text-red-700 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-950 dark:hover:bg-opacity-20"
                                                                            data-status="desactived">
                                                                            <x-icon icon="x" class="h-4 w-4" />
                                                                            Desactivado
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @else
                                    <x-tr>
                                        <x-td colspan="6" class="px-4 py-3 text-center">
                                            <span>No hay anuncios registrados</span>
                                        </x-td>
                                    </x-tr>
                                @endif

                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
            <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar el anuncio?"
                message="No podrás recuperar este registro" action="" />
            <div id="previewPopup"
                class="fixed inset-0 z-50 hidden h-screen items-center justify-center bg-black bg-opacity-70">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/admin/popup.js')
    @vite('resources/js/admin/order-table.js')
@endpush
