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
                                    <th style="min-width: 150px; max-width: 150px; min-height: 150px; max-height: 150px;">Cover</th>
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
                                <div id="cover_imageError"></div>
                                <label for="file-input"
                                    class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                    Klik atau taruh sini untuk upload cover gambar
                                </label>
                                <input name="cover_image" type="file" id="file-input" accept="image/*" class="hidden" />
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
                        <div id="titleError"></div>
                        <input name="title" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="author" class="font-medium text-gray-800">Author</label>
                        <div id="authorError"></div>
                        <input name="author" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="genre_id" class="font-medium text-gray-800">Genre</label>
                        <div id="genre_idError"></div>
                        <input name="genre_id" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="description" class="font-medium text-gray-800">Sinopsis</label>
                        <div id="descriptionError"></div>
                        <textarea name="description" id="" cols="30" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" rows="10"></textarea>

                        <label for="isbn" class="font-medium text-gray-800">ISBN</label>
                        <div id="isbnError"></div>
                        <input name="isbn" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="publisher" class="font-medium text-gray-800">Publisher</label>
                        <div id="publisherError"></div>
                        <input name="publisher" type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="publication_year" class="font-medium text-gray-800">Tahun Publish</label>
                        <div id="publication_yearError"></div>
                        <input name="publication_year" type="number" min="1900" max="{{ date("Y") }}" step="1" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        
                        <label for="price" class="font-medium text-gray-800">Harga</label>
                        <div id="priceError"></div>
                        <input name="price" type="number" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                        <label for="quantity" class="font-medium text-gray-800">Quantity</label>
                        <div id="quantityError"></div>
                        <input name="quantity" type="number" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
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

    {{-- Start Modal --}}

    <div id="initModalEdit">

    </div>

    {{-- End Modal --}}

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
                    if(!('error' in response)) {
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
                                    <button onclick="toggleModal(this)" data-id="${element.id}" data-modal-target="edit-user${element.id}" data-modal-toggle="edit-user${element.id}"
                                        class="rounded-lg w-full px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Detail/Edit</button>
                                </td>
                                <td>
                                    <button id="deleteBook" data-book_id="${element.id}" data-id="edit-modal${element.id}" class="rounded-lg w-full px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300">Delete</button>
                                </td>

                            </tr>
                            `

                            htmlModal +=
                                `
                            <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="edit-modal${element.id}">
                                <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity">
                                        <div class="absolute inset-0 bg-gray-900 opacity-75" />
                                    </div>
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                    <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                        <div class="text-center">
                                            <h3 style="font-size: 36px; font-weight: bold">Edit User</h3>
                                        </div>
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <label class="font-medium text-gray-800">Name</label>
                                            <input type="text" disabled value="${element.name}" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        
                                            <label class="font-medium text-gray-800">Email</label>
                                            <input type="text" disabled value="${element.email}" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />
                        
                                            <label class="font-medium text-gray-800">Role</label>
                                            <select class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="" id="role${element.id}">
                                            `
                            response.genres.forEach(element1 => {
                                htmlModal +=
                                    `
                                            <option value="${element1.id}" ${element.role_id == element1.id ? 'selected' : ''}>${element1.name}</option>
                                            `
                            });
                            htmlModal += `
                                            </select>
                                        </div>
                                        <div class="bg-gray-200 px-4 py-3 text-right">
                                            <button type="button" data-id="${element.id}" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                                                onclick="toggleModal(this)"><i class="fas fa-times"></i> Cancel</button>
                                            <button data-id="${element.id}" id="editBtnBook" type="button" class="py-2 px-4 bg-blue-500 text-white rounded font-medium hover:bg-blue-700 mr-2 transition duration-500"><i class="fas fa-plus"></i> Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `
                            no++;
                        });
                        $("#initTbodyBook").html(html)
                        $("#initModalEdit").html(htmlModal)
                        $('#book-manage-table').DataTable();
                    }else{
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
        }

        $(document).ready(function() {

            init()

            $(document).on('click', '#createBtn', function () {
                let formData = new FormData($('#bookForm')[0]);
                let id = $(this).attr('data-id')
                $.ajax({
                    type: 'POST',
                    url: '{{route("admin.createBook")}}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType:'json',
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
                            $('#' + key + 'Error').html(errText);
                        });
                    }
                });
            });

            $(document).on('click', `#editBtnBook`, function() {
                
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
                            url: '{{route("admin.deleteBook")}}',
                            data: {id:book_id},
                            dataType:'json',
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
                                    $('#' + key + 'Error').html(errText);
                                });
                            }
                        });
                    }
                });
            });
        });

        // Get the necessary elements from the HTML document
        const dropArea = document.querySelector('.drop-area');
        const fileInput = document.querySelector('#file-input');
        const previewContainer = document.querySelector('.preview-container');
        const previewImage = document.querySelector('.preview-image');
        const closeButton = document.querySelector('.close-button');
        const fileName = document.querySelector('.file-name');

        // Add event listener to the drop area to handle when a file is being dragged over it
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault(); // Prevent default behavior of browser
            dropArea.classList.add('active'); // Add "active" class to the drop area
        });

        // Add event listener to the drop area to handle when a file is no longer being dragged over it
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('active'); // Remove "active" class from the drop area
        });

        // Add event listener to the drop area to handle when a file is dropped onto it
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault(); // Prevent default behavior of browser
            const file = event.dataTransfer.files[0]; // Get the file that was dropped
            showPreview(file); // Show a preview of the file
            showFileName(file); // Show the name of the file
        });

        // Add event listener to the file input element to handle when a file is selected
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0]; // Get the file that was selected
            showPreview(file); // Show a preview of the file
            showFileName(file); // Show the name of the file
        });

        // Add event listener to the close button to handle when it is clicked
        closeButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default behavior of button
            fileInput.value = ''; // Clear the file input value
            previewImage.style.backgroundImage = ''; // Clear the preview image
            fileName.textContent = ''; // Clear the file name
            previewImage.classList.add('hidden'); // Hide the preview image
            previewContainer.classList.add('hidden'); // Hide the preview container
            previewImage.classList.remove('flex'); // Remove "flex" class from preview image
        });

        // Function to show a preview of the file
        function showPreview(file) {
            if (file.type.startsWith('image/')) { // Check if the file is an image
                const reader = new FileReader(); // Create a new FileReader object
                reader.readAsDataURL(file); // Read the file as a data URL
                reader.onload = () => { // When the file has been read
                    previewImage.style.backgroundImage = `url(${reader.result})`; // Set the background image of the preview container to the data URL
                    previewImage.classList.remove('hidden'); // Show the preview image
                    dropArea.classList.remove('active'); // Remove "active" class from drop area
                    previewContainer.classList.remove('hidden'); // Show the preview container
                    previewContainer.classList.add('flex'); // Add "flex" class to preview container
                };
            }
        }

        // Function to show the name of the file
        function showFileName(file) {
            fileName.textContent = file.name; // Set the text content of the file name element to the name of the file
            fileName.style.display = 'block'; // Show the file name element
        }
    </script>
</x-app-layout>
