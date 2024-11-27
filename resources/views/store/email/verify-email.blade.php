@extends('layouts.login-template')
@section('title', 'Miguitas | Verifica tu correo electrónico')
@section('content')
    <div class="flex h-screen flex-col items-center justify-center gap-y-4 bg-white">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="size-20">
        <h1 class="w-[450px] text-center text-2xl font-bold text-blue-store">
            Hola {{ $name }}, queremos asegurarnos que tu correo electrónico es correcto
        </h1>
        <p class="text-center font-dine-r text-zinc-500">
            Agradecemos tu paciencia, haz click en el botón de abajo para verificar tu correo electrónico.
        </p>
        <x-button-store type="a" typeButton="primary" href="{{ $url }}" text="Verificar correo electrónico" />
    </div>
@endsection
