<footer class="w-full bg-light-blue">
    <div class="mx-auto w-full p-10 lg:w-4/5">
        <div class="flex flex-col gap-8 sm:flex-row">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Miguitas" class="mx-auto h-44 w-44">
            <div class="flex flex-1 flex-col items-center justify-center gap-4">
                <h2 class="text-2xl font-bold text-white md:text-3xl lg:text-4xl xl:text-5xl">
                    MIGUITAS PET TREATS
                </h2>
                <p class="dine-r text-center text-base text-white md:text-lg">
                    Horneamos todos los días para los consentidos de cuatro patitas. ¡Elaboramos pasteles, pupcakes y
                    galletas de diferentes sabores, tamaño y forma para que cada día puedas consentir a tu perrito o
                    gatito de la mejor manera: natural!
                </p>
            </div>
        </div>
        <div class="mt-8">
            <div class="flex flex-col flex-wrap justify-between gap-8 md:flex-row">
                <div class="flex-1">
                    <h3 class="text-center text-xl font-bold uppercase text-light-pink md:text-left md:text-2xl">
                        Menú
                    </h3>
                    <ul class="mt-4 flex flex-col gap-2 text-center md:text-left">
                        <li class="text-sm text-white md:text-base">
                            <a class="link dine-r" href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link dine-r" href="{{ route('store') }}">
                                Tienda
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link dine-r" href="{{ route('home') }}">
                                Ordenar
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link dine-r" href="{{ route('faq') }}">
                                Preguntas frecuentes (FAQ)
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link dine-r" href="{{ route('contact') }}">
                                Contáctanos
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <h3 class="text-center text-xl font-bold uppercase text-light-pink md:text-left md:text-2xl">
                        Contáctanos
                    </h3>
                    <div class="mt-4 flex flex-col gap-2">
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 fill-white" icon="location-arrow" />
                            <p class="dine-r text-sm text-white md:text-base">
                                Antiguo Cuscatlán, La Libertad, El Salvador
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 fill-white" icon="phone" />
                            <p class="dine-r text-sm text-white md:text-base">
                                (+503) 2243-4190
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 fill-white" icon="whatsapp" />
                            <p class="dine-r text-sm text-white md:text-base">
                                (503) 7910-1241
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 fill-white" icon="email" />
                            <p class="dine-r text-sm text-white md:text-base">
                                administracion@miguitassv.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-center text-xl font-bold uppercase text-light-pink md:text-left md:text-2xl">
                        PAWSTRY SHOP
                    </h3>
                    <p class="dine-r mt-4 text-center text-sm text-white md:text-left md:text-base">
                        VE. ANTIGUO CUSCATLAN #12, COL. LA SULTANA, ANTIGUO CUSCATLAN, LA LIBERTAD, EL SALVADOR
                    </p>
                    <p class="dine-r mt-4 text-center text-sm text-light-pink md:text-left md:text-base">
                        Horario en tienda:
                    </p>
                    <p class="text-center md:text-left">
                        <span class="pluto-r text-sm font-bold text-white md:text-base">
                            MAR - VIER
                        </span>
                        <span class="dine-r ms-4 text-sm text-white md:text-base">
                            11:00 AM - 6:00 PM
                        </span>
                    </p>
                    <p class="text-center md:text-left">
                        <span class="pluto-r text-sm font-bold text-white md:text-base">
                            SÁBADO
                        </span>
                        <span class="dine-r ms-4 text-sm text-white md:text-base">
                            10:00 AM - 4:00 PM
                        </span>
                    </p>
                </div>
                <div class="flex-1">
                    <h3 class="text-center text-lg font-bold uppercase text-light-pink md:text-left md:text-xl">
                        Sigamos en contacto
                    </h3>
                    <div class="mt-4 flex items-center justify-center gap-4 md:justify-start">
                        <a href="https://www.facebook.com/miguitaselsalvador" target="_blank" rel="noopener noreferrer"
                            class="transform hover:scale-105">
                            <x-icon-store class="h-8 w-8 fill-white" icon="facebook" />
                        </a>
                        <a href="https://www.instagram.com/miguitaselsalvador/" target="_blank"
                            rel="noopener noreferrer" class="transform hover:scale-105">
                            <x-icon-store class="h-8 w-8 fill-white" icon="instagram" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-light-pink p-10">
        <div class="mx-auto flex w-full flex-col justify-between sm:flex-row lg:w-4/5">
            <div class="flex flex-col gap-4">
                <p class="dine-r text-base text-dark-blue md:text-lg">
                    Miguitas Pet Treats® NIT: 0614-120690-129-7<br>
                    Patricia Eugenia Solórzano Rivera
                </p>
                <p class="dine-r text-sm text-dark-blue md:text-base">
                    Miguitas Pet Treats © 2020 Desarrollado X Innovadesa.
                </p>
            </div>
            <div class="flex items-center gap-4">
                <img src="{{ asset('img/sello1.png') }}" alt="Logo Innovadesa" class="h-28 w-28">
                <img src="{{ asset('img/sello2.png') }}" alt="Logo Innovadesa" class="h-28 w-28">
            </div>
        </div>
    </div>

</footer>
