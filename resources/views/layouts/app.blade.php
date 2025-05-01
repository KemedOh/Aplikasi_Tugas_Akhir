<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JuruAI Politeknik LP3I Tasikmalaya</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#00426D]">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
<!-- Footer -->
<footer class="bg-gray-800 text-white py-2">
    <div class="max-w-7xl mx-auto px-6 sm:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-10">
            <!-- Section 1: Logo and Copyright -->
            <div class="flex flex-col items-center sm:items-start">
                <img src="{{ asset('images/logoLP3I.png') }}" alt="Logo" class="w-60 mb-4">
                <p class="text-sm text-center sm:text-left">&copy; {{ date('Y') }} {{ 'Ahmad Fauzi' }}. Semua hak cipta
                    dilindungi.</p>
            </div>

            <!-- Section 2: Contact Info -->
            <div class="flex flex-col space-y-4">
                <h3 class="font-semibold text-lg text-gray-300">Kontak</h3>
                <ul class="space-y-2">
                    <li class="text-gray-400">Jl. Ir. H. Juanda No.106, Panglayungan, Kec. Cipedes
                    Kota Tasikmalaya, Jawa Barat 46151</li>
                    <li class="text-gray-400">Email: <a href="mailto:email@domain.com"
                            class="hover:text-blue-500">ahmadsioh46@gmail.com</a></li>
                    <li class="text-gray-400">Phone: +62 888 8888 8888</li>
                </ul>
            </div>
        </div>

        <div class="mt-8 text-center border-t border-gray-700 pt-6">
            <p class="text-xs sm:text-sm text-gray-400">&copy; {{ date('Y') }} {{ 'Ahmad Fauzi' }}. All rights reserved.
            </p>
        </div>
    </div>
</footer>

</html>