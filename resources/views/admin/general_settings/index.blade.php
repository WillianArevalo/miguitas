@extends('layouts.admin-template')
@section('title', 'Ajustes generales')
@section('content')
    <div>
        @include('layouts.__partials.admin.header-page', [
            'title' => 'Ajustes',
            'description' => 'Configura los ajustes generales de la aplicación',
        ])
        <div class="m-4 dark:bg-black">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="tab-configurations"
                    data-tabs-toggle="#tab-configurations-content"
                    data-tabs-active-classes="text-primary-600 hover:text-primary-600 dark:text-primary-500 dark:hover:text-primary-500 border-primary-600 dark:border-primary-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block rounded-t-lg border-b-2 p-4" id="profile-styled-tab"
                            data-tabs-target="#settings-generales" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">
                            Información general
                        </button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block rounded-t-lg border-b-2 p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                            id="dashboard-styled-tab" data-tabs-target="#settings-store" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">
                            Configuraciones de la tienda
                        </button>
                    </li>
                </ul>
            </div>
            <div id="tab-configurations-content">
                <div class="hidden" id="settings-generales" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mt-4">
                        <form action="{{ Route('admin.general-settings.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <h2 class="mb-2 text-xl font-semibold text-zinc-800 dark:text-zinc-100">
                                    Tienda
                                </h2>
                                <div class="flex flex-col gap-4 lg:flex-row">
                                    <div class="flex-1">
                                        <div class="flex gap-4">
                                            <div class="flex flex-1 flex-col">
                                                <x-input type="text" name="store_name"
                                                    placeholder="Ingresa el nombre de la tienda"
                                                    value="{{ $settings->where('key', 'store_name')->first()->value ?? '' }}"
                                                    label="Nombre de la tienda" />
                                            </div>
                                        </div>
                                        <div class="mt-4 flex">
                                            <div class="flex flex-1 flex-col">
                                                <x-input type="textarea" name="store_description"
                                                    placeholder="Ingresa la descripción de la tienda"
                                                    label="Descripción de la tienda"
                                                    value="{{ $settings->where('key', 'store_description')->first()->value ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="mt-4 flex">
                                            <div class="flex flex-1 flex-col">
                                                <x-input type="text" name="store_url"
                                                    placeholder="Ingresa la URL de la tienda" label="URL de la tienda"
                                                    icon="link"
                                                    value="{{ $settings->where('key', 'store_url')->first()->value ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="mt-4 flex">
                                            <div class="flex flex-1 flex-col">
                                                <x-input type="text" name="store_map_location"
                                                    placeholder="Ingresa la ubicación de la tienda en Google Maps"
                                                    label="Ubicación de la tienda en Google Maps" icon="map"
                                                    value="{{ $settings->where('key', 'store_map_location')->first()->value ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col gap-4 sm:flex-row">
                                            <div class="flex-1">
                                                <label class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
                                                    Logo de la tienda
                                                </label>
                                                <div class="flex w-full items-center justify-center">
                                                    <label for="logo"
                                                        class="dark:hover:bg-bray-800 @error('image') is-invalid  @enderror flex h-60 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-400 bg-zinc-50 hover:border-zinc-500 hover:bg-zinc-100 dark:border-zinc-600 dark:bg-transparent dark:hover:border-zinc-700 dark:hover:bg-zinc-950">
                                                        @if ($settings->where('key', 'store_logo')->first()->value)
                                                            <img src="{{ Storage::url($settings->where('key', 'store_logo')->first()->value) }}"
                                                                alt="Preview Image" id="logo-preview"
                                                                class="m-10 h-64 w-56 rounded-xl object-cover">
                                                        @else
                                                            <div
                                                                class="flex flex-col items-center justify-center pb-6 pt-5">
                                                                <x-icon icon="cloud-upload"
                                                                    class="h-12 w-12 text-zinc-400 dark:text-zinc-500" />
                                                            </div>
                                                        @endif
                                                        <input id="logo" type="file" class="hidden"
                                                            name="store_logo" accept="image/*" />
                                                        <img alt="Preview Image" id="logo-preview"
                                                            class="m-10 hidden h-64 w-56 rounded-xl object-cover">
                                                    </label>
                                                </div>
                                                @error('image')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="flex-1">
                                                <label for="image"
                                                    class="mb-2 block text-sm font-medium text-zinc-900 dark:text-white">
                                                    Favicon de la tienda
                                                </label>
                                                <div class="flex w-full items-center justify-center">
                                                    <label for="favicon"
                                                        class="dark:hover:bg-bray-800 @error('image') is-invalid  @enderror flex h-60 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-zinc-400 bg-zinc-50 hover:border-zinc-500 hover:bg-zinc-100 dark:border-zinc-600 dark:bg-transparent dark:hover:border-zinc-700 dark:hover:bg-zinc-950">
                                                        @if ($settings->where('key', 'store_favicon')->first()->value)
                                                            <img src="{{ Storage::url($settings->where('key', 'store_favicon')->first()->value) }}"
                                                                alt="Preview Image" id="favicon-preview"
                                                                class="m-10 h-64 w-56 rounded-xl object-cover">
                                                        @else
                                                            <div
                                                                class="flex flex-col items-center justify-center pb-6 pt-5">
                                                                <x-icon icon="cloud-upload"
                                                                    class="h-12 w-12 text-zinc-400 dark:text-zinc-500" />
                                                            </div>
                                                        @endif
                                                        <input id="favicon" type="file" class="hidden"
                                                            name="store_favicon" accept=".ico" />
                                                        <img src="" alt="Preview Image" id="favicon-preview"
                                                            class="m-10 hidden h-64 w-56 rounded-xl object-cover">
                                                    </label>
                                                </div>
                                                @error('image')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-zinc-800 dark:text-zinc-100">
                                    Contacto
                                </h2>
                                <div class="mt-2">
                                    <div class="flex gap-4">
                                        <div class="flex flex-1 flex-col">
                                            <x-input type="text" name="store_address"
                                                placeholder="Ingresa la dirección de la tienda"
                                                value="{{ $settings->where('key', 'store_address')->first()->value ?? '' }}"
                                                label="Dirección de la tienda" icon="location" />
                                        </div>
                                    </div>
                                    <div class="mt-4 flex flex-col gap-4 sm:flex-row">
                                        <div class="flex flex-1 flex-col">
                                            <x-input type="text" name="store_email"
                                                placeholder="Ingresa el correo electrónico de contacto"
                                                value="{{ $settings->where('key', 'store_email')->first()->value ?? '' }}"
                                                label="Correo electrónico" icon="mail" />
                                        </div>
                                        <div class="flex flex-1 flex-col">
                                            <x-input type="text" name="store_phone"
                                                placeholder="Ingresa el número de teléfono de contacto"
                                                value="{{ $settings->where('key', 'store_phone')->first()->value ?? '' }}"
                                                label="Teléfono de contacto" icon="phone" />
                                        </div>
                                    </div>
                                    <div class="mt-4 flex gap-4">
                                        <div class="flex flex-1 flex-col">
                                            <x-input type="text" name="store_whatsapp"
                                                placeholder="Ingresa el número de WhatsApp de contacto"
                                                value="{{ $settings->where('key', 'store_whatsapp')->first()->value ?? '' }}"
                                                label="WhatsApp de contacto" icon="whatsapp" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-start">
                                <x-button type="submit" text="Guardar datos" icon="save" typeButton="primary"
                                    class="w-full sm:w-max" />
                            </div>
                        </form>

                        <div class="mt-4">
                            <x-paragraph>Redes sociales</x-paragraph>
                            <div class="mt-4 flex gap-4">
                                @if ($socialLinks->count() > 0)
                                    @foreach ($socialLinks as $socialLink)
                                        @php
                                            $colorMap = [
                                                'facebook' => 'blue',
                                                'instagram' => 'pink',
                                                'whatsapp' => 'green',
                                            ];
                                        @endphp
                                        <a href="{{ $socialLink->url }}"
                                            class="rounded-lg border border-zinc-400 p-4 dark:border-zinc-800 dark:hover:bg-zinc-950">
                                            <x-icon icon="{{ $socialLink->network_name }}"
                                                class="text-{{ $colorMap[$socialLink->network_name] }}-600 h-6 w-6" />
                                        </a>
                                    @endforeach
                                    <button type="button" data-modal-target="addSocialNetwork"
                                        data-modal-toggle="addSocialNetwork"
                                        class="rounded-lg border border-zinc-400 p-4 dark:border-zinc-800 dark:hover:bg-zinc-950">
                                        <x-icon icon="plus" class="h-6 w-6 text-zinc-800 dark:text-zinc-400" />
                                    </button>
                                @endif
                                @if ($socialLinks->count() === 0)
                                    <button type="button" data-modal-target="addSocialNetwork"
                                        data-modal-toggle="addSocialNetwork"
                                        class="rounded-lg border border-zinc-400 p-4 dark:border-zinc-800 dark:hover:bg-zinc-950">
                                        <x-icon icon="plus" class="h-6 w-6 text-zinc-800 dark:text-zinc-400" />
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="hidden" id="settings-store" role="tabpanel" aria-labelledby="dashboard-tab">
                    <h2 class="text-secondary text-xl font-semibold dark:text-blue-400">Configuraciones</h2>
                    <div class="flex gap-4">
                        <div
                            class="mt-4 flex h-max w-max flex-col gap-4 rounded-lg border border-zinc-400 p-4 dark:border-zinc-800">
                            <div>
                                <h3 class="text-zinc-700 dark:text-zinc-300">Modo mantenimiento</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">Activa o desactiva el modo
                                    mantenimiento
                                </p>
                                <form action="{{ Route('admin.general-settings.maintenance.update') }}" method="POST">
                                    @csrf
                                    <label class="mt-2 inline-flex cursor-pointer items-center">
                                        <input type="checkbox" name="site_in_maintenance" id="site_in_maintenance"
                                            value="{{ $maintenance->value ?? 0 }}" class="peer sr-only"
                                            {{ $maintenance->value == 1 ? 'checked' : '' }}>
                                        <div
                                            class="peer relative h-6 w-11 rounded-full bg-zinc-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-zinc-400 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rtl:peer-checked:after:-translate-x-full dark:border-zinc-600 dark:bg-zinc-700 dark:peer-focus:ring-blue-800">
                                        </div>
                                        <span class="ms-3 text-sm font-medium text-zinc-900 dark:text-zinc-300">
                                            Activado
                                        </span>
                                    </label>
                                </form>
                                <x-button type="a" text="Ver página en mantimiento" icon="view"
                                    typeButton="secondary" class="mt-2 w-max" />
                            </div>
                        </div>
                        <div
                            class="mt-4 flex h-max w-max flex-col gap-4 rounded-lg border border-zinc-400 p-4 dark:border-zinc-800">
                            <div>
                                <h3 class="text-zinc-700 dark:text-zinc-300">Idiomas</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Configura los idiomas disponibles en la aplicación
                                </p>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Idiomas agregados:
                                </p>
                                <div class="mt-2 flex gap-2">
                                    <span
                                        class="me-2 rounded bg-blue-100 px-2.5 py-0.5 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        Español
                                    </span>
                                    <span
                                        class="me-2 rounded bg-blue-100 px-2.5 py-0.5 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        Inglés
                                    </span>
                                </div>
                                <x-button type="a" text="Agregar idioma" icon="plus" typeButton="primary"
                                    class="mt-4 w-max" />
                            </div>
                        </div>
                        <div
                            class="mt-4 flex h-max w-max flex-col gap-4 rounded-lg border border-zinc-400 p-4 dark:border-zinc-800">
                            <div>
                                <h3 class="text-zinc-700 dark:text-zinc-300">Cookies</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Configura las cookies de la aplicación
                                </p>
                                <div class="mt-2 flex flex-col gap-2">
                                    <x-button type="button" text="Ver cookies" icon="view" typeButton="secondary"
                                        class="w-max" id="view-cookies" />
                                    <x-button type="a" text="Configurar cookies" icon="settings"
                                        typeButton="primary" class="w-max" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="rounded-lg border border-zinc-400 p-4 dark:border-zinc-800">
                            <h3 class="text-zinc-700 dark:text-zinc-300">Footer</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                Configura el contenido del footer de la aplicación
                            </p>
                            <div class="mt-4">
                                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                    Contenido actual:
                                </p>
                                @include('layouts.__partials.store.footer')
                            </div>
                            <x-button type="a" text="Editar footer" icon="edit" typeButton="primary"
                                class="mt-4 w-max" />
                        </div>
                        <div class="mt-4 rounded-lg border border-zinc-400 p-4 dark:border-zinc-800">
                            <h3 class="text-zinc-700 dark:text-zinc-300">
                                Menú de navegación
                            </h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                Configura el contenido del menú de navegación de la aplicación
                            </p>
                            <div class="mt-4">
                                <p class="mb-2 text-sm text-zinc-600 dark:text-zinc-400">
                                    Contenido actual:
                                </p>
                                @include('layouts.__partials.store.navbar')
                            </div>
                            <x-button type="a" text="Editar menú de navegación" icon="edit"
                                typeButton="primary" class="mt-4 w-max" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar red social -->
    <div id="addSocialNetwork" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-[100] hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-90 md:inset-0">
        <div class="relative h-full w-full max-w-md p-4 md:h-auto">
            <!-- Modal content -->
            <div
                class="relative animate-jump-in rounded-lg bg-white p-4 shadow animate-duration-300 dark:bg-zinc-950 sm:p-5">
                <!-- Modal header -->
                <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 dark:border-zinc-800 sm:mb-5">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                        Agregar red social
                    </h3>
                    <button type="button"
                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-zinc-900 dark:hover:bg-zinc-900 dark:hover:text-white"
                        data-modal-toggle="addSocialNetwork">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('admin.social-networks.store') }}" id="formAddSocialNetwork" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4">
                        <div>
                            <x-select name="network_name" label="Red social" id="network_name" required
                                :options="[
                                    'facebook' => 'Facebook',
                                    'twitter' => 'Twitter',
                                    'instagram' => 'Instagram',
                                    'whatsapp' => 'WhatsApp',
                                ]" />
                        </div>
                        <div>
                            <x-input label="URL" name="store_social_network_url" data-message="#message-url"
                                placeholder="Escribe la URL de la red social" icon="link" required="required"
                                type="text" />
                            <span class="invalid-feedback hidden text-sm text-red-500" id="message-url"></span>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <x-button type="submit" text="Agregar" icon="plus" typeButton="primary" />
                        <x-button type="button" data-modal-toggle="addSocialNetwork" text="Cancelar"
                            typeButton="secondary" />
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    @vite('resources/js/admin/general-settings.js')
@endpush
