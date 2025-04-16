<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;
use App\Models\Major;

class RecommendationController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        // Dapatkan semua jawaban user
        $answers = UserAnswer::where('user_id', $userId)
    ->with(['question', 'option']) // ← penting agar relasi terbaca
    ->get();


        // Hitung skor per jurusan
        // Hitung skor per jurusan
$scores = [];

foreach ($answers as $answer) {
    if ($answer->question && $answer->question->major_id) {
        $majorId = $answer->question->major_id;

        // boolean
        if ($answer->value === 1) {
            $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
        }

        // pilihan ganda dengan jawaban benar
        if (!is_null($answer->option) && $answer->option->is_correct){
            $scores[$majorId] = ($scores[$majorId] ?? 0) + 2;
        }
    }
    arsort($scores);
dd($scores);
}




        // Urutkan dari skor tertinggi
        arsort($scores);
        $topMajors = array_slice($scores, 0, 2, true);

        $results = [];
        $i = 0;
        foreach ($topMajors as $majorId => $score) {
            $major = Major::find($majorId);
            $results[] = [
                'major' => $major,
                'level' => $i == 0 ? 'sangat' : 'cukup',
            ];
            $i++;
        }

        return view('recommendations.index', compact('results'));
    }
}