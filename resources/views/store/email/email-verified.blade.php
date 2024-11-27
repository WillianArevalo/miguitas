@extends('layouts.login-template')
@section('title', 'Miguitas | Verifica tu correo electrónico')
@section('content')
    <div class="flex h-screen flex-col items-center justify-center gap-y-4"
        style="background-image: url('{{ asset('img/bg-email-verified.jpg') }}'); background-size: cover; background-position: center;">
        <div class="flex flex-col gap-y-4 rounded-xl border bg-white/80 p-10 shadow-lg backdrop-blur-lg">
            <h1 class="flex flex-col items-center gap-y-2 text-center text-4xl font-bold text-blue-store">
                <x-icon-store icon="mail-02" class="size-20" />
                Verifica tu correo electrónico
            </h1>
            <p class="mx-auto w-[450px] text-center font-dine-r text-zinc-500">
                Por favor, confirma tu correo electrónico <span
                    class="font-dine-b font-bold text-blue-store">{{ auth()->user()->email }}</span>,
                en tu
                correo se ha enviado un enlace para verificar tu cuenta.
            </p>
            <x-button-store text="Volver al inicio" class="mx-auto" href="{{ route('home') }}" typeButton="primary"
                type="a" />
        </div>
    </div>
@endsection
