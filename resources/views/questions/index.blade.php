<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pertanyaan Umum') }}
        </h2>
    </x-slot>
<div class="p-6 max-w-2xl mx-auto bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-800">Pertanyaan</h2>

    <div v-if="currentQuestion">
        <div class="my-4 p-4 bg-gray-100 rounded-md">
            <p class="text-lg">{{ currentIndex + 1 }}. {{ currentQuestion . question }}</p>
            <div class="flex gap-4 mt-2">
                <button @click="submitAnswer('ya')"
                    class="px-4 py-2 bg-gray-200 hover:bg-green-500 text-black rounded-md transition">
                    Ya
                </button>
                <button @click="submitAnswer('tidak')"
                    class="px-4 py-2 bg-gray-200 hover:bg-red-500 text-black rounded-md transition">
                    Tidak
                </button>
            </div>
        </div>
    </div>

    <div v-else>
        <p class="text-gray-500">Memuat pertanyaan...</p>
    </div>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                questions: [],
                currentIndex: 0,
            };
        },
        computed: {
            currentQuestion() {
                return this.questions[this.currentIndex] || null;
            }
        },
        mounted() {
            this.fetchQuestions();
        },
        methods: {
            async fetchQuestions() {
                try {
                    const response = await axios.get('/questions?category=umum');
                    this.questions = response.data;
                } catch (error) {
                    console.error("Error fetching questions", error);
                }
            },
            async submitAnswer(answer) {
                if (!this.currentQuestion) return;

                try {
                    await axios.post('/answers', {
                        question_id: this.currentQuestion.id,
                        answer: answer
                    });

                    console.log("Jawaban berhasil disimpan!");

                    if (this.currentIndex < this.questions.length - 1) {
                        this.currentIndex++; // Pindah ke pertanyaan berikutnya
                    } else {
                        alert("Selesai! Semua pertanyaan telah dijawab.");
                    }
                } catch (error) {
                    console.error("Gagal menyimpan jawaban", error);
                }
            }
        }
    };
</script>
</x-app-layout>