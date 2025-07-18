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
    <div id="header" class="mx-auto mb-4 mt-8 flex max-w-7xl content-center items-center justify-between gap-2 rounded-2xl bg-white px-4 py-8 lg:px-8">
        <div id="title">
            <h1 class="text-2xl font-bold text-gray-900">Kuis Tersedia</h1>
            <p class="text-gray-600"></p>
        </div>
        <div id="filter">
            <button id="filterButton" class="flex items-center rounded-md text-gray-500 hover:text-sky-500">
                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M6.532 4.75h6.936c.457 0 .854 0 1.165.03c.307.028.685.095.993.348c.397.326.621.814.624 1.322c.002.39-.172.726-.34.992c-.168.27-.411.59-.695.964l-2.596 3.422c-.252.332-.315.42-.359.51a1.2 1.2 0 0 0-.099.297c-.02.1-.023.212-.023.634v4.243c0 .208 0 .412-.014.578c-.015.164-.052.427-.224.663c-.21.287-.537.473-.9.495c-.302.019-.547-.103-.69-.183a7 7 0 0 1-.476-.31l-.989-.683l-.048-.033c-.191-.131-.403-.276-.562-.477a1.7 1.7 0 0 1-.303-.585c-.071-.244-.07-.5-.07-.738v-2.97c0-.422-.004-.534-.023-.634a1.2 1.2 0 0 0-.1-.297c-.043-.09-.106-.178-.358-.51L4.785 8.406c-.284-.374-.527-.694-.696-.964c-.167-.266-.34-.602-.339-.992a1.72 1.72 0 0 1 .624-1.322c.308-.253.686-.32.993-.349c.311-.029.707-.029 1.165-.029M5.308 6.305a.22.22 0 0 0-.057.134c.006.019.03.081.11.207c.128.205.33.472.64.881l2.575 3.394l.035.046c.201.264.361.475.478.715q.154.317.222.665c.051.261.05.527.05.864v2.968c0 .158.001.247.005.314l.006.062a.2.2 0 0 0 .036.073l.041.034c.05.04.12.088.248.176l.941.65V13.21c0-.337 0-.603.051-.864q.068-.347.222-.665c.117-.24.277-.45.478-.715l.035-.046l2.575-3.394c.31-.41.512-.676.64-.881c.08-.126.104-.188.11-.207a.22.22 0 0 0-.057-.134a1 1 0 0 0-.2-.032c-.232-.022-.556-.023-1.06-.023H6.568c-.504 0-.828 0-1.06.023a1 1 0 0 0-.2.032M15.75 10.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1-.75-.75m-1.5 2.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75m-.5 2.5a.75.75 0 0 1 .75-.75h5a.75.75 0 0 1 0 1.5h-5a.75.75 0 0 1-.75-.75m0 2.5a.75.75 0 0 1 .75-.75H17a.75.75 0 0 1 0 1.5h-2.5a.75.75 0 0 1-.75-.75" />
                    <path fill="currentColor"
                        d="M13.64 8H6.36l2.251 2.967c.201.264.361.475.478.715q.154.317.222.665c.051.261.05.527.05.864v2.968c0 .158.001.247.005.314l.006.062a.2.2 0 0 0 .036.073l.041.034c.05.04.12.088.248.176l.941.65V13.21c0-.337 0-.603.051-.864q.068-.347.222-.665c.117-.24.277-.45.478-.715z"
                        opacity="0.5" />
                </svg>
                Filter</button>
        </div>

        <!-- Modal Filter -->
        <div id="filterModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
            <div class="mx-4 w-full max-w-md rounded-2xl bg-white p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Filter Kuis</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="filterForm">
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="categoryFilter" class="w-full rounded-lg border-gray-300 px-3 py-3 text-gray-600 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500">
                            <option value="">Semua Kategori</option>
                            <option value="matematika">Matematika</option>
                            <option value="bahasa">Bahasa</option>
                            <option value="sains">Sains</option>
                            <option value="sejarah">Sejarah</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Urutkan</label>
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
    </div>
    <div class="mx-auto mb-16 max-w-7xl rounded-2xl bg-white px-4 py-8 lg:px-8">
        <div id="quiz-list-container">
            @include('quizzes.grid', ['quizzes' => $quizzes])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === DEKLARASI ELEMEN ===
            const filterButton = document.getElementById('filterButton');
            const filterModal = document.getElementById('filterModal');
            const closeModal = document.getElementById('closeModal');
            const resetFilterButton = document.getElementById('resetFilter');
            const quizContainer = document.getElementById('quiz-list-container');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');

            // === LOGIKA MODAL (SUDAH DIPERBAIKI) ===
            function showModal() {
                filterModal.classList.remove('hidden');
                filterModal.classList.add('flex');
            }

            function hideModal() {
                filterModal.classList.add('hidden');
                filterModal.classList.remove('flex');
            }

            filterButton.addEventListener('click', showModal);
            closeModal.addEventListener('click', hideModal);
            filterModal.addEventListener('click', (e) => {
                if (e.target === filterModal) {
                    hideModal();
                }
            });

            // === LOGIKA FILTER AJAX (OTOMATIS & DENGAN DEBOUNCE) ===
            const fetchQuizzes = async () => {
                const category = categoryFilter.value;
                const sort = sortFilter.value;

                quizContainer.innerHTML = '<div class="col-span-full min-h-[390px] content-center text-center py-12">Memuat kuis...</div>';

                const url = new URL("{{ route('quizzes.filter') }}");
                if (category) url.searchParams.append('category', category);
                if (sort) url.searchParams.append('sort', sort);

                try {
                    const response = await fetch(url);
                    const html = await response.text();
                    quizContainer.innerHTML = html;
                    // hideModal(); // Otomatis tutup modal setelah filter berhasil
                } catch (error) {
                    console.error('Gagal memuat kuis:', error);
                    quizContainer.innerHTML = '<div class="col-span-full text-center text-red-500 py-12">Terjadi kesalahan saat memuat data.</div>';
                }
            };

            // Fungsi helper untuk debounce
            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            const debouncedFetch = debounce(fetchQuizzes, 300);

            // Event listener `change` untuk filter otomatis
            categoryFilter.addEventListener('change', debouncedFetch);
            sortFilter.addEventListener('change', debouncedFetch);

            // Event listener untuk tombol "Reset"
            resetFilterButton.addEventListener('click', () => {
                categoryFilter.value = '';
                sortFilter.value = '';
                fetchQuizzes();
            });

            // Event listener untuk pagination (tidak berubah)
            document.body.addEventListener('click', function(e) {
                if (e.target.matches('#pagination-links a')) {
                    e.preventDefault();
                    const url = e.target.href;
                    quizContainer.innerHTML = '<div class="col-span-full text-center py-12">Memuat halaman berikutnya...</div>';
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            quizContainer.innerHTML = html;
                            quizContainer.scrollIntoView({
                                behavior: 'smooth'
                            });
                        })
                        .catch(error => console.error('Gagal memuat halaman:', error));
                }
            });
        });
    </script>
@endpush
