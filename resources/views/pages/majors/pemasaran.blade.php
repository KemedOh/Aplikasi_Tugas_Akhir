<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Prospek Kerja Jurusan Pemasaran') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 rounded-lg shadow-md">
        <!-- Gambar sementara -->
        <div class="mb-6">
            <img src="{{ asset('images/fotosementara.jpg') }}" alt="Manajemen Pemasaran"
                class="w-full sm:w-2/3 h-auto object-cover rounded-lg border border-gray-300 mx-auto">
        </div>

        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Manajemen Pemasaran (D3)</h3>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Manajemen Pemasaran adalah jurusan yang memfokuskan pembelajaran pada strategi pemasaran, riset pasar,
            komunikasi bisnis, dan perilaku konsumen. Mahasiswa akan mempelajari cara mengelola dan mengembangkan
            produk, merancang strategi pemasaran yang efektif, serta memahami tren pasar yang sedang berkembang.
        </p>
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
            Dalam jurusan ini, mahasiswa juga diajarkan bagaimana cara beradaptasi dengan perubahan cepat dalam dunia
            bisnis dan teknologi untuk menjadi pemasar yang kompeten.
        </p>

        <h4 class="text-xl font-semibold text-gray-800 dark:text-white mt-6 mb-2">Prospek Karir</h4>
        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 space-y-1">
            <li>Marketing Executive</li>
            <li>Brand Manager</li>
            <li>Product Manager</li>
            <li>Public Relations Specialist</li>
            <li>Market Research Analyst</li>
            <li>Advertising Specialist</li>
            <li>Entrepreneur (membuka bisnis sendiri)</li>
        </ul>

        <p class="mt-4 text-gray-700 dark:text-gray-300">
            Lulusan Manajemen Pemasaran sangat dibutuhkan oleh perusahaan-perusahaan di berbagai sektor, seperti retail,
            teknologi, e-commerce, FMCG, dan periklanan. Mereka juga memiliki kesempatan untuk menjadi pebisnis sukses
            dengan memulai usaha mereka sendiri.
        </p>
    </div>
</x-app-layout>