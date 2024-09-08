<div>
    <div class="bg-white mt-10 overflow-hidden shadow-md sm:rounded-lg mb-5">
        <div class="bg-white p-5 shadow-md">
            <h1 class="text-xl">Kriteria Data</h1>
            <p class="text-stone-500 mt-5">
                Data kriteria adalah data yang akan digunakan sebagai parameter perhitungan dalam rekomendasi
                calon anggota kpps. Dan yang pasti user harus memiliki data kriteria sesuai dengan data banyak
                data kriteria yang ada
            </p>
        </div>
        <div class="p-5 pb-1 bg-gray-200 bg-opacity-25">
            <div class="text-right mb-3">
                <x-button wire:click="modalOpen" wire:loading.attr="disabled">
                    {{ __('+ Tambah') }}
                </x-button>
            </div>
            <table class="w-full text-sm text-left text-gray-500 shadow-sm">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        @foreach($this->columns() as $column)
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
                                    @endif
                                @endif
                            </div>
                        </th>
    
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->data() as $key => $row)
                        <tr class="bg-white hover:bg-gray-50">
                            @foreach($this->columns() as $column)
                                <td>
                                    <div class="py-3 px-6 flex items-center cursor-pointer">
                                        @if ($column->label === 'No')
                                            {{ $key + 1 }}
                                        @else
                                            <x-dynamic-component :component="$column->component"
                                                :value="data_get($row, $column->key) ?? ' '">
                                            </x-dynamic-component>
                                        @endif
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="p-4">
                {{ $this->data()->links() }}
            </div>
        </div>
    </div>


    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-5">
        <div class="bg-white p-5 shadow-md">
            <h1 class="text-xl">Detail Kriteria</h1>
            <p class="text-stone-500 mt-5">
                Data kriteria adalah data yang akan digunakan sebagai parameter perhitungan dalam rekomendasi
                calon anggota kpps. Dan yang pasti user harus memiliki data kriteria sesuai dengan data banyak
                data kriteria yang ada
            </p>
        </div>
        <div class="p-5 bg-gray-200 bg-opacity-25 grid grid-cols-2 gap-3">
            @foreach ($this->data() as $row)
                <div class="bg-white p-3 shadow-md">
                    <div class="border-b-2 pb-2 mb-2 flex justify-between">
                        <span class="font-semibold">{{ ucwords($row->name) }} - {{ $row->symbol }}</span>
                        <x-button wire:click="modalDetailCriteriaOpen('{{ $row->id }}')">
                            {{ __('+') }}
                        </x-button>
                    </div>
                    @foreach ($row->criteriaDetails as $criteriaDetail)
                        <div class="flex justify-between text-gray-600 mb-2">
                            <div class="flex flex-col">
                                <span class="font-semibold text-sm">{{ $criteriaDetail->classification }} - ({{ $criteriaDetail->weight }})</span>
                            </div>
                            <p>
                                <a wire:click="modalDetailCriteriaOpen('{{ $row->id }}', '{{ $criteriaDetail->id }}')" class="cursor-pointer text-sm text-blue-600 dark:text-blue-500 hover:underline">
                                    perbarui
                                </a>
                                <span class="px-2">{{ __('|') }}</span>
                                <a wire:click="deleteDetailCriteria('{{ $criteriaDetail->id }}')" class="cursor-pointer text-sm text-blue-600 dark:text-blue-500 hover:underline">
                                    hapus
                                </a>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <livewire:criteria-detail-modal-form wire:model.live="criteriaDetailModal" :criteriaId="$criteriaIdForDetail" :criteriaDetailId="$criteriaDetailId" />
    <livewire:form-criteria wire:model.live="showModal" :criteriaId="$criteriaId" />
</div>