<div class="flex justify-center py-2">
    @if ($headBand->link_text)
        <h2 class="font-font-dine-r px-4 text-base font-medium text-white">
            {{ $headBand->title }}
            <a href="{{ $headBand->link }}"
                class="font-font-dine-r ms-4 text-sm font-normal text-white underline hover:text-zinc-900">
                {{ $headBand->link_text }}
            </a>
        </h2>
    @else
        <a href="{{ $headBand->link }}" class="font-font-dine-r px-4 text-base font-medium text-white hover:underline">
            {{ $headBand->title }}
        </a>
    @endif
</div>
