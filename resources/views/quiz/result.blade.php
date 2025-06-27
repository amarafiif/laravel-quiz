<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full items-center justify-between">
            <div class="flex-shrink">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Hasil Kuis: {{ $attempt->quiz->name }}
                </h2>
            </div>
            <div class="flex-shrink text-sm text-gray-600">
                <p>Waktu Mulai: {{ $attempt->started_at ? $attempt->started_at->format('d M Y H:i') : 'N/A' }}</p>
                <p>Waktu Selesai: {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y H:i') : 'N/A' }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-xl sm:rounded-lg">
                <div class="mb-6">
                    <div class="mb-8 text-center">
                        <h3 class="mb-4 text-2xl font-bold">Skor Anda: {{ number_format($attempt->score) }}%</h3>
                    </div>

                    <div class="space-y-6">
                        @foreach ($questions as $index => $question)
                            @php
                                $userAnswer = $userAnswers->get($question->id);
                                $isCorrect = $userAnswer ? $userAnswer->is_correct : false;
                            @endphp
                            <div class="{{ $isCorrect ? 'bg-green-50' : 'bg-red-50' }} rounded-lg border p-4">
                                <div class="mb-3">
                                    <h4 class="font-semibold">
                                        {{ $index + 1 }}. {{ $question->question_text }}
                                    </h4>
                                    @if ($question->image)
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-2 max-w-md">
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="{{ $userAnswer && $userAnswer->selected_option_id === $option->id ? ($option->is_correct ? 'bg-green-100' : 'bg-red-100') : '' }} {{ $option->is_correct ? 'text-green-600 font-semibold' : '' }} flex items-center rounded p-2">
                                            @if ($userAnswer && $userAnswer->selected_option_id === $option->id)
                                                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                                    </path>
                                                </svg>
                                            @endif
                                            {{ $option->option_text }}
                                            @if ($option->image)
                                                <img src="{{ asset('storage/' . $option->image) }}" alt="Option Image" class="ml-2 max-w-xs">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                @if ($userAnswer && !$isCorrect)
                                    <div class="mt-2 text-green-600">
                                        <p class="font-semibold">Jawaban yang benar:</p>
                                        <p>{{ $question->options->where('is_correct', true)->first()->option_text }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    @if ($attempt->quiz->is_allowed_repeat)
                        <a href="{{ route('quiz.start', $attempt->quiz_id) }}" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">
                            Coba Lagi
                        </a>
                    @endif
                    <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-gray-900">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
