<div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
    @foreach ($books as $item)
    <div class="group [perspective:1000px]">
        <div class="cursor-pointer relative w-72 bg-white shadow-md rounded-xl duration-500 transition:all [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
            <div class="[backface-visibility:hidden]">
                <img src="{{ asset('imageBooks/'.$item['cover_image']) }}"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs">Judul</span>
                    <p class="text-lg font-bold text-black truncate block capitalize">{{ $item['title'] }}</p>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.{{ $item['price'] }}</p>
                        {{-- <del>
                            <p class="text-sm text-gray-600 cursor-auto ml-2">$199</p>
                        </del> --}}
                    </div>
                </div>
            </div>

            <div class="absolute top-0 right-0 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                <div class="h-80 px-4 py-3 w-72 rounded-t-xl text-white flex flex-col" style="background-color: #fdcf76">
                    <div class="h-32">
                        <span class="uppercase text-xs block text-center">Sinopsis</span>
                        <p style="font-size: 12px" class="text-lg text-black font-bold truncate block">{{ $item['description'] }}</p>
                    </div>

                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <span class="uppercase text-xs">Author</span>
                            <p class="text-lg text-black font-bold truncate block capitalize">{{ $item['author'] }}</p>
                        </div>
                        <div class="w-1/2">
                            <span class="uppercase text-xs">ISBN</span>
                            <p class="text-lg text-black font-bold truncate block">{{ $item['isbn'] }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <span class="uppercase text-xs">Publisher</span>
                            <p class="text-lg text-black font-bold truncate block capitalize">{{ $item['publisher'] }}</p>
                        </div>
                        <div class="w-1/2">
                            <span class="uppercase text-xs">Publication Year</span>
                            <p class="text-lg text-black font-bold truncate block">{{ $item['publication_year'] }}</p>
                        </div>
                    </div>

                    <div>
                        <span class="uppercase text-xs">Genre</span>
                        <p class="text-lg text-black font-bold truncate block capitalize">{{ $item['genre_id'] }}</p>
                    </div>
                </div>
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs">Judul</span>
                    <p class="text-lg font-bold text-black truncate block capitalize">{{ $item['title'] }}</p>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black cursor-auto my-3">Rp.{{ $item['price'] }}</p>
                        <div wire:click="addToCart({{ Auth::user()->id }}, {{ $item['id'] }})" class="ml-auto"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
