@extends('layouts.main')

@section('main-content')
    <!-- Hero Section -->
    <section id="home" class="px-4 pb-16 pt-48 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="text-center">
                <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-6xl" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 200)">
                    Platform Quiz Online
                    <span class="text-sky-500">Terbaik</span>
                </h1>
                <p class="mx-auto mb-8 max-w-3xl text-lg text-gray-600 md:text-xl" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 400)">
                    Uji pengetahuanmu dengan mencoba berbagai kategori kuis yang tersedia. Kami merancang pengalaman belajar yang menyenangkan dan simpel.
                </p>
                <p class="mx-auto mb-10 w-fit rounded-full border-2 border-orange-300 bg-orange-100 px-4 py-1 text-center text-sm font-semibold italic text-orange-600" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 600)">Belajar itu simpel, cobain deh.</p>

                <div class="mb-20 flex flex-row items-center justify-center gap-2 lg:gap-4" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 600)">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-md transform rounded-lg bg-sky-500 px-8 py-4 font-semibold text-white transition-all hover:scale-105 hover:bg-sky-600 hover:shadow-xl md:text-lg">
                            Mulai Quiz
                        </a>
                        <a href="#features" class="text-md border-1 rounded-lg border-sky-500 bg-white px-8 py-4 font-semibold text-sky-500 transition-all hover:bg-sky-500 hover:text-white md:text-lg">
                            Selengkapnya
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="rounded-lg bg-sky-500 px-12 py-4 text-lg font-semibold text-white hover:bg-sky-600 hover:shadow-xl">
                            {{ __('Register') }}
                        </a>
                        <a href="{{ route('login') }}" class="rounded-lg bg-white px-12 py-4 text-lg font-semibold text-sky-500 transition-all hover:bg-gray-100">
                            {{ __('Login') }}
                        </a>
                    @endauth
                </div>

                <!-- Stats Counter -->
                <div class="mx-auto grid max-w-4xl grid-cols-1 gap-4 md:grid-cols-2" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 800)">
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center">
                        <div class="mb-2 text-3xl font-bold text-sky-500" x-data="{ count: 0 }" x-init="setInterval(() => { if (count < 100) count++ }, 30)">
                            <span x-text="count"></span>+
                        </div>
                        <p class="text-gray-600">Quiz Tersedia</p>
                    </div>
                    {{-- <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center">
                        <div class="mb-2 text-3xl font-bold text-sky-500" x-data="{ count: 0 }" x-init="setInterval(() => { if (count < 50) count++ }, 50)">
                            <span x-text="count"></span>+
                        </div>
                        <p class="text-gray-600">Kursus Premium</p>
                    </div> --}}
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center">
                        <div class="mb-2 text-3xl font-bold text-sky-500" x-data="{ count: 0 }" x-init="setInterval(() => { if (count < 1000) count += 10 }, 20)">
                            <span x-text="count"></span>+
                        </div>
                        <p class="text-gray-600">Peserta Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Fitur Unggulan</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">Nikmati pengalaman belajar yang tak terlupakan dengan fitur-fitur canggih kami</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-8 w-8 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.382 5.968A8.96 8.96 0 0 1 12 4c2.125 0 4.078.736 5.618 1.968l1.453-1.453l1.414 1.414l-1.453 1.453A9 9 0 1 1 3 13c0-2.125.736-4.078 1.968-5.618L3.515 5.93l1.414-1.414zM13 12V7.495L8 14h3v4.5l5-6.5zM8 1h8v2H8z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Quiz Interaktif</h3>
                    <p class="text-gray-600">Sistem quiz dengan timer, auto-save jawaban, dan penjelasan dari setiap soal untuk pengalaman belajar yang optimal.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-6 w-6 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M45.956 39.864c.266-3.271.544-8.463.544-15.864s-.278-12.593-.544-15.864c-.267-3.288-2.804-5.825-6.092-6.092C36.593 1.778 31.402 1.5 24 1.5c-7.401 0-12.593.278-15.864.544c-3.288.267-5.825 2.804-6.092 6.092C1.778 11.407 1.5 16.599 1.5 24s.278 12.593.544 15.864c.267 3.288 2.804 5.825 6.092 6.092c3.271.266 8.463.544 15.864.544s12.593-.278 15.864-.544c3.288-.267 5.825-2.804 6.092-6.092m-19.27-3.688a3.72 3.72 0 0 0 4.973-.524c3.776-4.244 6.199-8.03 7.411-10.118c.635-1.093.804-2.448-.143-3.285a6 6 0 0 0-.824-.611c-1.224-.754-2.593-.003-3.51 1.104c-1.503 1.816-3.897 4.667-5.618 6.52a.95.95 0 0 1-1.274.116c-1.53-1.151-3.436-2.79-4.958-4.138c-1.522-1.349-3.815-1.4-5.274.017c-2.498 2.428-5.075 5.273-7.225 7.79c-1.367 1.6-1.53 3.94.047 5.335a13 13 0 0 0 1.324 1.021c1.857 1.24 4.17.264 5.344-1.636c1.007-1.63 2.258-3.585 3.385-5.137a.98.98 0 0 1 1.401-.185a179 179 0 0 0 4.941 3.73M9 11a2 2 0 0 1 2-2h10a2 2 0 1 1 0 4H11a2 2 0 0 1-2-2m2 6a2 2 0 1 0 0 4h6a2 2 0 1 0 0-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Analisis Hasil</h3>
                    <p class="text-gray-600">Laporan hasil detail dengan statistik lengkap, riwayat quiz, dan rekomendasi pembelajaran.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-8 w-8 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <circle cx="12" cy="6" r="4" fill="currentColor" />
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M16.5 22c-1.65 0-2.475 0-2.987-.513C13 20.975 13 20.15 13 18.5s0-2.475.513-2.987C14.025 15 14.85 15 16.5 15s2.475 0 2.987.513C20 16.025 20 16.85 20 18.5s0 2.475-.513 2.987C18.975 22 18.15 22 16.5 22m.583-5.056a.583.583 0 1 0-1.166 0v.973h-.973a.583.583 0 1 0 0 1.166h.973v.973a.583.583 0 1 0 1.166 0v-.973h.973a.583.583 0 1 0 0-1.166h-.973z"
                                clip-rule="evenodd" />
                            <path fill="currentColor"
                                d="M15.678 13.503c-.473.005-.914.023-1.298.074c-.643.087-1.347.293-1.928.875c-.582.581-.788 1.285-.874 1.928c-.078.578-.078 1.284-.078 2.034v.172c0 .75 0 1.456.078 2.034c.06.451.18.932.447 1.38H12c-8 0-8-2.015-8-4.5S7.582 13 12 13c1.326 0 2.577.181 3.678.503" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Multi User</h3>
                    <p class="text-gray-600">Dashboard admin untuk mengelola kursus, quiz, dan user dengan panel Filament yang modern.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-8 w-8 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                            <path fill="currentColor"
                                d="M42 0a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h3v5.295C23.364 15.785 6.5 34.209 6.5 56.5C6.5 80.483 26.017 100 50 100s43.5-19.517 43.5-43.5a43.2 43.2 0 0 0-6.72-23.182l4.238-3.431l1.888 2.332a2 2 0 0 0 2.813.297l3.11-2.518a2 2 0 0 0 .294-2.812L89.055 14.75a2 2 0 0 0-2.813-.297l-3.11 2.518a2 2 0 0 0-.294 2.812l1.889 2.332l-4.22 3.414C73.77 18.891 64.883 14.435 55 13.297V8h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm8 20c20.2 0 36.5 16.3 36.5 36.5S70.2 93 50 93S13.5 76.7 13.5 56.5S29.8 20 50 20m.002 7.443L50 56.5l23.234 17.447a29.06 29.06 0 0 0 2.758-30.433a29.06 29.06 0 0 0-25.99-16.07"
                                color="currentColor" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Timer & Deadline</h3>
                    <p class="text-gray-600">Sistem timer otomatis dengan pengaturan deadline yang fleksibel untuk setiap quiz.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-8 w-8 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7.475 20q-1.852 0-3.163-1.311T3 15.525q0-1.823 1.274-3.126t3.097-1.343q.192 0 .385.029q.192.029.384.067L5.438 5.7q-.212-.404.018-.783q.23-.378.69-.378H8.62q.46 0 .845.242q.386.242.603.646L12 9.307l1.93-3.88q.218-.404.604-.646q.385-.242.845-.242h2.458q.46 0 .699.378q.239.38.028.783l-2.68 5.383q.174-.039.357-.058q.182-.02.375-.02q1.836.047 3.11 1.35T21 15.5q0 1.877-1.311 3.189T16.5 20q-.283 0-.578-.032q-.295-.031-.558-.12q1.182-.515 1.659-1.751T17.5 15.5q0-2.302-1.599-3.901T12 10t-3.901 1.599T6.5 15.5q0 1.373.44 2.642q.44 1.27 1.69 1.706q-.282.089-.567.12T7.475 20M12 20q-1.875 0-3.187-1.312T7.5 15.5t1.313-3.187T12 11t3.188 1.313T16.5 15.5t-1.312 3.188T12 20m0-3.4l1.071.81q.131.086.242.003t.062-.22l-.398-1.334l1.052-.759q.13-.086.08-.22t-.192-.134H12.61l-.418-1.394q-.05-.136-.192-.136t-.192.136l-.417 1.394h-1.308q-.142 0-.192.134t.08.22l1.052.76l-.398 1.332q-.05.137.062.22t.242-.002z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Sistem Skor</h3>
                    <p class="text-gray-600">Perhitungan skor otomatis dengan berbagi hasil dan leaderboard untuk memotivasi belajar.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-8 transition-all duration-300 hover:border-sky-200 hover:shadow-lg">
                    <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 transition-colors group-hover:bg-sky-500">
                        <svg class="h-8 w-8 text-sky-500 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M2 14.5c0-1.405 0-2.107.337-2.611a2 2 0 0 1 .552-.552C3.393 11 4.096 11 5.5 11s2.107 0 2.611.337a2 2 0 0 1 .552.552C9 12.393 9 13.096 9 14.5v4c0 1.404 0 2.107-.337 2.611a2 2 0 0 1-.552.552C7.607 22 6.904 22 5.5 22s-2.107 0-2.611-.337a2 2 0 0 1-.552-.552C2 20.607 2 19.904 2 18.5z" />
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M22 10v4c0 3.771 0 5.657-1.172 6.828S17.771 22 14 22c-1.7 0-3.015 0-4.056-.107c.335-.525.454-1.082.506-1.598c.05-.491.05-1.084.05-1.729v-4.132c0-.645 0-1.238-.05-1.729c-.054-.533-.18-1.11-.54-1.65a3.5 3.5 0 0 0-.966-.965c-.54-.36-1.116-.486-1.65-.54A14 14 0 0 0 6 9.5c.002-3.44.053-5.21 1.172-6.328C8.343 2 10.229 2 14 2s5.657 0 6.828 1.172S22 6.229 22 10m-10.75 9a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Responsive Design</h3>
                    <p class="text-gray-600">Interface yang responsif dan user-friendly, dapat diakses dari perangkat desktop maupun mobile.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quizzes Preview -->
    <section id="quizzes" class="py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Kuis Populer</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">Beberapa kuis yang banyak diminati oleh pengguna {{ config('app.name') }}</p>
            </div>

            <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($popularQuizzes as $item)
                    <div class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm hover:shadow-lg">
                        <div class="p-6">
                            <h3 class="mb-2 text-xl font-semibold text-gray-900">{{ $item->name }} </h3>
                            <p class="mb-4 text-gray-600">{{ $item->description }}</p>
                            <div class="">
                                <a href="{{ route('quiz.attempt', $item->slug) }}" class="flex text-sm font-medium text-sky-500">Kerjakan Kuis
                                    <span class="ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m13.5 6.497l4 4.002l-4 4.001m-9-4h13" stroke-width="1" />
                                        </svg>
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('list.quizzes') }}" class="transform rounded-lg bg-sky-500 px-8 py-4 text-lg font-semibold text-white shadow-lg transition-all hover:scale-105 hover:bg-sky-600 hover:shadow-xl">
                    Lihat Semua Kuis Tersedia
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Mudahnya Beneran</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">Mulai perjalanan belajar Anda dalam 3 langkah mudah</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                        <span class="text-2xl font-bold text-sky-500">1</span>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Daftarkan Akunmu</h3>
                    <p class="text-gray-600">Kamu dapat mendaftar akun secara gratis dan mulai mengakses berbagai kuis yang tersedia.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                        <span class="text-2xl font-bold text-sky-500">2</span>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Kerjakan Kuis</h3>
                    <p class="text-gray-600">Kerjakan quiz dengan timer, sistem auto-save, dan feedback real-time untuk pembelajaran optimal.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                        <span class="text-2xl font-bold text-sky-500">3</span>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Analisis & Tingkatkan</h3>
                    <p class="text-gray-600">Lihat hasil dan analisis detail untuk memahami progress dan area yang perlu diperbaiki.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    {{-- <section id="about" class="bg-gradient-to-br from-sky-50 to-blue-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                <div>
                    <h2 class="mb-6 text-3xl font-bold text-gray-900 md:text-4xl">Tentang Platform Kami</h2>
                    <p class="mb-6 text-lg tracking-tight text-gray-600">
                        Platform quiz online kami dirancang khusus untuk memberikan pengalaman belajar yang interaktif dan efektif.
                        Dengan teknologi modern dan interface yang user-friendly, kami membantu Anda mencapai tujuan pembelajaran dengan cara yang menyenangkan.
                    </p>
                    <div class="mb-8 space-y-4">
                        <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Dibangun dengan Laravel 11 & TailwindCSS</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Sistem autentikasi dengan Laravel Jetstream</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Admin panel dengan Filament 3</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="mr-3 h-5 w-5 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">Responsive design untuk semua perangkat</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="flex aspect-square items-center justify-center rounded-2xl bg-gradient-to-br from-sky-400 to-blue-600 shadow-xl">
                        <div class="text-center text-white">
                            <svg class="mx-auto mb-4 h-24 w-24" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            <h3 class="mb-2 text-2xl font-bold">Teknologi Terdepan</h3>
                            <p class="text-blue-100">Dibangun dengan teknologi modern untuk performa optimal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA Section -->
    {{-- <section class="bg-gradient-to-r from-sky-500 to-blue-600 py-16">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 items-center justify-items-end gap-4 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
                <div class="px-4 text-center lg:text-left">
                    <h2 class="mb-6 text-3xl font-bold text-white md:text-4xl">Siap Memulai Perjalanan Belajar?</h2>
                    <p class="mb-8 text-lg tracking-tight text-blue-100">Bergabunglah dengan ribuan peserta lainnya dan tingkatkan kemampuan Anda hari ini!</p>
                </div>

                <div class="flex justify-end">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-lg bg-white px-8 py-4 text-lg font-semibold text-sky-500 hover:bg-gray-100">
                            Lanjutkan Belajar
                        </a>
                    @else
                        <div class="">
                            <a href="{{ route('register') }}" class="rounded-lg bg-white px-8 py-4 text-lg font-semibold text-sky-500 hover:bg-gray-100">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section> --}}
@endsection
