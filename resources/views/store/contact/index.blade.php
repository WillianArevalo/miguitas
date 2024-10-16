@extends('layouts.template')
@section('title', 'Miguitas | Contactanos')
@section('content')
    <div>
        <div class="mx-auto flex w-full items-center justify-center md:w-4/5 lg:w-3/4">
            <img src="{{ asset('img/contactanos.png') }}" alt="Shop image" class="h-full w-full rounded-3xl">
        </div>
        <div class="mt-10 flex flex-col items-center justify-center gap-4">
            <h1 class="light-blue-2 font-weight-bold text-4xl">CONTÁCTANOS</h1>
            <div class="flex flex-col items-center justify-center gap-4 px-4">
                <div class="flex items-center justify-center gap-2 text-center">
                    <x-icon-store icon="location-arrow" class="h-6 w-6 fill-light-blue" />
                    <h2 class="light-blue pluto-r text-sm sm:text-base md:text-lg">
                        Antiguo Cuscatlán, Col Cumbres de Cuscatlán, La Libertad, El Salvador.
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <x-icon-store icon="phone" class="h-6 w-6 fill-light-blue" />
                    <h2 class="light-blue pluto-r text-sm sm:text-base md:text-lg">
                        (+503) 2243-4190
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <x-icon-store icon="whatsapp" class="h-6 w-6 fill-light-blue" />
                    <h2 class="light-blue pluto-r text-sm sm:text-base md:text-lg">
                        (+503) 7910-1241
                    </h2>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <x-icon-store icon="email" class="h-6 w-6 fill-light-blue" />
                    <h2 class="light-blue pluto-r text-sm sm:text-base md:text-lg">
                        administración@miguitasssv.com
                    </h2>
                </div>
            </div>
            <div class="my-10">
                <h2 class="light-blue-2 text-center text-3xl">Horarios</h2>
                <ul class="ms-4 mt-4 flex list-disc flex-col gap-4 px-8 text-base md:text-lg">
                    <li class="din-r text-zinc-500">
                        Atención en REDES: Martes a Viernes 9:00 am a 6 pm y Sábados 9:00 am a 4:00 pm
                    </li>
                    <li class="din-r text-zinc-500">
                        Entregas a DOMICILIO: Martes a Viernes 10:00 am a 3:00 pm Sábados 9:00 am a 4:00 pm
                    </li>
                    <li class="din-r text-zinc-500">
                        PAWstry Shop la Sultana: Martes a Viernes 11:00 am a 6:00 pm y Sábados 10:00 am a 4:00 pm
                    </li>
                    <li class="din-r text-zinc-500">
                        Domingo y Lunes CERRADO.
                    </li>
                    <li class="din-r text-zinc-500">
                        NO se realizan entregas.
                    </li>
                    <li class="din-r text-zinc-500">
                        Tienda virtual abierta para programar pedidos con envío a domicilio o RETIRO en tienda.</li>
                </ul>
            </div>
            <div class="my-10 w-full px-4 md:w-1/2">
                <h2 class="light-blue-2 font-weight-bold text-center text-xl sm:text-2xl md:text-3xl">ESCRÍBENOS</h2>
                <form action="" class="mt-4 w-full" method="POST">
                    @csrf
                    <div class="flex flex-col items-center gap-2 sm:flex-row">
                        <div class="flex w-full flex-1 flex-col gap-2">
                            <x-input-store type="text" name="name" placeholder="Nombre" />
                        </div>
                        <div class="flex w-full flex-1 flex-col gap-2">
                            <x-input-store type="text" name="last_name" placeholder="Apellido" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-2 sm:flex-row">
                        <div class="flex w-full flex-1 flex-col gap-2 md:flex-[2]">
                            <x-input-store type="email" icon="email" name="email" placeholder="Correo electrónico" />
                        </div>
                        <div class="flex w-full flex-1 flex-col gap-2">
                            <x-input-store type="text" name="phone" icon="phone" placeholder="Telefono" />
                        </div>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <x-input-store type="textarea" name="message" placeholder="Mensaje" />
                    </div>
                    <div class="mt-4 flex items-center justify-center">
                        <x-button-store type="submit" class="w-max px-10" typeButton="primary" text="Enviar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
