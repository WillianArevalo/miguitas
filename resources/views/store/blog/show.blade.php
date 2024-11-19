@extends('layouts.template')
@section('title' | 'Miguitas | Blog')
@section('content')
    <div>
        <div class="py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-xl font-bold text-white sm:text-2xl md:text-3xl">
                5 cosas que puedes hacer en el Día Mundial del Perro
            </h1>
            <div class="mt-4 flex items-center justify-center gap-4">
                <small class="font-dine-r text-white">
                    19 de septiembre de 2021
                </small>
                <span class="block h-2 w-2 rounded-full bg-white"></span>
                <small class="font-dine-r text-white">
                    8:40 AM
                </small>
            </div>
        </div>
        <div>
            <img src="{{ asset('img/pet-food.png') }}" alt="Image blog" class="mx-auto h-96 w-full object-cover">
        </div>
        <div class="p-4 sm:p-6 md:p-10">
            <div class="flex flex-col-reverse gap-4 lg:flex-row">
                <aside class="flex-1 lg:px-10">
                    <h3 class="font-pluto-r text-lg font-medium text-blue-store md:text-xl">
                        Artículos relacionados
                    </h3>
                    <ul class="mt-4 flex flex-col gap-2">
                        <li>
                            <a href="#" class="font-dine-r text-sm text-zinc-600 hover:underline md:text-base">
                                21 De Julio es el Día Mundial del Perro
                            </a>
                        </li>
                        <li>
                            <a href="#" class="font-dine-r text-sm text-zinc-600 hover:underline md:text-base">
                                10 cosas que no sabías de los gatos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="font-dine-r text-sm text-zinc-600 hover:underline md:text-base">
                                5 cosas que puedes hacer en el Día Mundial del Perro
                            </a>
                        </li>
                        <li>
                            <a href="#" class="font-dine-r text-sm text-zinc-600 hover:underline md:text-base">
                                Como cuidar a tu peludito
                            </a>
                        </li>
                    </ul>
                </aside>
                <div class="flex-[4]">
                    <div class="w-full md:w-4/5">
                        <section>
                            <h2 class="text-2xl font-bold text-blue-store md:text-3xl">
                                ¡21 De Julio es el Día Mundial del Perro!
                            </h2>
                            <p class="mt-2 text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                Nuestras vidas no serian iguales sin los perritos ¿no lo crees? Por eso desde el 2004 los
                                homenajeamos este día. Todos nuestros peluditos saben que es tener una familia que los ama y
                                los
                                cuida, pero muchos otros en nuestro país y resto del mundo, no han tenido esa bendición. Y
                                es
                                que según la OMS 7 de cada 10 perritos en el mundo no tienen hogar.Por ello queremos
                                reflexionar
                                en decisiones que podríamos tomar hoy al respecto:
                            </p>
                        </section>
                        <section class="mt-4">
                            <div class="flex flex-col items-center gap-8 lg:flex-row">
                                <div class="flex-1">
                                    <img src="{{ asset('img/conocenos-dog.png') }}" alt="Image blog"
                                        class="h-96 w-full object-cover">
                                </div>
                                <div class="flex-[2]">
                                    <div>
                                        <h2 class="font-pluto-r text-xl font-semibold text-zinc-500 md:text-2xl">
                                            1. Adoptar un peludito.
                                        </h2>
                                        <p class="text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                            En nuestro país son muchos los refugios que cuentan con cientos de perritos en
                                            sus
                                            albergues y cada uno busca una casita que puedan llenar de amor. Si, muchos han
                                            sufrido maltrato o se han enfermado por el abandono, pero el vinculo que se crea
                                            con
                                            ellos puede con ello. Es una noble y gran responsabilidad.
                                        </p>
                                    </div>
                                    <div class="mt-4">
                                        <h2 class="font-pluto-r text-xl font-semibold text-zinc-500 md:text-2xl">
                                            2. Apoyar un refugio.
                                        </h2>
                                        <p class="text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                            Si, desde donar $1 hasta convertirse en un padrino de un perrito en especifico y
                                            porqué no volverse un embajador de su causa y promoviendo su labor de todas las
                                            formas posibles. Compartiendo nuestras redes sociales sobre la labor y
                                            necesidades
                                            que tienen, puede ayudar mucho a crear conciencia y llevarles ayuda. Creemos que
                                            cada
                                            uno puede aportar un granito de arena para apoyar a aquellos que han decidido
                                            trabajar
                                            por ellos cada día.
                                            <br>
                                            <br>
                                            Agradecemos a Asociación Milagros de Amor, La Manada de Pick y Refugio Felino
                                            Cat
                                            Shelter por su arduo trabajo y por velar por todos los animalitos que tanto los
                                            necesitan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h2 class="font-pluto-r text-xl font-semibold text-zinc-500 md:text-2xl">
                                    3. Esterilizar y cuidar a tus mascotas.
                                </h2>
                                <p class="text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                    Aunque para muchos este sea un tema sensible, la esterilización es una de las mejores
                                    herramientas que ha demostrado su gran eficacia en evitar que el numero de perritos sin
                                    hogar aumente. De esta forma se puede cortar el ciclo de abandono y también la
                                    reproducción desmedida. Muchos refugios realizan cam- pañas de esterilización a bajo
                                    costo.
                                </p>
                            </div>
                            <div class="mt-4">
                                <h2 class="font-pluto-r text-xl font-semibold text-zinc-500 md:text-2xl">
                                    4. Denunciar el maltrato animal.
                                </h2>
                                <p class="text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                    ¿Ya conoces como denunciar efectivamente?
                                    Primero debes tener pruebas del delito. También conocer la hora y fecha en que ocurrió
                                    el hecho, para luego poner la denuncia en la alcaldía correspondiente. Si ellos no
                                    actúan, entonces puedes contactar al IBA (Instituto de Bienestar Animal de El Salvador)
                                </p>
                            </div>
                            <div class="mt-4">
                                <h2 class="font-pluto-r text-xl font-semibold text-zinc-500 md:text-2xl">
                                    5. Cuidarlos en la calle.
                                </h2>
                                <p class="text-left font-dine-r text-sm text-zinc-500 md:text-base">
                                    Si tienes la oportunidad de darle agüita, comida o resguardo a un perrito en las calles,
                                    por favor ¡hazlo! Si manejas, hazlo con cuidado si observas perritos sueltos alrededor.
                                    Déjalos cruzar las calles y frena para no lastimarlos. La mayoría de ocasiones ellos
                                    están en busca de satisfacer sus necesidades mas básicas
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
