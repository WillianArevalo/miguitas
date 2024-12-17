@extends('layouts.template')
@section('title', 'Miguitas | Galería')
@push('styles')
    @vite('resources/css/store/galeria.css')
@endpush
@section('content')
    <div class="main-container">
        <div class="py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl">Galería</h1>
        </div>
        <div>
            <div class="py-8 text-center">
                <h1 class="text-xl text-blue-store">Cada día recibimos fotos de clientes felices y satisfechos. </h1>
                <h1 class="mt-2 font-dine-r text-blue-store">Envíanos la tuya al WHATSAPP {{ $whatsApp->value }}</h1>
            </div>
            <div class="mx-auto w-3/4">

            </div>
        </div>
    </div>

@endsection
