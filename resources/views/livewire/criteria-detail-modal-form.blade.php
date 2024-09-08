<div>
    <x-dialog-modal wire:model.live="showModal">
        <x-slot name="title">
            {{ __('Form Kriteria') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Masukan data sesuai keterangan fill inputannya dan periksa kembali sebelum ingin melakukan submit
            agar data tidak salah input.') }}

            <div class="mt-4 grid grid-cols-1 gap-5" x-data="{}">
                <div>
                    <label class="text-sm font-medium text-gray-900">{{ __('Nama') }}</label>
                    <input wire:model="form.classification"
                        class="w-[100%] border-gray-300 bg-gray-50 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                    <x-input-error for="form.classification" class="mt-2" />
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900">{{ __('Bobot') }}</label>
                    <input wire:model="form.weight"
                        class="w-[100%] border-gray-300 bg-gray-50 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                    <x-input-error for="form.weight" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Kirim') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>