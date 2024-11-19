@extends('layouts.template')
@section('title', 'Miguitas | Registro')
@section('content')
    <div class="m-0 md:p-4 lg:mx-10 lg:mb-10">
        <div class="relative mx-auto flex h-full w-full flex-col-reverse overflow-hidden border md:flex-row xl:w-4/5">

            <div class="absolute left-5 top-4 h-2 w-full bg-white md:left-10 md:top-8"></div>
            <div class="absolute bottom-4 right-5 h-2 w-full bg-white md:bottom-8 md:right-10"></div>
            <div class="absolute left-5 top-4 h-full w-2 bg-white md:left-10 md:top-8"></div>
            <div class="absolute bottom-4 right-5 h-full w-2 bg-white md:bottom-8 md:right-10"></div>

            <div class="flex flex-[2] flex-col items-center justify-center bg-light-blue py-20 md:ps-10">
                <h1
                    class="flex flex-col items-center justify-center font-dine-r text-xl font-bold text-light-gray sm:text-2xl md:text-4xl">
                    Bienvenido a Miguitas
                    <span class="mt-2 text-sm text-white">
                        Crear una cuenta
                    </span>
                </h1>
                <div class="my-4 flex items-center justify-center gap-4">
                    <a href="">
                        <x-icon-store icon="facebook" class="h-8 w-8 text-white" />
                    </a>
                    <a href="{{ Route('auth.google') }}">
                        <x-icon-store icon="google" class="h-8 w-8 text-white" />
                    </a>
                    <a href="#">
                        <x-icon-store icon="linkedin" class="h-8 w-8 text-white" />
                    </a>
                </div>
                <div class="mt-4 w-4/5">
                    <form action="{{ Route('register.post') }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <div class="flex flex-col gap-2">
                                <x-input-store type="text" name="name" placeholder="Nombre" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <x-input-store type="text" name="last_name" placeholder="Apellido" />
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <x-input-store type="email" name="email" placeholder="Correo eletrónico" icon="email" />
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col gap-2">
                                <x-input-store type="password" name="password" placeholder="Contraseña" icon="key" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <x-input-store type="password" name="password" placeholder="Confirmar" />
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col items-center justify-center gap-4">
                            <x-button-store type="submit" text="Registrarse" typeButton="primary" />
                            <p class="font-pluto-r text-white">
                                ¿Ya tienes una cuenta?
                                <a href="{{ Route('login') }}" class="font-dine-r text-white underline">
                                    Iniciar sesión
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>


            <div class="flex flex-1 flex-col items-center justify-center gap-2 bg-light-pink py-10 md:pe-20 md:ps-10">
                <h2 class="pt-10 text-center text-xl font-semibold text-dark-pink md:pt-0 md:text-2xl">
                    ¡Hola amig@!
                </h2>
                <p class="w-1/2 text-center text-sm text-dark-blue md:w-full md:text-base">
                    Registrate y cumple los antojos de tu mascota con los mejores productos de la región.
                </p>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/register.js')
@endpush
