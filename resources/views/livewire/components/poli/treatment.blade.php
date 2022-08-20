<div>
    
    <div class="overflow-x-auto relative sm:rounded-lg">
        <div class="flex justify-between items-center pb-4">
            <div>
                <button
                    wire:click="createTreatment"
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
                <input wire:model="keyword" wire:keyup="renderTreatments" type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-0" placeholder="{{ __('Search for treatment') }}">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 shadow-md">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="p-4 rounded-tl">
                        {{ __('No') }}
                    </th>
                    <th scope="col" class="py-3 px-6">
                        {{ __('Treatment Name') }}
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
                @forelse($treatments as $id => $treatment)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="p-4 w-4">
                        {{ $id + 1 }}
                    </td>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        <!-- <a href="#" class="font-medium hover:underline hover:text-blue-400">{{ $treatment->name_as }}</a> -->
                        {{ $treatment->name_as == '' ? $treatment->name : $treatment->name_as }}
                    </th>
                    <td class="py-4 px-6">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Active</span>
                    </td>
                    <td class="py-4 px-6">
                        <button
                            wire:click="editTreatment({{ $treatment }})"
                            type="button"
                            class="mr-2 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:border-blue-700 hover:text-white font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center"
                        >
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <span class="sr-only">Edit Doctor</span>
                        </button>
                        <button
                            wire:click="deleteTreatment({{ $treatment }})"
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
                    <td class="p-4 w-4 text-center" colspan="4">{{ __('No Data') }} !!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Add Item Modal -->
    <x-jet-dialog-modal wire:model="modalCreateTreatment">
        <x-slot name="title">
            {{ __('Adding Treatment') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Treatment Name') }}</label>
                <input wire:model="treatment.name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Name') }}" autofocus>
            </div>
            <div class="mt-4">
                <label for="name_as" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Treatment Name As') }}</label>
                <input wire:model="treatment.name_as" type="text" id="name_as" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Name As') }}">
            </div>
            <div class="mt-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 1</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatment.price" min="0" type="number" id="price" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="price_c2" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 2</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatment.price_c2" min="0" type="number" id="price_c2" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="price_c3" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 3</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatment.price_c3" min="0" type="number" id="price_c3" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="type_bill" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Type Treatment') }}</label>
                <select wire:model="treatment.type" id="type_bill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">{{ __('Select') }} {{ __('Type Treatment') }}</option>
                    <option value="1">Treatment One</option>
                    <option value="2">Treatment Two</option>
                    <option value="3">Treatment Three</option>
                    <option value="4">Treatment Four</option>
                    <option value="5">Treatment Five</option>
                </select>
            </div>
            <div class="mt-4">
                <div class="flex space-x-6">
                    <div>
                        <span class="block mb-2 text-sm font-medium text-gray-900">Paten</span>
                        <label for="paten" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input wire:model="treatment.is_paten" type="checkbox" id="paten" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div>
                        <span class="block mb-2 text-sm font-medium text-gray-900">Wajib</span>
                        <label for="wajib" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input wire:model="treatment.wajib" type="checkbox" id="wajib" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label for="order" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Ordering') }} Wajib</label>
                <input wire:model="treatment.order" type="number" id="order" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Ordering') }} Wajib">
                <p class="mt-2 text-sm text-gray-600">{{ __('Please fill this if you checked wajib input.') }}</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="save" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalCreateTreatment')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
    <!-- Edit Item Modal -->
    <x-jet-dialog-modal wire:model="modalEditTreatment">
        <x-slot name="title">
            {{ __('Edit Treatment') }} {{ $treatmentEdit['name'] ?? '' }}
        </x-slot>

        <x-slot name="content">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Treatment Name') }}</label>
                <input wire:model="treatmentEdit.name" type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Name') }}" autofocus>
            </div>
            <div class="mt-4">
                <label for="name_as" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Treatment Name As') }}</label>
                <input wire:model="treatmentEdit.name_as" type="text" id="name_as" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Name As') }}">
            </div>
            <div class="mt-4">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 1</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatmentEdit.price" min="0" type="number" id="price" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="price_c2" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 2</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatmentEdit.price_c2" min="0" type="number" id="price_c2" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="price_c3" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Price Class') }} 3</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300">
                        Rp.
                    </span>
                    <input wire:model="treatmentEdit.price_c3" min="0" type="number" id="price_c3" class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="100.000">
                </div>
            </div>
            <div class="mt-4">
                <label for="type_bill" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Type Treatment') }}</label>
                <select wire:model="treatmentEdit.type" id="type_bill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">{{ __('Select') }} {{ __('Type Treatment') }}</option>
                    <option value="1">Treatment One</option>
                    <option value="2">Treatment Two</option>
                    <option value="3">Treatment Three</option>
                    <option value="4">Treatment Four</option>
                    <option value="5">Treatment Five</option>
                </select>
            </div>
            <div class="mt-4">
                <div class="flex space-x-6">
                    <div>
                        <span class="block mb-2 text-sm font-medium text-gray-900">Paten</span>
                        <label for="paten" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input wire:model="treatmentEdit.is_paten" type="checkbox" id="paten" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div>
                        <span class="block mb-2 text-sm font-medium text-gray-900">Wajib</span>
                        <label for="wajib" class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input wire:model="treatmentEdit.wajib" type="checkbox" id="wajib" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label for="order" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Ordering') }} Wajib</label>
                <input wire:model="treatmentEdit.order" type="number" id="order" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Ordering') }} Wajib">
                <p class="mt-2 text-sm text-gray-600">{{ __('Please fill this if you checked wajib input.') }}</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalEditTreatment')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
    <!-- Modal Delete Poli -->
    <x-jet-dialog-modal wire:model="modalDeleteTreatment">
        <x-slot name="title">
            {{ __('Delete Treatment ') }} {{ $treatmentDelete['name'] }}
        </x-slot>

        <x-slot name="content">
            <span class="">{{ __('Are you sure to delete doctor '. $treatmentDelete['name'] .'?') }}</span>
        </x-slot>

        <x-slot name="footer">
            <div class="flex space-x-2">
                <x-jet-button wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-button>
                <x-jet-button wire:click="$toggle('modalDeleteTreatment')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    
</div>
