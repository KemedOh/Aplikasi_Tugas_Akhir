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

    $questions = Question::where('category', $category)
        ->when($category === 'spesifik' && $majorId, function ($query) use ($majorId) {
            return $query->where('major_id', $majorId);
        })
        ->with('options')
        ->inRandomOrder()
        ->get();

    return view('questions.index', compact('questions', 'category', 'majorId'));
}

public function submitAll(Request $request)
{
    $userId = Auth::id();
    $answers = $request->input('answers');

    foreach ($answers as $questionId => $answerData) {
        $question = Question::findOrFail($questionId);

        if ($question->answer_type === 'boolean') {
            UserAnswer::updateOrCreate(
                [
                    'user_id' => $userId,
                    'question_id' => $questionId,
                ],
                [
                    'value' => $answerData['value'],
                    'option_id' => null,
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
                    'option_id' => $answerData['option_id'],
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

    foreach ($userAnswers as $answer) {
        $majorId = $answer->question->major_id;

        if ($answer->value === 1 && $majorId) {
            $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
        }
    }

    // Simpan 2 jurusan teratas ke tabel temporary_recommendations
    arsort($scores);
    $topMajors = array_slice($scores, 0, 2, true);
    TemporaryRecommendation::where('user_id', $userId)->delete(); // bersihkan dulu

    $i = 0;
    foreach ($topMajors as $majorId => $score) {
        TemporaryRecommendation::create([
            'user_id' => $userId,
            'major_id' => $majorId,
            'level' => $i === 0 ? 'sangat' : 'cukup',
        ]);
        $i++;
    }

    return redirect()->route('recommendations.show');
}
}