<div>
    
    <div class="overflow-x-auto relative sm:rounded-lg">
        <div class="flex justify-between items-center pb-4">
            <div>
                <button
                    wire:click="createPoli"
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-none focus:outline-none font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2"
                >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:model="query" type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-0" placeholder="{{ __('Search for poli') }}">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 shadow-md">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="p-4 rounded-tl">
                        {{ __('No') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Poli Name') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Poli Type') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="py-3 px-6 rounded-tr">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($polis as $id => $poli)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-4 w-4">
                        {{ $id + 1 }}
                    </td>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        <a href="{{ route('dashboard.poli.view', $poli->id) }}" class="font-medium hover:underline hover:text-blue-400">{{ $poli->name }}</a>
                    </th>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                            {{ $poli->type == 1 ? 'RAJAL' : 'RANAP' }}
                        </span>
                    </th>
                    <td class="py-4 px-6">
                        <label for="checked-toggle-{{ $id }}" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input
                                x-data="{}"
                                x-on:change="$wire.changeStatus({{ $poli->id }})"
                                type="checkbox"
                                value=""
                                id="checked-toggle-{{ $id }}"
                                class="sr-only peer"
                                @if($poli->status) checked @endif
                            >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </td>
                    <td class="py-4 px-6">
                        <button
                            type="button"
                            class="mr-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:border-blue-700 hover:text-white focus:outline-none font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center"
                            wire:click="editPoli({{ $poli }})"
                        >
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <span class="sr-only">Edit Poli</span>
                        </button>
                        <button
                            type="button"
                            class="text-red-700 border border-red-700 hover:bg-red-700 hover:border-red-700 hover:text-white focus:outline-none font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center"
                            wire:click="deletePoli({{ $poli }})"
                        >
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span class="sr-only">Delete Poli</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Modal Create Poli -->
    <x-jet-dialog-modal wire:model="modalPoliCreate">
        <x-slot name="title">
            {{ __('Create New Poli') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="create-poli-name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Poli Name') }}</label>
                <input wire:model="poliCreate.name" type="text" id="create-poli-name" placeholder="{{ __('Poli Name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <span class="block mb-2 text-sm font-medium text-gray-900">{{ __('Poli Status') }}</span>
                <label for="checked-create-toggle" class="inline-flex relative items-center mb-4 cursor-pointer">
                    <input wire:model="poliCreate.status" type="checkbox" value="" id="checked-create-toggle" class="sr-only peer" @if($poliCreate['status']) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    @if($poliCreate['status'])
                    <span class="ml-3 text-sm font-medium text-green-700">{{ __('Poli is Active') }}</span>
                    @else
                    <span class="ml-3 text-sm font-medium text-red-700">{{ __('Poli is Nonactive') }}</span>
                    @endif
                </label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalPoliCreate')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Modal Edit Poli -->
    <x-jet-dialog-modal wire:model="modalPoliEdit">
        <x-slot name="title">
            {{ __('Edit Poli '. $poliEdit['name']) }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="poli-name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Poli Name') }}</label>
                <input wire:model="poliEdit.name" type="text" id="poli-name" placeholder="{{ __('Poli Name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <span class="block mb-2 text-sm font-medium text-gray-900">{{ __('Poli Status') }}</span>
                <label for="checked-edit-toggle" class="inline-flex relative items-center mb-4 cursor-pointer">
                    <input wire:model="poliEdit.status" type="checkbox" value="" id="checked-edit-toggle" class="sr-only peer" @if($poliEdit['status']) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    @if($poliEdit['status'])
                    <span class="ml-3 text-sm font-medium text-green-700">{{ __('Poli is Active') }}</span>
                    @else
                    <span class="ml-3 text-sm font-medium text-red-700">{{ __('Poli is Nonactive') }}</span>
                    @endif
                </label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalPoliEdit')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
    <!-- Modal Delete Poli -->
    <x-jet-dialog-modal wire:model="modalPoliDelete">
        <x-slot name="title">
            {{ __('Delete Poli '. $poliDelete['name']) }}
        </x-slot>

        <x-slot name="content">
            <span class="">{{ __('Are you sure to delete poli '. $poliDelete['name'] .'?') }}</span>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalPoliDelete')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
</div>
