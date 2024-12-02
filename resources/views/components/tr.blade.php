@props(['section' => 'head', 'last' => false])
<tr {{ $attributes->merge(['class' => $last ? '' : 'border-b dark:border-zinc-800 border-zinc-400']) }}>
    {{ $slot }}
</tr>
