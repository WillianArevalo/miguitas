<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ $favicon ? Storage::url($favicon) : asset('images/logo.png') }}"
        type="image/x-icon">
    @vite('resources/css/store.css')
    @stack('styles')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="store overflow-x-hidden">

    @if ($headBands->count() > 0)
        <div id="headbands-container" class="relative h-8 overflow-hidden bg-light-blue sm:h-10">
            <div id="headbands-wrapper" class="absolute flex w-full flex-col">
                @foreach ($headBands as $headBand)
                    <x-head-band :headBand="$headBand" />
                @endforeach
            </div>
        </div>
    @endif

    @include('layouts.__partials.store.navbar')
    <main>
        @include('layouts.__partials.store.breadcrumb')
        @include('layouts.__partials.store.toast-store', ['top' => 'top-10'])
        @include('layouts.__partials.toast-container', [
            'class' => 'left-0 right-0 sm:right-5 sm:mx-auto top-10',
        ])
        @yield('content')

        @if (!request()->cookie('accept_cookies') && !request()->cookie('deny_cookies'))
            <x-cookie />
        @endif
    </main>
    @include('layouts.__partials.store.footer')
    @stack('scripts')
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
</body>

</html>
