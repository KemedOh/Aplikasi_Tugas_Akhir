<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prospek Kerja Jurusan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <!-- Gambar sementara -->
        <div class="mb-6">
            <img src="{{ asset('images/fotosementara.jpg') }}" alt="Manajemen Keuangan"
                class="w-full sm:w-2/3 h-auto object-cover rounded-lg border border-gray-300 mx-auto">
        </div>

        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Manajemen Keuangan (D3)</h3>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Manajemen Keuangan adalah jurusan yang fokus pada pengelolaan keuangan perusahaan, perencanaan keuangan,
            analisis investasi, dan pengendalian anggaran. Mahasiswa akan mempelajari konsep-konsep dasar tentang
            akuntansi, pasar modal, serta cara-cara mengelola dan mengatur uang dalam konteks bisnis.
        </p>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Dengan kurikulum yang mempersiapkan mahasiswa untuk menghadapi dunia keuangan yang terus berkembang, jurusan
            ini cocok bagi mereka yang tertarik dalam bidang akuntansi, investasi, atau manajemen risiko.
        </p>

        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mt-6 mb-2">Prospek Karir</h4>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
            <li>Financial Analyst</li>
            <li>Accountant</li>
            <li>Tax Consultant</li>
            <li>Investment Analyst</li>
            <li>Banker</li>
            <li>Auditor</li>
            <li>Risk Manager</li>
        </ul>

        <p class="mt-4 text-gray-700 dark:text-gray-300">
            Lulusan Manajemen Keuangan memiliki banyak peluang karir di sektor keuangan, bank, lembaga keuangan, dan
            perusahaan-perusahaan besar yang memerlukan pengelolaan keuangan yang tepat dan efisien.
        </p>
    </div>
</x-app-layout>