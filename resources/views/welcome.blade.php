<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('nav-menu-user')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('filter-book')
            <h1 class="mb-10 text-center text-2xl font-bold">Buku - Buku</h1>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="w-fit mx-auto">
                    @livewire('book-loop-card', ['books' => $books])
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>
