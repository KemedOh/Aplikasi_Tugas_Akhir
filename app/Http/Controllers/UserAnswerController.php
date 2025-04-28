<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Major;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class UserAnswerController extends Controller
{
    // Menyimpan satu jawaban (kalau perlu)
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_id' => 'required|exists:question_options,id',
            'major_id' => 'nullable|exists:majors,id',
        ]);

        $userAnswer = UserAnswer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'option_id' => $request->option_id,
            'major_id' => $request->major_id,
        ]);

        return response()->json($userAnswer, 201);
    }

    // Menyimpan semua jawaban sekaligus (submit form)
public function submitAll(Request $request)
{
    $userId = Auth::id();
    $answers = $request->input('answers');

    foreach ($answers as $questionId => $answer) {
        $question = Question::findOrFail($questionId); // Penting!

        $data = [
            'user_id' => $userId,
            'question_id' => $questionId,
            'major_id' => $question->major_id, // Ambil dari pertanyaan
        ];

        if (isset($answer['option_id'])) {
            $data['option_id'] = $answer['option_id'];
        } elseif (isset($answer['value'])) {
            $data['option_id'] = $answer['value'];
        }
    dd($data); // << tambahkan ini sebelum create

        UserAnswer::create($data);
    }

    return redirect()->route('dashboard')->with('success', 'Jawaban berhasil disimpan!');
}


    // Menghitung hasil dari jawaban soal khusus
    public function calculateResult($userId)
    {
        $userAnswers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', function ($query) {
                $query->where('category', 'spesifik');
            })
            ->with('option')
            ->get();

        $scores = [];

        foreach ($userAnswers as $answer) {
            $majorId = $answer->major_id;

            if ($answer->option && $answer->option->is_correct) {
                $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
            }
        }

        Recommendation::where('user_id', $userId)->delete();

        arsort($scores);
        $i = 0;
        foreach ($scores as $majorId => $score) {
            Recommendation::create([
                'user_id' => $userId,
                'major_id' => $majorId,
                'score' => $score,
                'level' => $i === 0 ? 'sangat_direkomendasikan' : 'cukup_direkomendasikan',
            ]);
            $i++;
            if ($i >= 2) break;
        }

        $topMajorId = array_key_first($scores);
        $topMajor = Major::find($topMajorId);
        $topScore = $scores[$topMajorId] ?? 0;

        return response()->json([
            'recommended_major' => $topMajor,
            'top_score' => $topScore,
            'scores' => $scores,
        ]);
    }

    // Menampilkan detail jawaban spesifik
    public function detail($majorId)
    {
        $userId = Auth::id();
        $major = Major::findOrFail($majorId);

        $answers = UserAnswer::with(['question', 'option'])
            ->where('user_id', $userId)
            ->whereHas('question', function ($q) use ($majorId) {
                $q->where('category', 'spesifik')->where('major_id', $majorId);
            })
            ->get();

        return view('answers.detail', compact('major', 'answers'));
    }
}