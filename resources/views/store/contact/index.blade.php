@extends('layouts.template')
@section('title', 'Miguitas | Contactanos')
@section('content')
    <div>
        <div class="mx-auto flex w-full items-center justify-center md:w-4/5 lg:w-3/4" data-aos="fade-up">
            <img src="{{ asset('img/contactanos.png') }}" alt="Shop image" class="h-full w-full rounded-3xl">
        </div>
        <div class="mt-10 flex flex-col items-center justify-center gap-4">
            <h1 class="font-pluto-m text-4xl font-bold text-blue-store">CONTÁCTANOS</h1>
            <div class="flex flex-col items-center justify-center gap-4 px-4">
                <div class="flex items-center justify-center gap-2 text-center">
                    <span class="size-12 flex items-center justify-center rounded-full bg-purple-100">
                        <x-icon-store icon="location-arrow" class="h-6 w-6 text-blue-store" />
                    </span>
                    <h2 class="light-blue w-1/2 font-pluto-r text-sm sm:text-base md:text-lg">
                        {{ $settings->where('key', 'store_address')->first()->value }}
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="size-12 flex items-center justify-center rounded-full bg-purple-100">
                        <x-icon-store icon="phone" class="h-6 w-6 text-blue-store" />
                    </span>
                    <h2 class="light-blue font-pluto-r text-sm sm:text-base md:text-lg">
                        {{ $settings->where('key', 'store_phone')->first()->value }}
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="size-12 flex items-center justify-center rounded-full bg-purple-100">
                        <x-icon-store icon="whatsapp" class="h-6 w-6 text-blue-store" />
                    </span>
                    <h2 class="light-blue font-pluto-r text-sm sm:text-base md:text-lg">
                        {{ $settings->where('key', 'store_whatsapp')->first()->value }}
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <span class="size-12 flex items-center justify-center rounded-full bg-purple-100">
                        <x-icon-store icon="email" class="h-6 w-6 text-blue-store" />
                    </span>
                    <h2 class="light-blue font-pluto-r text-sm sm:text-base md:text-lg">
                        {{ $settings->where('key', 'store_email')->first()->value }}
                    </h2>
                </div>
            </div>
            <div class="my-10">
                <h2 class="text-center text-3xl font-semibold text-blue-store">Horarios</h2>
                <ul class="ms-4 mt-4 flex list-disc flex-col gap-4 px-8 text-base md:text-lg">
                    <li class="font-din-r text-zinc-500">
                        Atención en REDES: Martes a Viernes 9:00 am a 6 pm y Sábados 9:00 am a 4:00 pm
                    </li>
                    <li class="font-din-r text-zinc-500">
                        Entregas a DOMICILIO: Martes a Viernes 10:00 am a 3:00 pm Sábados 9:00 am a 4:00 pm
                    </li>
                    <li class="font-din-r text-zinc-500">
                        PAWstry Shop la Sultana: Martes a Viernes 11:00 am a 6:00 pm y Sábados 10:00 am a 4:00 pm
                    </li>
                    <li class="font-din-r text-zinc-500">
                        Domingo y Lunes CERRADO ( NO se realizan entregas.)
                    </li>
                    <li class="font-din-r text-zinc-500">
                        Tienda virtual abierta para programar pedidos con envío a domicilio o RETIRO en tienda.</li>
                </ul>
            </div>
            <div class="my-10 w-full px-4 md:w-1/2">
                <h2 class="text-center text-xl font-bold text-blue-store sm:text-2xl md:text-3xl">ESCRÍBENOS</h2>
                <form action="{{ route('contact.store') }}" class="mt-4 w-full" method="POST">
                    @csrf
                    <div class="flex flex-col items-center gap-2 sm:flex-row">
                        <div class="flex w-full flex-1 flex-col gap-1">
                            <x-input-store type="text" name="name" required label="Nombre"
                                placeholder="Ingresa tu nombre" />
                        </div>
                        <div class="flex w-full flex-1 flex-col gap-1">
                            <x-input-store type="text" name="last_name" required label="Apellido"
                                placeholder="Ingresa tu apellido" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col items-center gap-2 sm:flex-row">
                        <div class="flex w-full flex-1 flex-col gap-1 md:flex-[2]">
                            <x-input-store type="email" icon="email" name="email" label="Correo electrónico"
                                placeholder="Ingresa tu correo electrónico" required />
                        </div>
                        <div class="flex w-full flex-1 flex-col gap-1">
                            <x-input-store type="text" name="phone" icon="phone" label="Teléfono"
                                placeholder="Ingresa tu teléfono" />
                        </div>
                    </div>
                    <div class="mt-4 flex flex-col items-start gap-2">
                        <x-input-store type="textarea" name="message" required label="Mensaje"
                            placeholder="Ingresa tu mensaje..." />
                    </div>
                    <div class="mt-4 flex items-center justify-center">
                        <x-button-store type="submit" class="w-max px-10" typeButton="primary" text="Enviar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
