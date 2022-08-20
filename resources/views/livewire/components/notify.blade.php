<div>
    <div class="fixed right-7 bottom-0">
        @foreach($toasts as $index => $data)
        <div
            x-data="{}"
            x-init="setTimeout(() => { $wire.emit('hideToast', '{{ $index }}') }, 2000);"
            id="toast-{{ $data['type'] }}"
            class="flex items-center px-3 py-2 mb-4 w-full w-96 text-gray-500 bg-white rounded-lg shadow ring-1 {{ $ringsType[$data['type']] }}"
            role="alert"
        >
            @if($data['icon'])
            <div class="inline-flex flex-shrink-0 justify-center items-center w-7 h-7 {{ $iconType[$data['type']] }} rounded-lg">
                @switch($data['type'])
                    @case('success')
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Check icon</span>
                        @break
                    
                    @case('warning')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="sr-only">Exclamation icon</span>
                        @break
                    
                    @case('danger')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Exclamation icon</span>
                        @break
                @endswitch
            </div>
            @endif
            <div class="mx-3 text-sm font-normal text-start {{ $colorsType[$data['type']] }}">{{ $data['msg'] }}</div>
            <button
                @click="$wire.emit('hideToast', '{{ $index }}') }"
                type="button"
                class="ml-auto pl-2 text-gray-400 hover:text-red-700 inline-flex border-l-2"
                data-dismiss-target="#toast-success"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        @endforeach
    </div>
</div>
