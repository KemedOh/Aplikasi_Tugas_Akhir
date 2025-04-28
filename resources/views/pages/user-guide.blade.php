<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panduan Pengguna Aplikasi') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 px-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
        <h1 class="text-3xl font-bold mb-6">📘 Panduan Pengguna Aplikasi Rekomendasi Jurusan</h1>

        <p class="mb-4">Selamat datang di aplikasi <strong>Rekomendasi Jurusan</strong>! Aplikasi ini dirancang untuk
            membantu kamu menemukan jurusan kuliah yang paling sesuai berdasarkan jawaban dari pertanyaan umum dan
            khusus. Ikuti langkah-langkah di bawah ini:</p>

        <ol class="list-decimal list-inside space-y-4">
            <li>
                <strong>Login ke Aplikasi</strong>
                <br>
                Masuk menggunakan akun yang telah terdaftar. Jika belum memiliki akun, silakan registrasi terlebih
                dahulu.
            </li>

            <li>
                <strong>Jawab Pertanyaan Umum</strong>
                <br>
                Setelah masuk, klik tombol <em>"Mulai Pertanyaan"</em> untuk mengisi pertanyaan umum. Pertanyaan ini
                digunakan untuk menyaring jurusan awal yang cocok untuk kamu.
            </li>

            <li>
                <strong>Lihat Rekomendasi Jurusan</strong>
                <br>
                Setelah menjawab semua pertanyaan umum, kamu akan langsung diarahkan ke halaman <strong>Hasil
                    Rekomendasi Sementara</strong> yang menampilkan jurusan dengan label:
                <ul class="list-disc list-inside ml-4">
                    <li><span class="text-green-600 font-semibold">Sangat Direkomendasikan</span></li>
                    <li><span class="text-yellow-500 font-semibold">Cukup Direkomendasikan</span></li>
                    <li><span class="text-orange-500 font-semibold">Kurang Direkomendasikan</span></li>
                    <li><span class="text-red-600 font-semibold">Tidak Direkomendasikan</span></li>
                </ul>
            </li>

            <li>
                <strong>Kerjakan Soal Spesifik</strong>
                <br>
                Pilih jurusan dari hasil rekomendasi untuk mengerjakan pertanyaan <em>khusus</em>. Minimal kamu harus
                menjawab pertanyaan dari jurusan yang "sangat" dan "cukup" direkomendasikan.
            </li>

            <li>
                <strong>Lihat Hasil Akhir</strong>
                <br>
                Setelah menjawab dua jurusan tersebut, tombol <strong>"Lihat Hasil Akhir"</strong> akan muncul. Klik
                tombol tersebut untuk melihat jurusan terbaik berdasarkan seluruh jawaban kamu.
            </li>
        </ol>

        <h2 class="text-2xl font-semibold mt-10 mb-4">❓ Pertanyaan yang Sering Diajukan (FAQ)</h2>

        <ul class="space-y-4">
            <li>
                <strong>Apakah saya bisa menjawab ulang?</strong><br>
                Tidak. Setelah menjawab semua pertanyaan dan melihat hasil akhir, jawaban tidak bisa diubah untuk
                menjaga kevalidan hasil.
            </li>
            <li>
                <strong>Apa yang dimaksud dengan soal spesifik?</strong><br>
                Soal spesifik adalah pertanyaan tambahan yang ditujukan untuk menguji pemahaman atau minat kamu pada
                jurusan tertentu.
            </li>
            <li>
                <strong>Mengapa tombol "Lihat Hasil Akhir" belum muncul?</strong><br>
                Kamu harus menjawab pertanyaan khusus dari dua jurusan: satu yang "sangat direkomendasikan" dan satu
                yang "cukup direkomendasikan".
            </li>
        </ul>

        <p class="mt-10 text-sm text-gray-500 dark:text-gray-400">Terima kasih telah menggunakan aplikasi ini. Semoga
            kamu menemukan jurusan yang paling tepat untuk masa depanmu! 🌟</p>
    </div>
</x-app-layout>