@extends('layouts.login-template')
@section('title', 'Miguitas | Verifica tu correo electrónico')
@section('content')
    <div class="flex h-screen flex-col items-center justify-center gap-y-4 bg-white">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="size-20">
        <h1 class="w-[450px] text-center text-2xl font-bold text-blue-store">
            Restablecer contraseña
        </h1>
        <p class="text-center font-dine-r text-zinc-500">
            Correo electrónico para restablecer contraseña. Haz click en el botón de abajo para restablecer tu contraseña.
        </p>
        <a href="{{ $url }}" class="font-dine-r text-lg text-blue-store">Restablecer contraseña</a>

        <p class="text-center font-dine-r text-xs text-zinc-500">
            Si no hiciste esta solicitud, por favor ignora este correo.
        </p>

    </div>
@endsection
