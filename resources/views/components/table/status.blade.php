@props([
    'value'
])

<div class="flex">
    <div @class([
        'text-white rounded-xl px-2 uppercase font-bold text-xs',
        'bg-red-500' => $value === 'deleted',
        'bg-green-500' => $value == '1',
        'bg-gray-500' => $value == '0',
])>
        {{ $value == 1 ? 'Active' : 'Inactive' }}
    </div>
</div>
