<x-app-layout>

    <style>
        .drop-area.active {
            border-color: #2563eb;
        }
    </style>

    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <button onclick="toggleModal(this)" data-id="create-modal"
                        class="bg-green-600 hover:bg-green-700 py-3 px-8 rounded-lg text-green-100 border-b-4 border-green-700 hover:border-green-800 transition duration-300">Tambah
                        Buku</button>
                    <div class="text-center">
                        <h1 style="font-size: 32px">List Buku</h1>
                    </div>

                    <div>
                        <table id="book-manage-table" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th
                                        style="min-width: 150px; max-width: 150px; min-height: 150px; max-height: 150px;">
                                        Cover</th>
                                    <th>Judul</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <th style="visibility: hidden"></th>
                                </tr>
                            </thead>
                            <tbody id="initTbodyBook">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Start Modal --}}

    <div id="initModalEdit">

    </div>

    {{-- End Modal --}}

    {{-- Start Modal Create --}}
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="create-modal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="text-center">
                    <h3 style="font-size: 36px; font-weight: bold">Tambah Buku</h3>
                </div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 overflow-y-scroll" style="max-height: 550px">
                    <form id="bookForm" action="#" enctype="multipart/form-data">

                        <div class="upload-container relative flex items-center justify-between w-full mb-4">
                            <div
                                class="drop-area w-full rounded-md border-2 border-dotted border-gray-200 transition-all hover:border-blue-600/30 text-center">
                                <div id="cover_imageErrorCreate"></div>
                                <label for="file-input"
                                    class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                    Klik atau taruh sini untuk upload cover gambar
                                </label>
                                <input name="cover_image" class="file-input hidden" type="file" id="file-input" accept="image/*"/>
                                <!-- Image upload input -->
                                <div class="preview-container hidden items-center justify-center flex-col">
                                    <div class="preview-image w-36 h-36 bg-cover bg-center rounded-md"></div>
                                    <span class="file-name my-4 text-sm font-medium"></span>
                                    <p
                                        class="close-button cursor-pointer transition-all mb-4 rounded-md px-3 py-1 border text-xs text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                                        Hapus</p>
                                </div>
                            </div>
                        </div>

                        <label for="title" class="font-medium text-gray-800">Judul Buku</label>
                        <div id="titleErrorCreate"></div>
                        <input name="title" type="text"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="author" class="font-medium text-gray-800">Author</label>
                        <div id="authorErrorCreate"></div>
                        <input name="author" type="text"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="genre_id" class="font-medium text-gray-800">Genre (pisahkan dengan ',')</label>
                        <div id="genre_idErrorCreate"></div>
                        <input name="genre_id" type="text"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="description" class="font-medium text-gray-800">Sinopsis</label>
                        <div id="descriptionErrorCreate"></div>
                        <textarea name="description" id="" cols="30" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3"
                            rows="10"></textarea>

                        <label for="isbn" class="font-medium text-gray-800">ISBN</label>
                        <div id="isbnErrorCreate"></div>
                        <input name="isbn" type="text"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="publisher" class="font-medium text-gray-800">Publisher</label>
                        <div id="publisherErrorCreate"></div>
                        <input name="publisher" type="text"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="publication_year" class="font-medium text-gray-800">Tahun Publish (yyyy)</label>
                        <div id="publication_yearErrorCreate"></div>
                        <input name="publication_year" type="number" min="1900" max="{{ date('Y') }}"
                            step="1" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="price" class="font-medium text-gray-800">Harga</label>
                        <div id="priceErrorCreate"></div>
                        <input name="price" type="number"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="quantity" class="font-medium text-gray-800">Quantity</label>
                        <div id="quantityErrorCreate"></div>
                        <input name="quantity" type="number"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                    </form>
                </div>
                <div class="bg-gray-200 px-4 py-3 text-right">
                    <button type="button" data-id="create-modal"
                        class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                        onclick="toggleModal(this)"><i class="fas fa-times"></i> Cancel</button>
                    <button data-id="create-modal" id="createBtn" type="button"
                        class="py-2 px-4 bg-green-500 text-white rounded font-medium hover:bg-green-700 mr-2 transition duration-500"><i
                            class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- End Modal Create --}}

    <script>
        function init() {
            $('#book-manage-table').DataTable().destroy();
            $("#initTbodyBook").html("")
            $("#initModalEdit").html("")

            $.ajax({
                type: "get",
                url: "{{ route('admin.getAllBooks') }}",
                dataType: "json",
                success: function(response) {
                    if (!('error' in response)) {
                        // html
                        let html = "";
                        let htmlModal = "";
                        let no = 1;
                        response.books.forEach(element => {
                            html +=
                                `
                            <tr>
                                <td>${no}</td>
                                <td ><img style="object-fit:cover; min-width: 150px; max-width: 150px; min-height: 150px; max-height: 150px;" src="{{ asset('imageBooks') }}/${element.cover_image}" alt="Cover Image"></td>
                                <td>${element.title}</td>
                                <td>${element.author}</td>
                                <td>${element.isbn}</td>
                                <td>Rp.${element.price}</td>
                                <td>
                                    <button onclick="toggleModal(this)" data-id="edit-book${element.id}" data-modal-target="edit-book${element.id}" data-modal-toggle="edit-book${element.id}"
                                        class="rounded-lg w-full px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Detail/Edit</button>
                                </td>
                                <td>
                                    <button id="deleteBook" data-book_id="${element.id}" data-id="edit-modal${element.id}" class="rounded-lg w-full px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300">Delete</button>
                                </td>

                            </tr>
                            `

                            htmlModal +=
                                `
                                <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden edit-book" id="edit-book${element.id}">
                                    <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 transition-opacity">
                                            <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                        </div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                            <div class="text-center">
                                                <h3 style="font-size: 36px; font-weight: bold">Edit Buku</h3>
                                            </div>
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 overflow-y-scroll" style="max-height: 550px">
                                                <form class="editForm" action="#" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="${element.id}">

                                                    <div class="relative flex items-center justify-center w-full mb-4">
                                                        <img class="object-cover w-2/4 rounded-md" src="{{asset('imageBooks')}}/${element.cover_image}">
                                                    </div>

                                                    <div class="upload-container relative flex items-center justify-between w-full mb-4">
                                                        <div
                                                            class="drop-area w-full rounded-md border-2 border-dotted border-gray-200 transition-all hover:border-blue-600/30 text-center">
                                                            <div class="cover_imageError${element.id}"></div>
                                                            <label for="edit_cover_image${element.id}"
                                                                class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                                                Klik atau taruh sini untuk upload cover gambar
                                                            </label>
                                                            <input name="cover_image" id="edit_cover_image${element.id}" type="file" class="file-input hidden" accept="image/*" />
                                                            <!-- Image upload input -->
                                                            <div class="preview-container hidden items-center justify-center flex-col">
                                                                <div class="preview-image w-36 h-36 bg-cover bg-center rounded-md" style="background-image:url('{{ asset('imageBooks') }}/${element.cover_image}')"></div>
                                                                <span class="file-name my-4 text-sm font-medium"></span>
                                                                <p
                                                                    class="close-button cursor-pointer transition-all mb-4 rounded-md px-3 py-1 border text-xs text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                                                                    Hapus</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label for="title" class="font-medium text-gray-800">Judul Buku</label>
                                                    <div class="titleError${element.id}"></div>
                                                    <input value="${element.title}" name="title" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="author" class="font-medium text-gray-800">Author</label>
                                                    <div class="authorError${element.id}"></div>
                                                    <input value="${element.author}" name="author" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="genre_id" class="font-medium text-gray-800">Genre</label>
                                                    <div class="genre_idError${element.id}"></div>
                                                    <input value="${element.genre_id}" name="genre_id" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="description" class="font-medium text-gray-800">Sinopsis</label>
                                                    <div class="descriptionError${element.id}"></div>
                                                    <textarea value="" name="description" id="" cols="30" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" rows="10">${element.description}</textarea>

                                                    <label for="isbn" class="font-medium text-gray-800">ISBN</label>
                                                    <div class="isbnError${element.id}"></div>
                                                    <input value="${element.isbn}" name="isbn" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="publisher" class="font-medium text-gray-800">Publisher</label>
                                                    <div class="publisherError${element.id}"></div>
                                                    <input value="${element.publisher}" name="publisher" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="publication_year" class="font-medium text-gray-800">Tahun Publish</label>
                                                    <div class="publication_yearError${element.id}"></div>
                                                    <input value="${element.publication_year}" name="publication_year" type="number" min="1900" max="{{ date('Y') }}" step="1" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                                                    
                                                    <label for="price" class="font-medium text-gray-800">Harga</label>
                                                    <div class="priceError${element.id}"></div>
                                                    <input value="${parseInt(element.price)}" name="price" type="number" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                                                    <label for="quantity" class="font-medium text-gray-800">Quantity</label>
                                                    <div class="quantityError${element.id}"></div>
                                                    <input value="${element.quantity}" name="quantity" type="number" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                                                </form>
                                            </div>
                                            <div class="bg-gray-200 px-4 py-3 text-right">
                                                <button type="button" data-id="edit-book${element.id}"
                                                    class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                                                    onclick="toggleModal(this)"><i class="fas fa-times"></i> Cancel</button>
                                                <button data-id="edit-book${element.id}" id="editBtnBook" type="button" data-real_id=${element.id}
                                                    class="py-2 px-4 bg-green-500 text-white rounded font-medium hover:bg-green-700 mr-2 transition duration-500"><i
                                                        class="fas fa-plus"></i> Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            `
                            no++;
                        });
                        $("#initTbodyBook").html(html)
                        $("#initModalEdit").html(htmlModal)
                        $('#book-manage-table').DataTable({
                            responsive:true
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Terjadi error pada server!",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Terjadi error pada server!",
                    });
                }
            });
        }

        function toggleModal(e) {
            let id = $(e).attr('data-id')
            $(`#${id}`).toggleClass('hidden')
            let dropArea = $(`#${id} .drop-area`);
            let fileInput = $(`#${id} .file-input`);
            let previewContainer = $(`#${id} .preview-container`);
            let previewImage = $(`#${id} .preview-image`);
            let closeButton = $(`#${id} .close-button`);
            let fileName = $(`#${id} .file-name`);

            dropArea.on('dragover', (event) => {
                event.preventDefault();
                dropArea.addClass('active');
            });

            dropArea.on('dragleave', () => {
                dropArea.removeClass('active');
            });

            dropArea.on('drop', (event) => {
                event.preventDefault();
                let file = event.originalEvent.dataTransfer.files[0];
                showPreview(file);
                showFileName(file);
            });

            fileInput.on('change', () => {
                event.preventDefault();
                let file = fileInput[0].files[0];
                showPreview(file);
                showFileName(file);
            });

            closeButton.on('click', (event) => {
                event.preventDefault();
                fileInput.val('');
                previewImage.css('background-image', '');
                fileName.text('');
                previewImage.addClass('hidden');
                previewContainer.addClass('hidden');
                previewImage.removeClass('flex');
            });

            function showPreview(file) {
                if (file.type.startsWith('image/')) {
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        previewImage.css('background-image', `url(${reader.result})`);
                        previewImage.removeClass('hidden');
                        dropArea.removeClass('active');
                        previewContainer.removeClass('hidden');
                        previewContainer.addClass('flex');
                    };
                }
            }

            function showFileName(file) {
                fileName.text(file.name);
                fileName.css('display', 'block');
            }
        }

        $(document).ready(function() {

            init()

            $(document).on('click', '#createBtn', function() {
                let formData = new FormData($('#bookForm')[0]);
                let id = $(this).attr('data-id')
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.createBook') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success"
                        });

                        $(`#${id}`).toggleClass('hidden')
                        init()
                        $('#bookForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Gagal! Cek kembali inputan!",
                        });

                        var errors = xhr.responseJSON.message;
                        let errText = "";
                        $.each(errors, function(key, value) {
                            errText = renderWarningMarkup(value)
                            $('#' + key + 'ErrorCreate').html(errText);
                        });
                    }
                });
            });

            $(document).on('click', `#editBtnBook`, function() {
                let id = $(this).attr('data-id')
                var real_id =  $(this).attr('data-real_id')
                let parentX = $(this).closest('.edit-book');
                var childZ = parentX.find('.editForm');
                let formData = new FormData(childZ[0]);
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.editBook') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success"
                        });

                        $(`#${id}`).toggleClass('hidden')
                        init()
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Gagal! Cek kembali inputan!",
                        });

                        var errors = xhr.responseJSON.message;
                        let errText = "";
                        $.each(errors, function(key, value) {
                            errText = renderWarningMarkup(value)
                            $('.' + key + 'Error'+real_id).html(errText);
                        });
                    }
                });
            });

            $(document).on('click', `#deleteBook`, function() {
                let id = $(this).attr('data-id')
                let book_id = $(this).attr('data-book_id')
                Swal.fire({
                    title: "Kamu yakin ingin menghapus?",
                    text: "Tindakan ini tidak bisa dikemablikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{ route('admin.deleteBook') }}',
                            data: {
                                id: book_id
                            },
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: response.message,
                                    icon: "success"
                                });

                                $(`#${id}`).toggleClass('hidden')
                                init()
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Gagal! Terjadi error pada serve!",
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
