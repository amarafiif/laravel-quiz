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

<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Left Side - Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Logo and Header -->
                <div class="text-center">
                    <div class="mb-6 flex items-center justify-center">
                        <svg class="h-10 w-10 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2 text-2xl font-bold text-gray-900">{{ config('app.name') }}</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-sky-500 hover:text-sky-600">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <!-- Alert -->
                <div class="mt-8">
                    <x-alert class="mb-4"></x-alert>
                </div>

                <!-- Form -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="email" class="block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="Masukkan email Anda" />
                            </div>
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Password') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="password" class="block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="password" name="password" required autocomplete="current-password"
                                    placeholder="Masukkan password Anda" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" class="h-4 w-4 rounded border-gray-300 text-sky-500 focus:ring-sky-500" />
                                <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                                    {{ __('Ingat saya') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-sky-500 hover:text-sky-600">
                                        Lupa password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="group relative flex w-full justify-center rounded-lg border border-transparent bg-sky-500 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                                {{ __('Masuk') }}
                            </button>
                        </div>
                    </form>
                </div>

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
        <div class="relative hidden w-0 flex-1 lg:block">
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
</body>

</html>
