@extends('layouts.admin-template')
@section('title', 'Políticas')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Políticas',
            'description' => 'Administrar las políticas de la plataforma',
        ])
        <div class="flex flex-col items-start border-b px-4 py-4 shadow-sm dark:border-zinc-800 dark:bg-black">
            <p class="text-sm text-zinc-700 dark:text-zinc-400">
                Administra:
            </p>
            <ul class="mt-2 flex flex-col gap-2 text-sm text-zinc-700 dark:text-zinc-400">
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Condiciones de uso
                </li>
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Políticas de privacidad
                </li>
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Garantías y cambios
                </li>
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Políticas de envío
                </li>
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Política de Reversión de pagos y Derecho de retracto
                </li>
                <li class="flex items-center gap-2">
                    <span class="block h-2 w-2 rounded-full bg-blue-500"></span>
                    Restricciones y Políticas de Promociones
                </li>
            </ul>
        </div>
        <div class="bg-zinc-50 dark:bg-black">
            <div class="mx-auto w-full">
                <div class="relative bg-white shadow-md dark:bg-black">
                    <div
                        class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                        <div class="w-full md:w-1/2">
                            <div class="flex items-center">
                                <x-input type="text" id="inputPolicies" placeholder="Buscar" icon="search" />
                            </div>
                        </div>
                        <div
                            class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                            <x-button data-drawer="#drawer-new-policie" class="open-drawer" type="button"
                                text="Nueva política" icon="plus" typeButton="primary" />
                        </div>
                    </div>
                    <div class="px-4 pb-4">
                        <x-table id="tablePolicies">
                            <x-slot name="thead">
                                <x-tr>
                                    <x-th class="w-10">
                                        <input id="default-checkbox" type="checkbox" value=""
                                            class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-blue-600">
                                    </x-th>
                                    <x-th>
                                        Nombre
                                    </x-th>
                                    <x-th>
                                        Imágenes
                                    </x-th>
                                    <x-th last="true">
                                        Acciones
                                    </x-th>
                                </x-tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @if ($policies->count() > 0)
                                    @foreach ($policies as $policy)
                                        <x-tr>
                                            <x-td>
                                                <input id="default-checkbox" type="checkbox" value="{{ $policy->id }}"
                                                    class="h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-blue-600">
                                            </x-td>
                                            <x-td>
                                                <span>{{ $policy->name }}</span>
                                            </x-td>
                                            <x-td>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($policy->images as $image)
                                                        <img src="{{ Storage::url($image->file_path) }}" alt="Preview Image"
                                                            class="main-image h-20 w-20 cursor-pointer rounded-lg object-cover">
                                                    @endforeach
                                                </div>
                                            </x-td>
                                            <x-td>
                                                <div class="flex gap-2">
                                                    <form action="{{ route('admin.policies.destroy', $policy->id) }}"
                                                        id="formDeletePolicie-{{ $policy->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button type="button"
                                                            data-form="formDeletePolicie-{{ $policy->id }}"
                                                            onlyIcon="true" icon="delete" typeButton="danger"
                                                            class="buttonDelete" />
                                                    </form>
                                                    <x-button type="a"
                                                        href="{{ Route('admin.policies.show', $policy->id) }}"
                                                        target="_blank" onlyIcon="true" icon="view"
                                                        typeButton="secondary" />
                                                    <x-button type="a"
                                                        href="{{ Route('admin.policies.download', $policy->id) }}"
                                                        onlyIcon="true" icon="import" typeButton="success" />
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @else
                                    <x-tr>
                                        <x-td class="text-center" colspan="4">
                                            No hay políticas registradas
                                        </x-td>
                                    </x-tr>
                                @endif
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>

        <x-delete-modal modalId="deleteModal" title="¿Estás seguro de eliminar la política?"
            message="No podrás recuperar este registro" action="" />

        <div id="drawer-new-policie"
            class="drawer fixed right-0 top-0 z-40 h-screen w-[500px] translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-black"
            tabindex="-1" aria-labelledby="drawer-new-policie">
            <h5 id="drawer-new-policie-label"
                class="mb-4 inline-flex items-center text-base font-semibold text-zinc-500 dark:text-zinc-400">
                Nueva política
            </h5>
            <button type="button" data-drawer="#drawer-new-policie"
                class="close-drawer absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div>
                <form action="{{ route('admin.policies.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data"
                    method="POST" id="formAddCategorie">
                    @csrf
                    <div class="w-full">
                        <x-input type="text" name="name" placeholder="Ingresa el nombre de la política"
                            label="Nombre" value="{{ old('name') }}" />
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
                            Imagen
                        </label>
                        <div class="flex w-full items-center justify-center">
                            <label for="file-policie"
                                class="dark:hover:bg-bray-800 @error('image') is-invalid  @enderror flex h-80 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-400 bg-zinc-50 hover:border-primary-400 hover:bg-zinc-100 dark:border-zinc-600 dark:bg-transparent dark:hover:border-primary-950 dark:hover:bg-zinc-950">
                                <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                    <x-icon icon="cloud-upload" class="h-12 w-12 text-zinc-400 dark:text-zinc-500" />
                                    <p class="mb-2 text-sm text-zinc-500 dark:text-zinc-400"><span
                                            class="font-semibold">Clic para agregar </span> o desliza la imagen</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">PNG, JPG, WEBP</p>
                                </div>
                                <input id="file-policie" type="file" class="hidden" name="file_path[]"
                                    accept="image/*,pdf" multiple />
                                <div id="preview-images" class="flex flex-wrap gap-4">
                                </div>
                            </label>
                        </div>
                        @error('file_path')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <x-button type="submit" text="Agregar política" icon="plus" typeButton="primary" />
                        <x-button type="button" data-drawer="#drawer-new-policie" class="close-drawer" text="Cancelar"
                            typeButton="secondary" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-image" class="relative">
        <button type="button"
            class="close absolute right-0 m-10 rounded-lg bg-zinc-200 p-2 hover:bg-zinc-300 dark:bg-zinc-900 dark:hover:bg-zinc-800"
            id="close-modal">
            <x-icon icon="x" class="h-5 w-5 text-black dark:text-white" />
        </button>
        <div class="flex h-full items-center justify-center" id="container-modal-image">
            <img class="block h-72 w-96 animate-jump-in rounded-xl object-contain animate-duration-300 md:h-4/5 md:w-2/5"
                id="image-modal" src="{{ asset('images/photo.jpg') }}" />
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/admin/policies.js')
    @vite('resources/js/admin/modal-image.js')
    @vite('resources/js/admin/order-table.js')
@endpush
