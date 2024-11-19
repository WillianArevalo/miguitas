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
                            <form class="flex items-center" action="{{ route('admin.categories.search') }}"
                                id="formSearchCategorie">
                                @csrf
                                <x-input type="text" id="inputSearch" name="inputSearch" data-form="#formSearchCategorie"
                                    data-table="#tableCategorie" placeholder="Buscar" icon="search" />
                            </form>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <x-button type="a" typeButton="primary" href="{{ route('admin.popups.create') }}"
                                text="Agregar anuncio" icon="plus" />
                        </div>
                    </div>
                    <div class="p-4">
                        <x-table>
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th>
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
                                        <x-tr>
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
                                                    <form action="{{ route('admin.popups.destroy', $adversiment->id) }}"
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
@endpush
