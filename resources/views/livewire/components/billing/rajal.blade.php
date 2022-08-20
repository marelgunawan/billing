<div>
	<div class="flex flex-col justify-center py-2">
        <div class="flex justify-center relative">
            @if ($listPasient['selected'])
            <div class="absolute left-5 top-2">
                <span class="block mt-1 text-base font-bold text-blue-400 ml-2">{{ $listPasient['selected']['name'] }} (@rm($listPasient['selected']['no_rm']))</span>
            </div>
            @endif
            <h2 class="font-bold text-3xl mt-2 mb-5 text-center">RAJAL</h2>
            <input wire:model="dateMasuk" type="date" pattern="\d{4}-\d{2}-\d{2}" class="w-auto shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400 absolute right-5 top-2">
        </div>
        <div class="flex w-full px-3 space-x-5 mt-4">
            <div class="flex flex-col w-4/12 relative">
                <label for="pasient">{{ __('Pasien') }}</label>
                <input wire:model="listPasient.keyword" wire:keyup="searchPX" type="text" placeholder="Search No RM..." class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400" autofocus>
                {{-- List --}}
                @if (strlen($listPasient['keyword']) > 0)
                <div class="absolute z-30 mt-1 top-full inset-x-0 p-2 rounded-md shadow bg-white">
                    <div class="flex flex-col space-y-1">
                        @forelse ($listPasient['lists'] as $pasient)
                        <div wire:click="selectPasient({{ $pasient['id'] }})" class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                            <span class="capitalize">{{ $pasient['name'] }}</span>
                        </div>
                        @empty
                        <div class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                            <span class="capitalize">Tidak ditemukan.</span>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif
                @if ($listPasient['upAddress'])
                <input wire:model="listPasient.address" type="text" placeholder="Alamat Px" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                @endif
            </div>
            <div class="flex flex-col w-4/12">
                <label for="poli">{{ __('Poli') }}</label>
                <select wire:model="poli" class="w-1/2 lg:w-auto mt-1 shadow-sm border-gray-300 rounded-md text-sm focus:border-purple-400  focus:ring-1 focus:ring-purple-400">
                    <option value="">Pilih Poli</option>
                    @foreach($polis as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col w-4/12">
                <label for="doctor">{{ __('Dokter') }}</label>
                <select wire:model="doctor" class="w-1/2 lg:w-auto mt-1 shadow-sm border-gray-300 rounded-md text-sm focus:border-purple-400  focus:ring-1 focus:ring-purple-400">
                    <option value="">Pilih Doctor</option>
                    @foreach($doctors as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex w-full px-3 space-x-5 mt-4">
            <div class="flex flex-col w-4/12 relative">
                <label for="tindakan">{{ __('Tindakan') }}</label>
                <div class="relative">
                    <input wire:model="listTindakan.keyword" wire:keyup="searchTindakan" type="text" placeholder="Search Tindakan" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                    {{-- List --}}
                    @if (count($listTindakan['lists']) > 0)
                    <div class="absolute z-30 mt-1 top-full inset-x-0 p-2 rounded-md shadow bg-white">
                        <div class="flex flex-col space-y-1">
                            @forelse ($listTindakan['lists'] as $items)
                            <div wire:click="selectTindakan({{ $items['id'] }})" class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                                <span class="capitalize">{{ $items['name'] }}</span>
                            </div>
                            @empty
                            <div class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                                <span class="capitalize">Tidak ditemukan.</span>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
                {{-- List Tindakan --}}
                @foreach ($tindakan as $index => $items)
                <div class="relative bg-green-400 text-white flex items-center rounded p-1 mt-1">
                    <span class="w-10/12 font-bold text-xs">{{ $items['name'] }} (@currency($items['price']))</span>
                    <div class="flex w-3/12 justify-start items-center space-x-2">
                        <svg wire:click="minQntTindakan({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                        </svg>
                        <span class="font-bold">{{ $items['qnt'] }}</span>
                        <svg wire:click="addQntTindakan({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="flex w-1/12 justify-end items-center hover:text-red-600">
                        <svg wire:click="dellTindakan({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex flex-col w-4/12 relative">
                <label for="penunjang">{{ __('Penunjang') }}</label>
                <div class="relative">
                    <input wire:model="listPenunjang.keyword" wire:keyup="searchPenunjang" type="text" placeholder="Search Penunjang" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                    {{-- List --}}
                    @if (count($listPenunjang['lists']) > 0)
                    <div class="absolute z-30 mt-1 top-full inset-x-0 p-2 rounded-md shadow bg-white">
                        <div class="flex flex-col space-y-1">
                            @forelse ($listPenunjang['lists'] as $items)
                            <div wire:click="selectPenunjang({{ $items['id'] }})" class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                                <span class="capitalize">{{ $items['name'] }}</span>
                            </div>
                            @empty
                            <div class="cursor-pointer hover:bg-purple-400 rounded-md p-2">
                                <span class="capitalize">Tidak ditemukan.</span>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
                
                {{-- List Penunjang --}}
                @foreach ($penunjang as $index => $items)
                <div class="relative bg-green-400 text-white flex items-center rounded p-1 mt-1">
                    <span class="w-10/12 font-bold text-xs">{{ $items['name'] }} (@currency($items['price']))</span>
                    <div class="flex w-3/12 justify-start items-center space-x-2">
                        <svg wire:click="minQntPenunjang({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                        </svg>
                        <span class="font-bold">{{ $items['qnt'] }}</span>
                        <svg wire:click="addQntPenunjang({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="flex w-1/12 justify-end items-center hover:text-red-600">
                        <svg wire:click="dellPenunjang({{ $index }})" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="flex flex-col w-4/12 relative space-y-2">
                <div class="flex flex-col">
                    <label for="laboratorium">{{ __('Laboratorium') }}</label>
                    <input wire:model="lab" type="number" placeholder="Laboratorium" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                </div>

                <div class="flex flex-col">
                    <label for="bhp">{{ __('BHP') }}</label>
                    <input wire:model="bhp" type="number" placeholder="BHP" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                </div>

                <div class="flex flex-col">
                    <label for="obat">{{ __('Obat') }}</label>
                    <input wire:model="obat" type="number" placeholder="Obat" class="w-full shadow-sm border-gray-300 rounded-md mt-1 text-sm focus:border-purple-400 focus:ring-1 focus:ring-purple-400">
                </div>
            </div>
        </div>

        <div class="flex w-full px-3 space-x-3 mt-4 justify-end">
            <div wire:loading.flex wire:target="save" class="justify-center my-2">
                <span class="text-{{ $msg['color'] }}-500 font-semibold tracking-wide">{{ $msg['text'] }}</span>
            </div>
            <div wire:loading.flex wire:target="rest" class="justify-center my-2">
                <span class="text-blue-500 font-semibold tracking-wide">Reseted data</span>
            </div>
            <button wire:click="save" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 disabled:opacity-25 transition">Save</button>
            <button wire:click="rest" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 disabled:opacity-25 transition">Reset</button>
            <a href="{{ route('bill.tempalaterajal', $urlCetak) }}" target="_blank" class="nline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 disabled:opacity-25 transition">Cetak</a>
        </div>
	</div>
</div>