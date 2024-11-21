<div class="mx-auto flex w-max justify-center sm:hidden">
    <a href="{{ Route('account.index') }}" data-tooltip-target="tooltip-general"
        class="link-profile {{ Route::is('account.index') ? 'active' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
        <x-icon-store icon="home" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">General</span>
    </a>
    <div id="tooltip-general" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        General
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <a href="{{ Route('orders.index') }}" data-tooltip-target="tooltip-orders"
        class="link-profile {{ Route::is('orders') ? 'active' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
        <x-icon-store icon="shopping-bag" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">Pedidos</span>
    </a>
    <div id="tooltip-orders" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        Pedidos
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <a href="#" data-tooltip-target="tooltip-payments"
        class="link-profile relative flex items-center px-2 py-4 ps-4 text-blue-store">
        <x-icon-store icon="credit-card" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">Pagos</span>
    </a>
    <div id="tooltip-payments" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        Pagos
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <a href="{{ Route('account.settings') }}" data-tooltip-target="tooltip-settings"
        class="link-profile {{ Route::is('account.settings') ? 'active' : '' }} relative flex items-center p-2 ps-4 text-blue-store">
        <x-icon-store icon="settings" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">Configuración</span>
    </a>
    <div id="tooltip-settings" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        Configuración
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <a href="{{ Route('account.addresses.index') }}" data-tooltip-target="tooltip-addresses"
        class="{{ Route::is('account.addresses.index') ? 'active' : '' }} link-profile relative flex items-center p-2 ps-4 text-blue-store">
        <x-icon-store icon="location" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">Direcciones</span>
    </a>
    <div id="tooltip-addresses" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        Direcciones
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <a href="{{ Route('account.tickets.index') }}" data-tooltip-target="tooltip-tickets"
        class="{{ Route::is('account.tickets.index') ? 'active' : '' }} link-profile relative flex items-center p-2 ps-4 text-blue-store">
        <x-icon-store icon="ticket-02" class="me-2 h-5 w-5 text-current" />
        <span class="hidden xl:block">Tickets</span>
    </a>
    <div id="tooltip-tickets" role="tooltip"
        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300">
        Tickets
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>

<div class="hidden sm:flex sm:flex-col">
    <div class="flex items-center gap-4 border-b-2 border-zinc-200 p-4">
        <img src="{{ Storage::url($user->profile) }}" alt="Imagen de {{ $user->full_name }}"
            class="h-20 w-20 rounded-full object-cover">
        <div class="flex flex-col justify-center gap-1">
            <h2 class="text-lg font-bold text-blue-store">{{ $user->full_name }}</h2>
            <p class="font-dine-r text-sm text-zinc-500">{{ $user->email }}</p>
        </div>
    </div>
    <div class="mb-4 mt-4 flex flex-col pt-4 xl:mt-0">
        <a href="{{ Route('account.index') }}"
            class="link-profile {{ Route::is('account.index') ? 'bg-blue-store rounded-xl text-white' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="home" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">General</span>
        </a>
        <a href="{{ Route('orders.index') }}"
            class="link-profile {{ Route::is('orders.index') ? 'bg-blue-store rounded-xl text-white' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="bag" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">Pedidos</span>
        </a>
        <a href="#" class="link-profile relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="payment" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">Pagos</span>
        </a>
        <a href="{{ Route('cancel-return') }}"
            class="link-profile {{ Route::is('cancel-return') ? 'bg-blue-store rounded-xl text-white' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="return-arrow" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">
                Cancelaciones y devoluciones
            </span>
        </a>
        <a href="{{ Route('account.addresses.index') }}"
            class="{{ Route::is('account.addresses.index') || Route::is('account.addresses.create') || Route::is('account.addresses.edit') ? 'bg-blue-store rounded-xl text-white' : '' }} link-profile relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="location" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">Direcciones</span>
        </a>
        <a href="{{ Route('account.tickets.index') }}"
            class="{{ Route::is('account.tickets.index') ? 'bg-blue-store rounded-xl text-white' : '' }} link-profile relative flex items-center px-2 py-4 ps-4 text-blue-store">
            <x-icon-store icon="headpones" class="me-2 h-5 w-5 text-current" />
            <span class="hidden xl:block">
                Soporte técnico
            </span>
        </a>
    </div>
</div>
