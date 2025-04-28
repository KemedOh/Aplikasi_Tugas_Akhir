<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            Jawaban Anda untuk Jurusan {{ $major->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">

            @if($answers->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-300">
                    Belum ada jawaban untuk jurusan ini.
                </p>
            @else
                <ul class="space-y-4">
                    @foreach($answers as $answer)
                        <li class="p-4 bg-gray-100 dark:bg-gray-700 rounded-xl">
                            <p class="text-gray-800 dark:text-white font-semibold">
                                {{ $answer->question->question }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                Jawaban Anda: <span class="font-medium">{{ $answer->option->text ?? '-' }}</span>
                                @if($answer->option && $answer->option->is_correct)
                                    <span class="ml-2 inline-block px-2 py-1 bg-green-500 text-white text-xs rounded-full">
                                        Benar
                                    </span>
                                @else
                                    <span class="ml-2 inline-block px-2 py-1 bg-red-500 text-white text-xs rounded-full">
                                        Salah
                                    </span>
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>