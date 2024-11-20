<div class="flex justify-center py-2">
    @if ($headBand->link_text)
        <h2 class="font-font-dine-r px-4 text-xs font-medium text-white sm:text-base">
            {{ $headBand->title }}
            <a href="{{ $headBand->link }}"
                class="font-font-dine-r ms-4 text-xs font-normal text-white underline hover:text-zinc-900 sm:text-sm">
                {{ $headBand->link_text }}
            </a>
        </h2>
    @else
        <a href="{{ $headBand->link }}"
            class="font-font-dine-r px-4 text-xs font-medium text-white hover:underline sm:text-base">
            {{ $headBand->title }}
        </a>
    @endif
</div>
