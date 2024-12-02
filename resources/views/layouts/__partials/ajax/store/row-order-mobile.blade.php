  @if ($orders->isEmpty())
      <div class="my-4 flex items-center justify-center gap-4 rounded-2xl border-2 border-dashed border-zinc-200 p-10">
          <x-icon-store icon="alert" class="h-8 w-8 text-blue-store" />
          <div class="flex flex-col items-center gap-1">
              <p class="font-pluto-r text-sm text-zinc-500">
                  No se encontraron pedidos
              </p>
          </div>
      </div>
  @else
      @foreach ($orders as $order)
          <x-order-card :order="$order" />
      @endforeach
  @endif
