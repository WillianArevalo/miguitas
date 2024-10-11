@extends('layouts.template')
@section('title', 'Miguitas | Inicio de sesión')
@push('styles')
    @vite('resources/css/store/login-signup.css')
@endpush
@section('content')
    <div class="main-container">
        <div class="form-container">
            <div class="form-header">
                <div class="rectangules">
                    <div class="rectangule1"></div>
                    <div class="rectangule2"></div>
                </div>
                <div class="square"></div>
            </div>
            <div class="form-content">
                <div class="left-rectangule"></div>
                <div class="container">
                    <div class="info">
                        <h1>¡Bienvenido
                            de nuevo!
                        </h1>
                        <p>Bienvenido al
                            mundo donde se
                            cumplen los deseos
                            de tu mejor amigo
                            peludo
                        </p>
                    </div>

                    <div class="form">
                        <div class="header">
                            <div class="title">
                                <h1>Inicio de sesión</h1>
                            </div>
                            <div class="icons">
                                <svg width="28" height="28" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.261 7.30904H8.93404V10.76H13.726C13.28 12.953 11.413 14.213 8.93404 14.213C8.24038 14.2142 7.5533 14.0785 6.91222 13.8135C6.27114 13.5486 5.68868 13.1597 5.19823 12.6691C4.70778 12.1786 4.31899 11.5961 4.05418 10.9549C3.78936 10.3138 3.65372 9.6267 3.65504 8.93304C3.65386 8.23946 3.78959 7.55246 4.05447 6.91145C4.31934 6.27044 4.70814 5.68801 5.19858 5.19758C5.68902 4.70714 6.27144 4.31834 6.91245 4.05346C7.55347 3.78859 8.24046 3.65285 8.93404 3.65404C10.193 3.65404 11.331 4.10104 12.224 4.83204L14.824 2.23304C13.24 0.852038 11.209 3.80581e-05 8.93404 3.80581e-05C7.75985 -0.00339412 6.59656 0.225348 5.51109 0.673108C4.42562 1.12087 3.43938 1.77881 2.6091 2.60909C1.77881 3.43938 1.12087 4.42562 0.673111 5.51109C0.225351 6.59656 -0.00339112 7.75985 4.10512e-05 8.93404C-0.00352385 10.1083 0.225128 11.2716 0.67284 12.3571C1.12055 13.4427 1.77849 14.429 2.6088 15.2593C3.43911 16.0896 4.4254 16.7475 5.51093 17.1952C6.59647 17.643 7.75981 17.8716 8.93404 17.868C13.401 17.868 17.463 14.619 17.463 8.93404C17.463 8.40604 17.382 7.83704 17.261 7.30904Z"
                                        fill="white" />
                                </svg>
                                <svg width="30" height="30" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.999 0C4.477 0 0 4.477 0 9.999C0 14.989 3.656 19.125 8.437 19.878V12.89H5.897V9.999H8.437V7.796C8.437 5.288 9.93 3.905 12.213 3.905C13.307 3.905 14.453 4.1 14.453 4.1V6.559H13.189C11.949 6.559 11.561 7.331 11.561 8.122V9.997H14.332L13.889 12.888H11.561V19.876C16.342 19.127 19.998 14.99 19.998 9.999C19.998 4.477 15.521 0 9.999 0Z"
                                        fill="white" />
                                </svg>
                                <svg width="28" height="28" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1V17C0 17.2652 0.105357 17.5196 0.292893 17.7071C0.48043 17.8946 0.734784 18 1 18H17C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V1C18 0.734784 17.8946 0.48043 17.7071 0.292893C17.5196 0.105357 17.2652 0 17 0ZM5.339 15.337H2.667V6.747H5.339V15.337ZM4.003 5.574C3.59244 5.574 3.1987 5.41091 2.9084 5.1206C2.61809 4.8303 2.455 4.43656 2.455 4.026C2.455 3.61544 2.61809 3.22171 2.9084 2.9314C3.1987 2.64109 3.59244 2.478 4.003 2.478C4.41355 2.478 4.80729 2.64109 5.0976 2.9314C5.38791 3.22171 5.551 3.61544 5.551 4.026C5.551 4.43656 5.38791 4.8303 5.0976 5.1206C4.80729 5.41091 4.41355 5.574 4.003 5.574ZM15.338 15.337H12.669V11.16C12.669 10.164 12.651 8.883 11.281 8.883C9.891 8.883 9.68 9.969 9.68 11.09V15.338H7.013V6.748H9.573V7.922H9.61C9.965 7.247 10.837 6.535 12.134 6.535C14.838 6.535 15.337 8.313 15.337 10.627L15.338 15.337Z"
                                        fill="white" />
                                </svg>

                            </div>
                        </div>
                        <form action="">
                            <div class="inputs">
                                <input class="" type="email" name="" id="" placeholder="Correo">
                                <input type="password" name="" id="" placeholder="Contraseña">
                            </div>
                            <div class="actions">
                                <b>¿Has olvidado tu contraseña?</b>
                                <button type="submit">Iniciar</button>
                                <a href="signup.html">
                                    <b>Regístrate</b>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right-rectangule"></div>
            </div>
            <div class="form-footer">
                <div class="square"></div>
                <div class="rectangules">
                    <div class="rectangule1"></div>
                    <div class="rectangule2"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
