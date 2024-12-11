@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="flex flex-col">
        <div class="pb-3">
            <h2 class="text-3xl font-bold text-blue-store">
                Soporte técnico
            </h2>
        </div>
        <div class="mb-4 border-t-2 border-zinc-200">
            <div class="mt-4 flex justify-end">
                <x-button-store type="a" href="{{ Route('account.tickets.create') }}" text="Crear ticket" icon="plus"
                    typeButton="primary" class="w-max" />
            </div>
            <div class="mt-4">
                @if ($tickets->count() > 0)
                    <div
                        class="hidden flex-col items-center justify-center gap-2 rounded-xl border border-zinc-200 px-4 shadow-sm lg:flex">
                        <table class="w-full table-auto font-dine-r">
                            <thead>
                                <tr class="border-b border-zinc-200">
                                    <th scope="col"
                                        class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                        Número de ticket
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                        Asunto
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-left font-dine-r text-xs font-medium uppercase tracking-wider text-zinc-500">
                                        Prioridad
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
                            <tbody class="divide-y divide-zinc-300 bg-white">
                                @foreach ($tickets as $ticket)
                                    <tr class="hover:bg-zinc-50">
                                        <td class="whitespace-nowrap px-4 py-4">
                                            <span
                                                class="font-secondary rounded-full bg-purple-100 px-3 py-1 text-sm text-blue-store">
                                                {{ $ticket->ticket_number }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4">
                                            <span class="font-secondary text-sm text-zinc-500">
                                                {{ $ticket->subject }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4">
                                            @switch($ticket->priority)
                                                @case('low')
                                                    <span
                                                        class="rounded-full bg-blue-100 px-2 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                        Baja
                                                    </span>
                                                @break

                                                @case('medium')
                                                    <span
                                                        class="rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                        Media
                                                    </span>
                                                @break

                                                @case('high')
                                                    <span
                                                        class="rounded-full bg-orange-100 px-2 py-1 font-dine-b text-xs font-medium text-orange-700">
                                                        Alta
                                                    </span>
                                                @break

                                                @case('urgent')
                                                    <span
                                                        class="rounded-full bg-red-100 px-2 py-1 font-dine-b text-xs font-medium text-red-700">
                                                        Urgente
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm text-zinc-500">
                                            @switch($ticket->status)
                                                @case('open')
                                                    <span
                                                        class="rounded-full bg-blue-100 px-2 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                        Abierto
                                                    </span>
                                                @break

                                                @case('pending')
                                                    <span
                                                        class="rounded-full bg-yellow-100 px-2 py-1 font-dine-b text-xs font-medium text-yellow-700">
                                                        Pendiente
                                                    </span>
                                                @break

                                                @case('resolved')
                                                    <span
                                                        class="flex w-max items-center gap-1 rounded-full bg-green-100 px-2 py-1 font-dine-b text-xs font-medium text-green-700">
                                                        <x-icon-store icon="circle-check" class="h-4 w-4 text-green-700" />
                                                        Resuelto
                                                    </span>
                                                @break

                                                @case('reopened')
                                                    <span
                                                        class="flex w-max items-center gap-1 rounded-full bg-blue-100 px-2 py-1 font-dine-b text-xs font-medium text-blue-700">
                                                        <x-icon-store icon="arrow-up" class="h-4 w-4 text-blue-700" />
                                                        Reabierto
                                                    </span>
                                                @break

                                                @case('closed')
                                                    <span
                                                        class="flex w-max items-center gap-1 rounded-full bg-red-100 px-2 py-1 font-dine-b text-xs font-medium text-red-700">
                                                        <x-icon-store icon="close" class="h-4 w-4 text-red-700" />
                                                        Cerrado
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-sm">
                                            <div class="flex items-center gap-2">
                                                <x-button-store icon="comment" type="a"
                                                    href="{{ Route('account.tickets.show', $ticket->ticket_number) }}"
                                                    typeButton="secondary" onlyIcon="true" class="w-max" />
                                                @if ($ticket->status == 'open' || $ticket->status == 'pending' || $ticket->status == 'reopened')
                                                    <div>
                                                        <form action="{{ Route('account.tickets.close', $ticket->id) }}"
                                                            method="POST" id="formCancelTicket-{{ $ticket->id }}">
                                                            @csrf
                                                            <x-button-store icon="trash" type="button"
                                                                href="{{ Route('account.tickets.show', $ticket->id) }}"
                                                                typeButton="danger" onlyIcon="true"
                                                                class="buttonDelete w-max"
                                                                data-tooltip-target="tooltip-cancel-ticket-{{ $ticket->id }}"
                                                                data-form="formCancelTicket-{{ $ticket->id }}" />
                                                        </form>
                                                        <div id="tooltip-cancel-ticket-{{ $ticket->id }}" role="tooltip"
                                                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-red-500 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                            Cancelar ticket
                                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div>
                                                        <form action="{{ Route('account.tickets.reopen', $ticket->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <x-button-store icon="arrow-up" type="submit"
                                                                href="{{ Route('account.tickets.show', $ticket->id) }}"
                                                                typeButton="info" onlyIcon="true" class="w-max"
                                                                data-tooltip-target="tooltip-cancel-ticket-{{ $ticket->id }}" />
                                                        </form>
                                                        <div id="tooltip-cancel-ticket-{{ $ticket->id }}" role="tooltip"
                                                            class="tooltip invisible absolute z-10 inline-block rounded-lg bg-blue-500 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                            Reabrir ticket
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

                    <!-- Cards mobile -->
                    <div class="flex flex-col gap-4 lg:hidden">
                        @foreach ($tickets as $ticket)
                            <div class="flex flex-col gap-2 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-secondary text-secondary flex items-center gap-2 rounded-xl bg-blue-100 px-2 py-1 text-lg font-bold">
                                        <x-icon-store icon="ticket-02" class="h-6 w-6 text-blue-500" />
                                        {{ $ticket->ticket_number }}
                                    </span>
                                    <div class="flex items-center gap-2 text-sm text-blue-500">
                                        <span class="block h-2 w-2 rounded-full bg-blue-500 ring-1 ring-blue-300"></span>
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="font-secondary text-sm text-zinc-500">
                                        Asunto: {{ $ticket->subject }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="font-secondary text-sm text-zinc-500">
                                        Descripción: {{ $ticket->description }}
                                    </span>
                                </div>
                                <div class="items -center flex justify-between">
                                    <div class="flex items-center text-sm text-zinc-500">
                                        @switch($ticket->status)
                                            @case('open')
                                                <span class="rounded-full bg-blue-100 px-4 py-1 text-xs font-medium text-blue-700">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            @break

                                            @case('pending')
                                                <span
                                                    class="rounded-full bg-yellow-100 px-4 py-1 text-xs font-medium text-yellow-700">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            @break

                                            @case('resolved')
                                                <span
                                                    class="rounded-full bg-green-100 px-4 py-1 text-xs font-medium text-green-700">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            @break

                                            @case('reopend')
                                                <span
                                                    class="rounded-full bg-orange-100 px-4 py-1 text-xs font-medium text-orange-700">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            @break

                                            @case('closed')
                                                <span class="rounded-full bg-blue-100 px-4 py-1 text-xs font-medium text-red-700">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            @break

                                            @default
                                        @endswitch
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <x-button-store icon="view" type="a" href="#"
                                            typeButton="secondary" onlyIcon="true" class="w-max" />
                                        <x-button-store icon="comment" type="a" href="#"
                                            typeButton="secondary" onlyIcon="true" class="w-max" />
                                        <div>
                                            <form action="{{ Route('account.tickets.close', $ticket->id) }}"
                                                method="POST" id="formCancelTicket-{{ $ticket->id }}">
                                                @csrf
                                                <x-button-store icon="cancel-circle" type="button"
                                                    href="{{ Route('account.tickets.show', $ticket->id) }}"
                                                    typeButton="danger" onlyIcon="true" class="buttonDelete w-max"
                                                    data-tooltip-target="tooltip-cancel-ticket"
                                                    data-form="formCancelTicket-{{ $ticket->id }}" />
                                            </form>
                                            <div id="tooltip-cancel-ticket" role="tooltip"
                                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-red-500 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
                                                Cancelar ticket
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="mt-3 flex items-center justify-center gap-2 rounded-xl border-2 border-dashed border-zinc-300 p-20 text-sm">
                        <x-icon-store icon="information-circle" class="h-6 w-6 text-zinc-500" />
                        <p class="text-center text-zinc-800">
                            No tienes tickets de soporte técnico
                        </p>
                    </div>
                @endif
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
                                Cancelar ticket
                            </h3>
                            <div class="mt-2">
                                <p class="font-dine-r text-sm text-zinc-400">
                                    ¿Estás seguro de que deseas cancelar este ticket?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <x-button-store type="button" text="No cancelar" icon="cancel" class="closeModal w-max text-sm"
                        typeButton="secondary" />
                    <x-button-store type="button" text="Si, cancelar ticket" icon="delete"
                        class="confirmDelete w-max text-sm" typeButton="danger" />
                </div>
            </div>
        </div>
    </div>

@endsection
