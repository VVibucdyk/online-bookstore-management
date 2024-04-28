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
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="w-fit mx-auto">
                    @livewire('book-loop-card', ['books' => $books])
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>
