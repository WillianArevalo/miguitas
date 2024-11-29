@extends('layouts.login-template')
@section('title', 'Cambiar contraseña')
@section('content')
    <div class="py- flex h-screen items-center justify-center bg-blue-store">
        <section class="z-10 mx-4 w-full rounded-3xl bg-white p-4 py-10 sm:w-9/12 md:w-1/2 lg:w-1/2 xl:w-4/12">
            <div class="text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="size-20 mx-auto">
                <h1 class="mt-4 font-pluto-r text-2xl font-bold text-blue-store">Cambiar contraseña</h1>
            </div>
            <form action="{{ Route('account.edit-password') }}" method="POST"
                class="mx-auto mt-4 flex w-[90%] flex-col gap-4 md:w-3/4" id="formChangePassword">
                @csrf
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="password" name="password" label="Contraseña actual"
                        placeholder="Ingresa tu contraseña actual" class="text-zinc-800" icon="key" />
                    <p id="password-error-message" class="text-xs text-red-500"></p>
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="new-password" name="new-password" label="Nueva contraseña"
                        placeholder="Ingresa la nueva contraseña" class="text-zinc-800" icon="key" />
                    <div id="password-strength-container" class="mt-2 h-2 w-full rounded bg-gray-200">
                        <div id="password-strength-bar" class="h-full w-0 rounded bg-red-500"></div>
                    </div>
                    <ul id="password-requirements" class="mt-2 list-disc pl-5 text-xs text-red-500"></ul>
                </div>
                <div class="flex flex-col gap-2">
                    <x-input-store type="password" id="confirm-password" name="confirm-password" label="Confirma contraseña"
                        icon="key" placeholder="Confirma la contraseña" class="text-zinc-800" />
                    <p id="password-match-message" class="text-xs text-red-500"></p>
                </div>
                <div class="flex items-center justify-center">
                    <x-button-store typeButton="primary" type="button" id="changePasswordButton" text="Cambiar contraseña"
                        class="font-medium" icon="reset-password" />
                </div>
            </form>
        </section>
    </div>

    <div class="confirmPasswordModal fixed inset-0 z-50 hidden items-center justify-center bg-zinc-800 bg-opacity-75 transition-opacity"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
            <div class="inline-block transform animate-jump-in overflow-hidden rounded-xl bg-white text-left align-bottom shadow-xl transition-all animate-duration-300 animate-once sm:my-8 sm:w-full sm:max-w-lg sm:align-middle"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <x-icon-store icon="circle-check" class="h-6 w-6 text-green-600" />
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                Contraseña cambiada
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    La contraseña se ha actualizado correctamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <x-button-store type="a" href="{{ Route('account.index') }}" text="Aceptar" icon="check"
                        class="confirmDelete w-max text-sm" typeButton="primary" />
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/password.js')
@endpush
