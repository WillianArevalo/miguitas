@extends('layouts.login-template')
@section('title', 'Miguitas | Reestablecer contraseña')
@section('content')
    <div class="flex flex-row-reverse">
        <div class="hidden h-screen w-full flex-1 items-start justify-center sm:flex">
            <img src="{{ asset('img/bg-email-verified.jpg') }}" alt="Login background" class="h-full w-full object-cover">
        </div>
        <div class="mx-auto flex h-screen flex-[2] flex-col items-center justify-center bg-blue-store lg:flex-1">
            <img alt="login-logo" src="{{ asset('img/logo.png') }}" class="size-24 mb-4 block">
            <h1 class="font-dine-r text-3xl font-bold text-light-gray sm:text-3xl md:text-4xl">
                Restablecer contraseña
            </h1>
            <div class="flex flex-col items-center justify-center">
                <p class="mt-2 w-2/3 text-center font-dine-r text-sm text-light-gray md:text-base">
                    Ingresa tu correo electrónico para restablecer tu contraseña.
                    Se enviará un correo con un enlace único para restablecer tu contraseña.
                </p>
            </div>
            <div class="mt-4 w-4/5 xl:w-2/3">
                <form action="{{ Route('password.send.email') }}" method="POST">
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
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        <x-button-store type="submit" text="Restablecer contraseña" typeButton="tertiary" class="mt-4" />
                        <a href="{{ Route('home') }}" class="mt-8 font-pluto-r text-white underline">
                            Regresar a Miguitas
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/register.js')
@endpush
