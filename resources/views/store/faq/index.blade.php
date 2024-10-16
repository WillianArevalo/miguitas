@extends('layouts.template')
@section('title', 'Preguntas frecuentes')

@section('content')
    <div class="main-container">
        <div class="w-full py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-5xl font-bold text-white">
                Preguntas frecuentes
            </h1>
        </div>
        <div class="flex flex-col">
            <div class="my-10 flex flex-col items-start justify-center gap-10 px-4 sm:justify-between md:flex-row">
                <div class="flex flex-1 items-center justify-center sm:justify-end">
                    <h1 class="text-4xl text-blue-store">
                        Cuenta
                    </h1>
                </div>
                <section class="flex flex-[2] flex-col gap-8 px-4 text-sm text-zinc-700 sm:px-10 md:text-base">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="">
                            <button
                                class="accordion-header flex w-full items-center justify-start gap-2 text-base md:text-lg"
                                data-target="#panel-{{ $i }}">
                                <x-icon-store icon="caret-right" class="h-5 w-5 text-zinc-800 transition-transform" />
                                Descripción
                            </button>
                            <div id="panel-{{ $i }}"
                                class="hidden animate-fade-down transition-all animate-duration-300">
                                <div class="p-6">
                                    <p class="text-sm text-zinc-700 sm:text-base">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas blanditiis commodi
                                        omnis necessitatibus temporibus repellendus, aspernatur ducimus sint assumenda
                                        deleniti quia voluptates, esse, ipsum impedit quo quas quos ea numquam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </section>
            </div>
            <div class="line"></div>
            <div class="my-10 flex flex-col items-start justify-center gap-10 px-4 sm:justify-between md:flex-row">
                <div class="flex flex-1 items-center justify-center sm:justify-end">
                    <h1 class="text-4xl text-blue-store">
                        Ordenes
                    </h1>
                </div>
                <section class="flex flex-[2] flex-col gap-8 px-4 text-sm text-zinc-700 sm:px-10 md:text-base">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="">
                            <button
                                class="accordion-header flex w-full items-center justify-start gap-2 text-base md:text-lg"
                                data-target="#panel-two-{{ $i }}">
                                <x-icon-store icon="caret-right" class="h-5 w-5 text-zinc-800 transition-transform" />
                                Descripción
                            </button>
                            <div id="panel-two-{{ $i }}"
                                class="hidden animate-fade-down transition-all animate-duration-300">
                                <div class="p-6">
                                    <p class="text-sm text-zinc-700 sm:text-base">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas blanditiis commodi
                                        omnis necessitatibus temporibus repellendus, aspernatur ducimus sint assumenda
                                        deleniti quia voluptates, esse, ipsum impedit quo quas quos ea numquam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </section>
            </div>
        </div>
    </div>
@endsection
