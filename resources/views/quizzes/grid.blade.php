<div id="quiz-grid" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($quizzes as $item)
        <div class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
            <div class="flex aspect-video items-center justify-center bg-sky-500">
                <img alt="Thumbnail {{ $item->name }}" srcset="{{ Storage::url($item->thumbnail) }}">
            </div>
            <div class="p-6">
                <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ $item->name }}</h3>
                <p class="mb-4 text-gray-600">{{ $item->description }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-sky-500">{{ $item->total_questions }} Soal</span>
                    <div class="flex items-center">
                        <span class="inline-flex items-center rounded-md bg-sky-100 px-2 py-1 text-sm font-semibold text-sky-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25" />
                                <path fill="currentColor" d="M12 5.3c0-.143 0-.214.046-.258s.116-.042.254-.036a7 7 0 1 1-6.207 10.75c-.074-.116-.111-.175-.096-.237s.077-.098.2-.169l5.653-3.263c.073-.043.11-.064.13-.099c.02-.034.02-.077.02-.161z" />
                            </svg>
                            {{ $item->attempt_time }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full min-h-[390px] content-center text-center text-gray-500">
            <p class="py-12 text-xl">Oops! Kuis yang Anda cari tidak ditemukan.</p>
        </div>
    @endforelse
</div>

<div id="pagination-links" class="mt-8">
    {{ $quizzes->links() }}
</div>
