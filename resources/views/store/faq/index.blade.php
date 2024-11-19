@extends('layouts.template')
@section('title', 'Miguitas | Preguntas frecuentes')
@section('content')
    <div class="main-container">
        <div class="w-full py-20 text-center" style="background-image: url({{ asset('img/bg-image.png') }});">
            <h1 class="text-5xl font-bold text-white">
                Preguntas frecuentes
            </h1>
        </div>
        <div class="flex flex-col">
            @php
                $groupedFaqs = $faqs->groupBy(function ($faq) {
                    return $faq->category->name;
                });
            @endphp
            @foreach ($groupedFaqs as $categoryName => $faqs)
                <div class="my-10 flex flex-col items-start justify-center gap-10 px-4 sm:justify-between md:flex-row">
                    <div class="flex flex-1 items-center justify-center sm:justify-end">
                        <h1 class="text-4xl text-blue-store">
                            {{ $categoryName }}
                        </h1>
                    </div>
                    <section class="flex flex-[2] flex-col gap-8 px-4 text-sm text-zinc-700 sm:px-10 md:text-base">
                        @foreach ($faqs as $faq)
                            <div class="">
                                <button
                                    class="accordion-header font-font-dine-r flex w-full items-center justify-start gap-2 text-base md:text-lg"
                                    data-target="#panel-{{ $faq->id }}">
                                    <x-icon-store icon="caret-right" class="h-5 w-5 text-zinc-800 transition-transform" />
                                    {{ $faq->question }}
                                </button>
                                <div id="panel-{{ $faq->id }}"
                                    class="hidden animate-fade-down transition-all animate-duration-300">
                                    <div class="p-6">
                                        <p class="font-font-pluto-r text-sm text-zinc-700 sm:text-base">
                                            {{ $faq->answer }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
                @if (!$loop->last)
                    <div class="line"></div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/store/faq.js')
@endpush
