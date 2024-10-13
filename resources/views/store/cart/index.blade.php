@extends('layouts.template')
@section('title', 'Miguitas | Carrito de compras')
@push('styles')
    @vite('resources/css/store/carrito.css')
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
            <h1>Carrito de compras</h1>
            <div class="sp"></div>
        </div>
        <div class="carrito">
            <div class="product-info-container">
                <div class="content">
                    <div class="columns-header">
                        <div class="product">
                            <h1>Producto</h1>
                        </div>
                        <div class="quantity">
                            <h1>Cantidad</h1>
                        </div>
                        <div class="total">
                            <h1>Total</h1>
                        </div>
                    </div>
                    <div class="product-container">
                        <div class="product-card">
                            <div class="product-info">
                                <div class="product-img">
                                    <img src="" alt="">
                                </div>
                                <div class="product">
                                    <h2>Lorem ipsum dolor sit</h2>
                                    <h2>$4.50</h2>
                                </div>
                            </div>
                            <div class="quantity">
                                <div class="input-container">
                                    <button class="decrement">-</button>
                                    <input type="number" class="number-input" value="1" min="1">
                                    <button class="increment">+</button>
                                </div>
                            </div>
                            <div class="total">
                                <h2>$4.50</h2>
                                <div class="delete">
                                    <svg width="38" height="40" viewBox="0 0 18 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 5H2V18C2 18.5304 2.21071 19.0391 2.58579 19.4142C2.96086 19.7893 3.46957 20 4 20H14C14.5304 20 15.0391 19.7893 15.4142 19.4142C15.7893 19.0391 16 18.5304 16 18V5H3ZM13.618 2L12 0H6L4.382 2H0V4H18V2H13.618Z"
                                            fill="white" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-info">
                                <div class="product-img">
                                    <img src="" alt="">
                                </div>
                                <div class="product">
                                    <h2>Lorem ipsum dolor sit</h2>
                                    <h2>$4.50</h2>
                                </div>
                            </div>
                            <div class="quantity">
                                <div class="input-container">
                                    <button class="decrement">-</button>
                                    <input type="number" class="number-input" value="1" min="1">
                                    <button class="increment">+</button>
                                </div>
                            </div>
                            <div class="total">
                                <h2>$4.50</h2>
                                <div class="delete">
                                    <svg width="38" height="40" viewBox="0 0 18 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 5H2V18C2 18.5304 2.21071 19.0391 2.58579 19.4142C2.96086 19.7893 3.46957 20 4 20H14C14.5304 20 15.0391 19.7893 15.4142 19.4142C15.7893 19.0391 16 18.5304 16 18V5H3ZM13.618 2L12 0H6L4.382 2H0V4H18V2H13.618Z"
                                            fill="white" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-info">
                                <div class="product-img">
                                    <img src="" alt="">
                                </div>
                                <div class="product">
                                    <h2>Lorem ipsum dolor sit</h2>
                                    <h2>$4.50</h2>
                                </div>
                            </div>
                            <div class="quantity">
                                <div class="input-container">
                                    <button class="decrement">-</button>
                                    <input type="number" class="number-input" value="1" min="1">
                                    <button class="increment">+</button>
                                </div>
                            </div>
                            <div class="total">
                                <h2>$4.50</h2>
                                <div class="delete">
                                    <svg width="38" height="40" viewBox="0 0 18 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 5H2V18C2 18.5304 2.21071 19.0391 2.58579 19.4142C2.96086 19.7893 3.46957 20 4 20H14C14.5304 20 15.0391 19.7893 15.4142 19.4142C15.7893 19.0391 16 18.5304 16 18V5H3ZM13.618 2L12 0H6L4.382 2H0V4H18V2H13.618Z"
                                            fill="white" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pedido-info">
                <div class="content">
                    <div class="header">
                        <h1>Resumen del pedido</h1>
                        <div class="line"></div>
                    </div>

                    <div class="detalles">
                        <div class="item">
                            <h2>Subtotal:</h2>
                            <h2>$4.50</h2>
                        </div>
                        <div class="item">
                            <h2>Impuestos:</h2>
                            <h2>------</h2>
                        </div>
                        <div class="item">
                            <h2>Envío:</h2>
                            <h2>------</h2>
                        </div>
                    </div>
                    <div class="footer">
                        <div class="line"></div>
                        <div class="total">
                            <h2>Total del pedido:</h2>
                            <h2>$13.50</h2>
                        </div>
                    </div>

                    <div class="finish">
                        <a href="facturacion.html">
                            <button>Finalizar la compra</button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="suggested-container">
            <h1 class="light-blue-2">¡TU PELUDO TIENE QUE PROBARLOS!</h1>
            <div class="line"></div>

            <div class="suggested-container-box">
                <div class="prev">
                    <svg width="40" height="45" viewBox="0 0 192 336" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 24L168 168L24 312" stroke="var(--dark-blue)" stroke-width="48"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <!-- Contenedor dónde se mostrarán las cards de productos sugeridos -->
                <div class="suggested-card-container-box">

                    <!-- Contenedor de la card -->
                    <div class="suggested-card-container">
                        <!-- Imágen de la card -->
                        <div class="suggested-card-img">
                            <img src="" alt="">
                        </div>
                        <!-- Información del producto -->
                        <div class="suggested-card-info">

                            <div class="product">
                                <!-- Nombre del producto -->
                                <h2 class="product-name">Lorem ipsum dolor sit</h2>
                                <!-- Precio del producto -->
                                <h2 class="product-price">$4.50</h2>
                            </div>

                            <div class="social-interaction">
                                <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg-header-fixer"
                                        d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                        stroke="#254183" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de la card -->
                    <div class="suggested-card-container">
                        <!-- Imágen de la card -->
                        <div class="suggested-card-img">
                            <img src="" alt="">
                        </div>
                        <!-- Información del producto -->
                        <div class="suggested-card-info">

                            <div class="product">
                                <!-- Nombre del producto -->
                                <h2 class="product-name">Lorem ipsum dolor sit</h2>
                                <!-- Precio del producto -->
                                <h2 class="product-price">$4.50</h2>
                            </div>

                            <div class="social-interaction">
                                <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg-header-fixer"
                                        d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                        stroke="#254183" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de la card -->
                    <div class="suggested-card-container">
                        <!-- Imágen de la card -->
                        <div class="suggested-card-img">
                            <img src="" alt="">
                        </div>
                        <!-- Información del producto -->
                        <div class="suggested-card-info">

                            <div class="product">
                                <!-- Nombre del producto -->
                                <h2 class="product-name">Lorem ipsum dolor sit</h2>
                                <!-- Precio del producto -->
                                <h2 class="product-price">$4.50</h2>
                            </div>

                            <div class="social-interaction">
                                <svg width="37" height="34" viewBox="0 0 39 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg-header-fixer"
                                        d="M28.8382 1C22.5832 1 19.5 7.18178 19.5 7.18178C19.5 7.18178 16.4168 1 10.1618 1C5.07848 1 1.05301 5.26351 1.00098 10.351C0.895006 20.9112 9.35734 28.4211 18.6329 34.7323C18.8886 34.9067 19.1907 35 19.5 35C19.8093 35 20.1115 34.9067 20.3671 34.7323C29.6417 28.4211 38.104 20.9112 37.999 10.351C37.947 5.26351 33.9215 1 28.8382 1Z"
                                        stroke="#254183" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="next">
                    <svg width="40" height="45" viewBox="0 0 192 336" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M24 24L168 168L24 312" stroke="var(--dark-blue)" stroke-width="48"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endsection
