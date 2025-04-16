<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pertanyaan Umum') }}
        </h2>
    </x-slot>
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold text-center mb-8">Hasil Rekomendasi Jurusan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @if(empty($results))
            <p class="text-center text-gray-500">Belum ada hasil rekomendasi yang tersedia.</p>
        @else
        @foreach($results as $result)
            <div
                class="p-6 rounded-xl shadow-lg border-2
                    {{ $result['level'] === 'sangat' ? 'border-green-500 bg-green-50' : 'border-yellow-500 bg-yellow-50' }}">
                <h2 class="text-2xl font-semibold mb-2">
                    {{ $result['major']->name }}
                </h2>
                <p class="text-lg text-gray-700">
                    {{ $result['level'] === 'sangat' ? 'Sangat Direkomendasikan' : 'Cukup Direkomendasikan' }}
                </p>
            </div>
        @endforeach
        @endif
    </div>
</div>



</x-app-layout>