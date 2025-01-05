<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __({{ $course->name }}) }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">
                <div class="flex space-x-6">
                    <div class="w-3/12 content-center">
                        <img src="{{ $course->thumbnail }}" class="rounded-lg" alt="thumbnail">
                    </div>
                    <div class="w-9/12 content-center">
                        <h3 class="text-xl font-medium text-gray-900">
                            {{ $course->name }}
                        </h3>
                        <p class="mt-5 text-gray-500 leading-relaxed">
                            {{ $course->description }}
                        </p>
                        <div class="mt-5">
                            <x-button
                                class="bg-slate-300 text-slate-700 hover:bg-slate-400 hover:text-slate-800 focus:bg-slate-400 focus:text-slate-800 active:bg-slate-400">
                                {{ __('Ambil Kelas') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
