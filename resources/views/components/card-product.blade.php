  <div class="card relative rounded-3xl border-[2px] border-light-blue p-2 sm:p-6">
      <div class="card-header flex items-center gap-2 md:gap-4">
          <img src="{{ asset('img/logo.png') }}" alt="Featured2 image"
              class="h-8 w-8 rounded-full object-cover md:h-14 md:w-14">
          <div class="flex flex-col items-start">
              <p class="pluto-r text-[8px] text-light-blue md:text-sm">miguitaselsalvador</p>
              <p class="pluto-m text-sm text-gray-store md:text-base">El Salvador</p>
          </div>
      </div>
      <div class="card-image mt-4">
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
                      <x-icon-store icon="comment" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                  </a>
                  <a href="">
                      <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                  </a>
              </div>
              <button>
                  <x-icon-store icon="cart" class="h-5 w-5 text-blue-store sm:h-8 sm:w-8" />
              </button>
          </div>
          <div class="pb-6">
              <small class="mt-2 block text-start">
                  <p class="pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
              </small>
              <h2 class="pluto-r overflow-hidden text-ellipsis whitespace-nowrap text-start text-sm font-semibold text-blue-store sm:text-base md:text-lg"
                  title="{{ $product->name }}">
                  {{ $product->name }}
              </h2>
              <div class="flex gap-4">
                  <p class="text-start">
                      <span class="dine-r text-lg text-gray-store">$</span>
                      <span class="dine-r text-lg text-gray-store">
                          {{ $product->price }}
                      </span>
                  </p>
                  @if ($product->max_price)
                      <p class="text-start">
                          <span class="dine-r text-lg text-gray-store">$</span>
                          <span class="dine-r text-lg text-gray-store">
                              {{ $product->max_price }}
                          </span>
                      </p>
                  @endif
              </div>
          </div>
      </div>
      <a href="{{ Route('products.details', $product->slug) }}"
          class="absolute bottom-0 right-0 m-2 rounded-full border-2 border-blue-store bg-light-pink p-2 sm:m-4">
          <x-icon-store icon="arrow-right" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
      </a>
  </div>
