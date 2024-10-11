@extends('layouts.template')
@section('title', 'Miguitas | Galería')
@push('styles')
    @vite('resources/css/store/galeria.css')
@endpush
@section('content')
    <div class="main-container">
        <div class="header-container" style="background-image: url({{ asset('img/bg-image.png') }});">
            <div class="icon">
                <a href="index.html">
                    <svg width="45" height="45" viewBox="0 0 226 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                            stroke="#8fadff" stroke-width="91" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <h1>GALERÍA</h1>
            <div class="sp"></div>
        </div>
        <div class="content">
            <h1 class="light-blue">Cada día recibimos fotos de clientes felices y satisfechos. </h1>
            <h1 class="light-blue">Envíanos la tuya al WHATSAPP 7910-1241.</h1>
            <div class="image-grid">
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
                <div class="image-item"></div>
            </div>
        </div>
    </div>

@endsection
