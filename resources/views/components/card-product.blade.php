      <div class="card relative rounded-3xl border border-light-blue p-4 sm:p-6">
          <div class="card-header flex items-center gap-2 md:gap-4">
              <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
                  class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
              <div class="flex flex-col items-start">
                  <p class="font-pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
                  <p class="font-pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
              </div>
          </div>
          <div class="card-image mt-4">
              <a href="{{ Route('products.details', $product->slug) }}">
                  <img src="{{ Storage::url($product->main_image) }}" alt="Featured2 image"
                      class="mx-auto h-36 w-36 rounded-xl object-cover md:h-60 md:w-full">
              </a>
          </div>
          <div class="card-body mt-4">
              <div class="flex flex-col items-start justify-between gap-y-2 sm:flex-row sm:items-center">
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
                  <div class="flex items-center gap-2">
                      <p class="font-dine-r text-xs text-gray-store sm:text-sm">
                          {{ number_format($product->rating, 1) }}
                      </p>
                      @for ($i = 0; $i < 5; $i++)
                          @if ($i < floor($product->rating))
                              <x-icon-store icon="star" class="h-4 w-4 text-yellow-400" />
                          @elseif ($i < $product->rating)
                              <x-icon-store icon="star-half" class="h-4 w-4 text-yellow-400" />
                          @else
                              <x-icon-store icon="star" class="h-4 w-4 text-zinc-300" />
                          @endif
                      @endfor
                  </div>
              </div>
              <div class="pb-6">
                  <small class="mt-2 block text-start">
                      <p class="font-dine-r text-xs text-gray-store sm:text-sm">
                          {{ $product->reviews->count() }} reseñas
                      </p>
                  </small>
                  <a href="{{ Route('products.details', $product->slug) }}"
                      class="overflow-hidden text-ellipsis whitespace-nowrap text-start font-pluto-r text-sm font-semibold text-blue-store sm:text-base md:text-lg"
                      title="{{ $product->name }}">
                      {{ $product->name }}
                  </a>
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
              class="absolute bottom-0 right-0 m-2 rounded-full border border-blue-store bg-light-pink p-2 hover:bg-pink-store sm:m-4">
              <x-icon-store icon="arrow-right" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
          </a>
      </div>
