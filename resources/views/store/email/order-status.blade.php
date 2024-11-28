@extends('layouts.login-template')
@section('title', 'Miguitas | Verifica tu correo electrónico')
@section('content')
    <div class="flex h-screen flex-col items-center justify-center gap-y-4 bg-white">
        <h1 class="text-center text-2xl font-bold text-blue-store">
            Miguitas - Estado {{ $status }} de tu pedido
        </h1>
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="size-20">
        @if ($number_order)
            <h2 class="w-[500px] text-center text-2xl font-bold text-blue-store">
                Hola Willian, el estado de tu pedido #{{ $number_order }} ha sido actualizado.
            </h2>
            <x-button-store type="a" target="_blank" typeButton="primary" href="{{ route('orders.show', $number_order) }}"
                text="Ver pedido" />
            <p class="text-center font-dine-r text-zinc-500">
                Si tienes alguna pregunta, no dudes en contactarnos. <br>
                <a href="mailto:contacto@miguitas.com" class="text-blue-store">contacto@miguitas.com</a>
            </p>
        @endif
    </div>
@endsection
