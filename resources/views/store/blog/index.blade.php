@extends('layouts.template')
@section('title', 'Miguitas | Blog')
@section('content')
    <div>
        <div class="py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-5xl font-bold text-white">
                Blog
            </h1>
        </div>
        <div class="my-8">
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                @for ($i = 0; $i < 5; $i++)
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
                            <x-button-store type="a" href="{{ Route('blog.show', 'mi-blog') }}" typeButton="primary"
                                text="Leer más" />
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
