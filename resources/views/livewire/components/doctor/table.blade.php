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
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-0" placeholder="{{ __('Search for doctor') }}">
            </div>
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
                        {{ __('Specialist') }}
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
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ __('Yes') }}</span>
                        @else
                        <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ __('No') }}</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <button
                            wire:click="editDoctor({{ $doctor->id }})"
                            type="button"
                            class="mr-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:border-blue-700 hover:text-white font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center"
                        >
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <span class="sr-only">Edit Doctor</span>
                        </button>
                        <button
                            wire:click="deleteDoctor({{ $doctor->id }})"
                            type="button"
                            class="text-red-700 border border-red-700 hover:bg-red-700 hover:border-red-700 hover:text-white focus:outline-none font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center"
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

        <div class="flex justify-end mt-2">
            <nav aria-label="Page Navigation Example">
                <ul class="inline-flex items-center -space-x-px">
                    <li>
                        <a href="#" class="block py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                    </li>
                    <li>
                        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="z-10 py-2 px-3 leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700">3</a>
                    </li>
                    <li>
                        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                    </li>
                    <li>
                        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Next</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
    <!-- Add Item Modal -->
    <x-jet-dialog-modal wire:model="modal">
        <x-slot name="title">
            {{ __('Adding Doctor') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="doctor-name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Name') }}</label>
                <input wire:model="doctor.name" type="text" id="doctor-name" placeholder="{{ __('Doctor Name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <label for="doctor-name-as" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Name As') }}</label>
                <input wire:model="doctor.name_as" type="text" id="doctor-name-as" placeholder="{{ __('Doctor Name As') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <label for="doctor-title" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Title') }}</label>
                <input wire:model="doctor.title" type="text" id="doctor-title" placeholder="Ex. Sp. A" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <span class="block mb-2 text-sm font-medium text-gray-900">{{ __('Spesialis') }}</span>
                <label for="checked-spesialis-toggle" class="inline-flex relative items-center mb-4 cursor-pointer">
                    <input wire:model="doctor.is_spesialist" type="checkbox" value="0" id="checked-spesialis-toggle" class="sr-only peer" @if($doctor['is_spesialis']) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    @if($doctor['is_spesialis'])
                    <span class="ml-3 text-sm font-medium text-green-700">{{ __('Spesialis') }}</span>
                    @else
                    <span class="ml-3 text-sm font-medium text-red-700">{{ __('Not Spesialis') }}</span>
                    @endif
                </label>
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
    
    <!-- Edit Item Modal -->
    <x-jet-dialog-modal wire:model="modalEdit">
        <x-slot name="title">
            {{ __('Edit Doctor') }} {{ $doctorEdit['name'] }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="doctor-name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Name') }}</label>
                <input wire:model="doctorEdit.name" type="text" id="doctor-name" placeholder="{{ __('Doctor Name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <label for="doctor-name-as" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Name As') }}</label>
                <input wire:model="doctorEdit.name_as" type="text" id="doctor-name-as" placeholder="{{ __('Doctor Name As') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <label for="doctor-title" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Doctor Title') }}</label>
                <input wire:model="doctorEdit.title" type="text" id="doctor-title" placeholder="Ex. Sp. A" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
            </div>
            <div class="mt-4">
                <span class="block mb-2 text-sm font-medium text-gray-900">{{ __('Specialist') }}</span>
                <label for="checked-specialist-toggle" class="inline-flex relative items-center mb-4 cursor-pointer">
                    <input wire:model="doctorEdit.is_specialist" type="checkbox" id="checked-specialist-toggle" class="sr-only peer" @if($doctorEdit['is_specialist']) checked @endif>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    @if($doctorEdit['is_specialist'])
                    <span class="ml-3 text-sm font-medium text-green-700">{{ __('Spesialis') }}</span>
                    @else
                    <span class="ml-3 text-sm font-medium text-red-700">{{ __('Not Spesialis') }}</span>
                    @endif
                </label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
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
