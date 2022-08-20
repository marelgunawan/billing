<x-app-layout>
    <x-slot name="header">
        <div class="flex space-x-2 items-center">
            <a href="{{ route('dashboard.poli.index') }}" class="font-semibold text-xl text-blue-400 leading-tight">
                {{ __('Poli') }}
            </a>
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($poli->name) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <livewire:components.poli.doctor relationship="true" :poli="$poli->id" />
            </div>
        </div>
        
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mt-7">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <livewire:components.poli.treatment relationship="true" :poli="$poli->id" />
            </div>
        </div>
    </div>
</x-app-layout>