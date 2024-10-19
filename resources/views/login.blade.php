@extends('layouts.template')
@section('title', 'Miguitas | Inicio de sesión')
@section('content')
    <div class="m-0 md:p-4 lg:mx-10 lg:mb-10">
        <div class="relative mx-auto flex h-full w-full flex-col overflow-hidden border md:flex-row xl:w-4/5">

            <div class="absolute left-5 top-4 h-2 w-full bg-white md:left-10 md:top-8"></div>
            <div class="absolute bottom-4 right-5 h-2 w-full bg-white md:bottom-8 md:right-10"></div>
            <div class="absolute left-5 top-4 h-full w-2 bg-white md:left-10 md:top-8"></div>
            <div class="absolute bottom-4 right-5 h-full w-2 bg-white md:bottom-8 md:right-10"></div>

            <div class="flex flex-1 flex-col items-center justify-center gap-2 bg-light-pink py-10 md:pe-10 md:ps-20">
                <h2 class="pt-10 text-center text-xl font-semibold text-dark-pink md:pt-0 md:text-2xl">
                    ¡Bienvenido de nuevo!
                </h2>
                <p class="w-1/2 text-center text-sm text-dark-blue md:w-full md:text-base">
                    Bienvenido al mundo donde se cumplen los deseos de tu mejor amigo peludo
                </p>
            </div>
            <div class="flex flex-[2] flex-col items-center justify-center bg-light-blue py-20 md:pe-10">
                <h1 class="dine-r text-xl font-bold text-light-gray sm:text-2xl md:text-4xl">Inicio de sesión</h1>
                <div class="my-4 flex items-center justify-center gap-4">
                    <a href="#">
                        <x-icon-store icon="facebook" class="h-8 w-8 text-white" />
                    </a>
                    <a href="#">
                        <x-icon-store icon="google" class="h-8 w-8 text-white" />
                    </a>
                    <a href="#">
                        <x-icon-store icon="linkedin" class="h-8 w-8 text-white" />
                    </a>
                </div>
                <div class="mt-4 w-4/5 md:w-2/3">
                    <form action="{{ Route('login.validate') }}" method="POST">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <x-input-store type="email" name="email" placeholder="Correo electrónico" icon="email" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <x-input-store type="password" name="password" placeholder="Contraseña" icon="key" />
                        </div>
                        <div class="mt-4 flex flex-col items-center justify-center gap-4">
                            <a href="#" class="dine-r text-white underline">¿Olvidaste tu contraseña?</a>
                            <x-button-store type="submit" text="Iniciar sesión" icon="login" typeButton="primary" />
                            <p class="pluto-r text-white">
                                ¿No tienes una cuenta? <a href="{{ Route('register') }}"
                                    class="dine-r text-white underline">Regístrate</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
