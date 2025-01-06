<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <div class="flex-shrink">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $attempt->quiz->name }}
                </h2>
            </div>

            <div class="flex-shrink bg-white shadow rounded-lg py-2 px-6">
                <p class="text-sm text-slate-500 text-center">Sisa waktu</p>
                <div x-data="{
                    time: {{ $remainingTime }},
                    init() {
                        setInterval(() => {
                            if (this.time > 0) {
                                this.time--;
                            } else {
                                document.getElementById('quizForm').submit();
                            }
                        }, 1000);
                    },
                    formatTime() {
                        const minutes = Math.floor(this.time / 60);
                        const seconds = this.time % 60;
                        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    }
                }" x-init="init()" class="text-center">
                    <span class="text-2xl font-bold text-gray-700" x-text="formatTime()"></span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form id="quizForm" action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        @foreach ($questions as $question)
                            <div class="border rounded-lg p-4">
                                <div class="mb-3">
                                    <h4 class="font-semibold text-md">{{ $loop->iteration }}. {{ $question->question_text }}</h4>
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
                                            <label for="option_{{ $option->id }}" class="ml-3 text-sm">
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

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                window.timer = (remainingSeconds) => ({
                    remainingSeconds: remainingSeconds,
                    displayTime: '',
                    intervalId: null,
                    init() {
                        this.updateTimer();
                        this.intervalId = setInterval(() => this.updateTimer(), 1000);
                    },
                    updateTimer() {
                        if (this.remainingSeconds <= 0) {
                            this.displayTime = 'Waktu Habis!';
                            clearInterval(this.intervalId);
                            document.getElementById('quizForm').submit();
                            return;
                        }

                        const hours = Math.floor(this.remainingSeconds / 3600);
                        const minutes = Math.floor((this.remainingSeconds % 3600) / 60);
                        const seconds = this.remainingSeconds % 60;

                        if (hours > 0) {
                            this.displayTime = `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        } else {
                            this.displayTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                        }
                        this.remainingSeconds--;
                    }
                });
            });

            // Your existing auto-save functionality
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
    @endpush
</x-app-layout>
