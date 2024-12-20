@extends('layouts.login-template')
@section('title', 'Miguitas | Inicio de sesión')
@section('content')
    <div class="flex">
        <div class="relative hidden h-screen w-full flex-1 items-start justify-center sm:flex">
            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-40 absolute top-10">
            <img src="{{ asset('img/login-3.jpg') }}" alt="Login background" class="h-full w-full object-cover">
        </div>
        <div class="mx-auto flex h-screen flex-[2] flex-col items-center justify-center bg-blue-store lg:flex-1">

            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-14 mb-4 block sm:hidden">

            <h1 class="font-dine-r text-3xl font-bold text-light-gray sm:text-3xl md:text-4xl">Inicio de sesión</h1>
            <div class="flex flex-col items-center justify-center">
                <h2 class="mt-2 font-dine-r text-base font-bold text-pink-store sm:text-lg md:text-xl">
                    ¡Bienvenido de nuevo!
                </h2>
                <p class="mt-2 w-2/3 text-center font-dine-r text-sm text-light-gray md:text-base">
                    Bienvenido al mundo donde se cumplen los deseos de tu mejor amigo peludo.
                </p>
            </div>

            <div class="mt-4 w-4/5 xl:w-2/3">
                <form action="{{ Route('login.validate') }}" method="POST">
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
                                class="w-full rounded-xl border-2 border-white bg-transparent px-6 py-3 pl-12 text-sm text-white transition duration-300 placeholder:font-dine-r placeholder:font-normal placeholder:text-zinc-100/70 focus:border-white focus:outline-none md:text-base" />
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
                                class="w-full rounded-xl border-2 border-white bg-transparent px-6 py-3 pl-12 text-sm text-white transition duration-300 placeholder:font-dine-r placeholder:font-normal placeholder:text-zinc-100/70 focus:border-white focus:outline-none md:text-base" />
                            @error('password')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        <div class="flex w-full flex-col justify-between sm:flex-row">
                            <div class="mb-4 flex items-center">
                                <input id="remember" type="checkbox" value=""
                                    class="h-4 w-4 rounded border-white bg-white text-light-blue focus:ring-2 focus:ring-light-blue">
                                <label for="remember" class="ms-2 text-sm font-medium text-zinc-100">
                                    Recuerdame
                                </label>
                            </div>
                            <a href="{{ Route('password.reset') }}" class="font-dine-r text-white underline">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                        <x-button-store type="submit" text="Iniciar sesión" icon="login" typeButton="tertiary"
                            class="mt-4" />
                        <div>
                            <p class="text-center font-dine-r text-white">
                                O inicia sesión con
                            </p>
                            <div class="mt-4 flex flex-col justify-center gap-4">
                                <a href="{{ Route('auth.google') }}"
                                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-2 font-dine-r text-sm text-zinc-500 hover:bg-zinc-200">
                                    <x-icon-store icon="google" class="size-5 text-current" />
                                    Iniciar sesión con Google
                                </a>
                            </div>
                        </div>
                        <p class="font-dine-r text-white">
                            ¿No tienes una cuenta? <a href="{{ Route('register') }}"
                                class="font-dine-r text-pink-store hover:underline">Regístrate</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
