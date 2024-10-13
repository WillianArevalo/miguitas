@extends('layouts.template')
@section('title', 'Miguitas | Tienda')
@section('content')
    @push('styles')
        @vite('resources/css/store/shop.css')
    @endpush
    <div class="main-container">
        <div class="img flex items-center justify-center">
            <img src="{{ asset('img/shop.png') }}" alt="Shop image">
        </div>

        <h1 class="title">CATEGORÍAS</h1>

        <div class="category-container">
            <div class="category">
                <div class="category-img gift">
                    <img src="{{ asset('img/giftcard.png') }}" alt="GiftCard image">
                </div>
                <div class="category-name">
                    <h1>Gift Card</h1>
                </div>

            </div>
            <div class="category">
                <div class="category-img">
                    <a href="category-pups.html">
                        <img src="{{ asset('img/pups.png') }}" alt="Pups image">
                    </a>
                </div>
                <div class="category-name">
                    <a href="category-pups.html">
                        <h1>For Pups</h1>
                    </a>
                </div>
            </div>
            <div class="category">
                <div class="category-img">
                    <img src="{{ asset('img/kitties.png') }}" alt="Kitties image">
                </div>
                <div class="category-name">
                    <h1>For Kitties</h1>
                </div>
            </div>
            <div class="category">
                <div class="category-img">
                    <img src="{{ asset('img/petlover.png') }}" alt="Petlover image">
                </div>
                <div class="category-name">
                    <h1>Petlover
                        Accesories</h1>
                </div>
            </div>
        </div>

        <h1 class="subtitle">PRODUCTOS DESTACADOS</h1>

        <!-- Contenedor donde se mostrarán las cards de productos destacados 2 (featured2-card) -->
        <div class="featured2-cards-container-box">

            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->


            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->


            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->


            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->


            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->


            <!-- Inicio de la card -->
            <!-- Contenedor de la card -->
            <div class="featured2-card-container">
                <!-- Header de la card -->
                <div class="featured2-card-header">
                    <!-- Icono o imagen del header -->
                    <div class="feautured2-card-header-icon">
                        <img src="" alt="">
                    </div>
                    <!-- Informacion del header -->
                    <div class="featured2-card-header-info">
                        <!-- Título del header -->
                        <h2 class="header-title">miguitaselsalvador</h1>
                            <!-- Subtitulo del header -->
                            <h2 class="header-subtitle">El Salvador</h2>
                    </div>
                </div>
                <!-- Imágen de la card -->
                <div class="featured2-card-img">
                    <img src="" alt="">
                </div>
                <!-- Botones de acción de la card -->
                <div class="featured2-card-actions">
                    <!-- Botones de interacción social -->
                    <div class="social-interaction">
                        <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="svg-header-fixer"
                                d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                stroke="#254183" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 136 136" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M118.229 104.962C117.874 103.656 118.658 101.841 119.406 100.532C119.639 100.142 119.892 99.7639 120.163 99.3994C126.58 89.668 130 78.2675 130 66.611C130.104 33.1518 102.359 6 68.0505 6C38.1296 6 13.1538 26.7283 7.31751 54.2438C6.44306 58.3232 6.00145 62.4835 6 66.6557C6 100.163 32.6748 127.741 66.9834 127.741C72.4382 127.741 79.8007 126.369 83.8158 125.246C87.8309 124.122 91.84 122.632 92.8743 122.232C93.9322 121.825 95.0556 121.616 96.1889 121.615C97.4268 121.61 98.6527 121.857 99.7927 122.339L120.011 129.636C120.454 129.827 120.923 129.95 121.403 130C121.782 129.999 122.156 129.923 122.505 129.776C122.854 129.629 123.17 129.414 123.436 129.144C123.701 128.874 123.91 128.554 124.051 128.203C124.192 127.851 124.261 127.475 124.256 127.097C124.231 126.764 124.171 126.436 124.077 126.116L118.229 104.962Z"
                                stroke="var(--light-blue-2)" stroke-width="9" stroke-miterlimit="10"
                                stroke-linecap="round" />
                        </svg>
                        <svg width="35" height="35" viewBox="0 0 95 95" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M90.0267 4L59.9173 90.0267L42.712 51.3147L4 34.1093L90.0267 4Z"
                                stroke="var(--light-blue-2)" stroke-width="8" stroke-linejoin="round" />
                            <path d="M90.0275 3.99994L42.7129 51.3146" stroke="var(--light-blue-2)" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <!-- Botón para el carrito -->
                    <div class="shop">
                        <a href="carrito.html">
                            <svg width="40" height="40" viewBox="0 0 180 163" fill="none"
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
                            </svg>
                        </a>
                    </div>
                </div>
                <!-- Vistas del producto -->
                <div class="featured2-card-views">
                    <h2>13,345 view</h2>
                </div>
                <!-- Información del producto -->
                <div class="featured2-card-product-info">
                    <div class="product">
                        <!--  Nombre del producto -->
                        <h1 class="product-name">#Cake Corazón FurryLove</h1>
                        <!-- Precio del producto -->
                        <h1 class="product-price">$9.50 – $20.00</h1>
                    </div>
                    <!-- Botón para información extra del producto -->
                    <div class="featured2-card-info">
                        <div class="icon">
                            <a href="product-info.html">
                                <svg width="45" height="45" viewBox="0 0 226 380" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M46 46L172.322 172.322C182.085 182.085 182.085 197.915 172.322 207.678L46 334"
                                        stroke="var(--light-blue)" stroke-width="91" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Final de la card -->

        </div>

        <div class="info-container">
            <p>Programa tu Pedido mínimo 1 día antes y máximo con 3
                semanas de anticipación considerando que DOM y LUNES
                estamos CERRADOS.</p>

            <p>Medios de Pago: tarjeta (en línea), transferencia bancaria o
                QR Banco Agrícola (enviando comprobante antes de 10 am
                del día de la entrega).</p>
        </div>
    </div>
@endsection
