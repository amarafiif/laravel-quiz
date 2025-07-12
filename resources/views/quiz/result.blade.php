<x-app-layout>
    <x-slot name="header">
        <div class="">
            <div class="flex w-full flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <div class="mb-2 flex items-center gap-3">
                        <div class="{{ $attempt->score >= 70 ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }} flex h-10 w-10 items-center justify-center rounded-full">
                            @if ($attempt->score >= 70)
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @else
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-2-9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Hasil Kuis
                            </h2>
                            <p class="text-lg font-medium text-gray-600">{{ $attempt->quiz->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:gap-6">
                    <!-- Duration Card -->
                    @php
                        $duration = null;
                        $durationText = 'N/A';

                        if ($attempt->started_at && $attempt->submitted_at) {
                            $duration = $attempt->started_at->diff($attempt->submitted_at);

                            if ($duration->h > 0) {
                                $durationText = $duration->h . ' jam ' . $duration->i . ' menit';
                            } elseif ($duration->i > 0) {
                                $durationText = $duration->i . ' menit ' . $duration->s . ' detik';
                            } else {
                                $durationText = $duration->s . ' detik';
                            }
                        }
                    @endphp

                    <div class="p-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Durasi</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $durationText }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Start Time Card -->
                    <div class="p-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Dimulai</p>
                                <div class="flex items-center space-x-1">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $attempt->started_at ? $attempt->started_at->format('H:i') : 'N/A' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $attempt->started_at ? $attempt->started_at->format('d M Y') : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End Time Card -->
                    <div class="p-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">Selesai</p>
                                <div class="flex items-center space-x-1">
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $attempt->submitted_at ? $attempt->submitted_at->format('H:i') : 'N/A' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y') : '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
                <div class="mb-6">
                    <!-- Score Section -->
                    <div class="mb-8 text-center">
                        <div class="{{ $attempt->score >= 70 ? 'bg-emerald-50 text-emerald-600 border-2 border-emerald-100' : 'bg-rose-50 text-rose-600 border-2 border-rose-100' }} mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full">
                            <span class="text-2xl font-bold">{{ number_format($attempt->score) }}%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            @if ($attempt->score >= 90)
                                Luar Biasa! 🎉
                            @elseif ($attempt->score >= 70)
                                Bagus! 👍
                            @else
                                Tetap Semangat! 💪
                            @endif
                        </h3>
                        <p class="mt-2 text-gray-600">
                            Anda menjawab {{ $userAnswers->where('is_correct', true)->count() }} dari {{ $questions->count() }} soal dengan benar
                        </p>
                    </div>

                    <!-- Questions Review -->
                    <div class="space-y-6">
                        @foreach ($questions as $index => $question)
                            @php
                                $userAnswer = $userAnswers->get($question->id);
                                $isCorrect = $userAnswer ? $userAnswer->is_correct : false;
                                $correctOption = $question->options->where('is_correct', true)->first();
                                $selectedOption = $userAnswer ? $question->options->find($userAnswer->selected_option_id) : null;
                            @endphp

                            <div class="{{ $isCorrect ? 'ring-1 ring-emerald-100' : 'ring-1 ring-rose-100' }} rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                                <!-- Question Header -->
                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                                    <h4 class="text-lg font-semibold leading-relaxed text-gray-800">
                                        {{ $index + 1 }}. {{ $question->question_text }}
                                    </h4>
                                    <div class="flex-shrink-0">
                                        @if ($isCorrect)
                                            <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                                                <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                                Benar
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-sm font-medium text-rose-700">
                                                <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd">
                                                    </path>
                                                </svg>
                                                Salah
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if ($question->image)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="max-w-md rounded-lg shadow-sm">
                                    </div>
                                @endif

                                <!-- Options -->
                                <div class="mb-4 space-y-3">
                                    @foreach ($question->options as $option)
                                        @php
                                            $isSelected = $selectedOption && $selectedOption->id === $option->id;
                                            $isCorrectOption = $option->is_correct;
                                        @endphp

                                        <div class="{{ $isSelected ? ($isCorrectOption ? 'border-emerald-200 bg-emerald-25' : 'border-rose-200 bg-rose-25') : ($isCorrectOption ? 'border-emerald-200 bg-emerald-25' : 'border-gray-200 bg-gray-25') }} rounded-lg border p-3 transition-colors">
                                            <div class="flex items-center">
                                                <!-- Option indicator -->
                                                <div class="mr-3 flex-shrink-0">
                                                    @if ($isSelected)
                                                        @if ($isCorrectOption)
                                                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-white">
                                                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-rose-400 text-white">
                                                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    @elseif ($isCorrectOption)
                                                        <div class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-500 text-white">
                                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </div>
                                                    @else
                                                        <div class="h-6 w-6 rounded-full border-2 border-gray-300"></div>
                                                    @endif
                                                </div>

                                                <!-- Option content -->
                                                <div class="min-w-0 flex-1">
                                                    <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:gap-2">
                                                        <span class="{{ $isCorrectOption ? 'font-medium text-emerald-700' : 'text-gray-700' }} break-words">
                                                            {{ $option->option_text }}
                                                        </span>
                                                        @if ($isSelected)
                                                            <span class="{{ $isCorrectOption ? 'text-emerald-600' : 'text-rose-600' }} text-xs font-medium">
                                                                (Pilihan Anda)
                                                            </span>
                                                        @elseif ($isCorrectOption && !$isCorrect)
                                                            <span class="text-xs font-medium text-emerald-600">(Jawaban Benar)</span>
                                                        @endif
                                                    </div>

                                                    @if ($option->image)
                                                        <img src="{{ asset('storage/' . $option->image) }}" alt="Option Image" class="mt-2 max-w-xs rounded shadow-sm">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Explanation Section -->
                                @if ($correctOption)
                                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                                        <h5 class="mb-2 flex items-center font-medium text-slate-700">
                                            <svg class="mr-2 h-5 w-5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            Penjelasan
                                        </h5>
                                        <p class="leading-relaxed text-slate-600">
                                            {{ $correctOption->explanation ?? 'Tidak ada penjelasan tersedia untuk soal ini.' }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col gap-4 border-t pt-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                        @if ($attempt->quiz->is_allowed_repeat)
                            <a href="{{ route('quiz.start', $attempt->quiz_id) }}"
                                class="inline-flex items-center justify-center rounded-lg bg-sky-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Coba Lagi
                            </a>
                        @endif
                        <a href="{{ route('courses.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Kursus
                        </a>
                    </div>

                    <div class="text-center text-sm text-gray-500 sm:text-right">
                        Selesai pada {{ $attempt->submitted_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
