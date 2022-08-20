<div>
    
    <div class="overflow-x-auto relative sm:rounded-lg">
        <div class="flex justify-between items-center pb-4">
            <div>
                <button
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-none focus:outline-none font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                    x-data="{}"
                    @click="$wire.showModal()"
                >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </div>
            @if(!$relationship)
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-0" placeholder="{{ __('Search for doctor') }}">
            </div>
            @endif
        </div>
        <table class="w-full text-sm text-left text-gray-500 shadow-md">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="p-4 rounded-tl">
                        {{ __('No') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Doctor Name') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Spesialis') }}
                    </th>
                    <th scope="col" class="py-3 px-6 rounded-tr">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $id => $doctor)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-4 w-4">
                        {{ $id + 1 }}
                    </td>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        <a href="#" class="font-medium hover:underline hover:text-blue-400">{{ $doctor->name }}</a>
                    </th>
                    <td class="py-4 px-6">
                        @if($doctor['is_specialist'])
                        <span class="bg-green-100 text-green-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-full">
                            <svg aria-hidden="true" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </span>
                        @else
                        <span class="bg-red-100 text-red-800 text-sm font-semibold inline-flex items-center p-1.5 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="sr-only">Icon description</span>
                        </span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        @if(!$relationship)
                        <button type="button" class="mr-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:border-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <span class="sr-only">Edit Doctor</span>
                        </button>
                        @endif
                        <button
                            wire:click="deleteDoctor({{ $doctor->id }})"
                            type="button"
                            class="text-red-700 border border-red-700 hover:bg-red-700 hover:border-red-700 hover:text-white focus:outline-none font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-blue-800"
                        >
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span class="sr-only">Delete Doctor</span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="text-center py-4 px-6" colspan="4">
                        {{ __('No Data') }} !!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Add Item Modal -->
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            {{ __('Adding Doctor') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="poli" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Select Doctor Name') }}</label>
                <livewire:components.search-select model="\App\Models\Doctor" searchBy="name" emitName="doctor" />
            </div>
            <div class="mt-4">
                <label for="poli" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Select Poli Name') }}</label>
                <select id="poli" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" disabled>
                    <option value="{{ $poli['id'] }}">{{ $poli['name'] }}</option>
                </select>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal Delete Poli -->
    <x-jet-dialog-modal wire:model="modalDelete">
        <x-slot name="title">
            {{ __('Delete Poli '. $doctorDelete['name']) }}
        </x-slot>

        <x-slot name="content">
            <span class="">{{ __('Are you sure to delete doctor '. $doctorDelete['name'] .'?') }}</span>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
</div>
