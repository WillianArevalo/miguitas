@extends('layouts.login-template')
@section('title', 'Miguitas | Inicio de sesión')
@section('content')
    <div class="flex">
        <div class="relative flex h-screen w-full flex-1 items-start justify-center">
            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-40 absolute top-10">
            <img src="{{ asset('img/login-3.jpg') }}" alt="Login background" class="h-full w-full object-cover">
        </div>
        <div class="mx-auto flex flex-1 flex-col items-center justify-center bg-blue-store">
            <h1 class="font-dine-r text-xl font-bold text-light-gray sm:text-2xl md:text-4xl">Inicio de sesión</h1>

            <div class="flex flex-col items-center justify-center">
                <h2 class="mt-2 font-dine-r text-base font-bold text-pink-store sm:text-lg md:text-xl">
                    ¡Bienvenido de nuevo!
                </h2>
                <p class="mt-2 w-2/3 text-center font-dine-r text-xs text-light-gray sm:text-sm md:text-base">
                    Bienvenido al mundo donde se cumplen los deseos de tu mejor amigo peludo.
                </p>
            </div>

            <div class="mt-4 w-4/5 md:w-2/3">
                <form action="{{ Route('login.validate') }}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <x-input-store type="email" name="email" label="Correo electrónico"
                            placeholder="Correo electrónico" icon="email" class="text-white" />
                    </div>
                    <div class="mt-2 flex flex-col">
                        <x-input-store type="password" label="Contraseña" class="text-white" name="password"
                            placeholder="Contraseña" icon="key" />
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        <div class="flex w-full justify-between">
                            <div class="flex items-center gap-2">
                                <input id="remember" type="checkbox"
                                    class="rounded-sm border-pink-store text-light-blue focus:ring-0" name="remember">
                                <label class="text-sm text-white" for="remember">
                                    Recuerdame
                                </label>
                            </div>
                            <a href="#" class="font-dine-r text-white underline">¿Olvidaste tu contraseña?</a>
                        </div>
                        <x-button-store type="submit" text="Iniciar sesión" icon="login" typeButton="tertiary"
                            class="mt-4" />
                        <div>
                            <p class="text-center font-dine-r text-white">
                                O inicia sesión con
                            </p>
                            <div class="mt-4 flex flex-col justify-center gap-4">
                                <a href="{{ Route('auth.google') }}"
                                    class="flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-2 font-pluto-r text-sm text-zinc-500 hover:bg-zinc-200">
                                    <x-icon-store icon="google" class="size-5 text-current" />
                                    Iniciar sesión con Google
                                </a>
                            </div>
                        </div>
                        <p class="font-pluto-r text-white">
                            ¿No tienes una cuenta? <a href="{{ Route('register') }}"
                                class="font-dine-r text-white underline">Regístrate</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
