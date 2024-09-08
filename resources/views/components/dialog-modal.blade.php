@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="pt-4">
        <div class="text-lg px-6 shadow-sm pb-4 font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="text-sm px-6 text-gray-600 py-4 scrollbar max-h-[68vh] overflow-y-auto">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
