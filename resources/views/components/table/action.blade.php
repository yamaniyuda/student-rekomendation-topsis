@props([
'value'
])

<div class="flex">
    <a href="{{ route('students.show', ['id' => $value]) }}"
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        Detail
    </a>
    <span class="px-2">|</span>
    <a  wire:click="modalOpen('{{ $value }}')"
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        Edit
    </a>
    <span class="px-2">|</span>
    <a  wire:click="delete('{{ $value }}')"
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        Hapus
    </a>
</div>