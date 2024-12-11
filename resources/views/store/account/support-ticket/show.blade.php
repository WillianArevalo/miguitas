@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="mb-4 flex flex-col">
        <div class="mb-4 flex flex-col-reverse justify-between gap-y-4 py-2 sm:flex-row">
            <h1 class="text-3xl font-bold text-blue-store">
                Ticket de soporte
            </h1>
            <div class="flex w-full flex-col items-center gap-4 gap-y-4 sm:w-max sm:flex-row">
                <div class="w-full sm:w-max">
                    <x-button-store type="a" href="{{ Route('account.tickets.index') }}" text="Regresar" icon="return"
                        typeButton="secondary" />
                </div>
                <div class="w-full sm:w-max">
                    @if ($ticket->status === 'reopened' || $ticket->status === 'pending')
                        <form action="{{ Route('account.tickets.close', $ticket->id) }}" method="POST" class="w-full"
                            id="formCancelTicket">
                            @csrf
                            <x-button-store type="button" data-form="formCancelTicket" text="Cerrar ticket"
                                typeButton="danger" class="buttonDelete w-full" />
                        </form>
                    @else
                        <form action="{{ Route('account.tickets.reopen', $ticket->id) }}" method="POST" class="w-full"
                            id="formReopenTicket">
                            @csrf
                            <x-button-store type="submit" data-form="formReopenTicket" text="Reabrir ticket"
                                typeButton="primary" class="buttonReopen w-full" />
                        </form>
                    @endif
                </div>
            </div>
        </div>

        @switch($ticket->status)
            @case('open')
                <span class="rounded-full bg-blue-100 px-4 py-1 font-dine-b text-sm font-medium text-blue-700">
                    {{ ucfirst($ticket->status) }}
                </span>
            @break

            @case('resolved')
                <span
                    class="flex w-full flex-col justify-between gap-y-2 rounded-xl border-2 border-dashed border-green-500 bg-green-50 p-4 text-base text-green-500 sm:flex-row">
                    <div class="flex items-center gap-2">
                        <x-icon-store icon="circle-check" class="h-6 w-6" />
                        Ticket resuelto
                    </div>
                    <p>
                        {{ $ticket->resolved_at->setTimezone(auth()->user()->timezone ?? 'UTC')->format('F j, Y, g:i A') }}
                    </p>
                </span>
            @break

            @case('reopened')
                <span
                    class="flex w-full flex-col justify-between gap-y-2 rounded-xl border-2 border-dashed border-blue-500 bg-blue-50 p-4 text-base text-blue-500 sm:flex-row">
                    <div class="flex items-center gap-2">
                        <x-icon-store icon="arrow-up" class="h-6 w-6" />
                        Ticket reabierto
                    </div>
                    <p>
                        {{ $ticket->reopened_at->setTimezone(auth()->user()->timezone ?? 'UTC')->format('F j, Y, g:i A') }}
                    </p>
                </span>
            @break

            @case('closed')
                <span
                    class="flex w-full justify-between rounded-xl border-2 border-dashed border-red-500 bg-red-50 p-4 text-base text-red-500">
                    <div class="flex items-center gap-2">
                        <x-icon-store icon="alert" class="h-6 w-6" />
                        Ticket cerrado
                    </div>
                    <p>
                        {{ $ticket->closed_at->setTimezone(auth()->user()->timezone ?? 'UTC')->format('F j, Y, g:i A') }}
                    </p>
                </span>
            @break

            @default
        @endswitch

        <div class="mt-8">
            <div class="flex flex-col items-start justify-between gap-y-4 sm:flex-row sm:items-center">
                <h2 class="text-xl font-bold text-zinc-600">
                    {{ $ticket->ticket_number }}
                </h2>
                <div>
                    @switch($ticket->priority)
                        @case('low')
                            <span
                                class="rounded-xl border-2 border-zinc-700 bg-zinc-100 px-4 py-2 font-dine-b text-base font-medium uppercase text-zinc-700">
                                Prioridad baja
                            </span>
                        @break

                        @case('medium')
                            <span
                                class="rounded-xl border-2 border-yellow-700 bg-yellow-100 px-4 py-2 font-dine-b text-base font-medium uppercase text-yellow-700">
                                Prioridad media
                            </span>
                        @break

                        @case('high')
                            <span
                                class="rounded-xl border-2 border-orange-700 bg-orange-100 px-4 py-2 font-dine-b text-base font-medium uppercase text-orange-700">
                                Prioridad alta
                            </span>
                        @break

                        @case('urgent')
                            <span
                                class="rounded-xl border-2 border-red-700 bg-red-100 px-4 py-2 font-dine-b text-base font-medium uppercase text-red-700">
                                Prioridad urgente
                            </span>
                        @break

                        @default
                    @endswitch
                </div>
            </div>
            <p class="mt-4 font-dine-r text-sm font-medium text-zinc-500 sm:mt-2">
                {{ $ticket->created_at->setTimezone('America/Mexico_City')->format('d/m/Y h:i a') }}
            </p>
        </div>
        <div class="mt-4">
            <h3 class="text-lg font-bold text-blue-store">
                {{ $ticket->subject }}
            </h3>
            <p class="mt-2 font-dine-r text-sm font-medium text-zinc-500">
                {{ $ticket->description }}
            </p>
        </div>

        @if ($ticket->lastRepliedBy)
            <div class="mt-4 rounded-xl border-2 border-dashed border-zinc-500 bg-zinc-50 p-4 text-zinc-500">
                <h2 class="text-base font-bold uppercase">
                    Última respuesta
                </h2>
                <div class="flex flex-col font-dine-r">
                    <p>Fecha:
                        {{ $ticket->last_replied_at->toFormattedDateString() }}
                    </p>
                    <p>Hora:
                        {{ $ticket->last_replied_at->setTimezone(auth()->user()->timezone ?? 'UTC')->format('h:i A') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="mt-4 border-t-2 border-zinc-300">
            <h2 class="mt-4 text-xl font-bold uppercase text-zinc-500">
                Comentarios
            </h2>
            @forelse ($ticket->comments as $comment)
                <div>
                    <div class="flex flex-col gap-4">
                        <div class="{{ $comment->type_user === 'admin' ? 'justify-end' : 'justify-start' }} flex">
                            <div class="flex items-start gap-2.5">
                                @if ($comment->type_user !== 'admin')
                                    @if ($comment->user->profile)
                                        @if ($comment->user->profile)
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="{{ Storage::url($comment->user->profile) }}"
                                                alt="Profile image {{ $comment->user->username }}">
                                        @else
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-200 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                                <x-icon icon="user" class="h-5 w-5" />
                                            </div>
                                        @endif
                                    @else
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-200 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                            <x-icon icon="user" class="h-5 w-5" />
                                        </div>
                                    @endif
                                @endif
                                <div
                                    class="leading-1.5 {{ $comment->type_user === 'admin' ? 'rounded-s-xl rounded-ee-xl' : 'rounded-e-xl rounded-es-xl' }} mt-4 flex w-full max-w-[400px] flex-col border-2 border-zinc-400 bg-zinc-100 p-4">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-blue-store">
                                            {{ $comment->user->username }}
                                        </span>
                                        <span class="font-dine-r text-xs font-normal text-zinc-500">
                                            {{ $comment->created_at->setTimezone(auth()->user()->timezone ?? 'UTC')->format('F j, Y, g:i A') }}
                                        </span>
                                    </div>
                                    <p class="py-2.5 font-dine-r text-sm font-normal text-zinc-700">
                                        {{ $comment->comment }}
                                    </p>
                                    @if ($comment->attachments)
                                        <div
                                            class="{{ count($comment->attachments) > 1 ? 'grid grid-cols-2 gap-4' : '' }} my-2.5">
                                            @foreach ($comment->attachments as $attachment)
                                                <div class="group relative my-2.5">
                                                    <div
                                                        class="absolute flex h-full w-full items-center justify-center rounded-lg bg-zinc-900/50 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                        <a href="{{ Storage::url($attachment['path']) }}" download
                                                            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-purple-200/30 hover:bg-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-700 focus:ring-opacity-40">
                                                            <x-icon icon="import" class="h-5 w-5 text-white" />
                                                        </a>
                                                    </div>
                                                    <img src="{{ Storage::url($attachment['path']) }}" alt="Image"
                                                        class="h-28 w-full rounded-xl object-cover" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                @if ($comment->type_user === 'admin')
                                    @if ($comment->user->profile)
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Storage::url($comment->user->profile) }}"
                                            alt="Profile image {{ $comment->user->username }}">
                                    @else
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-200 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                            <x-icon icon="user" class="h-5 w-5" />
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="my-4 flex items-center justify-center gap-2 rounded-xl border-2 border-dashed border-zinc-400 p-10 dark:border-zinc-800">
                    <x-icon icon="message-off" class="h-6 w-6 text-zinc-400 dark:text-zinc-600" />
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">No hay comentarios</p>
                </div>
            @endforelse


            @if ($ticket->status !== 'closed' && $ticket->status !== 'resolved')
                <form action="{{ Route('account.tickets.comment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <div class="mt-4">
                        <x-input-store type="textarea" name="comment" placeholder="Escribe un comentario"
                            label="Comentario" />
                    </div>
                    <div class="mt-4 flex flex-col items-start">
                        <div class="flex w-full justify-between">
                            <div class="flex flex-wrap items-center">
                                <div class="flex items-center">
                                    <label for="attachments" data-tooltip-target="tooltip-attachments"
                                        class="flex cursor-pointer items-center justify-center gap-2 rounded-full border-2 border-zinc-300 bg-white px-6 py-3 text-zinc-600 transition-colors duration-300 hover:bg-zinc-200/50">
                                        <x-icon icon="paperclip" class="h-4 w-4" />
                                        <span class="text-xs font-semibold">Adjuntar archivos</span>
                                        <input id="attachments" type="file" class="hidden" name="attachments[]"
                                            multiple />
                                    </label>
                                </div>
                            </div>
                            <x-button-store typeButton="secondary" text="Eliminar archivos" size="small"
                                id="btn-remove-attachments" class="hidden" type="button" icon="delete" />
                        </div>
                        <div class="hidden" id="container-preview-images">
                            <div class="mb-2 mt-4 flex w-full items-center gap-2" id="preview-images">
                            </div>
                        </div>
                    </div>
                    @error('comment')
                        <span class="text-xs italic text-red-500">{{ $message }}</span>
                    @enderror
                    <x-button-store type="submit" typeButton="primary" text="Enviar comentario" icon="send"
                        class="mt-4" />
                </form>
            @endif
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

@push('scripts')
    @vite('resources/js/store/ticket.js')
@endpush
