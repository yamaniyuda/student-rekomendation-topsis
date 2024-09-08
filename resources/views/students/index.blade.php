<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in-up">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mb-5 rounded-xl flex justify-between shadow-lg overflow-hidden">
                <div class="flex justify-center  flex-col ml-10"> 
                    <h1 class="text-3xl font-semibold">Hai, Kamu</h1>
                    <h1>Ayok manejemen data siswa siswi kamu, kamu dapat lihat di table di bawah</h1>
                </div>
                <img src="{{ URL::to('/students-img.png')  }}"  class="w-[40vh]" />
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:student-table />
            </div>
        </div>
    </div>
</x-app-layout>