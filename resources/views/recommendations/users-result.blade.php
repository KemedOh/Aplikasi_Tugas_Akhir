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
<!-- Gabungkan Form PDF dan Excel -->
<form method="GET" class="flex items-end gap-2">
    <!-- Nomor Urut Mulai -->
    <div class="w-full sm:w-auto">
        <label for="start_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut
            Mulai</label>
        <input type="number" name="start_number" id="start_number" min="1"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
            value="{{ old('start_number') }}" onchange="adjustNumber()" />
    </div>
    
    <!-- Nomor Urut Akhir -->
    <div class="w-full sm:w-auto">
        <label for="end_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut Akhir</label>
        <input type="number" name="end_number" id="end_number" min="1"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
            value="{{ old('end_number') }}" onchange="adjustNumber()" />
    </div>
    
    
    <!-- Nama -->
    <div class="w-full sm:w-auto">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
        <input type="text" name="name" id="name" placeholder="Masukkan Nama"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
    </div>
    <div>
        <label for="major_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Jurusan</label>
        <select name="major_id" id="major_id"
            class="mt-1 border rounded px-3 py-2 w-48 dark:bg-gray-700 dark:text-white">
            <option value="">Pilih Jurusan</option>
            @foreach ($majors as $major)
                <option value="{{ $major->id }}">{{ $major->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tombol Export Excel -->
    <div>
        <button type="submit" formaction="{{ route('recommendations.exportFiltered') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Export Excel
        </button>
    </div>

    <!-- Semua Excel -->
    <div class="w-full sm:w-auto mt-4">
        <button type="submit" formaction="{{ route('recommendations.exportAll') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
            Export Semua Excel
        </button>
    </div>
    
        <!-- Tombol Export PDF -->
        <div>
            <button type="submit" formaction="{{ route('recommendations.exportPdfFiltered') }}"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                Export PDF
            </button>
        </div>

    <!-- Semua PDF -->
    <div class="w-full sm:w-auto mt-4">
        <button type="submit" formaction="{{ route('recommendations.exportPdf') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
            Export Semua PDF
        </button>
    </div>

</form>

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
<script>
    function adjustNumber() {
        let start = parseInt(document.getElementById("start_number").value);
        let end = parseInt(document.getElementById("end_number").value);
        if (!isNaN(start) && !isNaN(end) && end < start) {
            document.getElementById("end_number").value = start;
        }
    }
</script>