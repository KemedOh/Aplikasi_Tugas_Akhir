<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pertanyaan Umum') }}
        </h2>
    </x-slot>
<div class="max-w-4xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Daftar Pertanyaan</h1>

    <form action="{{ route('questions.submitAll') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white shadow-md rounded-lg p-6">
            @if($questions->isEmpty())
                <p class="text-gray-500 text-center">Tidak ada pertanyaan yang tersedia.</p>
            @else
                <ul class="space-y-6">
                    @foreach($questions as $index => $question)
                        <li class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <h2 class="text-lg font-semibold mb-3">
                                {{ $index + 1 }}. {{ $question->text }}
                            </h2>

                            {{-- BOOLEAN (Ya/Tidak) --}}
                            @if($question->answer_type === 'boolean')
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $question->id }}][value]" value="1"
                                            class="form-radio text-green-600" required>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $question->id }}][value]" value="0"
                                            class="form-radio text-red-600" required>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>

                                {{-- CHOICE --}}
                            @elseif($question->answer_type === 'choice' && $question->options)
                                <div class="space-y-2 mt-2">
                                    @foreach($question->options as $option)
                                        <label class="flex items-center">
                                            <input type="radio" name="answers[{{ $question->id }}][option_id]" value="{{ $option->id }}"
                                                class="form-radio text-indigo-600" required>
                                            <span class="ml-2">{{ $option->option_text }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if(!$questions->isEmpty())
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow transition-all">
                    Simpan Jawaban
                </button>
            </div>
        @endif
    </form>
</div>


</x-app-layout>