<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($course->quizzes as $item)
                    <a href="#" class="block">
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-200 transform hover:-translate-y-1">
                            <div class="p-4 space-y-3">
                                <div class="aspect-video overflow-hidden rounded-lg">
                                    <img src="{{ $item->thumbnail }}" class="w-full h-full object-cover" alt="{{ $item->name }} thumbnail">
                                </div>
                                <div class="space-y-3">
                                    <h3 class="text-lg font-medium text-gray-900 line-clamp-2">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                                        {{ $item->description }}
                                    </p>
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center text-xs font-semibold px-2 py-1 rounded-md bg-blue-100 text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25" />
                                                <path fill="currentColor"
                                                    d="M12 5.3c0-.143 0-.214.046-.258s.116-.042.254-.036a7 7 0 1 1-6.207 10.75c-.074-.116-.111-.175-.096-.237s.077-.098.2-.169l5.653-3.263c.073-.043.11-.064.13-.099c.02-.034.02-.077.02-.161z" />
                                            </svg>
                                            {{ $item->attempt_time }}
                                        </span>
                                        <span class="inline-flex items-center text-xs font-semibold px-2 py-1 rounded-md bg-blue-100 text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24">
                                                <g fill="none">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M7 4.018c-.54.023-.928.074-1.271.19a4 4 0 0 0-2.522 2.52C3 7.349 3 8.115 3 9.649c0 .095 0 .143.013.181a.25.25 0 0 0 .158.158c.038.013.086.013.182.013h17.294c.096 0 .144 0 .182-.013a.25.25 0 0 0 .158-.158C21 9.791 21 9.743 21 9.647c0-1.533 0-2.3-.207-2.918a4 4 0 0 0-2.522-2.522c-.343-.115-.732-.166-1.271-.189V6.5a1.5 1.5 0 0 1-3 0V4h-4v2.5a1.5 1.5 0 1 1-3 0z"
                                                        clip-rule="evenodd" />
                                                    <path fill="currentColor" fill-opacity="0.25"
                                                        d="M3 11.5c0-.236 0-.354.073-.427S3.264 11 3.5 11h17c.236 0 .354 0 .427.073s.073.191.073.427v.5c0 3.771 0 5.657-1.172 6.828S16.771 20 13 20h-2c-3.771 0-5.657 0-6.828-1.172S3 15.771 3 12z" />
                                                    <path stroke="currentColor" stroke-linecap="round" d="M8.5 2.5v4m7-4v4" />
                                                </g>
                                            </svg>
                                            {{ $item->deadline }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
