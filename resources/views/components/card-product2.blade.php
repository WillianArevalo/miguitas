 <div class="swiper-slide relative rounded-3xl border border-zinc-200 p-2 shadow-xl sm:p-6">
     <div class="card-image">
         <img src="{{ asset('img/image.jpg') }}" alt="Featured2 image" class="h-48 w-full rounded-xl object-cover md:h-60">
     </div>
     <div class="card-body mt-4">
         <div class="flex items-center justify-between">
             <div class="flex items-center gap-3">
                 <a href="">
                     <x-icon-store icon="heart" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                 </a>
                 <a href="">
                     <x-icon-store icon="comment" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                 </a>
                 <a href="">
                     <x-icon-store icon="send" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
                 </a>
             </div>
             <button>
                 <x-icon-store icon="cart" class="h-6 w-6 text-blue-store sm:h-8 sm:w-8" />
             </button>
         </div>
         <div class="pb-6">
             <small class="mt-2 block text-start">
                 <p class="pluto-m text-xs text-gray-store sm:text-sm">13,355 view</p>
             </small>
             <h2 class="pluto-r text-start text-sm font-semibold text-blue-store sm:text-base md:text-lg">
                 #Cake Corazón FurryLove
             </h2>
             <p class="text-start">
                 <span class="dine-r text-lg text-gray-store">$</span>
                 <span class="dine-r text-lg text-gray-store">25.00</span>
             </p>
         </div>
     </div>
     <a href="{{ Route('products.details', 'name-product') }}"
         class="absolute bottom-0 right-0 m-2 rounded-full border-2 border-blue-store bg-pink-store p-2 sm:m-4">
         <x-icon-store icon="arrow-right" class="h-5 w-5 text-blue-store sm:h-7 sm:w-7" />
     </a>
 </div>
