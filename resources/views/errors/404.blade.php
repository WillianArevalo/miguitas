@extends('layouts.login-template')
@section('title', 'Página no encontrada')
@section('content')
    <div class="relative h-screen w-full">
        <img src="{{ asset('img/404.png') }}" alt="Image page not found" class="h-full w-full">
        <a href="{{ Route('home') }}" class="absolute bottom-0 right-0 m-10 font-bold text-pink-600">Volver al inicio</a>
    </div>
@endsection
