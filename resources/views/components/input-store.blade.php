@props([
    'type' => 'text',
    'name',
    'id' => null,
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'class' => '',
    'required' => false,
    'icon' => '',
    'error' => true,
])

@php
    $errorClass = $errors->has($name) ? 'is-invalid' : '';
    $labelClass = $required ? "after:content-['*'] after:ml-0.5 after:text-red-500" : '';
    $inputBaseClasses =
        'text-sm md:text-base font-din-r px-6 py-3 border border-zinc-300 rounded-xl focus:border-blue-store focus:outline-none focus:border-blue-store focus:ring-2 focus:ring-violet-200 placeholder:text-zinc-400 placeholder:font-normal transition duration-300 text-zinc-700';
    $classes = "{$inputBaseClasses} {$class} {$errorClass}";

    $id = $id ?? $name;
@endphp

<label for="{{ $id }}"
    class="{{ $labelClass }} text-start font-dine-r text-sm font-medium text-zinc-600 md:text-base">
    {{ $label }}
</label>

@if ($icon)
    <div class="relative w-full">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
            <x-icon-store icon="{{ $icon }}" class="h-4 w-4 text-blue-store sm:h-5 sm:w-5" />
        </div>
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
            placeholder="{{ $placeholder }}" value="{{ $value }}" class="{{ $classes }} w-full pl-12"
            {{ $attributes }} @if ($required) required @endif>
    </div>
@elseif ($type !== 'textarea')
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}" class="{{ $classes }} w-full"
        {{ $attributes }} @if ($required) required @endif>
@else
    <textarea id="{{ $id }}" name="{{ $name }}" rows="4"
        class="{{ $inputBaseClasses }} {{ $errorClass }} {{ $class }} w-full border border-blue-store px-6 py-3 text-base focus:border-blue-store focus:ring-2 focus:ring-violet-200"
        placeholder="{{ $placeholder }}">{{ $value }}</textarea>
@endif

@if ($error && $errors->has($name))
    <span class="error-msg text-sm text-red-500">{{ $errors->first($name) }}</span>
@endif
