<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="text-center">
                        <h1 style="font-size: 32px">User Management</h1>
                    </div>

                    <div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Login Terakhir</th>
                                    <th>Banned</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($respponseBody as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['role_id'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['email'] }}</td>
                                        <td>{{ $item['last_logged_in'] }}</td>
                                        <td>{{ $item['is_ban'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</x-app-layout>
