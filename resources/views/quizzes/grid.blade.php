@push('styles')
    <style>
        .modal-container {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
        }

        .modal-container:target {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-container:target .modal-content {
            transform: scale(1);
            opacity: 1;
        }

        .modal-content {
            transform: scale(0.95);
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }
    </style>
@endpush

<div id="quiz-grid" class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($quizzes as $item)
        {{-- <a href="#modal-quiz-{{ $item->slug }}" class="group block transform cursor-pointer overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"> --}}
        <a href="{{ route('quizzes.show', $item->slug) }}" class="group block transform cursor-pointer overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
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
        </a>

        <div id="modal-quiz-{{ $item->slug }}" class="modal-container fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div class="modal-content mx-4 w-full max-w-2xl rounded-2xl bg-white">
                <div class="relative">
                    {{-- Tombol Close --}}
                    <a href="#" class="absolute right-4 top-4 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-gray-800/50 text-white transition hover:bg-gray-800">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                    <img class="aspect-video w-full rounded-t-2xl object-cover" src="{{ Storage::url($item->thumbnail) }}" alt="Thumbnail {{ $item->name }}">
                </div>

                <div class="p-6 lg:p-8">
                    <h2 class="mb-2 text-3xl font-bold text-gray-900">{{ $item->name }}</h2>

                    {{-- Detail Kuis --}}
                    <div class="mb-6 flex flex-wrap gap-x-6 gap-y-2 text-gray-600">
                        <span class="flex items-center gap-1.5"><svg class="h-5 w-5 text-sky-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m-1-13h2v6h-2zm0 8h2v2h-2z" />
                            </svg> {{ $item->total_questions }} Soal</span>
                        <span class="flex items-center gap-1.5"><svg class="h-5 w-5 text-sky-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 2a10 10 0 1 0 0 20a10 10 0 0 0 0-20m0 18a8 8 0 1 1 0-16a8 8 0 0 1 0 16m1-13h-2v5l4.25 2.52l.75-1.23l-3.5-2.07z" />
                            </svg> {{ $item->attempt_time }}</span>
                        @if ($item->category)
                            <span class="flex items-center gap-1.5"><svg class="h-5 w-5 text-sky-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M5.5 22q-.625 0-1.062-.437T4 20.5v-17q0-.625.438-1.062T5.5 2h13q.625 0 1.063.438T20 3.5v17q0 .625-.437 1.063T18.5 22zM6 20h12V4H6zm6-7.25L9.5 15L7 12l4-4l5 5z" />
                                </svg> Kategori: {{ ucfirst($item->category) }}</span>
                        @endif
                    </div>

                    <p class="mb-8 leading-relaxed text-gray-700">{{ $item->description }}</p>

                    {{-- Tombol Aksi (CTA) Dinamis --}}
                    <div class="text-center">
                        @auth
                            <a href="{{ route('quiz.start', $item->slug) }}" class="inline-block w-full rounded-lg bg-sky-500 px-6 py-3 text-center font-semibold text-white transition hover:bg-sky-600 sm:w-auto">
                                Kerjakan Kuis Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block w-full rounded-lg bg-sky-500 px-6 py-3 text-center font-semibold text-white transition hover:bg-sky-600 sm:w-auto">
                                Login untuk Mengerjakan Kuis
                            </a>
                        @endauth
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
