<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="#" class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rajal') }}
            </a>
            <a href="#" class="font-semibold text-xl text-gray-400 hover:text-gray-800 leading-tight">
                {{ __('Ranap') }}
            </a>
            <a href="#" class="font-semibold text-xl text-gray-400 hover:text-gray-800 leading-tight">
                {{ __('Cetak') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <livewire:components.billing.rajal />
            </div>
        </div>
    </div>
</x-app-layout>