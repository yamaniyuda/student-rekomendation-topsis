<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Ranking Topsis') }}
      </h2>
  </x-slot>

  <div class="py-12 animate-fade-in-up">
      <div class="mx-auto sm:px-6 lg:px-8">
          @livewire('ranking-topsis')
      </div>
  </div>
</x-app-layout>