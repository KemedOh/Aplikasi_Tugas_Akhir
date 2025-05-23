<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pertanyaan Umum') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-8">Hasil Rekomendasi Jurusan</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($results as $result)
                        @php
                            $level = $result['level'];
                            $major = $result['major'];

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

                        <a href="{{ route('questions.index', ['category' => 'spesifik', 'major_id' => $major->id]) }}"
                            class="alert-button block p-6 rounded-xl shadow-lg border-2 transition hover:scale-105 {{ $colorClasses }}"
                            data-level="{{ $level }}">
                            <h2 class="text-2xl font-semibold mb-2">
                                {{ $major->name }}
                            </h2>
                            <p class="text-lg text-gray-700">
                                {{ $levelText }}
                            </p>
                        </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">Belum ada hasil rekomendasi yang tersedia.</p>
            @endforelse
        </div>

        {{-- Cek jika user sudah menjawab jurusan rekomendasi yang sangat dan cukup --}}
        @php
            $resultsCollection = collect($results);
        @endphp

        @if(
            $resultsCollection->where('level', 'sangat')->isNotEmpty() &&
            $resultsCollection->where('level', 'cukup')->isNotEmpty() &&
            $answeredSpecialCount >= 2
        )
                    <a href="{{ route('recommendations.final') }}"
                        class="bg-green-600 text-white px-4 py-2 mt-6 inline-block rounded-lg hover:bg-green-700">
                        Lihat Hasil Akhir
                    </a>
        @else
            <div class="mt-6 px-4 py-3 border-l-4 border-yellow-500 bg-yellow-50 text-yellow-800 rounded shadow">
                <strong>Perhatian:</strong> Silakan jawab soal spesifik untuk jurusan yang <span
                    class="font-semibold">sangat</span>
                dan <span class="font-semibold">cukup</span> direkomendasikan terlebih dahulu sebelum melihat hasil akhir.
            </div>
        @endif
    </div>

    {{-- ✅ SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alertButtons = document.querySelectorAll('.alert-button');

            alertButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    const level = button.dataset.level;

                    if (level === 'kurang' || level === 'tidak') {
                        event.preventDefault(); // Mencegah default redirect sementara

                        Swal.fire({
                            title: 'Peringatan!',
                            text: `Jurusan ini ${level} direkomendasikan berdasarkan jawaban Anda. Apakah Anda yakin ingin melanjutkan?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, lanjutkan!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = button.getAttribute('href');
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>