@if ($paginator->hasPages())
    <nav class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:items-center md:space-y-0"
        aria-label="Table navigation">
        <span class="flex items-center gap-1 text-sm font-normal text-zinc-500">
            Mostrando
            <span class="flex items-center font-semibold text-blue-store">{{ $paginator->firstItem() }}</span>
            a
            <span class="flex items-center font-semibold text-blue-store">{{ $paginator->lastItem() }}</span>
            de
            <span class="flex items-center font-semibold text-blue-store">{{ $paginator->total() }}</span>
        </span>
        <ul class="{{-- -space-x-px --}} inline-flex items-stretch space-x-2">
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span
                        class="ml-0 flex h-full items-center justify-center rounded-lg border border-zinc-300 bg-zinc-100 px-3 py-1.5 leading-tight text-zinc-500">
                        <span class="sr-only">Previous</span>
                        <x-icon-store icon="arrow-left" class="h-5 w-5" />
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="ml-0 flex h-full items-center justify-center rounded-lg border border-zinc-400 bg-white px-3 py-1.5 text-zinc-500 hover:border-blue-store hover:bg-zinc-100 hover:text-blue-store"
                        aria-label="@lang('pagination.previous')">
                        <span class="sr-only">Previous</span>
                        <x-icon-store icon="arrow-left" class="h-5 w-5" />
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span
                            class="flex items-center justify-center rounded-lg border border-zinc-400 bg-white px-3 py-2 text-sm leading-tight text-zinc-500">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span
                                    class="z-10 flex items-center justify-center rounded-lg border border-blue-store bg-blue-store px-3 py-2 text-sm leading-tight text-white">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center rounded-lg border border-zinc-400 bg-white px-3 py-2 text-sm leading-tight text-zinc-500 hover:border-blue-store hover:bg-zinc-100 hover:text-blue-store">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="flex h-full items-center justify-center rounded-lg border border-zinc-400 bg-white px-3 py-1.5 leading-tight text-zinc-500 hover:border-blue-store hover:bg-zinc-100 hover:text-blue-store"
                        aria-label="@lang('pagination.next')">
                        <span class="sr-only">Next</span>
                        <x-icon-store icon="arrow-right" class="h-5 w-5" />
                    </a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span
                        class="flex h-full items-center justify-center rounded-lg border border-zinc-300 bg-zinc-100 px-3 py-1.5 leading-tight text-zinc-500">
                        <span class="sr-only">Next</span>
                        <x-icon-store icon="arrow-right" class="h-5 w-5" />
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
