@extends('layouts.template')
@section('title', 'Miguitas | Mi cuenta')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    <section class="mx-auto p-0 xl:px-8">
        <div class="mx-auto flex flex-col px-4 sm:mt-8 md:gap-4 xl:flex-row xl:gap-8">
            <div class="mx-auto mb-4 h-max w-max overflow-hidden sm:mx-0 sm:w-auto sm:overflow-auto xl:min-w-[350px]">
                @include('layouts.__partials.store.nav-profile')
            </div>
            <div class="h-max w-full">
                @yield('profile-content')
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @vite('resources/js/select-address.js')
@endpush
