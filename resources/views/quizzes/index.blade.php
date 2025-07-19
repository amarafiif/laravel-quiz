@extends('layouts.main')

@section('title', 'Coba Beragam Kuis Gratis - ' . config('app.name'))
@section('description', 'Platform kuis online untuk pembelajaran dan persiapan berbagai tes. Latihan soal dengan berbagai kategori dan tingkat kesulitan dalam sistem yang interaktif dan mudah digunakan.')
@section('keywords', 'kuis, latihan soal, gratis, latihan tes soal gratis, tes gratis, edukasi, pembelajaran, platform kuis online')
@section('author', 'Tim ' . config('app.name'))
@section('publisher', config('app.name') . ' Indonesia')
@section('robots', 'index, follow')

@section('og:title', 'Kuis Tersedia - ' . config('app.name'))
@section('og:description', 'Temukan berbagai kuis menarik untuk menguji pengetahuan Anda. Pilih dari berbagai kategori dan tingkat kesulitan yang sesuai dengan minat Anda.')
@section('og:image', asset('images/og-image.jpg'))
@section('og:type', 'website')

@section('twitter:title', 'Kuis Tersedia - ' . config('app.name'))
@section('twitter:description', 'Temukan berbagai kuis menarik untuk menguji pengetahuan Anda. Pilih dari berbagai kategori dan tingkat kesulitan yang sesuai dengan minat Anda.')
@section('twitter:image', asset('images/og-image.jpg'))


@section('main-content')
    <div x-data="{ isFilterOpen: false }" @keydown.escape.window="isFilterOpen = false">

        <div id="header" class="mx-auto mt-6 flex max-w-7xl content-center items-center justify-between gap-2 rounded-2xl border-b-2 border-dashed border-gray-200 bg-white px-4 py-4 lg:px-8">
            <div id="title">
                <h1 class="text-2xl font-bold text-gray-900">Kuis Tersedia</h1>
                <p class="text-gray-600">Temukan kuis yang paling cocok untukmu.</p>
            </div>
            <div id="filter">
                <button @click="isFilterOpen = true" class="flex items-center rounded-md tracking-normal text-sky-500">Filter</button>
            </div>
        </div>


        <div x-show="isFilterOpen" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm" @click.self="isFilterOpen = false">
            <div x-show="isFilterOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="mx-4 w-full max-w-md rounded-2xl bg-white p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Filter Kuis</h3>
                    {{-- Tombol close modal --}}
                    <button @click="isFilterOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="filterForm">
                    <div class="mb-4">
                        <label for="categoryFilter" class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="categoryFilter" class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="sortFilter" class="mb-2 block text-sm font-medium text-gray-700">Urutkan</label>
                        <select id="sortFilter" class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Default</option>
                            <option value="popular">Populer</option>
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="mx-auto mb-16 max-w-7xl rounded-2xl bg-white px-4 py-8 lg:px-8">
            <div id="quiz-list-container">
                @include('quizzes.grid', ['quizzes' => $quizzes])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const quizContainer = $('#quiz-list-container');

            function fetchQuizzes() {
                const category = $('#categoryFilter').val();
                const sort = $('#sortFilter').val();
                const url = new URL("{{ route('quizzes.filter') }}");

                if (category) url.searchParams.append('category', category);
                if (sort) url.searchParams.append('sort', sort);

                url.searchParams.append('ajax', '1');

                quizContainer.html('<div class="col-span-full min-h-[390px] content-center text-center py-12">Memuat kuis...</div>');

                $.ajax({
                    url: url.toString(),
                    type: 'GET',
                    success: function(response) {
                        quizContainer.html(response);
                    },
                    error: function(error) {
                        console.error('Gagal memuat kuis:', error);
                        quizContainer.html('<div class="col-span-full text-center text-red-500 py-12">Terjadi kesalahan saat memuat data.</div>');
                    }
                });
            }

            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            const debouncedFetch = debounce(fetchQuizzes, 300);

            $('#categoryFilter, #sortFilter').on('change', debouncedFetch);

            $(document).on('click', '#pagination-links a', function(e) {
                e.preventDefault();
                const url = new URL($(this).attr('href'));

                const filterUrl = new URL("{{ route('quizzes.filter') }}");

                const page = url.searchParams.get('page');
                if (page) filterUrl.searchParams.append('page', page);

                filterUrl.searchParams.append('ajax', '1');

                const category = $('#categoryFilter').val();
                const sort = $('#sortFilter').val();
                if (category) filterUrl.searchParams.append('category', category);
                if (sort) filterUrl.searchParams.append('sort', sort);

                quizContainer.html('<div class="col-span-full min-h-[390px] content-center text-center py-12">Memuat halaman berikutnya...</div>');

                $.ajax({
                    url: filterUrl.toString(),
                    type: 'GET',
                    success: function(response) {
                        quizContainer.html(response);
                        $('html, body').animate({
                            scrollTop: quizContainer.offset().top - 110
                        }, 'smooth');
                    },
                    error: function(error) {
                        console.error('Gagal memuat halaman:', error);
                        quizContainer.html('<div class="col-span-full text-center text-red-500 py-12">Terjadi kesalahan saat memuat data.</div>');
                    }
                });
            });
        });
    </script>
@endpush
