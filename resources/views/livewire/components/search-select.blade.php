<div class="relative">
    <input
        type="text"
        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
        placeholder="Search Contacts..."
        wire:model="query"
        wire:keydown.arrow-up="decrementHighlight"
        wire:keydown.arrow-down="incrementHighlight"
        wire:keydown.enter="selectData"
    />

    @if(!empty($query))
        <!-- <div class="fixed top-0 bottom-0 left-0 right-0"></div> -->
 
        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg mt-2 rounded-sm">
            <div class="overflow-hidden rounded-sm flex flex-col space-y-1">
            @foreach($datas as $i => $data)
                <span
                    class="p-2 cursor-pointer hover:bg-gray-300 {{ $highlightIndex === $i ? 'bg-gray-300' : '' }}"
                    wire:click="selectData($i)"  
                >{{ $data['name'] }}</span>
            @endforeach
            </div>
        </div>
    @endif
</div>