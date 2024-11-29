  <div class="flex items-center justify-start xl:hidden">
      <x-button-store type="button" typeButton="primary" text="Menu perfil" data-drawer-target="nav-profile-mobile"
          data-drawer-show="nav-profile-mobile" aria-controls="nav-profile-mobile" />
  </div>
  <div id="nav-profile-mobile"
      class="w-92 fixed left-0 top-0 z-40 h-screen -translate-x-full overflow-y-auto bg-white p-4 transition-transform"
      tabindex="-1" aria-labelledby="drawer-label">
      <button type="button" data-drawer-hide="nav-profile-mobile" aria-controls="nav-profile-mobile"
          class="mx-auto flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-blue-store hover:bg-zinc-200 hover:text-zinc-900">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close menu</span>
      </button>
      <div class="mt-8">
          <div class="mb-4 mt-4 flex flex-col items-center justify-center gap-y-4 pt-4 xl:mt-0">
              <a href="{{ Route('account.index') }}"
                  class="{{ Route::is('account.index') ? 'bg-blue-store rounded-xl text-white' : '' }} w-max p-2 text-blue-store">
                  <x-icon-store icon="home" class="h-5 w-5 text-current" />
              </a>
              <a href="{{ Route('orders.index') }}"
                  class="{{ Route::is('orders.index') ? 'bg-blue-store rounded-xl text-white' : '' }} w-max p-2 text-blue-store">
                  <x-icon-store icon="bag" class="h-5 w-5 text-current" />
              </a>
              <a href="#" class="w-max p-2 text-blue-store">
                  <x-icon-store icon="payment" class="h-5 w-5 text-current" />
              </a>
              <a href="{{ Route('cancel-return') }}"
                  class="{{ Route::is('cancel-return') ? 'bg-blue-store rounded-xl text-white' : '' }} w-max p-2 text-blue-store">
                  <x-icon-store icon="return-arrow" class="h-5 w-5 text-current" />
              </a>
              <a href="{{ Route('account.addresses.index') }}"
                  class="{{ Route::is('account.addresses.index') || Route::is('account.addresses.create') || Route::is('account.addresses.edit') ? 'bg-blue-store rounded-xl text-white' : '' }} w-max p-2 text-blue-store">
                  <x-icon-store icon="location" class="h-5 w-5 text-current" />
              </a>
              <a href="{{ Route('account.tickets.index') }}"
                  class="{{ Route::is('account.tickets.index') ? 'bg-blue-store rounded-xl text-white' : '' }} w-max p-2 text-blue-store">
                  <x-icon-store icon="headpones" class="h-5 w-5 text-current" />
              </a>
          </div>
      </div>
  </div>

  <div class="hidden overflow-hidden xl:block">
      <div class="flex flex-col">
          <div class="flex items-center gap-4 border-b-2 border-zinc-200 p-4">
              <img src="{{ Storage::url($user->profile) }}" alt="Imagen de {{ $user->full_name }}"
                  class="min-h-20 max-w-20 min-w-20 max-h-20 rounded-full object-cover">
              <div class="flex w-80 flex-col justify-center gap-1">
                  <h2 class="text-wrap text-lg font-bold text-blue-store">{{ $user->full_name }}</h2>
                  <p class="text-wrap line-clamp-2 font-dine-r text-sm text-zinc-500" title="{{ $user->email }}">
                      {{ $user->email }}
                  </p>
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
              <a href="{{ Route('payments.index') }}"
                  class="link-profile {{ Route::is('payments.index') ? 'bg-blue-store rounded-xl text-white' : '' }} relative flex items-center px-2 py-4 ps-4 text-blue-store">
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
  </div>
