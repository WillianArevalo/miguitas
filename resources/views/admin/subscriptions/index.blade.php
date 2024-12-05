@extends('layouts.admin-template')
@section('title', 'Categorías')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Suscripciones',
            'description' => 'Administrar la información generada por los avisos emergentes.',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="mt-4 bg-white dark:bg-black">
                    <div class="mx-4 mb-4">
                        <x-table>
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        #
                                    </x-th>
                                    <x-th>
                                        Valor
                                    </x-th>
                                    <x-th :last="true">
                                        Acciones
                                    </x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($subscriptions->count() == 0)
                                    <x-tr last="true">
                                        <x-td colspan="3">
                                            <div class="p-10 text-center">
                                                No se encontraron registros
                                            </div>
                                        </x-td>
                                    </x-tr>
                                @else
                                    @foreach ($subscriptions as $subscription)
                                        <x-tr section="body" :last="$loop->last">
                                            <x-td>
                                                <span class="text-nowrap">{{ $loop->iteration }}</span>
                                            </x-td>
                                            <x-td>
                                                <span class="text-nowrap">{{ $subscription->value }}</span>
                                            </x-td>
                                            <x-td :last="true">
                                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}"
                                                    method="POST" id="formDeleteSubscription-{{ $subscription->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button type="button" onlyIcon="true" icon="delete"
                                                        typeButton="danger" class="buttonDelete"
                                                        data-form="formDeleteSubscription-{{ $subscription->id }}"
                                                        data-modal-target="deleteModal" data-modal-toggle="deleteModal" />
                                                </form>
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

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar el registro?"
            message="No podrás recuperar este registro" action="" />
    </div>
@endsection
