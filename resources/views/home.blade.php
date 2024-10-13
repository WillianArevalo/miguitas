@extends('layouts.template')
@section('title', 'Miguitas | Inicio')
@push('styles')
    @vite('resources/css/store/index.css')
@endpush
@section('content')
    <div class="header" style="background-image: url({{ asset('img/index.png') }});">
        <div>
            <a href="tienda.html" class="btn-primary">
                Compra ahora
            </a>
        </div>
    </div>

    <div class="m-paragraph-container mx-auto">
        <span class="m-title">Productos destacados</span>
        <p>
            Nuestra mejor receta para tu peludo: Ingredientes naturales y frescos, cero químicos y elaboramos los
            productos en “small batches”.
            Puedes estar seguro de que, con Miguitas, obtienes calidad, beneficiando a tu mascota para que viva más
            y mejor.
        </p>
    </div>

    <!-- Caja dónde se mostrarán las cards -->
    <div class="featured-cards-container-box">

        <!-- Contenedor de la card -->
        <div class="featured-card-container">
            <!-- Cuerpo de la card -->
            <div class="featured-card-body">
                <!-- Imagen de la card -->
                <div class="featured-card-img">
                    <img src="" alt="" />
                </div>
                <!-- Botones de acción -->
                <div class="featured-card-actions">
                    <a href="product-info.html">
                        <svg width="35" height="35" viewBox="0 0 180 163" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M73.1955 156.506C77.8134 156.506 81.557 152.762 81.557 148.144C81.557 143.526 77.8134 139.783 73.1955 139.783C68.5775 139.783 64.834 143.526 64.834 148.144C64.834 152.762 68.5775 156.506 73.1955 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M140.087 156.506C144.705 156.506 148.449 152.762 148.449 148.144C148.449 143.526 144.705 139.783 140.087 139.783C135.469 139.783 131.726 143.526 131.726 148.144C131.726 152.762 135.469 156.506 140.087 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M6.30371 5.99902H35.5689C35.5689 5.99902 39.0217 21.2874 41.2341 31.0835C45.6547 50.6576 51.7262 77.5416 55.2883 93.3139C57.0103 100.938 63.7804 106.337 71.5969 106.337H143.396C151.234 106.337 158.02 100.893 159.72 93.2419L173.533 31.0835"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M173.534 31.0835H43.9307" stroke="var(--light-blue-2)" stroke-width="12"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg></a>
                    <div></div>
                    <svg class="favorite" width="37" height="34" viewBox="0 0 39 36" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="svg-header-fixer"
                            d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                            stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <!-- Título de la card -->
                <div class="featured-card-title">
                    <h1>Cake Corazón FurryLove</h1>
                </div>
                <!-- Precios -->
                <div class="featured-card-prices">
                    <p>$9.50 – $20.00</p>
                </div>
            </div>
        </div>

        <!-- Contenedor de la card -->
        <div class="featured-card-container">
            <!-- Cuerpo de la card -->
            <div class="featured-card-body">
                <!-- Imagen de la card -->
                <div class="featured-card-img">
                    <img src="" alt="" />
                </div>
                <!-- Botones de acción -->
                <div class="featured-card-actions">
                    <a href="product-info.html">
                        <svg width="35" height="35" viewBox="0 0 180 163" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M73.1955 156.506C77.8134 156.506 81.557 152.762 81.557 148.144C81.557 143.526 77.8134 139.783 73.1955 139.783C68.5775 139.783 64.834 143.526 64.834 148.144C64.834 152.762 68.5775 156.506 73.1955 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M140.087 156.506C144.705 156.506 148.449 152.762 148.449 148.144C148.449 143.526 144.705 139.783 140.087 139.783C135.469 139.783 131.726 143.526 131.726 148.144C131.726 152.762 135.469 156.506 140.087 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M6.30371 5.99902H35.5689C35.5689 5.99902 39.0217 21.2874 41.2341 31.0835C45.6547 50.6576 51.7262 77.5416 55.2883 93.3139C57.0103 100.938 63.7804 106.337 71.5969 106.337H143.396C151.234 106.337 158.02 100.893 159.72 93.2419L173.533 31.0835"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M173.534 31.0835H43.9307" stroke="var(--light-blue-2)" stroke-width="12"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg> </a>
                    <div></div>
                    <svg class="favorite" width="37" height="34" viewBox="0 0 39 36" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="svg-header-fixer"
                            d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                            stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <!-- Título de la card -->
                <div class="featured-card-title">
                    <h1>Cake Corazón FurryLove</h1>
                </div>
                <!-- Precios -->
                <div class="featured-card-prices">
                    <p>$9.50 – $20.00</p>
                </div>
            </div>
        </div>

        <!-- Contenedor de la card -->
        <div class="featured-card-container">
            <!-- Cuerpo de la card -->
            <div class="featured-card-body">
                <!-- Imagen de la card -->
                <div class="featured-card-img">
                    <img src="" alt="" />
                </div>
                <!-- Botones de acción -->
                <div class="featured-card-actions">
                    <a href="product-info.html">
                        <svg width="35" height="35" viewBox="0 0 180 163" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M73.1955 156.506C77.8134 156.506 81.557 152.762 81.557 148.144C81.557 143.526 77.8134 139.783 73.1955 139.783C68.5775 139.783 64.834 143.526 64.834 148.144C64.834 152.762 68.5775 156.506 73.1955 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M140.087 156.506C144.705 156.506 148.449 152.762 148.449 148.144C148.449 143.526 144.705 139.783 140.087 139.783C135.469 139.783 131.726 143.526 131.726 148.144C131.726 152.762 135.469 156.506 140.087 156.506Z"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M6.30371 5.99902H35.5689C35.5689 5.99902 39.0217 21.2874 41.2341 31.0835C45.6547 50.6576 51.7262 77.5416 55.2883 93.3139C57.0103 100.938 63.7804 106.337 71.5969 106.337H143.396C151.234 106.337 158.02 100.893 159.72 93.2419L173.533 31.0835"
                                stroke="var(--light-blue-2)" stroke-width="12" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M173.534 31.0835H43.9307" stroke="var(--light-blue-2)" stroke-width="12"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg></a>
                    <div></div>
                    <svg class="favorite" width="37" height="34" viewBox="0 0 39 36" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path class="svg-header-fixer"
                            d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                            stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <!-- Título de la card -->
                <div class="featured-card-title">
                    <h1>Cake Corazón FurryLove</h1>
                </div>
                <!-- Precios -->
                <div class="featured-card-prices">
                    <p>$9.50 – $20.00</p>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center">
        <a href="tienda.html" class="btn-primary">
            Ver más
        </a>
    </div>


    <div class="decorator-perrito-image-cumple">
        <div class="text-container">
            <span class="t1">Más que un TREAT,
                una muestra de
                amor y cuidado</span>

            <span class="t2">Queremos ser parte de su vida</span>
        </div>
        <img src="../../resources/img/perritocumple.png" alt="">
    </div>

    <div class="m-paragraph-container">

        <span class="m-title">PAWTY PACKS</span>

        <p>¡La mejor manera de celebrar a tu peludo en su cumpleaños, su adopción, su logro o cualquier otro motivo!
            Incluye pastel o pupcakes,
            1 gorro, 3 globos, 1 galleta, 1 número de galleta y 1 bandana birthday boy o girl. También puedes
            comprar estos artículos individualmente.
        </p>

        <a href="tienda.html">
            <img src="../../resources/img/recursos miguitas-03.png" alt="" width="80%">
        </a>

    </div>

    <div class="letscelebrate">
        <img src="../../resources/img/celebrate.png" alt="" width="80%">
    </div>
@endsection
