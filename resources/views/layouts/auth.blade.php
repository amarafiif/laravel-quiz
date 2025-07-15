<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Masuk</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans tracking-tight antialiased">
    <div class="flex min-h-screen">
        <!-- Left Side - Form -->
        <div class="flex w-1/2 flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="lg:w-md mx-auto w-full max-w-md rounded-lg bg-white p-8">
                <!-- Logo and Header -->
                <div class="mb-8">
                    <div class="mb-8 flex items-center justify-center border-b-2 border-dashed pb-5">
                        <svg class="h-8 w-8 text-sky-500" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M209.5 18.66c-7.4-.02-14.8 1.93-19.2 6.96c-3.1 3.59-4.8 8.46 0 19.19c5.2 8.08 9.3 19.06 12.9 33.12l-17.9 4.66c-6.1-23.73-13.8-33-18.5-35.1c-2.4-1.04-4.7-1.14-8.3 0c-3.7 1.11-8.4 3.68-13.5 7.47c-7.9 5.8-12.6 13.22-12.4 19.25c3.7 12.42 13.1 18.6 25 24.19l-8 16.8c-4.6-2.1-8.7-4.4-12.4-6.8c-13.3-7.3-23.1-10.38-28-9.97c-2.6.22-4.1.85-6 2.77c-2 2-4.4 5.7-6.5 11.6c-3.5 9.9-4 17.7-1.5 21.8c2 3.2 7.2 6.9 20.1 8.2c3.3.1 6.7.2 10.4.4v.1h1.1l.2 18.7c-3.8 0-7.3-.1-10.6-.4c-11.1-.1-17.7.8-20.2 2.1c-1.6.8-2.1 1.3-2.9 3c-.9 1.8-1.8 5.1-2.4 10c-.6 4.5-.2 7.6.7 9.8c.9 2.1 2.1 3.6 5.3 5.3c6.5 3.5 21.7 5.8 47.3 3.7l1.5 18.6c-17.2 1.5-30.7 1.5-41.5-.5c4.7 15.1 14.5 21.9 25.7 21.9h94c10.6 0 19.8-7.7 23.4-22.1l8.1-32.1l9.9 31.6c4.7 14.8 14.2 22.6 23.5 22.6H383c11.2 0 21.1-6.9 25.7-22c-10.9 2.1-24.6 2.1-42.4.6l1.6-18.6c25.6 2.1 40.7-.2 47.2-3.7c3.2-1.7 4.4-3.2 5.3-5.3c1.4-6.3 2.1-19.3-4.5-22.8c-2.5-1.2-9.1-2.2-20.2-2.1c-3.3.3-6.8.4-10.6.4l.2-18.7h1v-.1c3.8-.2 7.2-.3 10.4-.4c12.9-1.3 18.2-5 20.2-8.2c2.5-4.1 2-11.9-1.6-21.8c-2.3-6.2-6-13.77-12.4-14.37c-17.1 2.07-29.1 9.67-40.4 16.77l-8-16.8c4.4-1.98 7.7-4.22 11.7-6.56c10.2-6.88 13-13.02 13.3-17.63c.2-6.03-4.6-13.45-12.4-19.25c-5.2-3.79-9.8-6.35-13.5-7.47c-3.6-1.11-6-1.01-8.3 0c-1.7.72-3.7 2.34-5.8 5.09c-5.7 9.01-10.4 21.31-12.7 30l-18.1-4.66c4.1-15.76 8.8-27.65 15-35.93c3.3-8.79 1.7-13.12-1.1-16.38c-9.4-7.73-28.3-9.73-38.7-1.99c-4.5 3.34-8.1 8.5-10.9 15c-5.5 12.97-7.1 30.87-7.1 43.99v.1l-.2 30.79v.1h-18.6v-.1l-.2-30.83v-.1c0-13.12-1.6-31.02-7.2-44.03c-2.7-6.5-6.3-11.66-10.8-15c-4.5-2.86-12-4.86-19.4-4.88m47.2 217.94c-7.9 10.7-19.4 17.6-32.8 17.6h-42.8c2 4.3 5.4 8.2 10 11.8c11.8 9 32.1 15 53.6 16.4l-.6.6c-7.9 8.5-33.2 6.5-48 .9c-35-12.8-67.9-21.9-101.28-11.1c-43.77 17.3-74.86 66.9-65.53 113.1c10.36 51.3 66.85 124.2 121.11 99.8c61.3-27.6 11.4-114.5-25.3-132.1c8.5 23.2 39.8 79.9 11.4 91.9c-34.2 14.4-81.56-43.6-69.48-86.9c20.71-57.4 66.08-49.5 99.38-37.5c60.3 21.7 31.2 169.9 95.2 167.1c38.9-1.7 85.4-60.7 48.7-106.3c3.9 28.6-20.4 75.5-42.9 63.4c-33.8-18.1 12.2-84.5 43.7-106.6c24.4-17.1 70.6-28.1 89.5-3.7c29.8 38.6-53.2 74.2-27.7 118.3c22.5 39 75.7 47.4 117.6-10.8c-29.1 17.4-68.6 25.8-79.6 1.6c-14.1-31.1 62.7-35.3 69.1-76c5.8-36.7-18.3-73.9-49.6-93.9c-39.9-25.6-109.3 30.9-160.3 7.7c19.7-2.1 37.9-8.1 48.6-16.7c4.2-3.4 7.3-7 9.3-11h-39.2c-12.9 0-24.2-7-32.1-17.6" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
                    </div>
                    <div id="header-form">
                        <div id="header">
                            <h1 class="text-3xl font-bold text-gray-900">@yield('header')</h1>
                        </div>
                        <div id="sub-header" class="mt-2">
                            <p class="text-gray-600">@yield('sub-header')</p>
                        </div>
                    </div>
                </div>

                <!-- Alert -->
                <div class="mt-8">
                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ $value }}
                        </div>
                    @endif
                </div>

                <!-- Form -->
                <div class="mt-8">
                    @yield('form-content')
                </div>

                @if (request()->is('register'))
                    <p class="mt-4 text-center text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-sky-500 hover:text-sky-600">
                            Masuk sekarang
                        </a>
                    </p>
                @elseif (request()->is('login'))
                    <p class="mt-4 text-center text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-sky-500 hover:text-sky-600">
                            Daftar sekarang
                        </a>
                    </p>
                @endif

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="/" class="flex items-center justify-center text-sm text-gray-600 hover:text-sky-500">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side - Content -->
        <div class="relative hidden w-1/2 flex-1 lg:block">
            <div class="absolute inset-0 h-full w-full bg-gradient-to-br from-sky-500 to-sky-600">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative flex h-full flex-col items-center justify-center p-12 text-white">
                    <!-- Content -->
                    <div class="w-full text-center">
                        <svg class="mx-auto mb-8 h-20 w-20 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>

                        <h3 class="mb-4 text-3xl font-bold">Mulai Perjalanan Belajar Anda</h3>
                        <p class="mx-auto mb-8 max-w-md text-center text-xl text-blue-100">
                            Akses ribuan quiz interaktif dan tingkatkan kemampuan Anda dengan cara yang menyenangkan dan efektif.
                        </p>

                        <!-- Features -->
                        <div class="mx-auto flex flex-row items-center justify-center gap-4 text-center text-sm">
                            <div class="flex items-center rounded-full border border-blue-50 bg-gradient-to-tr from-sky-50/10 to-sky-200/20 px-4 py-1">
                                <svg class="mr-3 h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-blue-100">Asah Berpikir Kritis</span>
                            </div>
                            <div class="flex items-center rounded-full border border-blue-50 bg-gradient-to-tr from-sky-50/10 to-sky-200/20 px-4 py-1">
                                <svg class="mr-3 h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-blue-100">Melatih Berpikir Cepat dan Akurat</span>
                            </div>
                            <div class="flex items-center rounded-full border border-blue-50 bg-gradient-to-tr from-sky-50/10 to-sky-200/20 px-4 py-1">
                                <svg class="mr-3 h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-blue-100">Berbagai Topik Kuis</span>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="absolute bottom-12 left-12 right-12">
                        <div class="grid grid-cols-3 gap-8 text-center">
                            <div>
                                <div class="text-2xl font-bold">100+</div>
                                <div class="text-sm text-blue-200">Quiz Tersedia</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">50+</div>
                                <div class="text-sm text-blue-200">Kursus Premium</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">1000+</div>
                                <div class="text-sm text-blue-200">Peserta Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (config('app.env') !== 'production')
        <div class="fixed bottom-5 left-1/2 -translate-x-1/2 transform rounded-xl bg-orange-600 px-4 py-2 text-center text-white shadow-sm shadow-orange-400 drop-shadow-xl">
            <span class="text-sm">🚧 Development Mode</span>
        </div>
    @endif
</body>

</html>
