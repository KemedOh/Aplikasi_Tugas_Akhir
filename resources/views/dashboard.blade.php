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

                <!-- Petunjuk -->
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
@php
    $userId = Auth::id();

    // Ambil 2 jurusan teratas dari rekomendasi
    $topRecommendations = \App\Models\Recommendation::where('user_id', $userId)
        ->orderByDesc('score')
        ->limit(2)
        ->with('major')
        ->get();

    // Cek apakah user sudah menjawab pertanyaan umum (category = 'umum')
    $hasGeneralAnswers = \App\Models\UserAnswer::where('user_id', $userId)
        ->whereHas('question', function ($query) {
            $query->where('category', 'umum');
        })
        ->exists();

    // Cek apakah user sudah menjawab soal spesifik untuk 2 jurusan teratas
    $answeredSpecificMajors = \App\Models\UserAnswer::where('user_id', $userId)
        ->whereHas('question', function ($query) {
            $query->where('category', 'spesifik');
        })
        ->pluck('major_id')
        ->toArray();

    $topMajorsAnswered = $topRecommendations->every(function ($rec) use ($answeredSpecificMajors) {
        return in_array($rec->major_id, $answeredSpecificMajors);
    });
@endphp



    @if (!$hasGeneralAnswers)
        <a href="{{ route('questions.index', ['category' => 'umum']) }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
            Mulai Pertanyaan
        </a>
    @elseif ($hasGeneralAnswers && !$hasSpecificAnswers)
        <a href="{{ route('recommendations.show') }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">
            Lanjutkan Menjawab Pertanyaan
        </a>
    @else
        <form action="{{ route('recommendations.finalResult') }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                Lihat Hasil Akhir
            </button>
        </form>
    @endif
</div>




                <!-- Rekomendasi -->
                <div class="mt-10">
                    <h2 class="text-xl font-semibold mb-2">Hasil Rekomendasi</h2>

                    @php
$userId = Auth::id();

// Ambil hasil rekomendasi dari tabel recommendations
$topRecommendations = \App\Models\Recommendation::where('user_id', $userId)
    ->orderByDesc('score')  // Urutkan berdasarkan skor tertinggi
    ->limit(2)  // Ambil 2 jurusan teratas
    ->with('major')  // Pastikan relasi 'major' di-load
    ->get();
                    @endphp

                    @if(!$hasSpecificAnswers)
                        <div class="p-4 mt-4 bg-yellow-100 text-yellow-700 rounded-lg">
                            Anda belum menjawab soal khusus jurusan. Mohon untuk menjawab soal khusus agar rekomendasi dapat
                            ditampilkan.
                        </div>
                    @elseif($topRecommendations->isEmpty())
                        <div class="p-4 mt-4 bg-red-100 text-red-700 rounded-lg">
                            Anda belum menjawab pertanyaan umum ataupun khusus jurusan. Mohon untuk segera menjawab
                            pertanyaan untuk
                            menampilkan hasil rekomendasi.
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($topRecommendations as $recommendation)
                                @php
        $level = match (true) {
            $recommendation->score >= 5 => 'sangat',
            $recommendation->score >= 3 => 'cukup',
            $recommendation->score >= 1 => 'kurang',
            default => 'tidak',
        };

        $colorClasses = match ($level) {
            'sangat' => 'border-green-500 bg-green-50 hover:bg-green-100 text-green-900',
            'cukup' => 'border-yellow-500 bg-yellow-50 hover:bg-yellow-100 text-yellow-900',
            'kurang' => 'border-orange-500 bg-orange-50 hover:bg-orange-100 text-orange-900',
            'tidak' => 'border-red-500 bg-red-50 hover:bg-red-100 text-red-900',
            default => 'border-gray-300 bg-white hover:bg-gray-100 text-gray-900'
        };

        $levelText = match ($level) {
            'sangat' => 'Sangat Direkomendasikan',
            'cukup' => 'Cukup Direkomendasikan',
            'kurang' => 'Kurang Direkomendasikan',
            'tidak' => 'Tidak Direkomendasikan',
            default => 'Tidak Diketahui'
        };
                                @endphp

                                <div
                                    class="p-6 rounded-xl shadow-md border-2 transition-all duration-200 hover:scale-105 bg-white {{ $colorClasses }}">
                                    <h2 class="text-2xl font-semibold mb-2">{{ $recommendation->major->name }}</h2>
                                    <p class="text-lg font-medium">{{ $levelText }}</p>
                                </div>
                            @endforeach
                        </div>


                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>