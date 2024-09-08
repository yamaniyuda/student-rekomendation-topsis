<div>
    <div class="relative overflow-x-auto rounded-lg">
        <div class="flex flex-col p-4 md:w-[50%]">
            <span class="text-2xl font-semibol text-left text-gray-900 ">
                {{ $this->title }}
            </span>
            <p class="mt-1 text-sm font-normal text-gray-500">
                {{ $this->desc }}
            </p>
        </div>
        <div class="pb-4 px-4 flex justify-between">
            {{-- <x-input></x-input>
            <x-button wire:click="modalOpen" wire:loading.attr="disabled">
                {{ __('+ New') }}
            </x-button> --}}
        </div>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    @foreach($this->columns() as $column)
                    {{-- <th wire:click="sort('{{ $column->key }}')"> --}}
                    <th>
                        <div class="py-3 px-6 flex items-center cursor-pointer">
                            {{ $column->label }}
                            @if($sortBy === $column->key)
                            @if ($sortDirection === 'asc')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            @else
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg> --}}
                            @endif
                            @endif
                        </div>
                    </th>

                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($this->data() as $row)
                <tr class="bg-white border-b hover:bg-gray-50">
                    @foreach($this->columns() as $column)
                    <td>
                        <div class="py-3 px-6 flex items-center cursor-pointer">
                            <x-dynamic-component :component="$column->component" :value="data_get($row, $column->key)">
                            </x-dynamic-component>
                        </div>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $this->data()->links() }}
    </div>

    <x-dialog-modal wire:model.live="showModal">
        <x-slot name="title">
            {{ __('Form ' . $this->title) }}
        </x-slot>

        <x-slot name="content">
            {{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}

            <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-input  />

                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3"
                        wire:click="logoutOtherBrowserSessions"
                        wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>