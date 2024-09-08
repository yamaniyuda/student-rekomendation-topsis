@props(['disabled' => false, 'label' => false, 'type' => 'text'])

@if ($label)
    <label class="text-sm font-medium text-gray-900">{{ $label }}</label>
@endif

@if ($type === 'textarea')
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} ></textarea>
@else
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 w-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
@endif
