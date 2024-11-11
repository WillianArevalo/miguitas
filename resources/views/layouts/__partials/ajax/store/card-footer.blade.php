  <button type="button" class="btn-add-favorite flex items-center justify-center"
      data-is-favorite="{{ $product->is_favorite ? 'favorite' : 'no-favorite' }}">
      @if ($product->is_favorite)
          <x-icon-store icon="heart-fill" class="h-5 w-5 fill-blue-store sm:h-7 sm:w-7" data-heart="filled" />
      @else
          <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" data-heart="outline" />
      @endif
  </button>
