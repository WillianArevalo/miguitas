<footer class="w-full bg-light-blue">
    <div class="mx-auto w-full p-10 lg:w-[90%]">
        <div class="flex flex-col gap-8 sm:flex-row">
            <img src="{{ $logo ? Storage::url($logo) : asset('img/logo.png') }}" alt="Logo Miguitas"
                class="mx-auto h-44 w-44">
            <div class="flex flex-1 flex-col items-center justify-center gap-4">
                <h2 class="text-2xl font-bold text-white md:text-3xl lg:text-4xl xl:text-5xl">
                    MIGUITAS PET TREATS
                </h2>
                <p class="w-3/4 text-center font-dine-r text-base text-white md:text-lg">
                    {{ $description }}
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
                            <a class="link font-dine-r" href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link font-dine-r" href="{{ route('store') }}">
                                Tienda
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link font-dine-r" href="{{ route('home') }}">
                                Ordenar
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link font-dine-r" href="{{ route('faq') }}">
                                Preguntas frecuentes (FAQ)
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link font-dine-r" href="{{ route('about') }}">
                                Conocenos
                            </a>
                        </li>
                        <li class="text-sm text-white md:text-base">
                            <a class="link font-dine-r" href="{{ route('contact') }}">
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
                            <x-icon-store class="min-h-5 min-w-5 text-white" icon="location-arrow" />
                            <p class="font-dine-r text-sm text-white md:text-base">
                                {{ $settings->where('key', 'store_address')->first()->value ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 text-white" icon="phone" />
                            <p class="font-dine-r text-sm text-white md:text-base">
                                {{ $settings->where('key', 'store_phone')->first()->value ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 text-white" icon="whatsapp" />
                            <p class="font-dine-r text-sm text-white md:text-base">
                                {{ $settings->where('key', 'store_whatsapp')->first()->value ?? '' }}
                            </p>
                        </div>
                        <div class="flex items-center justify-center gap-2 md:justify-start">
                            <x-icon-store class="h-5 w-5 text-white" icon="email" />
                            <p class="font-dine-r text-sm text-white md:text-base">
                                {{ $settings->where('key', 'store_email')->first()->value ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-center text-xl font-bold uppercase text-light-pink md:text-left md:text-2xl">
                        PAWSTRY SHOP
                    </h3>
                    <p class="mt-4 text-center font-dine-r text-sm uppercase text-white md:text-left md:text-base">
                        {{ $settings->where('key', 'store_address')->first()->value ?? '' }}
                    </p>
                    <p class="mt-4 text-center font-dine-r text-sm text-light-pink md:text-left md:text-base">
                        Horario en tienda:
                    </p>
                    <p class="text-center md:text-left">
                        <span class="font-pluto-r text-sm font-bold text-white md:text-base">
                            MAR - VIER
                        </span>
                        <span class="ms-4 font-dine-r text-sm text-white md:text-base">
                            11:00 AM - 6:00 PM
                        </span>
                    </p>
                    <p class="text-center md:text-left">
                        <span class="font-pluto-r text-sm font-bold text-white md:text-base">
                            SÁBADO
                        </span>
                        <span class="ms-4 font-dine-r text-sm text-white md:text-base">
                            10:00 AM - 4:00 PM
                        </span>
                    </p>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col gap-4">
                        <div>
                            <h3 class="text-center text-lg font-bold uppercase text-light-pink md:text-left md:text-xl">
                                Sigamos en contacto
                            </h3>
                            <div class="mt-4 flex items-center justify-center gap-4 md:justify-start">
                                @foreach ($socialLinks as $socialLink)
                                    <a href="{{ $socialLink->url }}" target="_blank" rel="noopener noreferrer"
                                        class="transform hover:scale-105">
                                        <x-icon-store class="h-8 w-8 text-white"
                                            icon="{{ $socialLink->network_name }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-center text-lg font-bold uppercase text-light-pink md:text-left md:text-xl">
                                Términos y condiciones
                            </h3>
                            <ul class="mt-4 flex flex-col gap-2 text-center md:text-left">
                                @foreach ($policies as $policy)
                                    <li class="text-sm text-white md:text-base">
                                        <a class="link font-dine-r"
                                            href="{{ route('terms-and-conditions', $policy->slug) }}">
                                            {{ $policy->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-light-pink py-10">
        <div class="mx-auto flex w-full flex-col justify-between px-10 sm:flex-row lg:w-[90%]">
            <div class="flex flex-col gap-4">
                <p class="font-dine-r text-base text-dark-blue md:text-lg">
                    Miguitas Pet Treats® NIT: 0614-120690-129-7<br>
                    Patricia Eugenia Solórzano Rivera
                </p>
                <p class="font-dine-r text-sm text-dark-blue md:text-base">
                    Miguitas Pet Treats © 2020 Desarrollado X Innovadesa.
                </p>
            </div>
            <div class="flex items-center gap-4">
                @if ($paymentMethods->count() > 0)
                    @foreach ($paymentMethods as $paymentMethod)
                        <img src="{{ Storage::url($paymentMethod->image) }}" alt="Logo Innovadesa"
                            class="h-20 w-20 rounded-xl">
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>
