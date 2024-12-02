@extends('layouts.admin-template')
@section('title', 'Clientes')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Clientes',
            'description' => 'Administrar clientes registrados.',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative bg-white dark:bg-black">
                    <div class="border-b border-zinc-400 p-4 dark:border-zinc-800">
                        <h2 class="text-base font-semibold text-zinc-700 dark:text-zinc-200">
                            Lista de clientes registrados
                        </h2>
                    </div>
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputCustomers" placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <x-button type="a" href="{{ route('admin.customers.create') }}" text="Nuevo cliente"
                                icon="plus" typeButton="primary" />
                        </div>
                    </div>
                    <div class="mx-4">
                        <x-table id="tableCustomers">
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        <input id="default-checkbox" type="checkbox" value=""
                                            class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                    </x-th>
                                    <x-th>Foto</x-th>
                                    <x-th>Nombre</x-th>
                                    <x-th>Apellido</x-th>
                                    <x-th>Correo</x-th>
                                    <x-th>Telefono</x-th>
                                    <x-th>Estado</x-th>
                                    <x-th :last="true">Acciones</x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($customers->isEmpty())
                                    <x-tr section="body" class="text-center">
                                        <x-td colspan="8" class="py-8">
                                            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                                No se ha agregado ningún cliente
                                            </span>
                                        </x-td>
                                    </x-tr>
                                @else
                                    @foreach ($customers as $customer)
                                        <x-tr section="body">
                                            <x-td>
                                                <input id="default-checkbox" type="checkbox" value="{{ $customer->id }}"
                                                    class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
                                            </x-td>
                                            <x-td>
                                                <img src="{{ Storage::url($customer->user->profile) }}"
                                                    alt="Foto de perfil del usuario {{ $customer->user->username }}"
                                                    class="h-10 w-10 rounded-full object-cover">
                                            </x-td>
                                            <x-td>
                                                <span>{{ $customer->user->name }}</span>
                                            </x-td>
                                            <x-td>
                                                <span>{{ $customer->user->last_name }}</span>
                                            </x-td>
                                            <x-td>
                                                <span>{{ $customer->user->email }}</span>
                                            </x-td>
                                            <x-td>
                                                <span>{{ $customer->phone ?? '---' }}</span>
                                            </x-td>
                                            <x-td>
                                                <x-badge-status :status="$customer->status" />
                                            </x-td>
                                            <x-td>
                                                <div class="flex gap-2">
                                                    <x-button type="a"
                                                        href="{{ route('admin.customers.edit', $customer->id) }}"
                                                        icon="edit" typeButton="success" onlyIcon="true" />
                                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                        id="formDeleteCustomer-{{ $customer->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button type="button"
                                                            data-form="formDeleteCustomer-{{ $customer->id }}"
                                                            icon="delete" typeButton="danger" class="buttonDelete"
                                                            onlyIcon="true" data-modal-target="deleteModal"
                                                            data-modal-toggle="deleteModal" />
                                                    </form>
                                                    <x-button type="a"
                                                        href="{{ route('admin.customers.edit', $customer->id) }}"
                                                        icon="view" typeButton="secondary" onlyIcon="true" />
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @endif
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar el cliente?"
            message="Se eliminará el usuario y toda la información relacionada a el cliente. No podrás recuperar este registro"
            action="" />
    </div>
@endsection

@push('scripts')
    @vite('resources/js/admin/order-table.js')
@endpush
