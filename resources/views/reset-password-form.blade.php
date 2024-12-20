@extends('layouts.login-template')
@section('title', 'Miguitas | Reestablecer contraseña')
@section('content')
    <div class="flex flex-row-reverse">
        <div class="hidden h-screen w-full flex-1 items-start justify-center sm:flex">
            <img src="{{ asset('img/bg-email-verified.jpg') }}" alt="Login background" class="h-full w-full object-cover">
        </div>
        <div class="mx-auto flex h-screen flex-[2] flex-col items-center justify-center bg-white lg:flex-1">
            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-24 mb-4 block">
            <h1 class="font-dine-r text-3xl font-bold text-blue-store sm:text-3xl md:text-4xl">
                Reestablecer contraseña
            </h1>
            <div class="mt-4 w-4/5 xl:w-2/3">
                <form action="{{ Route('password.change.post') }}" method="POST" id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="token_password" value="{{ $token }}">
                    <div class="flex flex-col gap-2">
                        <x-input-store type="password" id="new-password" name="new-password" label="Nueva contraseña"
                            placeholder="Ingresa la nueva contraseña" class="text-zinc-800" icon="key" />
                        <div id="password-strength-container" class="mt-2 h-2 w-full rounded bg-gray-200">
                            <div id="password-strength-bar" class="h-full w-0 rounded bg-red-500"></div>
                        </div>
                        <ul id="password-requirements" class="mt-2 list-disc pl-5 text-xs text-red-500"></ul>
                    </div>
                    <div class="mt-4 flex flex-col gap-2">
                        <x-input-store type="password" id="confirm-password" name="confirm-password"
                            label="Confirma contraseña" icon="key" placeholder="Confirma la contraseña"
                            class="text-zinc-800" />
                        <p id="password-match-message" class="text-xs text-red-500"></p>
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        <x-button-store type="button" text="Reestablecer contraseña" typeButton="primary" class="mt-4"
                            id="resetPasswordButton" />
                        <a href="{{ Route('home') }}" class="mt-8 font-pluto-r text-white underline">
                            Regresar a Miguitas
                        </a>
                    </div>
                </form>
            </div>
        </div>
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
                                <p class="font-dine-r text-sm text-gray-500">
                                    La contraseña se ha actualizado correctamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-4 bg-gray-50 px-4 py-3">
                    <x-button-store type="a" href="{{ Route('login') }}" text="Aceptar" icon="check"
                        class="confirmDelete w-max text-sm" typeButton="primary" />
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/store/password.js')
@endpush
