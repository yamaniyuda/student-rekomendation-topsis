<div>

    <div class="relative overflow-x-auto rounded-lg">
        <div class="flex flex-col p-4">
            <span class="text-2xl font-semibol text-left text-gray-900 ">
                {{ $this->title }}
            </span>
            <p class="mt-1 text-sm font-normal text-gray-500">
                {{ $this->desc }}
            </p>
        </div>
        <div class="pb-4 px-4 flex justify-end">
            {{-- <x-input></x-input> --}}
            <x-button wire:click="modalOpen" wire:loading.attr="disabled">
                {{ __('+ Tambah') }}
            </x-button>
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
                    @php
                        $data = $row->toArray();
                        // dd($data);
                        usort($data['student']['student_score'][0]['criteria_details'], function ($a, $b) {
                            $numA = (int) substr($a['criteria']['symbol'], 1);
                            $numB = (int) substr($b['criteria']['symbol'], 1);

                            return $numA - $numB;
                        });

                    @endphp
                    <tr class="bg-white border-b hover:bg-gray-50">
                        @foreach($this->columns() as $column)
                        <td>
                            <div class="py-3 px-6 flex items-center cursor-pointer">
                                <x-dynamic-component :component="$column->component" :value="data_get($data, $column->key) ?? ' '">
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
            {{ __('Masukan data sesuai keterangan fill inputannya dan periksa kembali sebelum ingin melakukan submit agar data tidak salah input.') }}

            <div class="mt-4 grid grid-cols-1 gap-5" x-data="{}" >
                <div>
                    <label class="text-sm font-medium text-gray-900">{{ __('Nama') }}</label>
                    <input wire:model="form.name"class="w-[100%] border-gray-300 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload Foto Profilsssss</label>
                    <input wire:model="form.photoProfile"  class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file">
                    <x-input-error for="form.photoProfile" class="mt-2" />
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900">{{ __('Gender:') }}</label>
                    <div>
                        <input type="radio" value="boy" wire:model="form.gender" id="boy">
                        <label for="boy" class="text-sm font-medium text-gray-900 mr-4">{{ __('Laki - laki') }}</label>
                        <input type="radio" value="girl" wire:model="form.gender" id="girl">
                        <label for="girl" class="text-sm font-medium text-gray-900">{{ __('Perempuan') }}</label>
                    </div>
                    <x-input-error for="form.gender" class="mt-2" />
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900">{{ __('Address') }}</label>
                    <textarea name="address" wire:model="form.address" class="border-gray-300 w-[100%] focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    <x-input-error for="form.address" class="mt-2" />
                </div>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model='form.status' class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900">Aktif</span>
                </label>
                <div>
                    <div class="border-t-2 border-dotted">
                        <div class="flex flex-col mt-4">
                            <span class="text-lg font-medium text-gray-900 ">
                                {{ __('Kriteria Data (Current Year)') }}
                            </span>
                            <p>
                                {{ __('Masukan data sesuai keterangan fill inputannya dan periksa kembali sebelum ingin melakukan submit agar data tidak salah input.') }}
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-5  pt-4">


                            @foreach ($this->getCriteria() as $criteria)
                                <div>
                                    <label class="text-sm font-medium text-gray-900">{{ $criteria->symbol }} - {{ ucfirst($criteria->name) }}</label>
                                    <select wire:model="form.criteriaSelections.{{ $criteria->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option hidden selected value></option>
                                        @foreach ($criteria->criteriaDetails as $criteriaDetails)
                                            <option value="{{ $criteriaDetails->id }}">{{ ucfirst($criteriaDetails->classification) }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="form.criteriaSelections.{{ $criteria->id }}" class="mt-2" />
                                </div>
                            @endforeach

                         
                        </div>
                    </div>
                </div>
                <div>
                    <div class="border-t-2 border-dotted">
                        <div class="flex flex-col mt-4">
                            <span class="text-lg font-medium text-gray-900 ">
                                {{ __('Kriteria Data') }}
                            </span>
                            <p>
                                {{ __('Masukan data sesuai keterangan fill inputannya dan periksa kembali sebelum ingin melakukan submit agar data tidak salah input.   ') }}
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-5  pt-4">
                            <div>
                                <label class="text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                                <input wire:model="form.email"class="w-[100%] border-gray-300 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                <x-input-error for="form.email" class="mt-2" />
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-900">{{ __('Password') }}</label>
                                <input wire:model="form.password"class="w-[100%] border-gray-300 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                                <x-input-error for="form.password" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="hideModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>