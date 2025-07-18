<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name') . ' - Platform Quiz Online')</title>
    <meta name="description" content="@yield('description', 'Platform kuis online untuk pembelajaran dan persiapan berbagai tes. Latihan soal dengan berbagai kategori dan tingkat kesulitan dalam sistem yang interaktif dan mudah digunakan.')">
    <meta name="keywords" content="@yield('keywords', 'kuis online, latihan soal, pembelajaran interaktif, tes online, quiz edukasi, platform belajar, simulasi ujian, latihan quiz, sistem pembelajaran, edukasi digital')">
    <meta name="author" content="@yield('author', 'Tim ' . config('app.name'))">
    <meta name="publisher" content="@yield('publisher', config('app.name') . ' Indonesia')">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og:type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og:title', config('app.name') . ' - Platform Quiz Online Terbaik')">
    <meta property="og:description" content="@yield('og:description', 'Tingkatkan pengetahuan Anda dengan platform quiz online interaktif. Berbagai kategori soal dan sistem pembelajaran yang menyenangkan untuk semua kalangan.')">
    <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="@yield('twitter:card', 'summary_large_image')">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter:title', config('app.name') . ' - Platform Quiz Online Terbaik')">
    <meta property="twitter:description" content="@yield('twitter:description', 'Tingkatkan pengetahuan Anda dengan platform quiz online interaktif. Berbagai kategori soal dan sistem pembelajaran yang menyenangkan.')">
    <meta property="twitter:image" content="@yield('twitter:image', asset('images/og-image.jpg'))">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>

<body class="flex min-h-screen flex-col bg-gradient-to-br from-gray-50 to-gray-100 font-sans tracking-tight antialiased">
    @if (config('app.env') !== 'production')
        <div class="fixed bottom-5 left-0 z-50 transform rounded-e-xl bg-orange-400 px-4 py-2 text-center text-white shadow-sm shadow-orange-400 drop-shadow-xl">
            <span class="text-sm">🚧 Development Mode</span>
        </div>
    @endif

    <!-- Navigation -->
    @include('layouts.partials.navbar')

    <!-- Main -->
    <main class="flex-grow">
        @yield('main-content')
    </main>


    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Smooth Scrolling Script -->
    <script>
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
    @stack('scripts')
</body>

</html>
