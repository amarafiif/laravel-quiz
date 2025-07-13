<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Daftar</title>

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
                    <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-sky-500 hover:text-sky-600">
                            Masuk sekarang
                        </a>
                    </p>
                </div>

                <!-- Form -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-label for="name" value="{{ __('Nama Lengkap') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="name" class="{{ $errors->has('name') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="text"
                                    name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
                                @error('name')
                                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <x-label for="username" value="{{ __('Username') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="username" class="{{ $errors->has('username') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="text"
                                    name="username" :value="old('username')" required autocomplete="username" placeholder="Masukkan username unik Anda" />
                                @error('username')
                                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="email" class="{{ $errors->has('email') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="email"
                                    name="email" :value="old('email')" required autocomplete="email" placeholder="Masukkan alamat email Anda" />
                                @error('email')
                                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <x-label for="password" value="{{ __('Password') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="password" class="{{ $errors->has('password') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="password"
                                    name="password" required autocomplete="new-password" placeholder="Buat password yang kuat" />
                                @error('password')
                                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="block text-sm font-medium text-gray-700" />
                            <div class="mt-1">
                                <x-input id="password_confirmation"
                                    class="{{ $errors->has('password_confirmation') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="password"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password Anda" />
                                @error('password_confirmation')
                                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start">
                                <div class="flex h-5 items-center">
                                    <x-checkbox name="terms" id="terms" required class="h-4 w-4 rounded border-gray-300 text-sky-500 focus:ring-sky-500" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms" class="text-gray-600">
                                        {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="font-medium text-sky-500 hover:text-sky-600">' . __('Syarat Layanan') . '</a>',
                                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="font-medium text-sky-500 hover:text-sky-600">' . __('Kebijakan Privasi') . '</a>',
                                        ]) !!}
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div>
                            <button type="submit" class="group relative flex w-full justify-center rounded-lg border border-transparent bg-sky-500 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                                {{ __('Daftar Sekarang') }}
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
            <div class="absolute inset-0 h-full w-full bg-gradient-to-br from-purple-400 to-pink-600">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative flex h-full flex-col items-center justify-center p-12 text-white">
                    <!-- Content -->
                    <div class="max-w-md text-center">
                        <svg class="mx-auto mb-8 h-20 w-20 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <h3 class="mb-4 text-3xl font-bold">Bergabunglah dengan Komunitas Belajar</h3>
                        <p class="mb-8 text-xl text-purple-100">
                            Dapatkan akses ke platform quiz terbaik dan mulai perjalanan pembelajaran Anda bersama ribuan pengguna lainnya.
                        </p>

                        <!-- Benefits -->
                        <div class="space-y-4 text-left">
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-purple-100">Gratis untuk selamanya</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-purple-100">Akses ke semua kursus premium</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-purple-100">Sertifikat dan badge pencapaian</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-3 h-5 w-5 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-purple-100">Progress tracking dan analytics</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="absolute bottom-12 left-12 right-12">
                        <div class="rounded-xl bg-white/10 p-6 backdrop-blur-lg">
                            <h4 class="mb-4 text-center text-lg font-semibold">Platform Terpercaya</h4>
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div>
                                    <div class="text-xl font-bold">⭐ 4.9</div>
                                    <div class="text-xs text-purple-200">Rating Pengguna</div>
                                </div>
                                <div>
                                    <div class="text-xl font-bold">99%</div>
                                    <div class="text-xs text-purple-200">Kepuasan User</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
