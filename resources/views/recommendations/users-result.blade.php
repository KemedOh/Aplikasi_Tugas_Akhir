<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Rekomendasi User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 mt-4">
    <!-- Bagian Tombol Export -->
    <div class="flex gap-4 mb-4 items-end">
        <!-- Form Filter Berdasarkan Jurusan -->
        <form action="{{ route('recommendations.exportFiltered') }}" method="GET" class="flex gap-4 items-center">
            <div>
                <label for="major_id" class="mr-2 font-medium text-white">Pilih Jurusan:</label>
                <select name="major_id" id="major_id" class="border rounded px-2 py-1">
                    <option value="">Pilih Jurusan</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}">{{ $major->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Export Berdasarkan Jurusan
            </button>
        </form>
    
        <!-- Tombol Export Semua -->
        <a href="{{ route('recommendations.exportAll') }}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Export Semua Data
        </a>
    </div>


        <!-- Tabel Rekomendasi -->
        <div class="flex justify-center">
            <div class="w-full md:w-10/12">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h3 class="font-semibold text-lg">{{ __('Daftar Hasil Rekomendasi') }}</h3>
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border-b px-4 py-2">No</th>
                                    <th class="border-b px-4 py-2">Nama</th>
                                    <th class="border-b px-4 py-2">Email</th>
                                    <th class="border-b px-4 py-2">No. HP</th>
                                    <th class="border-b px-4 py-2">Sangat Direkomendasikan</th>
                                    <th class="border-b px-4 py-2">Cukup Direkomendasikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border-b px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border-b px-4 py-2">{{ $user->name }}</td>
                                        <td class="border-b px-4 py-2">{{ $user->email }}</td>
                                        <td class="border-b px-4 py-2">{{ $user->nomor_telepon ?? '-' }}</td>
                                        <td class="border-b px-4 py-2">
                                            {{ $user->recommendations->where('level', 'sangat_direkomendasikan')->first()?->major?->name ?? '-' }}
                                        </td>
                                        <td class="border-b px-4 py-2">
                                            {{ $user->recommendations->where('level', 'cukup_direkomendasikan')->first()?->major?->name ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($users->isEmpty())
                            <div class="text-center py-4">
                                <p class="text-gray-500">Belum ada hasil rekomendasi user.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>