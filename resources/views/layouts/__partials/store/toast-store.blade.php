@if (Session::has('success') || Session::has('error') || Session::has('info'))
    <div id="toast"
        class="{{ $top }} font-secondary fixed left-0 right-0 z-50 mx-auto flex w-max animate-fade-left items-center justify-between gap-4 rounded-xl bg-white p-4 text-zinc-500 shadow-lg animate-duration-300 animate-once sm:right-5 sm:mx-0 sm:ms-auto sm:w-96"
        role="alert">
        <div class="flex items-center gap-x-4">
            <div class="inline-flex flex-shrink-0 items-center justify-center">
                @if ($message = Session::get('success'))
                    <x-icon-store icon="circle-check" class="h-6 w-6 text-green-500" />
                @elseif($message = Session::get('error'))
                    <x-icon-store icon="circle-exclamation" class="h-6 w-6 text-red-500" />
                @elseif($message = Session::get('info'))
                    <x-icon-store icon="circle-info" class="h-6 w-6 text-blue-500" />
                @endif
            </div>
            <div class="ms-auto flex flex-col text-start">
                @if ($message = Session::get('success'))
                    <h3 class="font-pluto-r text-base font-semibold sm:text-base">
                        ¡Exito!
                    </h3>
                @elseif($message = Session::get('error'))
                    <h3 class="font-pluto-r text-base font-semibold sm:text-base">
                        ¡Error!
                    </h3>
                @elseif($message = Session::get('info'))
                    <h3 class="font-pluto-r text-base font-semibold sm:text-base">
                        ¡Información!
                    </h3>
                @endif
                <p class="font-dine-r text-xs font-normal sm:text-sm">
                    {{ $message }}
                </p>
            </div>
        </div>
        <button type="button"
            class="min-w-8 -mx-1.5 -my-1.5 ms-auto inline-flex h-8 items-center justify-center rounded-xl bg-white text-zinc-400 hover:bg-zinc-100 hover:text-zinc-900 focus:ring-2 focus:ring-zinc-300"
            data-dismiss-target="#toast" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif
