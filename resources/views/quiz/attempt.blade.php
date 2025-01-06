<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $attempt->quiz->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Timer -->
                <div class="mb-4 text-right" x-data="timer({{ $remainingTime }})">
                    <div class="text-xl font-bold" x-text="displayTime"></div>
                </div>

                <form id="quizForm" action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        @foreach ($questions as $question)
                            <div class="border rounded-lg p-4">
                                <div class="mb-3">
                                    <h4 class="font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</h4>
                                    @if ($question->image)
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-2 max-w-md">
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="flex items-center">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                id="option_{{ $option->id }}"
                                                {{ isset($userAnswers[$question->id]) && $userAnswers[$question->id] == $option->id ? 'checked' : '' }}
                                                class="answer-radio" data-question-id="{{ $question->id }}">
                                            <label for="option_{{ $option->id }}" class="ml-2">
                                                {{ $option->option_text }}
                                                @if ($option->image)
                                                    <img src="{{ asset('storage/' . $option->image) }}" alt="Option Image" class="mt-1 max-w-xs">
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-between">
                        <div id="saveStatus" class="text-green-600 hidden">
                            Jawaban tersimpan
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Selesaikan Kuis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @push('scripts')
        <script>
            function timer(remainingSeconds) {
                return {
                    remainingSeconds: remainingSeconds,
                    displayTime: '',
                    init() {
                        this.updateTimer();
                        setInterval(() => this.updateTimer(), 1000);
                    },
                    updateTimer() {
                        if (this.remainingSeconds <= 0) {
                            this.displayTime = 'Waktu Habis!';
                            document.getElementById('quizForm').submit();
                            return;
                        }

                        const minutes = Math.floor(this.remainingSeconds / 60);
                        const seconds = this.remainingSeconds % 60;
                        this.displayTime = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                        this.remainingSeconds--;
                    }
                }
            }

            // Auto-save functionality
            document.querySelectorAll('.answer-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    const questionId = this.dataset.questionId;
                    const optionId = this.value;
                    const saveStatus = document.getElementById('saveStatus');

                    fetch(`{{ route('quiz.answer', $attempt->id) }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                question_id: questionId,
                                option_id: optionId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            saveStatus.classList.remove('hidden');
                            setTimeout(() => {
                                saveStatus.classList.add('hidden');
                            }, 2000);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
    @endpush --}}
</x-app-layout>
