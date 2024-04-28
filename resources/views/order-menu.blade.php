<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @livewire('nav-menu-user')

    <div class="py-12">
        @livewire('list-order')
    </div>
</x-guest-layout>
