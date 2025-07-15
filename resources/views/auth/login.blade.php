@extends('layouts.auth')

@section('form-content')
    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-gray-700" />
            <div class="mt-1">
                <x-input id="email" class="block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="member@example.com" />
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

            {{-- @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-sky-500 hover:text-sky-600">
                        Lupa password?
                    </a>
                </div>
            @endif --}}
        </div>

        <div>
            <button type="submit" class="group relative flex w-full justify-center rounded-lg border border-transparent bg-sky-500 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                {{ __('Masuk') }}
            </button>
        </div>
    </form>
@endsection
