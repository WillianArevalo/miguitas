@extends('layouts.__partials.store.template-profile')
@section('profile-content')
    <div class="flex flex-col">
        <div class="flex flex-col-reverse justify-between py-2 sm:flex-row">
            <h2 class="text-3xl font-bold text-blue-store">
                Nuevo ticket de soporte
            </h2>
            <div class="w-max">
                <x-button-store type="a" href="{{ Route('account.tickets.index') }}" text="Regresar" icon="return"
                    typeButton="secondary" />
            </div>
        </div>
        <div class="mt-4 border-t-2 border-zinc-200">
            <form action="{{ Route('account.tickets.store') }}" enctype="multipart/form-data" method="POST" class="mt-4">
                @csrf
                <div class="flex flex-col gap-4">
                    <div class="flex w-full gap-4 max-[460px]:flex-col">
                        <div class="flex flex-[2] flex-col gap-2">
                            <x-input-store type="text" placeholder="Ingresa el asunto del ticket" name="subject"
                                label="Asunto" value="{{ old('subject') }}" required />
                        </div>
                        <div class="flex flex-1 flex-col gap-2">
                            <x-select-store name="priority" value="{{ old('prioriry') }}" label="Prioridad" id="priority"
                                required :options="[
                                    'low' => 'Baja',
                                    'medium' => 'Media',
                                    'high' => 'Alta',
                                    'urgent' => 'Urgente',
                                ]" />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-select-store name="category" value="{{ old('category') }}" label="Categoría" id="category"
                                required :options="$categories" />
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex flex-1 flex-col gap-2">
                            <x-input-store type="textarea" name="description" label="Descripción"
                                value="{{ old('description') }}" placeholder="Ingresa la descripción del ticket" required />
                        </div>
                    </div>

                    <div class="mt-2 flex items-center gap-2">
                        <input type="checkbox" value="0" name="add_comment" id="add_comment"
                            class="text-secondary focus:ring-secondary h-4 w-4 rounded border border-zinc-400 bg-zinc-100 focus:ring-2">
                        <label for="default" class="text-sm text-zinc-500 sm:text-base">
                            Agregar comentario
                        </label>
                    </div>

                    <div class="hidden" id="comment-container">
                        <div class="flex flex-col gap-2">
                            <x-input-store type="textarea" name="comment" label="Comentario" value="{{ old('comment') }}"
                                placeholder="Ingresa el comentario" />
                        </div>
                        <div class="mt-4 flex w-full">
                            <div class="flex flex-1 flex-col gap-2">
                                <p class="text-start text-sm font-medium text-zinc-600 sm:text-base">Archivos</p>
                                <label for="attachments"
                                    class="flex w-max cursor-pointer items-center justify-center gap-2 rounded-full border-2 border-blue-store bg-white px-6 py-3 text-sm text-blue-store transition-colors duration-300 hover:bg-zinc-100 sm:text-base">
                                    <x-icon-store icon="cloud-upload" class="h-5 w-5 text-zinc-800" />
                                    Adjuntar archivos
                                    <input type="file" name="attachments[]" id="attachments" multiple class="hidden" />
                                </label>
                                <div id="previewImages"
                                    class="mt-2 flex h-32 flex-wrap items-center justify-center gap-4 rounded-xl border-2 border-dashed border-zinc-400 p-4">
                                    <p class="text-sm text-zinc-600">No se han seleccionado archivos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-4 flex justify-center">
                    <x-button-store type="submit" text="Crear ticket" class="w-max" typeButton="primary" />
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/ticket.js')
@endpush
