@extends('layouts.admin-template')
@section('title', 'Preguntas frecuentes')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Preguntas frecuentes',
            'description' => 'Administra las preguntas frecuentes de tu aplicación',
        ])
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative bg-white dark:bg-black">
                    <div class="border-b border-zinc-400 p-4 dark:border-zinc-800">
                        <h2 class="text-base font-semibold text-zinc-700 dark:text-zinc-200">
                            Lista de preguntas
                        </h2>
                    </div>
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputFaq" placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <x-button data-drawer="#drawer-new-faq-category" class="open-drawer" type="button"
                                text="Nueva categoría" icon="plus" typeButton="secondary" />
                            <x-button data-drawer="#drawer-new-faq" class="open-drawer" type="button" text="Nueva pregunta"
                                icon="plus" typeButton="primary" />
                        </div>
                    </div>
                    <div class="px-4">
                        <x-table id="tableFaq">
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        <x-icon icon="hash" class="h-4 w-4" />
                                    </x-th>
                                    <x-th>
                                        Categoría
                                    </x-th>
                                    <x-th>
                                        Estado
                                    </x-th>
                                    <x-th>
                                        Pregunta
                                    </x-th>
                                    <x-th>
                                        Respuesta
                                    </x-th>
                                    <x-th last="true">Acciones</x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($faqs->count() > 0)
                                    @foreach ($faqs as $faq)
                                        <x-tr>
                                            <x-td>
                                                {{ $faq->id }}
                                            </x-td>
                                            <x-td>
                                                {{ $faq->category->name }}
                                            </x-td>
                                            <x-td>
                                                <x-badge-status :status="$faq->active" />
                                            </x-td>
                                            <x-td>
                                                {{ $faq->question }}
                                            </x-td>
                                            <x-td>
                                                <span class="text-wrap line-clamp-2 w-full">
                                                    {{ $faq->answer }}
                                                </span>
                                            </x-td>
                                            <x-td>
                                                <div class="flex gap-2">
                                                    <x-button type="button" class="editFaq"
                                                        data-href="{{ route('admin.faq.edit', $faq->id) }}"
                                                        data-action="{{ route('admin.faq.update', $faq->id) }}"
                                                        onlyIcon="true" icon="edit" typeButton="success" />
                                                    <form action="{{ route('admin.faq.destroy', $faq->id) }}"
                                                        id="formDeleteFaq-{{ $faq->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button type="button"
                                                            data-form="formDeleteFaq-{{ $faq->id }}" onlyIcon="true"
                                                            icon="delete" typeButton="danger" class="buttonDelete"
                                                            data-modal-target="deleteModal"
                                                            data-modal-toggle="deleteModal" />
                                                    </form>
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @else
                                    <x-tr>
                                        <x-td colspan="6" class="text-center">
                                            <div class="py-10">
                                                No hay preguntas registradas
                                            </div>
                                        </x-td>
                                    </x-tr>
                                @endif
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar la pregunta?"
            message="No podrás recuperar este registro" />

        <x-delete-modal modalId="deleteModalCategory" title="¿Estás seguro de eliminar la categoría?"
            message="No podrás recuperar este registro" />

        <div id="drawer-new-faq"
            class="drawer fixed right-0 top-0 z-40 h-screen w-[500px] translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black"
            tabindex="-1" aria-labelledby="drawer-new-faq">
            <h5 id="drawer-new-faq-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Nueva pregunta
            </h5>
            <button type="button" data-drawer="#drawer-new-faq"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <form action="{{ route('admin.faq.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data"
                    method="POST" id="formAddFaq">
                    @csrf
                    <div class="w-full">
                        <x-select name="faq_category_id" id="faq_category_id" label="Categoría" :options="$faqCategories->pluck('name', 'id')->toArray()"
                            value="{{ old('faq_category_id') }}" />
                    </div>
                    <div class="w-full">
                        <x-input type="text" name="question" id="question" placeholder="Ingresa la pregunta"
                            icon="question" label="Pregunta" value="{{ old('question') }}" />
                    </div>
                    <div>
                        <x-input type="textarea" name="answer" id="answer" placeholder="Ingresa la respuesta"
                            label="Respuesta" value="{{ old('answer') }}" />
                    </div>
                    <div class="w-full">
                        <x-input type="checkbox" name="active" id="active" label="Activo"
                            value="{{ old('active') }}" />
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <x-button type="submit" text="Agregar pregunta" icon="plus" typeButton="primary" />
                        <x-button type="button" class="close-drawer" data-drawer="#drawer-new-faq" text="Cancelar"
                            typeButton="secondary" />
                    </div>
                </form>
            </div>
        </div>

        <div id="drawer-edit-faq"
            class="drawer fixed right-0 top-0 z-40 h-screen w-[500px] translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black"
            tabindex="-1" aria-labelledby="drawer-edit-faq">
            <h5 id="drawer-edit-faq-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Editar pregunta
            </h5>
            <button type="button" data-drawer="#drawer-edit-faq"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <form action="{{ route('admin.faq.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data"
                    method="POST" id="formEditFaq">
                    @csrf
                    @method('PUT')
                    <div class="w-full">
                        <x-select name="faq_category_id" id="faq_category_id_edit" label="Categoría" :options="$faqCategories->pluck('name', 'id')->toArray()"
                            value="{{ old('faq_category_id') }}" />
                    </div>

                    <div class="w-full">
                        <x-input type="text" name="question" id="question_edit" placeholder="Ingresa la pregunta"
                            icon="question" label="Pregunta" value="{{ old('question') }}" />
                    </div>
                    <div>
                        <x-input type="textarea" name="answer" id="answer_edit" placeholder="Ingresa la respuesta"
                            label="Respuesta" value="{{ old('answer') }}" />
                    </div>
                    <div class="w-full">
                        <x-input type="checkbox" name="active" id="active_edit" label="Activo"
                            value="{{ old('active') }}" />
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <x-button type="submit" text="Editar" icon="edit" typeButton="primary" />
                        <x-button type="button" class="close-drawer" data-drawer="#drawer-edit-faq" icon="cancel"
                            text="Cancelar" typeButton="secondary" />
                    </div>
                </form>
            </div>
        </div>

        <div id="drawer-new-faq-category"
            class="drawer fixed right-0 top-0 z-40 h-screen w-[500px] translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black"
            tabindex="-1" aria-labelledby="drawer-new-faq-category">
            <h5 id="drawer-new-faq-category-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Nueva categoría
            </h5>
            <button type="button" data-drawer="#drawer-new-faq-category"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <div class="rounded-lg border-2 border-dashed border-zinc-400 p-4 dark:border-zinc-800">
                    <h4 class="text-sm font-normal text-zinc-500 dark:text-zinc-400">
                        Categorías ingresadas
                    </h4>
                    <div class="mt-2 flex flex-col gap-1">
                        @foreach ($faqCategories as $category)
                            <span class="flex items-center justify-between text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $category->name }}
                                <form action="{{ route('admin.faq-categories.destroy', $category->id) }}"
                                    id="formDeleteFaqCategory-{{ $category->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="button" onlyIcon="true" size="small" icon="delete"
                                        typeButton="danger" data-modal-target="deleteModalCategory"
                                        data-form="formDeleteFaqCategory-{{ $category->id }}"
                                        data-modal-toggle="deleteModalCategory" class="buttonDelete" />
                                </form>
                            </span>
                        @endforeach
                    </div>
                </div>
                <form action="{{ route('admin.faq-categories.store') }}" class="mt-4 flex flex-col gap-4"
                    method="POST">
                    @csrf
                    <div class="w-full">
                        <x-input type="text" name="name" placeholder="Ingresa el nombre de la categoría"
                            icon="bookmark" label="Nombre" value="{{ old('name') }}" />
                    </div>
                    <div class="w-full">
                        <x-input type="checkbox" name="active" id="active_category" label="Activo"
                            value="{{ old('active') }}" />
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <x-button type="submit" text="Guardar" icon="save" typeButton="primary" />
                        <x-button type="button" class="close-drawer" data-drawer="#drawer-new-faq-category"
                            icon="cancel" text="Cancelar" typeButton="secondary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comprueba si hay errores de validación en la sesión
            @if ($errors->any())
                $("#drawer-new-faq").removeClass("translate-x-full");
                $("#overlay").removeClass("hidden");
            @endif
        });
    </script>
@endsection

@push('scripts')
    @vite('resources/js/admin/faq.js')
    @vite('resources/js/admin/order-table.js')
@endpush
