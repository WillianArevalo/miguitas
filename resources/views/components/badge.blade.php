@props(['color' => 'gray', 'size' => 'medium'])

@php
    $sizeClasses = [
        'small' => 'px-2 py-0.5 text-xs',
        'medium' => 'px-3 py-1 text-sm',
        'large' => 'px-4 py-1.5 text-base',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['medium'];
@endphp

<span
    class="bg-{{ $color }}-100 text-{{ $color }}-800 dark:bg-{{ $color }}-900 dark:text-{{ $color }}-300 {{ $sizeClass }} w-max rounded-full font-semibold dark:bg-opacity-20">
    {{ $slot }}
</span>
