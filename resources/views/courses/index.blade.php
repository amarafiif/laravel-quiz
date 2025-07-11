<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kursus Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-3 sm:px-6 lg:px-8">
            @foreach ($courses as $item)
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6 lg:p-8">
                        <div id="courses">
                            <div class="flex space-x-6">
                                <div class="w-3/12 content-center">
                                    <img src="{{ Storage::url($item->thumbnail) }}" class="rounded-lg" alt="thumbnail">
                                </div>
                                <div class="w-6/12 content-center">
                                    <h3 class="text-xl font-medium text-gray-900">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="mt-5 leading-relaxed text-gray-500">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                <div class="w-3/12 content-center justify-items-center">
                                    <a href="{{ route('courses.show', $item->id) }}" class="ms-4 flex rounded-md bg-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-400 hover:text-slate-800 focus:bg-slate-400 focus:text-slate-800 active:bg-slate-400">
                                        Lanjutkan Kursus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
