 @if ($subcategories->count() > 0)
     @foreach ($subcategories as $subcategorie)
         <li class="itemOptionSubcategorie flex gap-2 rounded-lg px-4 py-2.5 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
             data-value="{{ $subcategorie->id }}" data-input="#subcategorie_id">
             <div>
                 <x-input type="checkbox" value="{{ $subcategorie->id }}" name="subcategories[]"
                     class="subcategories_checkbox" data-name="{{ $subcategorie->name }}" />
             </div>
             {{ $subcategorie->name }}
         </li>
     @endforeach
 @endif
