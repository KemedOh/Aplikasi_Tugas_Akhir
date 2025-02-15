<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold">Dashboard Mahasiswa Baru</h1>
                <p class="mt-2 text-lg">Selamat datang, {{ Auth::user()->name }}! Anda dapat memulai menjawab pertanyaan
                    untuk menentukan jurusan Anda.</p>
    
                <!-- Informasi -->
                <div class="mt-6 bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                    <h2 class="text-xl font-semibold">Petunjuk:</h2>
                    <ul class="list-disc pl-5 mt-2">
                        <li>Jawablah pertanyaan sesuai dengan minat dan kemampuan Anda.</li>
                        <li>Hasil dari jawaban akan membantu menentukan jurusan yang cocok untuk Anda.</li>
                        <li>Pastikan menjawab dengan jujur agar hasilnya lebih akurat.</li>
                    </ul>
                </div>
    
                <!-- Tombol Mulai Pertanyaan -->
                <div class="mt-6">
                    <a href="#"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Mulai Pertanyaan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
