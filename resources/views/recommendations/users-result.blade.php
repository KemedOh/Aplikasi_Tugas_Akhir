<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Hasil Rekomendasi User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 mt-6">
        <!-- Bagian Tombol Export -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Export Data</h3>
            <div class="flex flex-wrap gap-4 items-end">
                <!-- Excel Filter -->
                <form action="{{ route('recommendations.exportFiltered') }}" method="GET" class="flex items-end gap-2">
                    <div>
                        <label for="major_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Excel -
                            Pilih Jurusan</label>
                        <select name="major_id" id="major_id"
                            class="mt-1 border rounded px-3 py-2 w-48 dark:bg-gray-700 dark:text-white">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        Export Excel
                    </button>
                </form>

                <!-- Semua Excel -->
                <a href="{{ route('recommendations.exportAll') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                    Export Semua Excel
                </a>

                <!-- PDF Filter -->
                <form action="{{ route('recommendations.exportPdfFiltered') }}" method="GET"
                    class="flex items-end gap-2">
                    <div>
                        <label for="major_id_pdf" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PDF
                            - Pilih Jurusan</label>
                        <select name="major_id" id="major_id_pdf"
                            class="mt-1 border rounded px-3 py-2 w-48 dark:bg-gray-700 dark:text-white">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                        Export PDF
                    </button>
                </form>

                <!-- Semua PDF -->
                <a href="{{ route('recommendations.exportPdf') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                    Export Semua PDF
                </a>
            </div>
        </div>

        <!-- Tabel Hasil Rekomendasi -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="bg-gray-100 dark:bg-gray-700 px-6 py-3">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Hasil Rekomendasi</h3>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-800 dark:text-gray-100">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
                        <tr>
                            <th class="px-4 py-2 border-b">No</th>
                            <th class="px-4 py-2 border-b">Nama</th>
                            <th class="px-4 py-2 border-b">Email</th>
                            <th class="px-4 py-2 border-b">No. HP</th>
                            <th class="px-4 py-2 border-b">Sangat Direkomendasikan</th>
                            <th class="px-4 py-2 border-b">Cukup Direkomendasikan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($users as $index => $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ $user->nomor_telepon ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    {{ $user->recommendations->where('level', 'sangat_direkomendasikan')->first()?->major?->name ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $user->recommendations->where('level', 'cukup_direkomendasikan')->first()?->major?->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                    Belum ada hasil rekomendasi user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>