@props([
    'type' => 'button',
    'text' => '',
    'icon' => null,
    'typeButton' => 'default',
    'class' => '',
    'iconAlign' => 'left',
    'onlyIcon' => false,
    'size' => 'normal',
    'loading' => false, // Añadido para el estado de carga
])

@php
    // Definir las clases según el tamaño
    $sizes = [
        'small' => [
            'padding' => 'px-4 py-2',
            'text' => 'text-xs',
            'icon' => 'h-4 w-4',
        ],
        'normal' => [
            'padding' => 'px-6 py-3',
            'text' => 'text-sm sm:text-base',
            'icon' => 'h-5 w-5 sm:h-6 sm:w-6',
        ],
        'large' => [
            'padding' => 'px-8 py-4',
            'text' => 'text-base',
            'icon' => 'h-6 w-6',
        ],
    ];

    // Establecer el padding dependiendo de si es solo ícono o no
    $padding = $onlyIcon ? 'px-2 py-1' : $sizes[$size]['padding'];

    // Clases base
    $baseClasses = 'rounded-full flex items-center justify-center gap-2 transition-colors duration-300 ' . $padding;

    // Tipos de botones (estilos únicos para la tienda)
    $buttonTypes = [
        'primary' =>
            'bg-blue-store text-white hover:bg-blue-selected disabled:bg-violet-400 disabled:text-violet-200 disabled:cursor-not-allowed',
        'secondary' =>
            'bg-white text-zinc-600 border-2 border-zinc-300 hover:bg-zinc-200/50 disabled:bg-zinc-100/50 disabled:text-zinc-400 disabled:cursor-not-allowed',
        'tertiary' => 'bg-pink-store text-dark-blue hover:bg-pink-selected hover:text-white',
        'danger' => 'bg-red-100/70 text-red-500 hover:bg-red-200/70 border-2 border-red-500/70',
        'warning' => 'bg-yellow-100/70 text-yellow-600 hover:bg-yellow-600 border-2 border-yellow-600/70',
        'info' => 'bg-blue-100/70 text-blue-500 hover:bg-blue-200/70',
        'success' => 'bg-green-100/70 text-green-500 hover:bg-green-200/70 border-2 border-green-500/70',
        'default' => 'bg-white text-zinc-600 border border-zinc-400 hover:bg-zinc-100',
    ];

    // Clases finales para el botón
    $classes = $buttonTypes[$typeButton] . ' ' . $baseClasses . ' ' . $class;

    // Estado de carga: cuando está cargando, añadimos opacidad
    $loadingClasses = $loading ? 'opacity-75 cursor-not-allowed' : '';
    $classes .= ' ' . $loadingClasses;
@endphp

@if ($type === 'a')
    <a href="{{ $attributes->get('href') }}" {{ $attributes->except('href') }} class="{{ $classes }}">
        @if ($loading)
            <!-- Spinner para estado de carga -->
            <x-icon-store icon="spinner" class="{{ $sizes[$size]['icon'] }} animate-spin text-white" />
        @else
            @if ($iconAlign === 'left' && !$onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
            @if (!$onlyIcon)
                <span class="{{ $sizes[$size]['text'] }}">{{ $text }}</span>
            @endif
            @if ($iconAlign === 'right' && !$onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
            @if ($onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes }} class="{{ $classes }}"
        @if ($loading) disabled @endif>
        @if ($loading)
            <!-- Spinner para estado de carga -->
            <x-icon-store icon="spinner" class="{{ $sizes[$size]['icon'] }} animate-spin text-white" />
        @else
            @if ($iconAlign === 'left' && !$onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
            @if (!$onlyIcon)
                <span class="{{ $sizes[$size]['text'] }}">{{ $text }}</span>
            @endif
            @if ($iconAlign === 'right' && !$onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
            @if ($onlyIcon)
                <x-icon-store :icon="$icon" class="{{ $sizes[$size]['icon'] }} fill-current" />
            @endif
        @endif
    </button>
@endif
