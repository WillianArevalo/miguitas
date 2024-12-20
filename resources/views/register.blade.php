@extends('layouts.login-template')
@section('title', 'Miguitas | Registro')
@section('content')
    <div class="flex flex-row-reverse">
        <div class="hidden h-screen w-full flex-1 items-start justify-center sm:flex">
            <img src="{{ asset('img/register-2.jpg') }}" alt="Login background" class="h-full w-full object-cover">
        </div>
        <div class="mx-auto flex h-screen flex-[2] flex-col items-center justify-center bg-blue-store lg:flex-1">
            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-14 mb-4 block">
            <h1 class="font-dine-r text-3xl font-bold text-light-gray sm:text-3xl md:text-4xl">
                Bienvenido a Miguitas
            </h1>
            <div class="flex flex-col items-center justify-center">
                <p class="mt-2 w-2/3 text-center font-dine-r text-sm text-light-gray md:text-base">
                    Registrate y cumple los antojos de tu mascota con los mejores productos de la región.
                </p>
            </div>
            <div class="mt-4 w-4/5 xl:w-2/3">
                <div>
                    <div class="mt-4 flex flex-col justify-center gap-4">
                        <a href="{{ Route('auth.google') }}"
                            class="flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3 font-dine-r text-sm text-zinc-500 hover:bg-zinc-200">
                            <x-icon-store icon="google" class="size-5 text-current" />
                            Registrate con Google
                        </a>
                    </div>
                </div>

                <p class="mt-4 text-center font-dine-r text-white">
                    O continua con tu correo electrónico
                </p>

                <form action="{{ Route('register.post') }}" method="POST">
                    @csrf
                    <div class="mt-2 flex flex-col gap-1">
                        <label for="email" class="text-start text-sm font-medium text-white md:text-base">
                            Correo electrónico
                        </label>
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <x-icon-store icon="email" class="size-4 sm:size-5 text-white" />
                            </div>
                            <input type="email" name="email" id="email" placeholder="email@example.com"
                                class="w-full rounded-xl border-2 border-white bg-transparent px-6 py-3 pl-12 text-sm text-zinc-200 transition duration-300 placeholder:font-dine-r placeholder:font-normal placeholder:text-zinc-100/70 focus:border-white focus:outline-none md:text-base" />
                            @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col gap-1">
                        <label for="password" class="text-start text-sm font-medium text-white md:text-base">
                            Contraseña
                        </label>
                        <div class="relative w-full">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                <x-icon-store icon="key" class="size-4 sm:size-5 text-white" />
                            </div>
                            <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña"
                                class="w-full rounded-xl border-2 border-white bg-transparent px-6 py-3 pl-12 text-sm text-zinc-200 transition duration-300 placeholder:font-dine-r placeholder:font-normal placeholder:text-zinc-100/70 focus:border-white focus:outline-none md:text-base" />
                            @error('password')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        <x-button-store type="submit" text="Registrarse" typeButton="tertiary" class="mt-4" />
                        <p class="font-dine-r text-white">
                            ¿Ya tienes una cuenta? <a href="{{ Route('login') }}" class="font-dine-r text-white underline">
                                Inicia sesión
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/register.js')
@endpush
