<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\UserAnswer;
use App\Models\Major;
use Illuminate\Support\Facades\Auth;
use App\Models\TemporaryRecommendation;
class QuestionController extends Controller
{
    // Tampilkan form pertanyaan berdasarkan kategori
    public function index(Request $request)
{
    $category = $request->query('category', 'umum');
    $majorId = $request->query('major_id');

    // Ambil pertanyaan berdasarkan kategori dan major_id
    $questions = Question::where('category', $category)
        ->when($category === 'spesifik' && $majorId, function ($query) use ($majorId) {
            return $query->where('major_id', $majorId);
        })
        ->with('options')
        ->inRandomOrder()
        ->get();

    // Pisahkan pertanyaan berdasarkan level
    $very_important_questions = $questions->filter(function ($question) {
        return $question->level === 'sangat'; // Pertanyaan sangat penting
    });

    $important_questions = $questions->filter(function ($question) {
        return $question->level === 'cukup'; // Pertanyaan cukup penting
    });

    return view('questions.index', compact('questions', 'category', 'majorId', 'very_important_questions', 'important_questions'));
}


public function submitAll(Request $request)
{
    $userId = Auth::id();
    $answers = $request->input('answers');

    foreach ($answers as $questionId => $answerData) {
        $question = Question::findOrFail($questionId);

        if ($question->answer_type == 'boolean') {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => $userId,
                    'question_id' => $questionId,
                ],
                [
                    'value' => (int) $answerData['value'],
                    'option_id' => null,  // Tidak ada option_id untuk boolean
                    'major_id' => $question->major_id,
                ]
            );
        } elseif ($question->answer_type === 'choice') {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => $userId,
                    'question_id' => $questionId,
                ],
                [
                    'value' => null,
                    'option_id' => $answerData['option_id'],  // Ini akan menyimpan option_id yang dipilih
                    'major_id' => $question->major_id,
                ]
            );
        }
    }


    // Hitung skor berdasarkan pertanyaan umum
    $scores = [];

    $userAnswers = UserAnswer::where('user_id', $userId)
        ->whereHas('question', fn($query) => $query->where('category', 'umum'))
        ->with('question')
        ->get();

    // Proses perhitungan skor
    foreach ($userAnswers as $answer) {
        $majorId = $answer->major_id;

        if ($answer->value == 1 && $majorId) {
            $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
        }
    }

    // Urutkan skor berdasarkan nilai tertinggi
    arsort($scores);
    $topMajors = array_slice($scores, 0, 2, true);

    // Bersihkan rekomendasi sementara yang lama
    TemporaryRecommendation::where('user_id', $userId)->delete();

    // Simpan rekomendasi jurusan teratas
    $i = 0;
    foreach ($topMajors as $majorId => $score) {
        TemporaryRecommendation::create([
            'user_id' => $userId,
            'major_id' => $majorId,
            'level' => $i === 0 ? 'sangat' : 'cukup',
        ]);
        $i++;
    }

    // Redirect ke halaman rekomendasi
    return redirect()->route('recommendations.show');
}
public function specialQuestions($majorId)
{
    $userId = Auth::id();

    // Ambil ID soal yang sudah dijawab oleh user
    $answeredQuestionIds = UserAnswer::where('user_id', $userId)
        ->pluck('question_id')
        ->toArray();

    // Ambil pertanyaan spesifik untuk jurusan yang belum dijawab
    $questions = Question::where('category', 'spesifik')
        ->where('major_id', $majorId)
        ->whereNotIn('id', $answeredQuestionIds)
        ->get();

    if ($questions->isEmpty()) {
        // Cek jurusan lain yang wajib dijawab
        $mandatoryMajors = TemporaryRecommendation::where('user_id', $userId)
            ->whereIn('level', ['sangat', 'cukup']) // Jurusan yang wajib
            ->pluck('major_id')
            ->toArray();

        foreach ($mandatoryMajors as $mandatoryMajorId) {
            $unansweredCount = Question::where('category', 'spesifik')
                ->where('major_id', $mandatoryMajorId)
                ->whereNotIn('id', $answeredQuestionIds)
                ->count();

            if ($unansweredCount > 0) {
                // Ada jurusan lain yang masih belum selesai, lanjut ke sana
                return redirect()->route('questions.nextSpecialQuestion', ['majorId' => $mandatoryMajorId]);
            }
        }

        // Semua jurusan sudah dijawab
        return redirect()->route('dashboard')->with('success', 'Semua pertanyaan untuk semua jurusan sudah dijawab!');
    }

    // Kalau masih ada pertanyaan untuk jurusan ini, tampilkan menggunakan view yang sama
    return view('questions.index', [
        'questions' => $questions,
        'category' => 'spesifik',  // Menandakan ini adalah soal spesifik
        'majorId' => $majorId,     // Kirimkan ID jurusan yang sedang diproses
    ]);
}


}