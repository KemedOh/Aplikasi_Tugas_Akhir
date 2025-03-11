<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Major;

class UserAnswerController extends Controller
{
    // Menyimpan jawaban pengguna
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|string',
        ]);

        $userAnswer = UserAnswer::create([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
        ]);

        return response()->json($userAnswer, 201);
    }

    // Menghitung hasil dan memberikan rekomendasi jurusan
    public function calculateResult($userId)
    {
        // Menghitung jumlah jawaban per jurusan
        $results = UserAnswer::where('user_id', $userId)
            ->join('questions', 'user_answers.question_id', '=', 'questions.id')
            ->whereNotNull('questions.major_id')
            ->selectRaw('questions.major_id, COUNT(*) as score')
            ->groupBy('questions.major_id')
            ->orderByDesc('score')
            ->get();

        if ($results->isEmpty()) {
            return response()->json(['message' => 'Belum ada cukup data untuk rekomendasi'], 400);
        }

        // Jurusan dengan skor tertinggi
        $bestMajor = Major::find($results->first()->major_id);

        return response()->json([
            'recommended_major' => $bestMajor->name,
            'scores' => $results
        ]);
    }
}