@extends('layouts.main')

@section('main-content')
    <!-- Notification Status -->
    <div class="fixed right-4 top-4 z-50" id="saveStatus">
        <div class="hidden rounded-lg border border-gray-200 bg-white px-4 py-3 shadow-xl transition-all duration-300" id="statusAlert">
            <div class="flex items-center">
                <div class="mr-2" id="statusIcon"></div>
                <span id="saveStatusText" class="text-sm font-medium"></span>
            </div>
        </div>
    </div>

    <div class="py-12">
        {{-- Timer --}}
        <div class="sticky top-0 z-50 mb-12 bg-sky-500 px-6 py-2 shadow-lg">
            <p class="text-center text-sm uppercase tracking-wider text-gray-50">Sisa waktu</p>
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
                <span class="text-2xl font-bold tracking-wider text-white" x-text="formatTime()"></span>
            </div>
        </div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <!-- Header -->
                <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-8">
                    <h1 class="text-left text-2xl font-bold text-gray-900">{{ $attempt->quiz->name }}</h1>
                    <p class="mt-2 text-left text-sm text-gray-600">Kerjakan dengan teliti dan sesuai kemampuan Anda</p>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <form id="quizForm" action="{{ route('quiz.submit', $attempt->id) }}" method="POST">
                        @csrf

                        <!-- Questions Section -->
                        <div class="space-y-6">
                            {{-- <div class="border-b pb-6">
                                <h2 class="text-center text-xl font-bold text-gray-800">Soal Kuis</h2>
                            </div> --}}

                            @foreach ($questions as $question)
                                <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6" id="question-container-{{ $question->id }}">
                                    <!-- Question Header -->
                                    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                                        <div class="flex-1">
                                            <div class="flex gap-3">
                                                <span class="mb-3 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-700">
                                                    {{ $loop->iteration }}
                                                </span>
                                                <div class="{{ isset($userAnswers[$question->id]) ? '' : 'hidden' }} text-sm text-green-600" id="status_{{ $question->id }}">
                                                    <span class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-700">
                                                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        Jawaban Tersimpan
                                                    </span>
                                                </div>
                                            </div>
                                            <hr class="border-1 mb-3 w-full border-dashed border-gray-200">
                                            <div class="flex items-start gap-3">
                                                <div class="min-w-0 flex-1">
                                                    <div class="prose-md prose max-w-none text-gray-800">
                                                        {!! Str::markdown($question->question_text) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($question->image)
                                        <div class="mb-4">
                                            <img src="{{ asset('storage/' . $question->image) }}" alt="Question Image" class="max-w-md rounded-lg shadow-sm">
                                        </div>
                                    @endif

                                    <!-- Options -->
                                    <div class="mt-6 space-y-3">
                                        @foreach ($question->options as $option)
                                            @php
                                                $isSelected = isset($userAnswers[$question->id]) && $userAnswers[$question->id] == $option->id;
                                            @endphp

                                            <div class="option-container {{ $isSelected ? 'bg-sky-50 border-sky-200' : 'border-gray-200 bg-gray-50' }} rounded-lg border p-3 transition-colors hover:bg-gray-100" data-question-id="{{ $question->id }}">
                                                <div class="flex items-center">
                                                    <!-- Option indicator -->
                                                    <div class="mr-3 flex-shrink-0">
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" id="option_{{ $option->id }}" class="answer-radio h-4 w-4 text-sky-600 focus:ring-sky-500" data-question-id="{{ $question->id }}"
                                                            {{ $isSelected ? 'checked' : '' }}>
                                                    </div>

                                                    <!-- Option content -->
                                                    <div class="min-w-0 flex-1">
                                                        <label for="option_{{ $option->id }}" class="cursor-pointer">
                                                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:gap-2">
                                                                <span class="break-words text-gray-700">
                                                                    {{ $option->option_text }}
                                                                </span>
                                                            </div>

                                                            @if ($option->image)
                                                                <img src="{{ asset('storage/' . $option->image) }}" alt="Option Image" class="mt-2 max-w-xs rounded shadow-sm">
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col gap-4 border-t pt-6 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-sky-500 px-6 py-3 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Selesaikan Kuis
                                </button>
                            </div>

                            <div class="text-center text-sm text-gray-500 sm:text-right">
                                <p>Pastikan semua jawaban telah dipilih sebelum menyelesaikan kuis</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const saveStatus = document.getElementById('saveStatus');
            const statusAlert = document.getElementById('statusAlert');
            const saveStatusText = document.getElementById('saveStatusText');
            const statusIcon = document.getElementById('statusIcon');

            // Fungsi untuk menampilkan status
            function showStatus(message, type = 'info') {
                saveStatusText.textContent = message;

                // Set icon based on type
                if (type === 'success') {
                    statusIcon.innerHTML =
                        '<svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
                    saveStatusText.className = 'text-sm font-medium text-emerald-700';
                } else if (type === 'error') {
                    statusIcon.innerHTML =
                        '<svg class="h-5 w-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';
                    saveStatusText.className = 'text-sm font-medium text-rose-700';
                } else {
                    statusIcon.innerHTML =
                        '<svg class="h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';
                    saveStatusText.className = 'text-sm font-medium text-amber-700';
                }

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

                    showStatus('Jawaban tersimpan', 'success');
                    const questionStatus = document.getElementById(`status_${questionId}`);
                    if (questionStatus) {
                        questionStatus.classList.remove('hidden');
                    }

                } catch (error) {
                    showStatus('Gagal menyimpan jawaban: ' + error.message, 'error');
                }
            }

            // Fungsi untuk mengupdate styling option
            function updateOptionStyling(questionId, selectedOptionId) {
                // Reset all options for this question
                const questionContainer = document.getElementById(`question-container-${questionId}`);
                const optionContainers = questionContainer.querySelectorAll('.option-container');

                optionContainers.forEach(container => {
                    if (container.dataset.questionId == questionId) {
                        // Reset to unselected state
                        container.classList.remove('bg-sky-50', 'border-sky-200');
                        container.classList.add('border-gray-200', 'bg-gray-50');
                    }
                });

                // Apply selected style to the chosen option
                const selectedOption = document.getElementById(`option_${selectedOptionId}`);
                if (selectedOption) {
                    const selectedContainer = selectedOption.closest('.option-container');
                    if (selectedContainer) {
                        selectedContainer.classList.remove('border-gray-200', 'bg-gray-50');
                        selectedContainer.classList.add('bg-sky-50', 'border-sky-200');
                    }
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

                    // Update styling immediately
                    updateOptionStyling(this.dataset.questionId, this.value);

                    // Save answer to server
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
