<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Final Rekomendasi Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if($topMajor)
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-2xl p-6 mb-6 border-l-8 border-green-500">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                                {{ $topMajor->name }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-1">
                                Skor Akhir: <span class="font-bold text-green-600 text-lg">{{ $topScore }}</span>
                            </p>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mt-4">
                                <div class="bg-green-500 h-4 rounded-full" style="width: {{ min(100, $topScore * 20) }}%"></div>
                            </div>
                            <span class="inline-block bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full mt-3">
                                Sangat Direkomendasikan
                            </span>

                            @if($topMajor->description)
                                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $topMajor->description }}
                                </p>
                            @endif

                            <a href="{{ route('answers.detail', ['major' => $topMajor->id]) }}"
                                class="mt-4 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                Lihat Detail Jawaban
                            </a>
                        </div>

                        {{-- Jurusan lain --}}
                        @php
    $otherRecommendations = \App\Models\Recommendation::where('user_id', auth()->id())
        ->where('major_id', '!=', $topMajor->id)
        ->with('major')
        ->get();
                        @endphp

                        @foreach($otherRecommendations as $rec)
                            <div class="bg-white dark:bg-gray-700 shadow rounded-xl p-5 mb-4 border-l-8 border-yellow-400">
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">
                                    {{ $rec->major->name }}
                                </h4>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">
                                    Skor Akhir: <span class="font-bold text-yellow-500">{{ $rec->score }}</span>
                                </p>
                                <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-3 mt-2">
                                    <div class="bg-yellow-400 h-3 rounded-full" style="width: {{ min(100, $rec->score * 20) }}%"></div>
                                </div>
                                <span class="inline-block bg-yellow-400 text-white text-sm font-semibold px-3 py-1 rounded-full mt-3">
                                    Cukup Direkomendasikan
                                </span>

                                @if($rec->major->description)
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $rec->major->description }}
                                    </p>
                                @endif

                                <a href="{{ route('answers.detail', ['major' => $rec->major->id]) }}"
                                    class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                    Lihat Detail Jawaban
                                </a>
                            </div>
                        @endforeach

            @else
                <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 p-4 rounded-lg text-center">
                    <p>Belum ada hasil akhir. Silakan selesaikan dulu semua soal khusus jurusan.</p>
                </div>
            @endif

<div class="mt-8 text-center">
    @if($allAnswered)
        <a href="{{ route('dashboard') }}"
            class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition">
            Kembali ke Dashboard
        </a>
    @else
        @php
            // Cek dulu level topMajor di rekomendasi sementara
            $allowedLevels = ['sangat', 'cukup'];

            $isAllowed = \App\Models\TemporaryRecommendation::where('user_id', auth()->id())
                ->where('major_id', $topMajor->id)
                ->whereIn('level', $allowedLevels)
                ->exists(); // cek apakah ada datanya
        @endphp

        @if($isAllowed)
            <a href="{{ route('questions.nextSpecialQuestion', ['majorId' => $topMajor->id]) }}"
                class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition">
                Lanjutkan ke Pertanyaan Khusus
            </a>
        @else
            <p class="text-gray-500">Tidak ada pertanyaan khusus yang perlu dijawab untuk jurusan ini.</p>
        @endif
    @endif
</div>

        </div>
    </div>
</x-app-layout>