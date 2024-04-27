<x-app-layout>


    <div class="py-12">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    {{-- <a class="bg-green-600 hover:bg-green-700 py-3 px-8 rounded-lg text-green-100 border-b-4 border-green-700 hover:border-green-800 transition duration-300" href="">Tambah Akun</a> --}}
                    <div class="text-center">
                        <h1 style="font-size: 32px">User Management</h1>
                    </div>

                    <div>
                        <table id="user-manage-table" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Login Terakhir</th>
                                    <th>Action</th>
                                    <th style="visibility: hidden">Action</th>
                                </tr>
                            </thead>
                            <tbody id="initTbodyEditUser">
                                
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

    <script>

        function init(data = null) {
            $('#user-manage-table').DataTable().destroy();
            $("#initTbodyEditUser").html("")
            $("#initModalEdit").html("")

            // html
            let html = "";
            let htmlModal = "";
            let no = 1;
            data.users.forEach(element => {
                html +=
                `
                <tr>
                    <td>${no}</td>
                    <td>${element.role_name}</td>
                    <td>${element.name}</td>
                    <td>${element.email}</td>
                    <td>${element.last_logged_in == null ? '-' : 'element.last_logged_in'}</td>
                    <td>
                        <button onclick="toggleModal(this)" data-id="${element.id}" data-modal-target="edit-user${element.id}" data-modal-toggle="edit-user${element.id}"
                            class="rounded-lg w-full px-4 py-2 bg-blue-500 text-blue-100 hover:bg-blue-600 duration-300">Change Role</button>
                    </td>
                    <td>
                        <button id="deleteUser" data-id="${element.id}" class="rounded-lg w-full px-4 py-2 bg-red-600 text-red-100 hover:bg-red-700 duration-300">Delete</button>
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
                            data.roles.forEach(element1 => {
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
                                <button data-id="${element.id}" id="editBtnUser" type="button" class="py-2 px-4 bg-blue-500 text-white rounded font-medium hover:bg-blue-700 mr-2 transition duration-500"><i class="fas fa-plus"></i> Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                `
                no++
            });
            $("#initTbodyEditUser").html(html)
            $("#initModalEdit").html(htmlModal)
            $('#user-manage-table').DataTable();
        }

        function toggleModal(e) {
            let id = $(e).attr('data-id')
            $(`#edit-modal${id}`).toggleClass('hidden')
        }

        $(document).ready(function() {

            $.ajax({
                type: "get",
                url: "{{route('admin.getManageUser')}}",
                dataType: "json",
                success: function (response) {
                    init(response)
                }
            });

            

            $(document).on('click', `#editBtnUser`, function () {
                let id = $(this).attr('data-id')
                let role_id = $(`#role${id}`).val();
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.updateUser') }}",
                    data: {id, role_id},
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success"
                        });
                        $(`#edit-modal${id}`).toggleClass('hidden')
                        init(response)
                    },
                    error : function () {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Terjadi error pada server!",
                        });
                    }
                });
            });

            $(document).on('click', `#deleteUser`, function () {
                let id = $(this).attr('data-id')
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.deleteUser') }}",
                    data: {id},
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success"
                        });
                        $(`#edit-modal${id}`).toggleClass('hidden')
                        init(response)
                    },
                    error : function () {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Terjadi error pada server!",
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
