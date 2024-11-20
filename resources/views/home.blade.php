@extends('layouts.template')
@section('title', 'Miguitas | Inicio')
@section('content')
    <div class="overflow-x-hidden">
        <div class="relative flex h-[700px] w-full items-center justify-center bg-blue-store">
            <div class="flex-1">
                <img src="{{ asset('img/index-dog.jpg') }}" alt="cake" class="h-[700px] w-full object-cover">
            </div>
            <div class="relative z-10 mx-auto flex h-full w-full flex-1 flex-col items-center justify-center p-10">
                <h1 class="mx-auto w-full text-center text-xl font-bold text-white sm:text-2xl md:text-4xl lg:w-2/3">
                    Celébralos con un pastel especial, elaborado con ingredientes de alta calidad desde 2015.
                </h1>
                <div class="mt-8 flex items-center justify-center">
                    <x-button-store type="button" typeButton="secondary" text="Ordenar pastel" size="large" />
                </div>
                <div
                    class="absolute -bottom-6 left-0 right-0 mx-auto flex w-max items-center gap-4 rounded-3xl bg-pink-store p-4 shadow-lg">
                    <p class="text-lg text-zinc-800 sm:text-xl md:text-2xl">Excelente</p>
                    <div class="flex items-center gap-2">
                        @for ($i = 0; $i < 5; $i++)
                            <x-icon-store icon="star" class="h-5 w-5 text-zinc-800" />
                        @endfor
                    </div>
                    <p class="text-base text-zinc-800 sm:text-lg md:text-xl">3,250 review</p>
                </div>
            </div>
        </div>

        @if ($topProducts->count() > 0)
            <div class="mb-10 mt-20 px-0 sm:px-4 md:px-10">
                <h2 class="my-4 text-center text-3xl text-light-blue sm:text-4xl md:text-5xl">
                    Top sellers
                </h2>
                <div class="mt-4">
                    <div class="swiper mySwiper w-100 h-full px-4">
                        <div class="swiper-wrapper pb-10">
                            @foreach ($topProducts as $product)
                                <x-card-product2 :product="$product" />
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="mt-4 flex items-center justify-center">
                        <x-button-store type="button" typeButton="primary" text="Ver más" />
                    </div>
                </div>
            </div>
        @endif

        <div class="marquees">
            <div class="marquee-slider">
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="natural" class="h-5 w-5" />
                    Ingredientes naturales de alta calidad. No fillers.
                </span>
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="meat" class="h-5 w-5" />
                    La mejor materia prima en plaza. Carnes magras.
                </span>
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="gluten" class="h-5 w-5" />
                    Gluten free - No adivitos - No saborizantes - No preserverantes
                </span>
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="love" class="h-5 w-5" />
                    Ba(r)ked with Love. Producción en pequeños lotes.
                </span>
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="check-medic" class="h-5 w-5" />
                    Aprobados por veterinarios.
                </span>
                <span class="mx-4 flex items-center gap-2 text-dark-blue">
                    <x-icon-store icon="check-duotone" class="h-5 w-5" />
                    Registrados en MAG, MH y DC.
                </span>
            </div>
        </div>

        <div>
            <div class="flex flex-col gap-8 bg-pink-store py-4 xl:flex-row">
                <div class="flex-1 text-center">
                    <h3 class="text-lg text-blue-store sm:text-xl md:text-2xl lg:text-3xl">
                        Producto del mes
                    </h3>
                    <div class="mt-4 flex flex-col items-center justify-center gap-4">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="flex items-start justify-center gap-4">
                                <span class="mt-1 flex items-center justify-center">
                                    <x-icon-store icon="circle-check" class="h-8 w-8 text-blue-store" />
                                </span>
                                <div class="flex w-1/2 flex-col gap-2 text-left">
                                    <p class="text-lg text-blue-store sm:text-xl md:text-2xl">
                                        #Cake Corazón FurryLove
                                    </p>
                                    <p class="text-wrap text-xs text-gray-store sm:text-sm md:text-base">
                                        Pastel de cumpleaños para perros y gatos con ingredientes naturales.
                                    </p>
                                </div>
                            </div>
                        @endfor
                        <div class="flex items-center justify-center">
                            <x-button-store type="button" typeButton="primary" text="Ver producto" />
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <img src="{{ asset('img/pet-food.png') }}" alt="Pet food"
                        class="mx-auto h-96 w-96 object-cover xl:h-[500px]">
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="text-center">
                <h2 class="my-4 text-center text-3xl text-light-blue sm:text-4xl md:text-5xl">
                    ¡Peludos consentidos a la vista¡
                </h2>
            </div>
            <div class="relative right-24 mb-[600px] mt-14 flex items-center justify-center">
                <!-- Card 1 -->
                <div
                    class="card absolute top-0 z-10 w-max -translate-x-10 translate-y-[150px] rotate-12 transform rounded-[30px] border border-zinc-100 bg-white p-2 shadow-2xl sm:-translate-x-20 sm:p-6 md:-translate-x-60 md:translate-y-[100px]">
                    <div class="card-header flex items-center gap-2 md:gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                            class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
                        <div class="flex flex-col items-start">
                            <p class="font-pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                            <p class="font-pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
                        </div>
                    </div>
                    <div class="card-image mt-2">
                        <img src="{{ asset('img/pets1.jpg') }}" alt="Featured2 image"
                            class="h-48 w-48 rounded-xl object-cover md:h-52 md:w-52">
                    </div>
                    <div class="card-body mt-2">
                        <div class="flex items-center justify-start">
                            <div class="flex items-center gap-3">
                                <a href="">
                                    <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="comment" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                            </div>
                        </div>
                        <div>
                            <small class="mt-2 block text-start">
                                <p class="font-pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="card absolute top-0 z-0 w-max translate-x-[50px] -rotate-12 transform rounded-[30px] border border-zinc-100 bg-white p-2 shadow-2xl sm:p-6 md:translate-x-[10px]">
                    <div class="card-header flex items-center gap-2 md:gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                            class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
                        <div class="flex flex-col items-start">
                            <p class="font-pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                            <p class="font-pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
                        </div>
                    </div>
                    <div class="card-image mt-2">
                        <img src="{{ asset('img/pets2.jpg') }}" alt="Featured2 image"
                            class="h-48 w-48 rounded-xl object-cover md:h-52 md:w-52">
                    </div>
                    <div class="card-body mt-2">
                        <div class="flex items-center justify-start">
                            <div class="flex items-center gap-3">
                                <a href="">
                                    <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="comment" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                            </div>
                        </div>
                        <div>
                            <small class="mt-2 block text-start">
                                <p class="font-pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="card absolute top-0 z-20 w-max translate-x-[200px] translate-y-[150px] rotate-3 transform rounded-[30px] border border-zinc-100 bg-white p-2 shadow-2xl sm:p-6">
                    <div class="card-header flex items-center gap-2 md:gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                            class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
                        <div class="flex flex-col items-start">
                            <p class="font-pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                            <p class="font-pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
                        </div>
                    </div>
                    <div class="card-image mt-2">
                        <img src="{{ asset('img/pets3.jpg') }}" alt="Featured2 image"
                            class="h-48 w-48 rounded-xl object-cover md:h-52 md:w-52">
                    </div>
                    <div class="card-body mt-2">
                        <div class="flex items-center justify-start">
                            <div class="flex items-center gap-3">
                                <a href="">
                                    <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="comment" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                            </div>
                        </div>
                        <div>
                            <small class="mt-2 block text-start">
                                <p class="font-pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="card absolute top-0 z-0 w-max -translate-y-[20px] translate-x-[210px] -rotate-12 transform rounded-[30px] border border-zinc-100 bg-white p-2 shadow-2xl sm:translate-x-[310px] sm:p-4 md:translate-x-[410px] md:translate-y-[60px]">
                    <div class="card-header flex items-center gap-2 md:gap-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                            class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
                        <div class="flex flex-col items-start">
                            <p class="font-pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                            <p class="font-pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
                        </div>
                    </div>
                    <div class="card-image mt-2">
                        <img src="{{ asset('img/pets4.jpg') }}" alt="Featured2 image"
                            class="h-48 w-48 rounded-xl object-cover md:h-52 md:w-52">
                    </div>
                    <div class="card-body mt-2">
                        <div class="flex items-center justify-start">
                            <div class="flex items-center gap-3">
                                <a href="">
                                    <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="comment" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                </a>
                                <a href="">
                                    <x-icon-store icon="send" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" />
                                </a>
                            </div>
                        </div>
                        <div>
                            <small class="mt-2 block text-start">
                                <p class="font-pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div
                class="mx-auto flex w-full flex-col gap-4 rounded-3xl border border-zinc-100 p-10 px-4 shadow-xl sm:flex-row lg:w-3/4">
                <div class="flex-1">
                    <div>
                        <h4 class="text-center text-xl font-bold text-dark-pink sm:text-2xl md:text-3xl">
                            Cake Corazón FurryLove
                        </h4>
                        <p class="mt-4 font-dine-r text-sm text-zinc-600 sm:text-base md:text-lg">
                            Creamos este pastel natural y especial para que la pancita de tu amor eterno se alegre aun
                            más
                            ya sea compartiéndolo con sus amigos o hermanitos, o el sólito. Porque ellos no son solo
                            nuestros mejores amigos, sino también nuestros amores eternos y fieles. ¡Por eso los
                            consentimos!
                        </p>
                        <p class="mt-4 font-dine-r text-sm text-zinc-600 sm:text-base md:text-lg">
                            Todos nuestros productos son horneados con ingredientes naturales, sin preservantes
                            artificiales, no contienen trigo (principal alérgeno) y son elaborados especialmente para su
                            peludo!
                        </p>
                        <div class="mt-4 flex items-center justify-center">
                            <x-button-store type="a" href="#" class="w-full sm:w-auto" typeButton="primary"
                                text="Ver producto" size="large" />
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('img/cake-corazon.png') }}" class="h-96 w-96 object-cover"
                            alt="Cake corazon">
                    </div>
                    <div class="mt-4">
                        <p class="mt-4 font-dine-r text-sm text-blue-store sm:text-base md:text-lg">
                            (Mantequilla maní natural, Tocino horneado, Zanahoria, Queso. Se recomienda que el o los
                            peluditos hayan probado anteriormente un treat de sabor de mantequilla de maní)
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-20">
            <div class="text-center">
                <h2 class="my-4 text-center text-3xl text-light-blue sm:text-4xl md:text-5xl">
                    Pasteles disfrutados por peluditos
                </h2>
            </div>

            <div
                class="relative mx-auto mt-4 flex w-full flex-col gap-8 rounded-3xl bg-light-pink px-10 pb-6 pt-10 sm:flex-row xl:w-3/4">
                <div class="flex flex-1 items-center justify-center">
                    <img src="{{ asset('img/chihuahua.png') }}" alt="Chihuahua" class="h-80 w-80 sm:h-full sm:w-full">
                </div>
                <div class="flex flex-[4] items-center justify-center">

                    <div class="flex items-center gap-4 text-light-blue">
                        <div class="text-[50px] sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">+</p>
                        </div>
                        <div class="bg-white p-2 text-[40px] sm:p-4 sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">1</p>
                        </div>
                        <div class="bg-white p-2 text-[40px] sm:p-4 sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">5</p>
                        </div>
                        <div class="text-[50px] sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">,</p>
                        </div>
                        <div class="bg-white p-2 text-[40px] sm:p-4 sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">0</p>
                        </div>
                        <div class="bg-white p-2 text-[40px] sm:p-4 sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">0</p>
                        </div>
                        <div class="bg-white p-2 text-[40px] sm:p-4 sm:text-[70px] md:text-[80px] lg:text-[100px]">
                            <p class="text-shadow-lg">0</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-1 left-0 h-max w-full rounded-full bg-brown-store p-2 shadow-xl sm:p-4">
                </div>
            </div>
        </div>

        @if ($products->count() > 0)
            <div class="mt-20">
                <div class="mt-4 px-0 sm:px-4 md:px-10">
                    <div>
                        <div class="swiper mySwiper w-100 h-full px-4">
                            <div class="swiper-wrapper pb-10">
                                @foreach ($products as $product)
                                    <x-card-product2 :product="$product" />
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex items-center justify-center">
                    <x-button-store type="button" typeButton="primary" text="Ver más" />
                </div>
            </div>
        @endif

        <div class="my-20">
            <div class="relative mx-auto flex w-full px-4 xl:w-1/2">
                <div
                    class="absolute -bottom-36 left-0 z-10 flex-1 rotate-6 transform shadow-2xl sm:relative sm:-top-5 sm:left-2">
                    <img src="{{ asset('img/pack-products.png') }}" class="h-40 w-40 object-cover sm:h-full sm:w-full"
                        alt="Pack products">
                </div>
                <div class="h-max flex-[2]">
                    <h4 class="text-center text-xl font-bold uppercase text-light-blue sm:text-2xl md:text-3xl">
                        PAWTY PACKS
                    </h4>
                    <div class="relative ms-4 mt-4 rounded-e-[30px] border border-zinc-200 px-10 py-6 shadow-xl">
                        <p class="font-dine-r text-base text-zinc-600 md:text-lg">
                            ¡La mejor manera de celebrar a tu peludo en su cumpleaños, su adopción, su logro o cualquier
                            otro motivo!
                        </p>
                        <p class="mt-8 font-dine-r text-base text-zinc-600 md:text-lg">
                            Incluye pastel o pupcakes, 1 gorro, 3 globos, 1 galleta, 1 número de galleta y 1 bandana
                            birthday
                            boy o girl. También puedes comprar estos artículos individualmente.
                        </p>
                        <div class="absolute -bottom-6 right-0 z-30">
                            <x-button-store class="uppercase" text="Compre su PAWTY PACK completo" type="button"
                                typeButton="primary" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative mx-auto mt-56 flex w-full px-4 sm:mt-20 xl:w-1/2">
                <div
                    class="absolute -bottom-36 left-0 z-10 flex-1 rotate-6 transform shadow-2xl sm:relative sm:-top-5 sm:left-2">
                    <img src="{{ asset('img/pack-products.png') }}" class="h-40 w-40 object-cover sm:h-full sm:w-full"
                        alt="Pack products">
                </div>
                <div class="h-max flex-[2]">
                    <h4 class="text-center text-xl font-bold uppercase text-light-blue sm:text-2xl md:text-3xl">
                        PAWTY PACKS
                    </h4>
                    <div class="relative ms-4 mt-4 rounded-e-[30px] border border-zinc-200 px-10 py-6 shadow-xl">
                        <p class="font-dine-r text-base text-zinc-600 md:text-lg">
                            ¡La mejor manera de celebrar a tu peludo en su cumpleaños, su adopción, su logro o cualquier
                            otro motivo!
                        </p>
                        <p class="mt-8 font-dine-r text-base text-zinc-600 md:text-lg">
                            Incluye pastel o pupcakes, 1 gorro, 3 globos, 1 galleta, 1 número de galleta y 1 bandana
                            birthday
                            boy o girl. También puedes comprar estos artículos individualmente.
                        </p>
                        <div class="absolute -bottom-6 right-0 z-30">
                            <x-button-store class="uppercase" text="Compre su PAWTY PACK completo" type="button"
                                typeButton="primary" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-56 sm:mt-20">
            <div class="text-center">
                <h2 class="my-4 text-center text-3xl text-light-blue sm:text-4xl md:text-5xl">
                    MiguiNews
                </h2>
                <p class="font-dine-r text-sm font-medium text-dark-pink sm:text-base md:text-lg">
                    Conoce mas sobre nosotros y lo que estamos haciendo en nuestro
                    <a href="{{ Route('blog') }}" class="text-blue-store underline">blog</a>
                </p>
            </div>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <div
                    class="card relative h-[450px] w-80 overflow-hidden rounded-[50px] border border-zinc-200 shadow-xl md:h-[540px]">
                    <div class="card-img">
                        <img src="{{ asset('img/blog-img-2.jpg') }}" alt="Blog 1" class="h-56 w-full object-cover">
                    </div>
                    <div class="relative -top-10 flex flex-col gap-4 p-6">
                        <h5 class="text-sm text-blue-store sm:text-base md:text-lg">
                            Título del blog
                        </h5>
                        <p class="font-dine-r text-xs text-gray-store sm:text-sm md:text-base">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut sapiente velit laborum,
                            totam dicta, sint incidunt similique, obcaecati nemo architecto inventore ea quidem
                            reprehenderit dignissimos eveniet atque quo
                        </p>
                        <div class="flex justify-between">
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="user" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">Autor</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="clock" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">
                                    hace 2 horas
                                </span>
                            </div>
                        </div>
                        <x-button-store type="button" typeButton="primary" text="Leer más" />
                    </div>
                </div>
                <div
                    class="card relative h-[450px] w-80 overflow-hidden rounded-[50px] border border-zinc-200 shadow-xl md:h-[540px]">
                    <div class="card-img">
                        <img src="{{ asset('img/blog-img-2.jpg') }}" alt="Blog 1" class="h-56 w-full object-cover">
                    </div>
                    <div class="relative -top-10 flex flex-col gap-4 p-6">
                        <h5 class="text-sm text-blue-store sm:text-base md:text-lg">
                            Título del blog
                        </h5>
                        <p class="font-dine-r text-xs text-gray-store sm:text-sm md:text-base">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut sapiente velit laborum,
                            totam dicta, sint incidunt similique, obcaecati nemo architecto inventore ea quidem
                            reprehenderit dignissimos eveniet atque quo
                        </p>
                        <div class="flex justify-between">

                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="user" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">Autor</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="clock" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">
                                    hace 2 horas
                                </span>
                            </div>

                        </div>
                        <x-button-store type="button" typeButton="primary" text="Leer más" />
                    </div>
                </div>
                <div
                    class="card relative h-[450px] w-80 overflow-hidden rounded-[50px] border border-zinc-200 shadow-xl md:h-[540px]">
                    <div class="card-img">
                        <img src="{{ asset('img/perro con lentes.jpg') }}" alt="Blog 1"
                            class="h-56 w-full object-cover">
                    </div>
                    <div class="relative -top-10 flex flex-col gap-4 p-6">
                        <h5 class="text-sm text-blue-store sm:text-base md:text-lg">
                            Título del blog
                        </h5>
                        <p class="font-dine-r text-xs text-gray-store sm:text-sm md:text-base">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut sapiente velit laborum,
                            totam dicta, sint incidunt similique, obcaecati nemo architecto inventore ea quidem
                            reprehenderit dignissimos eveniet atque quo
                        </p>
                        <div class="flex justify-between">
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="user" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">Autor</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="clock" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">
                                    hace 2 horas
                                </span>
                            </div>
                        </div>
                        <x-button-store type="button" typeButton="primary" text="Leer más" />
                    </div>
                </div>
                <div
                    class="card relative h-[450px] w-80 overflow-hidden rounded-[50px] border border-zinc-200 shadow-xl md:h-[540px]">
                    <div class="card-img">
                        <img src="{{ asset('img/blog-img-2.jpg') }}" alt="Blog 1" class="h-56 w-full object-cover">
                    </div>
                    <div class="relative -top-10 flex flex-col gap-4 p-6">
                        <h5 class="text-sm text-blue-store sm:text-base md:text-lg">
                            Título del blog
                        </h5>
                        <p class="font-dine-r text-xs text-gray-store sm:text-sm md:text-base">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere aut sapiente velit laborum,
                            totam dicta, sint incidunt similique, obcaecati nemo architecto inventore ea quidem
                            reprehenderit dignissimos eveniet atque quo
                        </p>
                        <div class="flex justify-between">
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="user" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">Autor</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="rounded-full bg-rose-100 p-2">
                                    <x-icon-store icon="clock" class="h-3 w-3 text-dark-pink" />
                                </span>
                                <span class="font-dine-r text-xs text-gray-store sm:text-sm">
                                    hace 2 horas
                                </span>
                            </div>
                        </div>
                        <x-button-store type="button" typeButton="primary" text="Leer más" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <div class="mb-8 flex flex-col items-center justify-center gap-2">
                <div class="text-center">
                    <h2 class="my-4 text-center text-3xl text-light-blue sm:text-4xl md:text-5xl">¡Síguenos en
                        Instagram!
                    </h2>
                </div>
                <span class="font-dine-r text-sm text-gray-store">Mira nuestras últimas publicaciones</span>
                <x-button-store type="a" typeButton="secondary" text="Ver más" class="w-max" icon="instagram"
                    size="small" href="https://www.instagram.com/miguitaselsalvador/" target="_blank" />
            </div>
            <script src="https://static.elfsight.com/platform/platform.js" async></script>
            <div class="elfsight-app-3111fc49-9741-4f51-a3e6-3a8c8e2c8eff a-none font-dine-r" data-elfsight-app-lazy>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        var copy = document.querySelector(".marquee-slider").cloneNode(true);
        document.querySelector(".marquees").appendChild(copy);
    </script>
@endpush
