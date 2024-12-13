<section
    {{ $attributes->merge(['class' => 'cookies fixed bottom-16 left-12 z-50 mx-auto max-w-md animate-fade-right rounded-2xl border border-white bg-white p-4 shadow-lg']) }}>
    <h2 class="text-lg font-semibold text-blue-store">
        Cookies
    </h2>
    <p class="mt-2 font-dine-r text-xs text-zinc-600">
        Hola, este sitio web utiliza cookies esenciales para garantizar su correcto funcionamiento
        y seguimiento para comprender cómo interactúa con él. Este último se establecerá solo
        después de consentimiento.
        <a href="{{ route('cookies') }}"
            class="font-dine-b font-medium text-zinc-700 underline transition-colors duration-300 hover:text-blue-600">
            Política de cookies
        </a>.
    </p>
    <p class="mt-3 font-dine-r text-xs text-zinc-600">
        Al cerrar esta configuración modal, se guardará la configuración predeterminada.
    </p>
    <div class="mt-4 grid shrink-0 grid-cols-2 gap-4">
        <form action="{{ Route('cookies.store') }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="action" value="deny-all">
            <div class="flex-1">
                <x-button-store type="button" typeButton="secondary" size="small" text="Denegar todas"
                    class="w-full text-xs" id="deny-all-cookies" />
            </div>
        </form>
        <form action="{{ Route('cookies.store') }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="action" value="accept-all">
            <x-button-store type="button" typeButton="primary" size="small" id="accept-all-cookies"
                text="Aceptar todas" class="w-full text-xs" />
        </form>
    </div>
    <button class="close-cookies absolute right-0 top-0 m-4">
        <x-icon icon="x" class="h-4 w-4 text-zinc-600" />
    </button>
</section>
