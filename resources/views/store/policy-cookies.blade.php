@extends('layouts.template')
@section('title', 'Miguitas | Política de cookies')
@section('content')
    <div class="mx-auto w-full rounded-lg bg-white p-8 px-4 md:w-4/5 lg:w-3/4 xl:w-1/2">
        <div data-aos="fade-down">
            <h1 class="mb-4 text-4xl font-bold text-blue-store">Política de Cookies</h1>
            <p class="mb-4 font-dine-r text-zinc-600">
                En <span class="font-pluto-r font-semibold">Miguitas</span>, utilizamos cookies para mejorar tu experiencia
                como
                usuario. Actualmente, solo empleamos una cookie que nos permite recordar tu sesión cuando aceptas mantenerla
                activa.
            </p>
        </div>
        <div class="flex items-center" data-aos="fade-right">
            <div class="flex flex-col items-start justify-center">
                <div class="flex items-center gap-2">
                    <span class="size-2 block bg-blue-store ring-2 ring-violet-200"></span>
                    <h3 class="text-xl font-semibold text-zinc-800">¿Qué son las cookies?</h3>
                </div>
                <p class="font-dine-r text-zinc-600">
                    Las cookies son pequeños archivos de texto que se almacenan en tu navegador cuando visitas un sitio web.
                    Se utilizan para diferentes propósitos, como personalizar tu experiencia o mantener sesiones activas.
                </p>
            </div>
            <img src="{{ asset('img/cookies.jpg') }}" alt="Cookies" class="ml-4 h-40 w-1/3 rounded-xl object-cover">
        </div>

        <div class="mt-10" data-aos="fade-left">
            <div class="flex items-center gap-2">
                <span class="size-2 block bg-blue-store ring-2 ring-violet-200"></span>
                <h3 class="text-xl font-semibold text-zinc-800">¿Qué cookies usamos?</h3>
            </div>
            <ul class="mb-4 list-disc pl-5">
                <li class="font-dine-r text-blue-store">
                    <span class="font-pluto-m text-blue-store">cookie_consent</span>: <span class="text-zinc-600">
                        Esta cookie nos permie recordar que has aceptado nuestra política de cookies.
                    </span>
                </li>
                <li class="font-dine-r text-blue-store">
                    <span class="font-pluto-m text-blue-store">remember_token</span>: <span class="text-zinc-600">
                        Esta cookie opcional almacena tu sesión activa para que no
                        tengas que iniciar sesión cada vez que visites nuestro sitio.
                    </span>
                </li>
            </ul>
        </div>
        <div data-aos="fade-right">
            <div class="mt-10 flex items-center gap-2">
                <span class="size-2 block bg-blue-store ring-2 ring-violet-200"></span>
                <h3 class="text-xl font-semibold text-zinc-800">¿Por cuánto tiempo se almacenan?</h3>
            </div>
            <p class="mb-4 font-dine-r text-zinc-600">
                Las cookies de <span class="font-pluto-r font-semibold">Miguitas</span> se almacenan durante 30 días o hasta
                que
                las
                elimines manualmente desde tu navegador.
            </p>
        </div>
        <div class="mt-8" data-aos="fade-left">
            <div class="flex items-center gap-2">
                <span class="size-2 block bg-blue-store ring-2 ring-violet-200"></span>
                <h3 class="text-xl font-semibold text-zinc-800">¿Comó puedes desactivarlas?</h3>
            </div>
            <p class="mt-2 font-dine-r text-zinc-600">
                Puedes deshabilitar las cookies desde las configuraciones de tu navegador. Sin embargo, ten en cuenta que al
                hacerlo podrías perder ciertas funcionalidades, como mantener tu sesión activa.
            </p>
        </div>
    </div>
@endsection
