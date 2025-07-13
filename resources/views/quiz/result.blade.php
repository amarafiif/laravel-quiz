<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <!-- Header -->
                <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-6 py-8">
                    <h1 class="text-center text-3xl font-bold text-gray-900">Hasil Kuis</h1>
                </div>

                <!-- Meta Data and Score Section -->
                <div class="p-6">
                    <div class="mb-8 w-full">
                        <!-- Left Side - Meta Data -->
                        <div class="space-y-9">
                            <div class="rounded-xl bg-gray-50 p-6">
                                <h2 class="mb-5 flex items-center border-b-2 border-dashed border-gray-200 pb-5 text-lg font-semibold text-gray-800">
                                    <svg class="mr-2 h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Informasi Kuis
                                </h2>

                                <div class="flex w-full flex-col items-center justify-between gap-6 sm:flex-row">
                                    <div id="info" class="w-full md:w-1/2">
                                        <!-- Quiz Name -->
                                        <div class="mb-4">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Nama Kuis</dt>
                                            <dd class="text-lg font-semibold text-gray-900">{{ $attempt->quiz->name }} [{{ $questions->count() }} Soal]</dd>
                                        </div>

                                        <!-- User Name -->
                                        <div class="mb-4">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Dikerjakan oleh</dt>
                                            <dd class="text-lg font-semibold text-gray-900">{{ $attempt->user->name }}</dd>
                                        </div>

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

                                        <!-- Duration -->
                                        <div class="mb-4">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Durasi Pengerjaan</dt>
                                            <dd class="flex items-center text-lg font-semibold text-gray-900">

                                                {{ $durationText }}
                                            </dd>
                                        </div>

                                        <!-- Start Time -->
                                        <div class="mb-4">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Waktu Mulai</dt>
                                            <dd class="flex items-center text-lg font-semibold text-gray-900">

                                                {{ $attempt->started_at ? $attempt->started_at->format('d M Y, H:i') : 'N/A' }}
                                            </dd>
                                        </div>

                                        <!-- End Time -->
                                        <div class="mb-4">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Waktu Selesai</dt>
                                            <dd class="flex items-center text-lg font-semibold text-gray-900">

                                                {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y, H:i') : 'N/A' }}
                                            </dd>
                                        </div>

                                        <div class="">
                                            <dt class="mb-1 text-sm font-medium text-gray-500">Bagikan</dt>
                                            <div class="flex items-center space-x-3">
                                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('quiz.result', $attempt->uuid)) }}" target="_blank" class="pointer-events-none text-blue-600 hover:text-blue-800">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                            d="M12 3.8a8.25 8.25 0 0 0-2.096 16.232v-4.607H8.762a1.2 1.2 0 0 1-1.199-1.199v-1.701a1.2 1.2 0 0 1 1.199-1.199h1.114c-.013-.347-.039-.696-.039-1.043c0-.889.15-2.658 1.553-3.662c.435-.31.844-.516 1.294-.637c.441-.117.883-.143 1.355-.143c.834 0 1.411.083 1.778.136l.165.023a.93.93 0 0 1 .806.92v1.883a.93.93 0 0 1-.97.93c-.153.006-.675.026-1.126.026c-.31 0-.402.071-.434.106c-.045.048-.162.224-.162.764v.697h1.273a1.2 1.2 0 0 1 1.184 1.39l-.259 1.707a1.2 1.2 0 0 1-1.182 1.002h-1.016v4.607A8.25 8.25 0 0 0 12 3.8m-9.75 8.25C2.25 6.665 6.615 2.3 12 2.3s9.75 4.365 9.75 9.75c0 4.89-3.599 8.938-8.293 9.642a.75.75 0 0 1-.86-.742v-6.275a.75.75 0 0 1 .75-.75h1.506l.166-1.099h-1.673a.75.75 0 0 1-.75-.75V10.63c0-.705.145-1.339.567-1.79c.435-.464 1.017-.58 1.53-.58c.196 0 .409-.004.595-.01v-.83a10 10 0 0 0-1.249-.078c-.427 0-.715.025-.967.093c-.243.064-.49.179-.809.407c-.747.535-.924 1.58-.926 2.428l.066 1.78a.75.75 0 0 1-.75.777h-1.59v1.099h1.59a.75.75 0 0 1 .75.75v6.275a.75.75 0 0 1-.86.742C5.849 20.988 2.25 16.94 2.25 12.05"
                                                            clip-rule="evenodd" />
                                                        <path fill="currentColor"
                                                            d="M3.75 12.05a8.25 8.25 0 1 1 10.346 7.982v-4.607h1.016c.586 0 1.086-.424 1.182-1.002l.259-1.708a1.2 1.2 0 0 0-1.184-1.389h-1.273v-.697c0-.54.117-.716.162-.764c.033-.035.124-.106.434-.106c.451 0 .973-.02 1.127-.027a.93.93 0 0 0 .97-.928V6.92A.93.93 0 0 0 16 6.003V6l-.01.001L15.983 6l-.165-.023a11.6 11.6 0 0 0-1.778-.136c-.472 0-.914.026-1.355.143c-.45.12-.86.326-1.294.637c-1.404 1.004-1.553 2.773-1.553 3.662c0 .233.012.467.023.7l.016.343H8.762a1.2 1.2 0 0 0-1.199 1.199v1.701a1.2 1.2 0 0 0 1.199 1.199h1.142v4.607A8.254 8.254 0 0 1 3.75 12.05"
                                                            opacity="0.5" />
                                                    </svg>
                                                </a>
                                                <a href="https://api.whatsapp.com/send?text=Heyy! 👋😎 Aku abis ngerjain kuis seru nih buat tes seberapa pinter otakku! 🧠✨ Penasaran sama hasilnya? 🤔 Yuk cek di sini: {{ urlencode(route('quiz.result', $attempt->uuid)) }} 📊🎯 Kalian juga cobain dong, siapa tau bisa ngalahin skorku! 😏🔥"
                                                    target="_blank" class="text-green-500 hover:text-green-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                                            <path
                                                                d="M12 4.428a7.572 7.572 0 0 0-6.183 11.944a.75.75 0 0 1 .077.731L4.82 19.586l3.147-.913a.75.75 0 0 1 .554.054A7.572 7.572 0 1 0 12 4.428M2.928 12a9.072 9.072 0 1 1 5.176 8.195L3.71 21.47a.75.75 0 0 1-.897-1.018l1.542-3.568A9.03 9.03 0 0 1 2.928 12" />
                                                            <path
                                                                d="M4.428 12a7.572 7.572 0 1 1 4.093 6.727a.75.75 0 0 0-.554-.054l-3.147.913l1.074-2.483a.75.75 0 0 0-.077-.731A7.53 7.53 0 0 1 4.428 12m8.944 2.753c-.372.22-1.187.287-2.736-1.262s-1.482-2.363-1.262-2.736c.56-.057 1.097-.432 1.595-.93c.369-.369.07-1.264-.666-2c-.737-.737-1.632-1.035-2-.667c-2.372 2.371-1.184 5.482 1 7.667c2.214 2.214 5.238 3.428 7.666 1c.369-.369.07-1.264-.666-2c-.737-.737-1.632-1.035-2-.667c-.499.498-.874 1.035-.93 1.595"
                                                                opacity="0.5" />
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right Side - Score Information -->
                                    <div id="score" class="w-full space-y-6 md:w-1/2">
                                        <div class="rounded-xl border-2 border-slate-300 bg-gradient-to-br from-slate-50 to-slate-100 p-6 text-center">
                                            <!-- Score Circle -->
                                            <div class="{{ $attempt->score >= 70 ? 'bg-emerald-200 text-emerald-500 border-emerald-300' : 'bg-rose-200 text-rose-500 border-rose-300' }} mx-auto mb-6 flex h-28 w-28 items-center justify-center rounded-full border-4 shadow-lg">
                                                <span class="text-3xl font-bold">{{ number_format($attempt->score) }}%</span>
                                            </div>

                                            <!-- Score Predicate -->
                                            <div class="mb-6">
                                                <h3 class="mb-2 text-2xl font-bold text-gray-800">
                                                    @if ($attempt->score >= 90)
                                                        Luar Biasa! 🎉
                                                    @elseif ($attempt->score >= 80)
                                                        Sangat Baik! ⭐
                                                    @elseif ($attempt->score >= 70)
                                                        Baik! 👍
                                                    @elseif ($attempt->score >= 60)
                                                        Cukup 📚
                                                    @else
                                                        Tetap Semangat! 💪
                                                    @endif
                                                </h3>
                                                <p class="text-gray-600">
                                                    @if ($attempt->score >= 90)
                                                        Pencapaian yang menakjubkan!
                                                    @elseif ($attempt->score >= 80)
                                                        Hasil yang sangat memuaskan!
                                                    @elseif ($attempt->score >= 70)
                                                        Anda telah lulus dengan baik!
                                                    @elseif ($attempt->score >= 60)
                                                        Masih perlu sedikit perbaikan
                                                    @else
                                                        Jangan menyerah, terus belajar!
                                                    @endif
                                                </p>
                                            </div>

                                            <!-- Statistics -->
                                            <div class="grid grid-cols-3 gap-0">
                                                <!-- Empty Answers -->
                                                <div class="rounded-lg p-4">
                                                    <div class="mb-2 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-2xl font-bold text-slate-600">{{ $questions->count() - $userAnswers->count() }}</div>
                                                    <div class="text-sm text-gray-600">Kosong</div>
                                                </div>

                                                <!-- Correct Answers -->
                                                <div class="border-x border-slate-200 p-4">
                                                    <div class="mb-2 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-2xl font-bold text-slate-600">{{ $userAnswers->where('is_correct', true)->count() }}</div>
                                                    <div class="text-sm text-gray-600">Benar</div>
                                                </div>

                                                <!-- Wrong Answers -->
                                                <div class="rounded-lg p-4">
                                                    <div class="mb-2 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-2xl font-bold text-slate-600">{{ $questions->count() - $userAnswers->where('is_correct', true)->count() }}</div>
                                                    <div class="text-sm text-gray-600">Salah</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Questions Review -->
                    <div class="space-y-6">
                        <div class="border-t pt-6">
                            <h2 class="mb-6 text-center text-xl font-bold text-gray-800">Review Jawaban</h2>
                        </div>

                        @foreach ($questions as $index => $question)
                            @php
                                $userAnswer = $userAnswers->get($question->id);
                                $isCorrect = $userAnswer ? $userAnswer->is_correct : false;
                                $isAnswered = $userAnswer !== null; // Tambahkan pengecekan apakah sudah dijawab
                                $correctOption = $question->options->where('is_correct', true)->first();
                                $selectedOption = $userAnswer ? $question->options->find($userAnswer->selected_option_id) : null;
                            @endphp

                            <div class="{{ !$isAnswered ? 'ring-1 ring-amber-100 bg-amber-50' : ($isCorrect ? 'ring-1 ring-emerald-100' : 'ring-1 ring-rose-100') }} rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                                <!-- Question Header -->
                                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                                    <h4 class="text-lg font-semibold leading-relaxed text-gray-800">
                                        {{ $index + 1 }}. {{ $question->question_text }}
                                    </h4>
                                    <div class="flex-shrink-0">
                                        @if (!$isAnswered)
                                            <span class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-3 py-1 text-sm font-medium text-amber-700">
                                                <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Tidak Dijawab
                                            </span>
                                        @elseif ($isCorrect)
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

                                        <div class="{{ $isSelected ? ($isCorrectOption ? 'border-emerald-200 bg-emerald-50' : 'border-rose-200 bg-rose-50') : ($isCorrectOption ? 'border-emerald-200 bg-emerald-50' : 'border-gray-200 bg-gray-50') }} rounded-lg border p-3 transition-colors">
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
                                                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-rose-500 text-white">
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
                                                        @elseif ($isCorrectOption && !$isAnswered)
                                                            <span class="text-xs font-medium text-emerald-600">(Jawaban Benar)</span>
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

                                <!-- Tidak dijawab notice -->
                                @if (!$isAnswered)
                                    <div class="mb-4 rounded-lg border border-amber-200 bg-amber-50 p-4">
                                        <div class="flex items-center">
                                            <svg class="mr-2 h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="font-medium text-amber-700">Soal ini tidak dijawab</span>
                                        </div>
                                    </div>
                                @endif

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

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col gap-4 border-t pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                            @if ($attempt->quiz->is_allowed_repeat)
                                <a href="{{ route('quiz.start', $attempt->quiz_id) }}"
                                    class="inline-flex items-center justify-center rounded-lg bg-sky-500 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Coba Lagi
                                </a>
                            @endif
                            <a href="{{ route('courses.index') }}"
                                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
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
    </div>
</x-app-layout>
