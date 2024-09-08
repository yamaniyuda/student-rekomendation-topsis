<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criteria') }}
        </h2>
    </x-slot>

    <div class="pb-5 animate-fade-in-up">
        <div class=" mx-auto sm:px-6 lg:px-8">
            @livewire('criteria-table', ['lazy' => true])
        </div>
    </div>
</x-app-layout>