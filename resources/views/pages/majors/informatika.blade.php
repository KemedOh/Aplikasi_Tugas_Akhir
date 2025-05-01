<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prospek Kerja Jurusan Informatika') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <!-- Gambar sementara dengan lebar lebih kecil -->
        <div class="mb-6">
            <img src="{{ asset('images/fotosementara.jpg') }}" alt="Teknik Informatika"
                class="w-full sm:w-2/3 h-auto object-cover rounded-lg border border-gray-300 mx-auto">
        </div>

        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Teknik Informatika (D2)</h3>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Jurusan Teknik Informatika di Politeknik LP3I Tasikmalaya dirancang untuk mencetak lulusan yang menguasai
            teknologi informasi dan pemrograman komputer. Selama masa studi, mahasiswa akan dibekali dengan pengetahuan
            tentang dasar-dasar pemrograman, pengembangan perangkat lunak, sistem basis data, keamanan jaringan, dan
            pengelolaan proyek IT.
        </p>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Tidak hanya teori, pendekatan pembelajaran berbasis praktik juga menjadi kekuatan utama jurusan ini.
            Mahasiswa akan banyak berinteraksi dengan proyek nyata dan simulasi dunia kerja, sehingga mereka siap
            bersaing secara profesional begitu lulus.
        </p>

        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mt-6 mb-2">Prospek Karir</h4>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
            <li>Programmer / Software Developer</li>
            <li>Web Developer</li>
            <li>IT Support Specialist</li>
            <li>Database Administrator</li>
            <li>Network Engineer</li>
            <li>System Analyst</li>
            <li>Technopreneur (wirausaha berbasis teknologi)</li>
        </ul>

        <p class="mt-4 text-gray-700 dark:text-gray-300">
            Lulusan Teknik Informatika sangat dicari di berbagai sektor, baik di perusahaan teknologi, startup,
            institusi pendidikan, perbankan, hingga industri kreatif. Dengan pertumbuhan teknologi yang pesat, jurusan
            ini menjadi pilihan yang sangat strategis bagi generasi muda yang ingin berkarier di dunia digital.
        </p>
    </div>
</x-app-layout>