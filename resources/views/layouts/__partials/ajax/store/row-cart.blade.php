@if ($cart && $cart->items->count() > 0)
    @foreach ($cart->items as $item)
        <div class="mt-4 flex flex-col items-center gap-4 rounded-2xl border border-zinc-200 p-4 shadow-sm md:flex-row">
            <div class="flex-[3]">
                <div class="flex gap-4">
                    <div>
                        <img src="{{ Storage::url($item->product->main_image) }}" alt="{{ $item->product->name }}"
                            class="h-20 w-20 rounded-xl object-cover">
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-dark-pink">
                            {{ $item->product->name }}
                        </h3>
                        <ul>
                            @foreach ($item->options as $option)
                                <li class="font-pluto-r text-sm text-zinc-700">
                                    <span class="font-medium">
                                        {{ $option->productOptionValue->option->name }}:
                                    </span>
                                    {{ $option->productOptionValue->value }}
                                </li>
                            @endforeach
                        </ul>
                        <p class="font-dine-r text-sm text-zinc-700">
                            $ {{ $item->price }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex-1 text-blue-store">
                <div class="flex h-10 w-max items-center gap-6 overflow-hidden rounded-xl border-2 border-dark-pink">
                    <form action="{{ route('cart.update', $item->product->id) }}" method="POST"
                        id="form-minus-cart-{{ $item->product->id }}">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="button" data-form="#form-minus-cart-{{ $item->product->id }}"
                            class="btnMinusCart flex h-10 items-center justify-center border-e-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                            <x-icon-store icon="minus" class="h-4 w-4 fill-current" />
                        </button>
                    </form>
                    <span class="text-base font-bold">
                        {{ $item->quantity }}
                    </span>
                    <form action="{{ route('cart.update', $item->product->id) }}" method="POST"
                        id="form-plus-cart-{{ $item->product->id }}">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="button" data-form="#form-plus-cart-{{ $item->product->id }}"
                            class="btnPlusCart flex h-10 items-center justify-center border-s-2 border-dark-pink px-3 hover:bg-dark-pink hover:text-white">
                            <x-icon-store icon="plus" class="h-4 w-4 fill-current" />
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex-1 text-center">
                <h3 class="font-dine-r text-xl font-bold text-blue-store">
                    $ {{ number_format($item->sub_total, 2) }}
                </h3>
            </div>
            <div class="flex flex-1 items-center justify-center">
                <form action="{{ Route('cart.remove', $item->product->id) }}" method="POST"
                    id="form-remove-cart-{{ $item->product->id }}">
                    @csrf
                    <x-button-store data-form="#form-remove-cart-{{ $item->product->id }}" type="button"
                        icon="trash" class="btnRemoveCart" onlyIcon="true" typeButton="secondary" />
                </form>
            </div>
        </div>
    @endforeach
@else
    <div class="flex h-96 flex-col items-center justify-center">
        <x-icon-store icon="cart" class="h-20 w-20 fill-current text-zinc-200" />
        <p class="text-lg text-zinc-200">
            No hay productos en el carrito
        </p>
    </div>
@endif
