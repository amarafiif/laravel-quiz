<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Platform kuis online untuk pembelajaran dan persiapan berbagai tes. Latihan soal dengan berbagai kategori dan tingkat kesulitan dalam sistem yang interaktif dan mudah digunakan.">
    <meta name="keywords" content="kuis online, latihan soal, pembelajaran interaktif, tes online, quiz edukasi, platform belajar, simulasi ujian, latihan quiz, sistem pembelajaran, edukasi digital">
    <meta name="author" content="Tim {{ config('app.name') }}">
    <meta name="publisher" content="{{ config('app.name') }} Indonesia">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ config('app.name') }} - Platform Quiz Online Terbaik">
    <meta property="og:description" content="Tingkatkan pengetahuan Anda dengan platform quiz online interaktif. Berbagai kategori soal dan sistem pembelajaran yang menyenangkan untuk semua kalangan.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ config('app.name') }} - Platform Quiz Online Terbaik">
    <meta property="twitter:description" content="Tingkatkan pengetahuan Anda dengan platform quiz online interaktif. Berbagai kategori soal dan sistem pembelajaran yang menyenangkan.">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name') }} - Platform Quiz Online </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans tracking-tight antialiased">
    @if (config('app.env') !== 'production')
        <div class="fixed bottom-5 left-0 z-50 transform rounded-e-xl bg-orange-400 px-4 py-2 text-center text-white shadow-sm shadow-orange-400 drop-shadow-xl">
            <span class="text-sm">🚧 Development Mode</span>
        </div>
    @endif
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 w-full border-b border-gray-200/20 bg-white/80 backdrop-blur-lg" x-data="{ open: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 justify-between">
                <div class="flex items-center">
                    <div class="flex flex-shrink-0 items-center">
                        <svg class="h-8 w-8 text-sky-500" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M209.5 18.66c-7.4-.02-14.8 1.93-19.2 6.96c-3.1 3.59-4.8 8.46 0 19.19c5.2 8.08 9.3 19.06 12.9 33.12l-17.9 4.66c-6.1-23.73-13.8-33-18.5-35.1c-2.4-1.04-4.7-1.14-8.3 0c-3.7 1.11-8.4 3.68-13.5 7.47c-7.9 5.8-12.6 13.22-12.4 19.25c3.7 12.42 13.1 18.6 25 24.19l-8 16.8c-4.6-2.1-8.7-4.4-12.4-6.8c-13.3-7.3-23.1-10.38-28-9.97c-2.6.22-4.1.85-6 2.77c-2 2-4.4 5.7-6.5 11.6c-3.5 9.9-4 17.7-1.5 21.8c2 3.2 7.2 6.9 20.1 8.2c3.3.1 6.7.2 10.4.4v.1h1.1l.2 18.7c-3.8 0-7.3-.1-10.6-.4c-11.1-.1-17.7.8-20.2 2.1c-1.6.8-2.1 1.3-2.9 3c-.9 1.8-1.8 5.1-2.4 10c-.6 4.5-.2 7.6.7 9.8c.9 2.1 2.1 3.6 5.3 5.3c6.5 3.5 21.7 5.8 47.3 3.7l1.5 18.6c-17.2 1.5-30.7 1.5-41.5-.5c4.7 15.1 14.5 21.9 25.7 21.9h94c10.6 0 19.8-7.7 23.4-22.1l8.1-32.1l9.9 31.6c4.7 14.8 14.2 22.6 23.5 22.6H383c11.2 0 21.1-6.9 25.7-22c-10.9 2.1-24.6 2.1-42.4.6l1.6-18.6c25.6 2.1 40.7-.2 47.2-3.7c3.2-1.7 4.4-3.2 5.3-5.3c1.4-6.3 2.1-19.3-4.5-22.8c-2.5-1.2-9.1-2.2-20.2-2.1c-3.3.3-6.8.4-10.6.4l.2-18.7h1v-.1c3.8-.2 7.2-.3 10.4-.4c12.9-1.3 18.2-5 20.2-8.2c2.5-4.1 2-11.9-1.6-21.8c-2.3-6.2-6-13.77-12.4-14.37c-17.1 2.07-29.1 9.67-40.4 16.77l-8-16.8c4.4-1.98 7.7-4.22 11.7-6.56c10.2-6.88 13-13.02 13.3-17.63c.2-6.03-4.6-13.45-12.4-19.25c-5.2-3.79-9.8-6.35-13.5-7.47c-3.6-1.11-6-1.01-8.3 0c-1.7.72-3.7 2.34-5.8 5.09c-5.7 9.01-10.4 21.31-12.7 30l-18.1-4.66c4.1-15.76 8.8-27.65 15-35.93c3.3-8.79 1.7-13.12-1.1-16.38c-9.4-7.73-28.3-9.73-38.7-1.99c-4.5 3.34-8.1 8.5-10.9 15c-5.5 12.97-7.1 30.87-7.1 43.99v.1l-.2 30.79v.1h-18.6v-.1l-.2-30.83v-.1c0-13.12-1.6-31.02-7.2-44.03c-2.7-6.5-6.3-11.66-10.8-15c-4.5-2.86-12-4.86-19.4-4.88m47.2 217.94c-7.9 10.7-19.4 17.6-32.8 17.6h-42.8c2 4.3 5.4 8.2 10 11.8c11.8 9 32.1 15 53.6 16.4l-.6.6c-7.9 8.5-33.2 6.5-48 .9c-35-12.8-67.9-21.9-101.28-11.1c-43.77 17.3-74.86 66.9-65.53 113.1c10.36 51.3 66.85 124.2 121.11 99.8c61.3-27.6 11.4-114.5-25.3-132.1c8.5 23.2 39.8 79.9 11.4 91.9c-34.2 14.4-81.56-43.6-69.48-86.9c20.71-57.4 66.08-49.5 99.38-37.5c60.3 21.7 31.2 169.9 95.2 167.1c38.9-1.7 85.4-60.7 48.7-106.3c3.9 28.6-20.4 75.5-42.9 63.4c-33.8-18.1 12.2-84.5 43.7-106.6c24.4-17.1 70.6-28.1 89.5-3.7c29.8 38.6-53.2 74.2-27.7 118.3c22.5 39 75.7 47.4 117.6-10.8c-29.1 17.4-68.6 25.8-79.6 1.6c-14.1-31.1 62.7-35.3 69.1-76c5.8-36.7-18.3-73.9-49.6-93.9c-39.9-25.6-109.3 30.9-160.3 7.7c19.7-2.1 37.9-8.1 48.6-16.7c4.2-3.4 7.3-7 9.3-11h-39.2c-12.9 0-24.2-7-32.1-17.6" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden items-center space-x-8 md:flex">
                    <a href="#home" class="px-3 py-2 font-medium text-gray-600 transition-colors hover:text-sky-500">Home</a>
                    <a href="#features" class="px-3 py-2 font-medium text-gray-600 transition-colors hover:text-sky-500">Fitur</a>
                    <a href="#courses" class="px-3 py-2 font-medium text-gray-600 transition-colors hover:text-sky-500">Kursus</a>
                    <a href="#about" class="px-3 py-2 font-medium text-gray-600 transition-colors hover:text-sky-500">Tentang</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-lg bg-sky-500 px-4 py-2 font-medium text-white transition-colors hover:bg-sky-600">Dashboard</a>
                        @else
                            {{-- <a href="{{ route('login') }}" class="rounded-lg bg-white px-8 py-2 font-medium text-gray-600 transition-colors hover:text-sky-500">Login</a> --}}
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-lg bg-sky-500 px-8 py-2 font-medium text-white transition-colors hover:bg-sky-600">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="p-2 text-gray-600 hover:text-sky-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" x-transition class="md:hidden">
            <div class="space-y-1 border-t border-gray-200 bg-white px-2 pb-3 pt-2">
                <a href="#home" class="block px-3 py-2 font-medium text-gray-600 hover:text-sky-500">Home</a>
                <a href="#features" class="block px-3 py-2 font-medium text-gray-600 hover:text-sky-500">Fitur</a>
                <a href="#courses" class="block px-3 py-2 font-medium text-gray-600 hover:text-sky-500">Kursus</a>
                <a href="#about" class="block px-3 py-2 font-medium text-gray-600 hover:text-sky-500">Tentang</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="mx-3 mt-4 block rounded-lg bg-sky-500 px-3 py-2 font-medium text-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 font-medium text-gray-600 hover:text-sky-500">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="mx-3 mt-2 block rounded-lg bg-sky-500 px-3 py-2 font-medium text-white">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="px-4 pb-16 pt-48 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="text-center">
                <h1 class="mb-6 text-4xl font-bold text-gray-900 md:text-6xl" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 200)">
                    Platform Quiz Online
                    <span class="text-sky-500">Terbaik</span>
                </h1>
                <p class="mx-auto mb-8 max-w-3xl text-xl text-gray-600" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 400)">
                    Tingkatkan pengetahuan Anda dengan berbagai kursus dan quiz interaktif.
                    Belajar dengan cara yang menyenangkan dan efektif!
                </p>

                <div class="mb-20 flex flex-row items-center justify-center gap-4" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 600)">
                    @auth
                        <a href="{{ route('dashboard') }}" class="transform rounded-lg bg-sky-500 px-8 py-4 text-lg font-semibold text-white transition-all hover:scale-105 hover:bg-sky-600 hover:shadow-xl">
                            Mulai Quiz Sekarang
                        </a>
                        <a href="{{ route('courses.index') }}" class="rounded-lg border-2 border-sky-500 px-8 py-4 text-lg font-semibold text-sky-500 transition-all hover:bg-sky-500 hover:text-white">
                            Jelajahi Kursus
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
                <div class="mx-auto grid max-w-4xl grid-cols-1 gap-4 md:grid-cols-3" x-data="{ show: false }" x-show="show" x-transition.duration.1000ms x-init="setTimeout(() => show = true, 800)">
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center">
                        <div class="mb-2 text-3xl font-bold text-sky-500" x-data="{ count: 0 }" x-init="setInterval(() => { if (count < 100) count++ }, 30)">
                            <span x-text="count"></span>+
                        </div>
                        <p class="text-gray-600">Quiz Tersedia</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white p-6 text-center">
                        <div class="mb-2 text-3xl font-bold text-sky-500" x-data="{ count: 0 }" x-init="setInterval(() => { if (count < 50) count++ }, 50)">
                            <span x-text="count"></span>+
                        </div>
                        <p class="text-gray-600">Kursus Premium</p>
                    </div>
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

    <!-- Courses Preview -->
    <section id="courses" class="bg-gradient-to-br from-gray-50 to-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Kursus Populer</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">Pilih dari berbagai kursus yang telah dirancang oleh para ahli</p>
            </div>

            <div class="mb-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Course Card 1 -->
                <div class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex aspect-video items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-900">Pemrograman Dasar</h3>
                        <p class="mb-4 text-gray-600">Pelajari konsep dasar pemrograman dengan quiz interaktif dan praktek langsung.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-sky-500">15 Quiz Tersedia</span>
                            <div class="flex items-center text-yellow-400">
                                ⭐ 4.8
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex aspect-video items-center justify-center bg-gradient-to-br from-green-400 to-green-600">
                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-900">Web Development</h3>
                        <p class="mb-4 text-gray-600">Kuasai teknologi web modern dengan HTML, CSS, JavaScript dan framework populer.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-sky-500">20 Quiz Tersedia</span>
                            <div class="flex items-center text-yellow-400">
                                ⭐ 4.9
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="group transform overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex aspect-video items-center justify-center bg-gradient-to-br from-purple-400 to-purple-600">
                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-semibold text-gray-900">Data Science</h3>
                        <p class="mb-4 text-gray-600">Eksplorasi dunia data science dengan Python, analisis data, dan machine learning.</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-sky-500">12 Quiz Tersedia</span>
                            <div class="flex items-center text-yellow-400">
                                ⭐ 4.7
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                @auth
                    <a href="{{ route('courses.index') }}" class="transform rounded-lg bg-sky-500 px-8 py-4 text-lg font-semibold text-white shadow-lg transition-all hover:scale-105 hover:bg-sky-600 hover:shadow-xl">
                        Lihat Semua Kursus
                    </a>
                @else
                    <a href="{{ route('register') }}" class="transform rounded-lg bg-sky-500 px-8 py-4 text-lg font-semibold text-white shadow-lg transition-all hover:scale-105 hover:bg-sky-600 hover:shadow-xl">
                        Daftar untuk Mengakses Kursus
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-16 text-center">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">Cara Kerja Platform</h2>
                <p class="mx-auto max-w-2xl text-lg text-gray-600">Mulai perjalanan belajar Anda dalam 3 langkah mudah</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                        <span class="text-2xl font-bold text-sky-500">1</span>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Daftar & Pilih Kursus</h3>
                    <p class="text-gray-600">Buat akun gratis dan pilih kursus yang sesuai dengan minat dan kebutuhan Anda.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-sky-100">
                        <span class="text-2xl font-bold text-sky-500">2</span>
                    </div>
                    <h3 class="mb-3 text-xl font-semibold text-gray-900">Ikuti Quiz Interaktif</h3>
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
    <section id="about" class="bg-gradient-to-br from-sky-50 to-blue-50 py-16">
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
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-sky-500 to-blue-600 py-16">
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
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div class="col-span-1 md:col-span-2">
                    <div class="mb-4 flex items-center">
                        <svg class="h-8 w-8 text-sky-500" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M209.5 18.66c-7.4-.02-14.8 1.93-19.2 6.96c-3.1 3.59-4.8 8.46 0 19.19c5.2 8.08 9.3 19.06 12.9 33.12l-17.9 4.66c-6.1-23.73-13.8-33-18.5-35.1c-2.4-1.04-4.7-1.14-8.3 0c-3.7 1.11-8.4 3.68-13.5 7.47c-7.9 5.8-12.6 13.22-12.4 19.25c3.7 12.42 13.1 18.6 25 24.19l-8 16.8c-4.6-2.1-8.7-4.4-12.4-6.8c-13.3-7.3-23.1-10.38-28-9.97c-2.6.22-4.1.85-6 2.77c-2 2-4.4 5.7-6.5 11.6c-3.5 9.9-4 17.7-1.5 21.8c2 3.2 7.2 6.9 20.1 8.2c3.3.1 6.7.2 10.4.4v.1h1.1l.2 18.7c-3.8 0-7.3-.1-10.6-.4c-11.1-.1-17.7.8-20.2 2.1c-1.6.8-2.1 1.3-2.9 3c-.9 1.8-1.8 5.1-2.4 10c-.6 4.5-.2 7.6.7 9.8c.9 2.1 2.1 3.6 5.3 5.3c6.5 3.5 21.7 5.8 47.3 3.7l1.5 18.6c-17.2 1.5-30.7 1.5-41.5-.5c4.7 15.1 14.5 21.9 25.7 21.9h94c10.6 0 19.8-7.7 23.4-22.1l8.1-32.1l9.9 31.6c4.7 14.8 14.2 22.6 23.5 22.6H383c11.2 0 21.1-6.9 25.7-22c-10.9 2.1-24.6 2.1-42.4.6l1.6-18.6c25.6 2.1 40.7-.2 47.2-3.7c3.2-1.7 4.4-3.2 5.3-5.3c1.4-6.3 2.1-19.3-4.5-22.8c-2.5-1.2-9.1-2.2-20.2-2.1c-3.3.3-6.8.4-10.6.4l.2-18.7h1v-.1c3.8-.2 7.2-.3 10.4-.4c12.9-1.3 18.2-5 20.2-8.2c2.5-4.1 2-11.9-1.6-21.8c-2.3-6.2-6-13.77-12.4-14.37c-17.1 2.07-29.1 9.67-40.4 16.77l-8-16.8c4.4-1.98 7.7-4.22 11.7-6.56c10.2-6.88 13-13.02 13.3-17.63c.2-6.03-4.6-13.45-12.4-19.25c-5.2-3.79-9.8-6.35-13.5-7.47c-3.6-1.11-6-1.01-8.3 0c-1.7.72-3.7 2.34-5.8 5.09c-5.7 9.01-10.4 21.31-12.7 30l-18.1-4.66c4.1-15.76 8.8-27.65 15-35.93c3.3-8.79 1.7-13.12-1.1-16.38c-9.4-7.73-28.3-9.73-38.7-1.99c-4.5 3.34-8.1 8.5-10.9 15c-5.5 12.97-7.1 30.87-7.1 43.99v.1l-.2 30.79v.1h-18.6v-.1l-.2-30.83v-.1c0-13.12-1.6-31.02-7.2-44.03c-2.7-6.5-6.3-11.66-10.8-15c-4.5-2.86-12-4.86-19.4-4.88m47.2 217.94c-7.9 10.7-19.4 17.6-32.8 17.6h-42.8c2 4.3 5.4 8.2 10 11.8c11.8 9 32.1 15 53.6 16.4l-.6.6c-7.9 8.5-33.2 6.5-48 .9c-35-12.8-67.9-21.9-101.28-11.1c-43.77 17.3-74.86 66.9-65.53 113.1c10.36 51.3 66.85 124.2 121.11 99.8c61.3-27.6 11.4-114.5-25.3-132.1c8.5 23.2 39.8 79.9 11.4 91.9c-34.2 14.4-81.56-43.6-69.48-86.9c20.71-57.4 66.08-49.5 99.38-37.5c60.3 21.7 31.2 169.9 95.2 167.1c38.9-1.7 85.4-60.7 48.7-106.3c3.9 28.6-20.4 75.5-42.9 63.4c-33.8-18.1 12.2-84.5 43.7-106.6c24.4-17.1 70.6-28.1 89.5-3.7c29.8 38.6-53.2 74.2-27.7 118.3c22.5 39 75.7 47.4 117.6-10.8c-29.1 17.4-68.6 25.8-79.6 1.6c-14.1-31.1 62.7-35.3 69.1-76c5.8-36.7-18.3-73.9-49.6-93.9c-39.9-25.6-109.3 30.9-160.3 7.7c19.7-2.1 37.9-8.1 48.6-16.7c4.2-3.4 7.3-7 9.3-11h-39.2c-12.9 0-24.2-7-32.1-17.6" />
                        </svg>
                        <span class="ml-2 text-xl font-bold">{{ config('app.name') }}</span>
                    </div>
                    <p class="mb-4 max-w-md tracking-tight text-gray-400">
                        Platform quiz online terbaik untuk meningkatkan pengetahuan dan keterampilan Anda dengan cara yang interaktif dan menyenangkan.
                    </p>
                    {{-- <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 transition-colors hover:text-sky-400">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 transition-colors hover:text-sky-400">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 transition-colors hover:text-sky-400">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.162-1.499-.69-2.436-2.878-2.436-4.625 0-3.769 2.748-7.229 7.931-7.229 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div> --}}
                </div>
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 transition-colors hover:text-white">Home</a></li>
                        <li><a href="#features" class="text-gray-400 transition-colors hover:text-white">Fitur</a></li>
                        <li><a href="#courses" class="text-gray-400 transition-colors hover:text-white">Kursus</a></li>
                        <li><a href="#about" class="text-gray-400 transition-colors hover:text-white">Tentang</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="mb-4 text-lg font-semibold">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 transition-colors hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Panduan</a></li>
                        <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Kontak</a></li>
                        <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name') }}. Dibuat dengan ❤️ menggunakan Laravel.</p>
            </div>
        </div>
    </footer>

    <!-- Smooth Scrolling Script -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/90');
                nav.classList.remove('bg-white/80');
            } else {
                nav.classList.add('bg-white/80');
                nav.classList.remove('bg-white/90');
            }
        });
    </script>
</body>

</html>
