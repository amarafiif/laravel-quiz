<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kursus Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3">
            @foreach ($courses as $item)
                <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div id="courses">
                            <div class="flex space-x-6">
                                <div class="w-3/12 content-center">
                                    <img src="{{ $item->thumbnail }}" class="rounded-lg" alt="thumbnail">
                                </div>
                                <div class="w-6/12 content-center">
                                    <h3 class="text-xl font-medium text-gray-900">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="mt-5 text-gray-500 leading-relaxed">
                                        {{ $item->description }}
                                    </p>
                                </div>
                                <div class="w-3/12 content-center justify-items-center">
                                    <a href="{{ route('courses.show', $item->id) }}"
                                        class="flex ms-4 text-sm font-semibold px-4 py-2 rounded-md bg-slate-300 text-slate-700 hover:bg-slate-400 hover:text-slate-800 focus:bg-slate-400 focus:text-slate-800 active:bg-slate-400">
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
