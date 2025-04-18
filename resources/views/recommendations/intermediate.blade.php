<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Sementara Rekomendasi Jurusan') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-8">Hasil Sementara</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($otherMajors as $otherMajor)
                        @php
                            $level = $otherMajor->level;
                            $colorClasses = match ($level) {
                                'sangat' => 'border-green-500 bg-green-50 hover:bg-green-100',
                                'cukup' => 'border-yellow-500 bg-yellow-50 hover:bg-yellow-100',
                                'kurang' => 'border-orange-500 bg-orange-50 hover:bg-orange-100',
                                'tidak' => 'border-red-500 bg-red-50 hover:bg-red-100',
                                default => 'border-gray-300 bg-white hover:bg-gray-100'
                            };

                            $levelText = match ($level) {
                                'sangat' => 'Sangat Direkomendasikan',
                                'cukup' => 'Cukup Direkomendasikan',
                                'kurang' => 'Kurang Direkomendasikan',
                                'tidak' => 'Tidak Direkomendasikan',
                                default => 'Tidak Diketahui'
                            };
                        @endphp

                        <a href="{{ route('recommendations.intermediate', ['majorId' => $otherMajor->major_id]) }}"
                            class="block p-6 rounded-xl shadow-lg border-2 transition hover:scale-105 {{ $colorClasses }}">
                            <h2 class="text-2xl font-semibold mb-2">
                                {{ $otherMajor->major->name }}
                            </h2>
                            <p class="text-lg text-gray-700">
                                {{ $levelText }}
                            </p>
                        </a>
            @endforeach
        </div>

        {{-- Cek apakah user sudah menjawab 2 jurusan utama --}}
        @if($otherMajors->isEmpty())
            <a href="{{ route('recommendations.final') }}"
                class="bg-green-600 text-white px-4 py-2 mt-6 inline-block rounded-lg hover:bg-green-700">
                Lihat Hasil Akhir
            </a>
        @else
            <p class="text-gray-600 mt-4">Silakan jawab jurusan rekomendasi lainnya terlebih dahulu.</p>
        @endif
    </div>

</x-app-layout>