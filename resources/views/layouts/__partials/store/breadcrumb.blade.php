<!-- Breadcrumb -->
@php $breadcrumbs = Breadcrumbs::generate(); @endphp
@if (!empty($breadcrumbs) && count($breadcrumbs) > 1)
    <div class="mb-4 flex items-center justify-center sm:justify-end">
        <nav class="flex w-max px-0 py-3 text-zinc-700 sm:px-6" aria-label="Breadcrumb">
            <ol
                class="inline-flex flex-wrap items-center justify-center gap-2 space-x-0 text-[10px] text-xs uppercase rtl:space-x-reverse sm:gap-0 sm:text-sm md:space-x-2">
                @foreach ($breadcrumbs as $key => $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li>
                            <div class="flex items-center gap-1 sm:gap-4">
                                <a href="{{ $breadcrumb->url }}"
                                    class="flex items-center gap-1 rounded-lg px-2 py-1 font-dinc-r text-sm font-semibold text-zinc-500 underline-offset-2 hover:text-blue-store hover:underline sm:text-base">
                                    {!! $breadcrumb->title !!}
                                </a>
                                <x-icon-store icon="arrow-badge-right"
                                    class="mx-1 block h-5 w-5 text-zinc-400 rtl:rotate-180" />
                            </div>
                        </li>
                    @else
                        <li aria-current="page">
                            <div class="flex items-center">
                                <span
                                    class="ms-1 flex items-center gap-2 rounded-lg px-2 py-1 font-dinc-r text-sm font-semibold text-blue-store underline underline-offset-2 sm:text-base md:ms-2">
                                    {!! $breadcrumb->title !!}
                                </span>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endif
