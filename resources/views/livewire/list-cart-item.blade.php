<div class="container mx-auto mt-10">
    <style>
        @layer utilities {
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        }
    </style>
    @php
        $totalPrice = 0;
    @endphp
    
    @if (empty($dataCart))
        <h1 class="mb-10 text-center text-2xl font-bold">Cart Kamu Kosong :(</h1>
    @else
        <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
    @endif
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
            @if (!empty($dataCart))
                @foreach ($dataCart as $item)
                @php
                    $totalPrice += $item['price'] * $item['quantity'];
                @endphp
                <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                    <img src="{{ asset('imageBooks/'.$item['cover_image']) }}"
                        alt="product-image" class="w-full rounded-lg sm:w-40" />
                    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                        <div class="mt-5 sm:mt-0">
                            <h2 class="text-lg font-bold text-gray-900">{{ $item['title'] }}</h2>
                            <p class="mt-1 text-xs text-gray-700">ISBN : {{ $item['isbn'] }}</p>
                            <p class="mt-1 text-xs text-gray-700">Publisher : {{ $item['publisher'] }}</p>
                            <p class="mt-1 text-xs text-gray-700">Harga : Rp.{{ (int)$item['price'] }}</p>
                            <p class="mt-1 text-xs text-gray-700">Stok : {{ (int)$item['book_quantity'] }}</p>
                        </div>
                        <div class="mt-4 flex justify-between items-center im sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                            <div class="flex items-center border-gray-100">
                                <span wire:click="decreaceCart({{ Auth::user()->id }}, {{ $item['book_id'] }})" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                    - </span>
                                <input disabled value="{{$item['quantity']}}" class="h-8 w-24 border bg-white text-center text-xs outline-none" type="number"
                                    value="2" min="1" />
                                <span wire:click="insertCart({{ Auth::user()->id }}, {{ $item['book_id'] }})"
                                    class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                    + </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm">Rp.{{$item['price'] * $item['quantity']}}</p>
                                <svg wire:click="removeCart({{ Auth::user()->id }}, {{ $item['book_id'] }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Sub total -->
            
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        <p id="totalPrice" data-total="{{ $totalPrice }}" class="mb-1 text-lg font-bold">Rp.{{ $totalPrice }}</p>
                    </div>
                </div>
                <button id="checkout" class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Checkout</button>
            </div>
        @endif
    </div>

    <script>
        $(document).on('click', '#checkout', function () {
            const csrfToken = "{{ csrf_token() }}";
            Swal.fire({
                title: "Buat Order?",
                text: `Total yang harus dibayar adalah : ${$('#totalPrice').text()}`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tentu saja!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        url: "{{ route('create-order') }}",
                        data: {
                            user_id : {{ Auth::user()->id }},
                            total : $('#totalPrice').attr('data-total')
                        },
                        dataType: "json",
                        success: function (response) {
                            Swal.fire({
                                title: "Berhasil Membuat Order!",
                                text: "Buka menu transaksi untuk lebih detail.",
                                icon: "success"
                            });

                            window.location.href = "{{ route('order-menu') }}";
                        },
                        error:function (xhr, status, error) { 
                            var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Coba lagi beberapa saat';
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errorMessage
                            });
                        }
                    });
                }
            }); 
        });
    </script>
</div>
