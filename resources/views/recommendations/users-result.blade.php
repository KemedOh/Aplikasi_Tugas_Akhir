<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Rekomendasi User') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 mt-4">
        <div class="flex justify-end mb-4">
            <a href="{{ route('recommendations.export') }}"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Export ke Excel
            </a>
        </div>

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
                                    {{-- @dd($user->recommendations->pluck('level', 'major_id')) --}}


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