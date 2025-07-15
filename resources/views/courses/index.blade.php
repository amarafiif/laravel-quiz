<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Topik Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @foreach ($courses as $item)
                    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="p-6">
                            <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:space-x-6 lg:space-y-0">
                                <!-- Thumbnail -->
                                <div class="mx-auto flex-shrink-0 lg:mx-0">
                                    <img src="{{ Storage::url($item->thumbnail) }}" class="h-32 w-48 rounded-lg object-cover shadow-sm" alt="{{ $item->name }}">
                                </div>

                                <!-- Content -->
                                <div class="flex-1 text-center lg:text-left">
                                    <h3 class="mb-2 text-xl font-semibold text-gray-900">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="leading-relaxed text-gray-600">
                                        {{ $item->description }}
                                    </p>
                                </div>

                                <!-- Action Button -->
                                <div class="flex flex-shrink-0 justify-center">
                                    <a href="{{ route('courses.show', $item->code) }}"
                                        class="inline-flex items-center rounded-md bg-sky-600 px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                                        Lihat Kuis
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
