@extends('layouts.admin-template')
@section('title', 'Categorías')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Mensajes de contacto',
            'description' => 'Administrar mensajes de contacto enviados por los usuarios.',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative bg-white dark:bg-black">
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputSearchContactMessages" name="inputSearchContactMessages"
                                    data-form="#formSearchContactMessages" data-table="#tableContactMessages"
                                    placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 mb-4">
                        <x-table id="tableContactMessages">
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th>
                                        Nombre
                                    </x-th>
                                    <x-th>
                                        Apellido
                                    </x-th>
                                    <x-th>
                                        Correo electrónico
                                    </x-th>
                                    <x-th>
                                        Teléfono
                                    </x-th>
                                    <x-th>
                                        Mensaje
                                    </x-th>
                                    <x-th :last="true">
                                        Acciones
                                    </x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody" id="tableCategorie">
                                @if ($contactMessages->count() == 0)
                                    <x-tr>
                                        <x-td colspan="6">
                                            <div class="p-10 text-center">
                                                No hay mensajes de contacto
                                            </div>
                                        </x-td>
                                    </x-tr>
                                @else
                                    @foreach ($contactMessages as $contactMessage)
                                        <x-tr section="body">
                                            <x-td>
                                                <span class="text-nowrap">{{ $contactMessage->name }}</span>
                                            </x-td>
                                            <x-td>
                                                <span class="text-nowrap">{{ $contactMessage->last_name }}</span>
                                            </x-td>
                                            <x-td>
                                                <span class="text-nowrap">{{ $contactMessage->email }}</span>
                                            </x-td>
                                            <x-td>
                                                <span class="text-nowrap">{{ $contactMessage->phone }}</span>
                                            </x-td>
                                            <x-td>
                                                <span class="text-nowrap">{{ $contactMessage->message }}</span>
                                            </x-td>
                                            <x-td :last="true">
                                                <form
                                                    action="{{ route('admin.contact-messages.delete', $contactMessage->id) }}"
                                                    method="POST" id="formDeleteContactMessage-{{ $contactMessage->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="button" onlyIcon="true" icon="delete"
                                                        typeButton="danger"
                                                        data-form="formDeleteContactMessage-{{ $contactMessage->id }}"
                                                        data-modal-target="deleteModal" data-modal-toggle="deleteModal" />
                                                </form>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @endif
                            </x-slot>
                        </x-table>
                    </div>
                    {{ $contactMessages->links('vendor.pagination.pagination-custom') }}
                </div>
            </div>
        </div>

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar el mensaje de contacto?"
            message="No podrás recuperar este registro" action="" />
    </div>
@endsection


@push('scripts')
    @vite('resources/js/admin/order-table.js')
@endpush
