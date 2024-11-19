<div class="swiper-slide relative rounded-3xl border border-zinc-200 p-2 shadow-xl sm:p-6">
    <div class="card-image">
        <img src="{{ Storage::url($product->main_image) }}" alt="Featured2 image"
            class="h-48 w-full rounded-xl object-cover md:h-60">
    </div>
    <div class="card-body mt-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <form action="{{ Route('favorites.add', $product->id) }}" method="POST"
                    class="flex items-center justify-center">
                    @csrf
                    <div class="favorite-container">
                        <button type="button" class="btn-add-favorite flex items-center justify-center"
                            data-is-favorite="{{ $product->is_favorite ? 'favorite' : 'no-favorite' }}">
                            @if ($product->is_favorite)
                                <x-icon-store icon="heart-fill" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7"
                                    data-heart="filled" />
                            @else
                                <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7"
                                    data-heart="outline" />
                            @endif
                        </button>
                    </div>
                </form>
                <a href="">
                    <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                </a>
            </div>
        </div>
        <div class="pb-6">
            <small class="mt-2 block text-start">
                <p class="font-pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
            </small>
            <h2 class="overflow-hidden text-ellipsis whitespace-nowrap text-start font-pluto-r text-sm font-semibold text-blue-store sm:text-base md:text-lg"
                title="{{ $product->name }}">
                {{ $product->name }}
            </h2>
            <div class="flex gap-4">
                <p class="text-start">
                    <span class="font-dine-r text-lg text-gray-store">$</span>
                    <span class="font-dine-r text-lg text-gray-store">
                        {{ $product->price }}
                    </span>
                </p>
                @if ($product->max_price)
                    <p class="text-start">
                        <span class="font-dine-r text-lg text-gray-store">$</span>
                        <span class="font-dine-r text-lg text-gray-store">
                            {{ $product->max_price }}
                        </span>
                    </p>
                @endif
            </div>
        </div>
    </div>
    <a href="{{ Route('products.details', $product->slug) }}"
        class="absolute bottom-0 right-0 m-2 rounded-full border-2 border-blue-store bg-pink-store p-2 sm:m-4">
        <x-icon-store icon="arrow-right" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
    </a>
</div>
