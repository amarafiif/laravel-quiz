@extends('layouts.auth')

@section('header', 'Lupa Password')
@section('sub-header', 'Silakan masukkan alamat email Anda untuk menerima tautan reset password.')

@section('form-content')
    <x-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="block">
            <x-label for="email" value="{{ __('Email') }}" />
            <div class="mt-1">
                <x-input id="email" class="block w-full appearance-none rounded-lg border border-gray-300 px-3 py-3 text-sm placeholder-gray-400 focus:border-sky-500 focus:outline-none focus:ring-sky-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
        </div>

        <div class="mt-4 flex items-center justify-end">
            <button type="submit" class="group relative flex w-full justify-center rounded-lg border border-transparent bg-sky-500 px-4 py-3 text-sm font-medium text-white transition-colors hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                {{ __('Submit') }}
            </button>
        </div>
    </form>
@endsection
