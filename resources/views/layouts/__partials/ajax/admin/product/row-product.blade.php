 @if ($products->count() > 0)
     @foreach ($products as $product)
         <x-tr section="body">
             <x-td>
                 <input type="checkbox" value="{{ $product->id }}" name="products_ids[]"
                     class="checkboxs-products h-4 w-4 rounded border-2 border-zinc-400 bg-zinc-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-zinc-800 dark:bg-zinc-950 dark:ring-offset-zinc-800 dark:focus:ring-primary-600">
             </x-td>
             <x-td>
                 <div class="flex flex-col gap-1">
                     @if ($product->is_top)
                         <span
                             class="text-nowrap flex w-max items-center gap-2 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:bg-opacity-20 dark:text-green-300">
                             <x-icon icon="star" class="h-3 w-3" />
                             Top
                         </span>
                     @endif
                     <span>{{ $product->name }}</span>
                 </div>
             </x-td>
             <x-td>
                 <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}"
                     class="min-w-16 h-16 w-16 rounded-lg object-cover">
             </x-td>
             <x-td>
                 <span>
                     ${{ $product->price }}
                     {{ $product->max_price ? ' - $' . $product->max_price : '' }}
                 </span>
             </x-td>
             <x-td>
                 <span>{{ $product->sku }}</span>
             </x-td>
             <x-td>
                 <span>{{ $product->stock }} en stock</span>
             </x-td>
             <x-td>
                 <div class="flex flex-col gap-1">
                     <span
                         class="text-nowrap w-max rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:bg-opacity-20 dark:text-green-300">
                         {{ $product->categories->name }}
                     </span>
                     <span
                         class="text-nowrap w-max rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:bg-opacity-20 dark:text-blue-300">
                         @foreach ($product->subcategories as $subcategory)
                             {{ $subcategory->name }}
                             @if (!$loop->last)
                                 /
                             @endif
                         @endforeach
                     </span>
                 </div>
             </x-td>
             <x-td>
                 <x-badge-status :status="$product->is_active" />
             </x-td>
             <x-td>
                 <div class="flex items-center space-x-2">
                     <x-button type="a" icon="edit" typeButton="success"
                         href="{{ route('admin.products.edit', $product->id) }}" onlyIcon="true" />
                     <form action="{{ route('admin.products.destroy', $product->id) }}"
                         id="formDeleteProduct-{{ $product->id }}" method="POST">
                         @csrf
                         @method('DELETE')
                         <x-button type="button" data-form="formDeleteProduct-{{ $product->id }}" icon="delete"
                             typeButton="danger" class="buttonDelete" onlyIcon="true" data-modal-target="deleteModal"
                             data-modal-toggle="deleteModal" />
                     </form>
                     <x-button type="a" icon="view" typeButton="secondary"
                         href="{{ route('admin.products.show', $product->id) }}" onlyIcon="true" />
                     <form action="{{ route('admin.flash-offers.add-flash-offer') }}" method="POST">
                         @csrf
                         <input type="hidden" name="product_id" value="{{ $product->id }}">
                         <x-button type="submit" icon="flash" typeButton="secondary"
                             data-tooltip-target="tooltip-default-{{ $product->id }}" onlyIcon="true" />
                         <div id="tooltip-default-{{ $product->id }}" role="tooltip"
                             class="tooltip invisible absolute z-10 inline-block rounded-lg bg-violet-500 px-3 py-2 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-violet-700">
                             Oferta flash
                             <div class="tooltip-arrow" data-popper-arrow></div>
                         </div>
                     </form>
                 </div>
             </x-td>
         </x-tr>
     @endforeach
 @else
     <tr>
         <td class="px-4 py-3 text-center" colspan="8">
             <span>No hay productos registrados</span>
         </td>
     </tr>
 @endif
