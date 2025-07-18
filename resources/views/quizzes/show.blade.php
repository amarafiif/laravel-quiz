@extends('layouts.main')

@section('title', $quiz->name)
@section('description', $quiz->description)
@section('keywords', 'kuis, latihan soal, gratis, latihan tes soal gratis, tes gratis, edukasi, pembelajaran, platform kuis online')
@section('author', 'Tim ' . config('app.name'))
@section('publisher', config('app.name') . ' Indonesia')
@section('robots', 'index, follow')

@section('og:title', $quiz->name)
@section('og:description', $quiz->description)
@section('og:image', asset('images/og-image.jpg'))
@section('og:type', 'website')

@section('twitter:title', $quiz->name)
@section('twitter:description', $quiz->description)
@section('twitter:image', asset('images/og-image.jpg'))


@section('main-content')
    <div id="header" class="mx-auto mb-4 mt-8 flex max-w-7xl content-center items-center justify-between gap-2 rounded-2xl bg-white px-4 py-8 lg:px-8">
        <div id="title">
            <h1 class="text-2xl font-bold text-gray-900">{{ $quiz->name }}</h1>
            <p class="text-gray-600"></p>
        </div>
    </div>
    <div id="quiz-detail" class="mx-auto mb-24 mt-8 max-w-7xl gap-2 rounded-2xl bg-white px-4 py-8 lg:px-8">
        <div class="flex flex-col content-center items-center justify-between gap-4 lg:flex-row">
            <div id="thumbnail" class="w-full lg:w-auto">
                <img class="h-48 w-full rounded-lg object-cover lg:w-80" src="{{ Storage::url($quiz->thumbnail) }}" alt="Thumbnail {{ $quiz->name }}">
            </div>
            <div id="detail-info" class="flex-1 space-y-4 px-0 lg:space-y-6 lg:px-4">
                <h2 class="text-md text-gray-600 lg:text-lg">{{ $quiz->description }}</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center rounded-full bg-sky-100 px-3 py-1 text-sm font-medium text-sky-600">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        {{ $quiz->total_questions }} Soal
                    </span>
                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-600">
                        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $quiz->attempt_time }}
                    </span>
                    @if ($quiz->category)
                        <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-sm font-medium text-orange-600">
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ ucfirst($quiz->category) }}
                        </span>
                    @endif
                </div>
            </div>
            <div id="actions" class="w-full lg:mt-4 lg:w-auto">
                <a href="{{ route('quiz.start', $quiz->slug) }}" class="block w-full rounded-lg bg-sky-500 px-8 py-3 text-center font-medium text-white transition-colors hover:bg-sky-600 lg:inline-block lg:w-auto">
                    Kerjakan Kuis
                </a>
            </div>
        </div>

        <hr class="my-8 border-dashed border-gray-300">

        @foreach ($quiz->questions as $item)
            <div class="mt-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6" id="question-container-{{ $item->id }}">
                <!-- Question Header -->
                <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
                    <div class="flex-1">
                        <div class="flex gap-3">
                            <span class="mb-3 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-bold text-slate-700">
                                {{ $loop->iteration }}
                            </span>

                        </div>
                        <hr class="border-1 mb-3 w-full border-dashed border-gray-200">
                        <div class="flex items-start gap-3">
                            <div class="min-w-0 flex-1">
                                <div class="prose-md prose max-w-none text-gray-800">
                                    {!! Str::markdown($item->question_text) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($item->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Question Image" class="max-w-md rounded-lg shadow-sm">
                    </div>
                @endif
            </div>
        @endforeach
    </div>

@endsection
