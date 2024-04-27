<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bookstore Management') }}</title>

        {{-- Style --}}
        <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function renderWarningMarkup(arrMsg) {
                let html = 
                `
                <div id="hideAlert" class="flex justify-between text-orange-200 shadow-inner rounded p-3 bg-orange-600">
                    <ul>
                `

                $.each(arrMsg, function (index, value) { 
                    html += `<li><strong>*</strong>${value}</li>`
                });

                html += `
                    </ul>
                    <strong class="text-xl align-center cursor-pointer alert-del">&times;</strong>
                </div>
                `;
                return html;
            }

            $(document).on('click', '.alert-del', function () {
                $(this).closest('#hideAlert').hide();
            });
        </script>

        <!-- Styles -->
        @livewireStyles

        <style>
            div.dt-container select.dt-input{
                width: 25%;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
