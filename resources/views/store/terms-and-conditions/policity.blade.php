@extends('layouts.template')
@section('title', 'Miguitas | Condiciones de uso')
@section('content')
    <div class="overflow-x-hidden">
        <div class="text-center">
            <div class="mt-4 flex items-center justify-center">
                <x-button-store type="a" typeButton="secondary" href="{{ route('policies.download-pdf', $policy->id) }}"
                    text="Descargar PDF" icon="download" />
            </div>
            @foreach ($policy->images as $image)
                <img src="{{ Storage::url($image->file_path) }}" alt="Preview Image"
                    class="main-image mx-auto h-full w-full object-contain px-4 sm:w-3/4 lg:w-1/2">
            @endforeach
        </div>
    </div>
@endsection
