@extends('layouts.template')
@section('title', 'Miguitas | Conócenos')
@push('styles')
    @vite('resources/css/store/conocenos.css')
@endpush
@section('content')
    <div class="mt-8">
        <div class="mx-auto flex h-60 w-full flex-col justify-end overflow-hidden rounded-[50px] sm:h-96 md:h-[500px] xl:w-3/4"
            style="background-image: url({{ asset('img/conocenos.png') }}); background-size: cover;">
            <div class="m-10 w-max">
                <x-button-store type="a" href="{{ Route('contact') }}" class="btn-primary uppercase" text="Contáctanos"
                    typeButton="primary" size="large" />
            </div>
        </div>
        <div class="mt-10">
            <div class="flex flex-col items-center justify-center gap-8 sm:flex-row">
                <div class="flex flex-1 items-center justify-center">
                    <img src="{{ asset('img/conocenos-dog.png') }}" alt="Conocenos" class="h-80 w-80 object-cover">
                </div>
                <div class="flex flex-1 flex-col gap-4 px-4 text-sm text-zinc-700 sm:pe-20 md:text-base">
                    <h1 class="text-4xl font-bold text-light-blue">MIGUITAS</h1>
                    <p>MIGUITAS PET TREATS nace en 2015 como
                        una iniciativa para que toda la familia
                        comparta los mejores sabores y la mejor
                        calidad cuando se trata de celebraciones, o
                        quizá, darse un gustito. Nuestras mascotas
                        también son parte de la familia, y no
                        podemos dejarlos atrás.
                    </p>
                    <p>Cada producto Miguitas es elaborado con
                        pasión, cuidando el detalle de la frescura y
                        calidad de cada uno de los ingredientes que
                        utilizamos. Ahora puedes adquirir cualquier
                        producto Miguitas directamente desde aquí y
                        te lo llevamos a tu casa u oficina.</p>
                </div>
            </div>
            <div class="mt-20 text-zinc-700">
                <div class="mx-auto flex w-full flex-col gap-4 px-4 text-sm sm:w-1/2 sm:px-0 md:text-base">
                    <p>En Miguitas, horneamos todos los días para los consentidos de cuatro patitas. ¡Elaboramos pasteles,
                        pupcakes y galletas de diferentes sabores, tamaño y forma para que cada día puedas consentir a tu
                        perrito o gatito de la mejor manera: natural! Tenemos también otros snacks como jerky, meatballs y
                        paletas además de accesorios: gorros, bandanas, velas, etc.
                    </p>
                    <p>
                        Contamos con registro del Ministerio de Agricultura y Ganadería para la elaboración de alimentos
                        para los peludos. <b class="light-blue">Ver Registro.</b>
                    </p>
                    <p>
                        Nuestros perritos suelen cansarse de comer su concentrado diario, es por ello que MIGUITAS PET
                        TREATS te ofrece una alternativa saludable y nutritiva para que puedas consentir y variar la dieta
                        de
                        tu mascota, o si prefieres usarlas como premio para su entrenamiento.
                    </p>
                </div>
                <div class="mx-auto mt-10 w-full px-4 sm:w-4/5 md:w-3/5">
                    <h2 class="text-lg font-bold text-light-blue sm:text-xl md:text-2xl">
                        Cada producto es elaborado con pasión, cuidando el detalle de la frescura y calidad de cada uno de
                        los ingredientes.
                    </h2>
                    <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:gap-4 md:gap-8">
                        <div class="flex flex-1 flex-col gap-4">
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">PAWTY PACKS</h3>
                                <p>
                                    La mejor manera de celebrar a tu peludo en su cumpleaños, su adopción, su logro, etc
                                </p>
                            </div>
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">JERKY</h3>
                                <p>
                                    Res o pollo deshidratado.100% proteína. Sin nada artificial, sólo ingredientes frescos
                                    sin aditivos, pre-mezclas o fillers. ¡El treat perfecto para los carnívoros!
                                </p>
                            </div>
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">PUPCAKES</h3>
                                <p>
                                    La versión perruna individual de un pastel de celebración. Ingredientes frescos y máxima
                                    calidad. ¡Más prácticos, imposible!
                                </p>
                            </div>
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">PUPSICLES</h3>
                                <p>
                                    Paletas de distintos sabores para peludos, cero ingredientes alérgenos o esencias
                                    artificiales, perfectas para los que mueren de calor y les gusta lo helado
                                </p>
                            </div>

                        </div>
                        <div class="flex flex-1 flex-col gap-4">
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">COOKIES</h3>
                                <p>
                                    Premia y varía la dieta de tu mascota con cualquiera de nuestros 9 sabores de galletas
                                    naturales
                                </p>
                            </div>
                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">ACCESORIOS</h3>
                                <p>
                                    Gorros, pañoletas, velas, números de galleta y globos huellitas. ¡Tenemos el accesorio
                                    perfecto para su celebración!
                                </p>
                            </div>

                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">CAKES</h3>
                                <p>¿Tu peludo está por cumplir años? Nosotros te hacemos el pastel para que celebres con él,
                                    ¡naturalmente!

                                </p>
                            </div>

                            <div
                                class="flex flex-col gap-2 rounded-2xl border border-zinc-200 p-4 text-sm shadow-md md:text-base">
                                <h3 class="text-lg font-bold text-dark-pink sm:text-xl">KITTYCAKES</h3>
                                <p>
                                    Los gatos también son consentidos en Miguitas, nuestra receta de Kittycakes sorprenderá
                                    a este rey de la casa tan especial.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto my-20 w-full px-4 md:w-1/2">
                    <h2 class="text-lg font-bold text-light-blue sm:text-xl md:text-2xl">
                        Creemos en la alimentación natural para el bienestar integral, y mayor longevidad de tu mascota.
                    </h2>
                    <div class="mt-4 flex items-center justify-center gap-4">
                        <x-button-store type="a" href="{{ Route('store') }}" text="Ver productos"
                            typeButton="primary" />
                        <x-button-store type="a" href="{{ Route('contact') }}" text="Contáctanos"
                            typeButton="secondary" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
