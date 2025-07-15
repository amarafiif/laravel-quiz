@extends('layouts.auth')

@section('header', 'Daftar Akun Baru')
@section('sub-header', 'Selamat datang! Silakan daftar akun Anda untuk mengakses beragam kuis diplatform kami.')

@section('form-content')
    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-label for="name" value="{{ __('Nama Lengkap') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="name" class="{{ $errors->has('name') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
                @error('name')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- <div>
            <x-label for="username" value="{{ __('Username') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="username" class="{{ $errors->has('username') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="text" name="username"
                    :value="old('username')" required autocomplete="username" placeholder="Masukkan username unik Anda" />
                @error('username')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div> --}}

        <div>
            <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="email" class="{{ $errors->has('email') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="email" name="email"
                    :value="old('email')" required autocomplete="email" placeholder="Masukkan alamat email Anda" />
                @error('email')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <x-label for="password" value="{{ __('Password') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="password" class="{{ $errors->has('password') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="password" name="password" required
                    autocomplete="new-password" placeholder="Buat password yang kuat" />
                @error('password')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="password_confirmation" class="{{ $errors->has('password_confirmation') ? 'border-red-500' : '' }} block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password Anda" />
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
@endsection
