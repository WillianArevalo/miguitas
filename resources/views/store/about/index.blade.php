@extends('layouts.template')
@section('title', 'Miguitas | Conócenos')
@push('styles')
    @vite('resources/css/store/conocenos.css')
@endpush
@section('content')
    <div class="main-container">
        <div class="header" style="background-image: url({{ asset('img/conocenos.png') }});">
            <div class="btn">
                <a href="contactanos.html">
                    <button>CONTÁCTANOS</button>
                </a>
            </div>
        </div>
        <div class="content mt-4">
            <div class="container1">
                <div class="img">
                    <img src="{{ asset('img/conocenos-dog.png') }}" alt="Conocenos">
                </div>
                <div class="text-info">
                    <h1>MIGUITAS</h1>
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
            <div class="container2">
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
                <h2>Cada producto es elaborado con pasión,
                    cuidando el detalle de la frescura y calidad de
                    cada uno de los ingredientes.
                </h2>
                <div class="product-info">
                    <div class="info-item">
                        <h3>PAWTY PACKS</h3>
                        <p>La mejor manera de celebrar a tu peludo en
                            su cumpleaños, su adopción, su logro, etc</p>
                    </div>
                    <div class="info-item">
                        <h3>COOKIES</h3>
                        <p>Premia y varía la dieta de tu mascota con
                            cualquiera de nuestros 9 sabores de galle-
                            tas naturales</p>
                    </div>
                    <div class="info-item">
                        <h3>JERKY</h3>
                        <p>Res o pollo deshidratado.100% proteína. Sin
                            nada artificial, sólo ingredientes frescos sin
                            aditivos, pre-mezclas o fillers. ¡El treat per-
                            fecto para los carnívoros!</p>
                    </div>
                    <div class="info-item">
                        <h3>ACCESORIOS</h3>
                        <p>Gorros, pañoletas, velas, números de galleta
                            y globos huellitas. ¡Tenemos el accesorio
                            perfecto para su celebración!</p>
                    </div>
                    <div class="info-item">
                        <h3>PUPCAKES</h3>
                        <p>La versión perruna individual de un pastel de
                            celebración. Ingredientes frescos y máxima
                            calidad. ¡Más prácticos, imposible!</p>
                    </div>
                    <div class="info-item">
                        <h3>CAKES</h3>
                        <p>¿Tu peludo está por cumplir años? Nosotros
                            te hacemos el pastel para que celebres con
                            él, ¡naturalmente!</p>
                    </div>
                    <div class="info-item">
                        <h3>PUPSICLES</h3>
                        <p>Paletas de distintos sabores para peludos,
                            cero ingredientes alérgenos o esencias artifi-
                            ciales, perfectas para los que mueren de
                            calor y les gusta lo helado</p>
                    </div>
                    <div class="info-item">
                        <h3>KITTYCAKES</h3>
                        <p>Los gatos también son consentidos en Migui-
                            tas, nuestra receta de Kittycakes sorprenderá
                            a este rey de la casa tan especial.</p>
                    </div>
                </div>
                <h2>Creemos en la alimentación natural para el
                    bienestar integral, y mayor longevidad de tu
                    mascota.
                </h2>
                <div class="action-buttons">
                    <a href="{{ Route('store') }}" class="btn-primary sm uppercase">
                        Ver productos
                    </a>
                    <a href="{{ Route('contact') }}" class="btn-primary sm uppercase">
                        Contactarnos
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
