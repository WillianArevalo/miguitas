@extends('layouts.login-template')
@section('title', 'Página no encontrada')
@section('content')
    <div class="relative h-screen w-full">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="size-28 absolute left-0 top-0 m-10">
        <img src="{{ asset('img/404.png') }}" alt="Image page not found" class="h-full w-full object-cover">
        <x-button-store type="a" href="{{ Route('home') }}" typeButton="primary" class="absolute bottom-0 right-0 m-10"
            text="Volver al inicio" size="large" />
    </div>
@endsection
