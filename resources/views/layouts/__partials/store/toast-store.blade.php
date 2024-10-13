@if (Session::has('success') || Session::has('error') || Session::has('info'))
    <div id="toast"
        class="{{ $top }} font-secondary fixed left-0 right-0 z-50 mx-auto flex w-max animate-fade-left items-center justify-between gap-4 rounded-xl bg-white p-4 text-zinc-500 shadow-lg animate-duration-300 animate-once sm:right-5 sm:mx-0 sm:ms-auto sm:w-96"
        role="alert">
        <div class="inline-flex flex-shrink-0 items-center justify-center">
            @if ($message = Session::get('success'))
                <x-icon-store icon="circle-check" class="h-6 w-6 fill-green-600" />
            @elseif($message = Session::get('error'))
                <x-icon-store icon="circle-exclamation" class="h-6 w-6 fill-red-600" />
            @elseif($message = Session::get('info'))
                <x-icon-store icon="circle-info" class="h-6 w-6 fill-blue-600" />
            @endif
        </div>
        <div class="ms-auto text-center text-xs font-normal sm:text-sm">
            {{ $message }}
        </div>
        <button type="button"
            class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white text-zinc-400 hover:bg-zinc-100 hover:text-zinc-900 focus:ring-2 focus:ring-zinc-300"
            data-dismiss-target="#toast" aria-label="Close">
            <span class="sr-only">Close</span>
            <x-icon-store icon="close" class="h-4 w-4 fill-current" />
        </button>
    </div>
@endif
