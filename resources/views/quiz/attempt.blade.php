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
                    remainingTime: {{ $remainingTime }},
                    init() {
                        this.updateTimer();
                        setInterval(() => this.updateTimer(), 1000);
                    },
                    updateTimer() {
                        if (this.remainingTime <= 0) {
                            document.getElementById('quizForm').submit();
                            return;
                        }
                        this.remainingTime--;
                    },
                    formatTime() {
                        const minutes = Math.floor(this.remainingTime / 60);
                        const seconds = this.remainingTime % 60;
                        return `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    }
                }" x-init="init()" class="text-center">
                    <span class="text-2xl font-bold text-gray-700" x-text="formatTime()"></span>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Notification Status -->
    <div class="fixed top-4 right-4 z-50" id="saveStatus">
        <div class="hidden transition-all duration-300 px-4 py-2 rounded shadow-lg" id="statusAlert">
            <span id="saveStatusText"></span>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6 min-h-screen">
                <form id="quizForm" action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
                    @csrf                    
                    <div class="space-y-6">
                        @foreach ($questions as $question)
                            <div class="border rounded-lg p-4 mb-4 bg-white" id="question-container-{{ $question->id }}" style="min-height: 100px; visibility: visible !important; display: block !important;">
                                <!-- Debug untuk setiap question -->
                                <div class="text-xs text-gray-500 mb-2">
                                    Debug: Question ID {{ $question->id }} - Options: {{ $question->options->count() }}
                                </div>
                                
                                <div class="mb-3">
                                    <h4 class="font-semibold text-md">
                                        {{ $loop->iteration }}. {{ $question->question_text }}
                                    </h4>
                                    @if ($question->image)
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="mt-2 max-w-md">
                                    @endif
                                </div>

                                <div class="space-y-2">
                                    @foreach ($question->options as $option)
                                        <div class="flex items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                                                id="option_{{ $option->id }}" class="answer-radio" data-question-id="{{ $question->id }}"
                                                onclick="console.log('Radio clicked:', { id: this.id, questionId: this.dataset.questionId, value: this.value })"
                                                {{ isset($userAnswers[$question->id]) && $userAnswers[$question->id] == $option->id ? 'checked' : '' }}>
                                            <label for="option_{{ $option->id }}" class="ml-3 text-sm flex-grow cursor-pointer">
                                                {{ $option->option_text }}
                                                @if ($option->image)
                                                    <img src="{{ asset('storage/' . $option->image) }}" alt="Option Image" class="mt-1 max-w-xs">
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-2 hidden text-sm text-green-600" id="status_{{ $question->id }}">
                                    <svg class="inline-block w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Jawaban tersimpan</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Selesaikan Kuis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const saveStatus = document.getElementById('saveStatus');
                const statusAlert = document.getElementById('statusAlert');
                const saveStatusText = document.getElementById('saveStatusText');

                // Fungsi untuk menampilkan status
                function showStatus(message, type = 'info') {
                    saveStatusText.textContent = message;
                    statusAlert.className = `px-4 py-2 rounded shadow-lg ${
                    type === 'success' ? 'bg-green-100 text-green-700' :
                    type === 'error' ? 'bg-red-100 text-red-700' :
                    'bg-yellow-100 text-yellow-700'
                }`;
                    statusAlert.classList.remove('hidden');

                    setTimeout(() => {
                        statusAlert.classList.add('hidden');
                    }, 3000);
                }

                // Fungsi untuk menyimpan jawaban
                async function saveAnswer(questionId, optionId) {
                    showStatus('Menyimpan jawaban...', 'info');

                    const url = `{{ url('/quiz/attempt/' . $attempt->id . '/answer') }}`;

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.content;
                        if (!token) {
                            throw new Error('CSRF token not found');
                        }

                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                question_id: questionId,
                                option_id: optionId
                            })
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal menyimpan jawaban');
                        }

                        showStatus('✓ Jawaban tersimpan', 'success');
                        const questionStatus = document.getElementById(`status_${questionId}`);
                        if (questionStatus) {
                            questionStatus.classList.remove('hidden');
                        }

                    } catch (error) {
                        showStatus('⚠ Gagal menyimpan jawaban: ' + error.message, 'error');
                    }
                }

                // Event listener untuk radio buttons
                const radioButtons = document.querySelectorAll('.answer-radio');

                radioButtons.forEach(radio => {
                    radio.addEventListener('change', function(event) {
                        console.log('Radio button changed:', {
                            questionId: this.dataset.questionId,
                            optionId: this.value
                        });
                        saveAnswer(this.dataset.questionId, this.value);
                    });
                });

                // Form submission handler
                const quizForm = document.getElementById('quizForm');
                if (quizForm) {
                    quizForm.addEventListener('submit', function(e) {
                        const unansweredQuestions = {{ $questions->count() }} -
                            document.querySelectorAll('input[type="radio"]:checked').length;

                        if (unansweredQuestions > 0) {
                            if (!confirm(`Masih ada ${unansweredQuestions} pertanyaan yang belum dijawab. Yakin ingin menyelesaikan kuis?`)) {
                                e.preventDefault();
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
