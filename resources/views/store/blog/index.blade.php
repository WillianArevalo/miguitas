@extends('layouts.template')
@section('title', 'Miguitas | Blog')
@push('styles')
    @vite('resources/css/store/blog.css')
@endpush
@section('content')
    <div class="main-container">
        <div class="header-container" style="background-image: url({{ asset('img/bg-image.png') }});">
            <div class="icon">
                <a href="{{ Route('home') }}">
                    <svg width="45" height="45" viewBox="0 0 226 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                            stroke="#8fadff" stroke-width="91" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <h1>BLOG</h1>
        </div>

        <!-- Caja dónde se mostrarán las cards de blog (blog-cards) -->
        <div class="blog-card-container-box">
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <a href="blog-info.html"> <button class="card-info">VER MÁS</button></a>

                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
            <!-- Contenedor de la card -->
            <div class="blog-card-container">
                <!-- Imágen de la card -->
                <div class="blog-card-img">
                    <img src="" alt="">
                </div>
                <!-- Información de la card -->
                <div class="blog-card-info">
                    <!-- Título de la card -->
                    <h1 class="card-title">Lorem ipsum dolor
                        sit amet</h1>
                    <!-- Texto de la card -->
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetuer
                        adipiscing elit, sed diam nonummy nibh euis-
                        mod tincidunt ut laoreet dolore magna ali-
                        quam erat volutpat.</p>
                    <!-- Botón de la card -->
                    <div class="card-button">
                        <button class="card-info">VER MÁS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
