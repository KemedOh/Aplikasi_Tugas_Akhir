<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tentang Aplikasi dan Pembuatnya') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10 px-6 bg-white dark:bg-gray-900 rounded-xl shadow-md">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="flex-shrink-0">
                {{-- Ganti src foto di bawah dengan foto profil kamu --}}
                <img src="{{ asset('images/foto.jpg') }}" alt="Foto"
                    class="w-48 h-48 object-cover rounded-full shadow-lg">
            </div>
            <div class="text-gray-800 dark:text-gray-200">
                <h3 class="text-2xl font-bold mb-2">Profil</h3>
                <p class="mb-2">
                    lahir di <strong>Kapuas, 17 Mei 2004</strong>. Beralamat di Jl. Dr. Murjani, Kelurahan
                    Pahandut, Kecamatan Pahandut, Kota Palangkaraya, Provinsi Kalimantan Tengah.
                </p>
                <p class="mb-2">
                    Sejak kecil, memiliki ketertarikan besar pada bidang <strong>psikologi</strong>, khususnya
                    kemampuan membaca karakter seseorang hanya dengan sekali lihat. Keingintahuan tentang cara manusia
                    berpikir dan bertindak membuat terus belajar memahami emosi serta perilaku manusia secara
                    intuitif.
                </p>
                <p class="mb-2">
                    Walaupun minat awal adalah psikologi, memilih untuk menempuh jalur yang berbeda dengan
                    mengambil studi di bidang <strong>informatika</strong>. Dunia teknologi informasi justru menjadi
                    sarana lain bagi untuk mendalami pemahaman tentang manusia melalui pendekatan berbasis data
                    dan kecerdasan buatan.
                </p>
                <p class="mb-2">
                 menyelesaikan pendidikan Diploma (D3) di <strong>Politeknik LP3I Tasikmalaya</strong> dengan
                    Program Studi <strong>Manajemen Informatika</strong>. Dalam proses tersebut, mengangkat
                    tugas akhir berjudul:
                </p>
                <blockquote class="italic bg-gray-100 dark:bg-gray-800 p-4 rounded">
                    “Perancangan Aplikasi Web Berbasis Kecerdasan Buatan (Artificial Intelligence) untuk Membantu Calon
                    Mahasiswa Baru Memilih Jurusan yang Sesuai di Politeknik LP3I Tasikmalaya.”
                </blockquote>
                <p class="mt-4">
                    Meski sering bertingkah konyol hanya untuk melihat reaksi orang, sebenarnya adalah seorang
                    <strong>introvert</strong> yang suka merenung dan menikmati ruang pribadinya. Ia percaya bahwa
                    interaksi yang mendalam dengan orang lain adalah cara terbaik untuk memahami mereka. Dalam diam, ia
                    terus belajar, berkembang, dan mencintai proses mengenal dunia serta diri sendiri.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>