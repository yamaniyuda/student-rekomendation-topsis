@props([
'value'
])

<div class="flex">
    <a wire:click="update('{{ $value }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        perbarui
    </a>
    <span class="px-2">{{ __('|') }}</span>
    <a wire:click="delete('{{ $value }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        hapus
    </a>
</div>