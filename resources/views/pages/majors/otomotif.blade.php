<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prospek Kerja Jurusan Otomotif') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <!-- Gambar sementara -->
        <div class="mb-6">
            <img src="{{ asset('images/fotosementara.jpg') }}" alt="Teknik Otomotif"
                class="w-full sm:w-2/3 h-auto object-cover rounded-lg border border-gray-300 mx-auto">
        </div>

        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Teknik Otomotif (D2)</h3>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Jurusan Teknik Otomotif memberikan pembelajaran yang mendalam tentang teknologi kendaraan bermotor, sistem
            kelistrikan, sistem mesin, dan perawatan kendaraan. Mahasiswa akan dilatih untuk mengidentifikasi kerusakan,
            melakukan perbaikan, serta merawat mesin kendaraan dengan standar industri terkini.
        </p>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Dengan peningkatan jumlah kendaraan dan kebutuhan untuk perawatan kendaraan yang terus meningkat, jurusan
            ini sangat relevan dan akan terus dibutuhkan oleh berbagai industri otomotif.
        </p>

        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mt-6 mb-2">Prospek Karir</h4>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
            <li>Teknisi Otomotif</li>
            <li>Service Advisor</li>
            <li>Ahli Kelistrikan Otomotif</li>
            <li>Supervisor Bengkel</li>
            <li>Quality Control Otomotif</li>
            <li>Sales & Marketing Sparepart Otomotif</li>
            <li>Entrepreneur (membuka bengkel otomotif)</li>
        </ul>

        <p class="mt-4 text-gray-700 dark:text-gray-300">
            Lulusan Teknik Otomotif memiliki banyak peluang untuk bekerja di bengkel otomotif, perusahaan manufaktur
            kendaraan, dealer mobil, serta dapat mengembangkan usaha pribadi di sektor otomotif. Dengan keahlian di
            bidang ini, mereka juga dapat bekerja di perusahaan-perusahaan global yang bergerak di bidang otomotif.
        </p>
    </div>
</x-app-layout>