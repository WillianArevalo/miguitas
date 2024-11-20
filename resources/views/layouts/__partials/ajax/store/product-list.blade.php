@if ($products->count() > 0)
    <div class="grid grid-cols-3 gap-4 px-2 max-[840px]:grid-cols-2 xl:grid-cols-3">
        @foreach ($products as $product)
            <x-card-product :product="$product" />
        @endforeach
    </div>
    {{ $products->links('vendor.pagination.pagination-store') }}
@else
    <div
        class="flex h-full flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-300 p-10 px-4">
        <x-icon-store icon="sad" class="mb-4 h-12 w-12 text-zinc-500" />
        <p class="flex items-center gap-2 text-center text-base text-zinc-500">
            No se encontraron productos con los filtros aplicados, <br> intenta con otros filtros.
        </p>
    </div>
@endif
