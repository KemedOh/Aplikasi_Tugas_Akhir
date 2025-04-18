<?php

namespace App\Http\Controllers;

use App\Models\TemporaryRecommendation;
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
        $scores = [];

        foreach ($answers as $answer) {
            if ($answer->question && $answer->question->major_id) {
                $majorId = $answer->question->major_id;

                // boolean
                if ($answer->value == 1) {
                    $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
                }

                // pilihan ganda dengan jawaban benar
                if (!is_null($answer->option) && $answer->option->is_correct) {
                    $scores[$majorId] = ($scores[$majorId] ?? 0) + 2;
                }
            }
        }

        // Urutkan dari skor tertinggi
        arsort($scores);
        $topMajors = array_slice($scores, 0, 2, true);

        $results = [];
        $levelPriority = ['sangat' => 1, 'cukup' => 2, 'kurang' => 3, 'tidak' => 4];

        foreach (Major::all() as $major) {
            $score = $scores[$major->id] ?? 0;

            if ($score >= 5) {
                $level = 'sangat';
            } elseif ($score >= 3) {
                $level = 'cukup';
            } elseif ($score >= 1) {
                $level = 'kurang';
            } else {
                $level = 'tidak';
            }

            $results[] = [
                'major' => $major,
                'level' => $level,
            ];
        }

        // Urutkan berdasarkan prioritas level
        usort($results, function ($a, $b) use ($levelPriority) {
            return $levelPriority[$a['level']] <=> $levelPriority[$b['level']];
        });

        return view('recommendations.index', compact('results'));
    }

    public function intermediateResult(Request $request, $majorId)
    {
        $userId = Auth::id();

        // Ambil jurusan yang sedang dipilih
        $major = Major::findOrFail($majorId);

        // Ambil semua jawaban spesifik dari user untuk jurusan ini
        $answers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', fn($q) => 
                $q->where('category', 'spesifik')->where('major_id', $majorId)
            )
            ->with('option')
            ->get();

        // Hitung skor soal spesifik jurusan ini
        $score = 0;
        foreach ($answers as $answer) {
            if ($answer->option && $answer->option->is_correct) {
                $score++;
            }
        }

        // ✅ Update skor ke tabel temporary_recommendations
        TemporaryRecommendation::updateOrCreate(
            ['user_id' => $userId, 'major_id' => $majorId],
            ['score' => $score]
        );

        // Ambil jurusan rekomendasi lainnya
        $otherMajors = TemporaryRecommendation::where('user_id', $userId)
            ->where('major_id', '!=', $majorId)
            ->with('major')
            ->get();

        return view('recommendations.intermediate', compact('major', 'score', 'otherMajors'));
    }

    public function finalResult(Request $request)
    {
        $userId = Auth::id();

        // Ambil semua jurusan yang sangat & cukup direkomendasikan dari temporary_recommendations
        $recommendedMajors = TemporaryRecommendation::where('user_id', $userId)
            ->whereIn('level', ['sangat', 'cukup']) // Pastikan kolom 'level' ada
            ->pluck('major_id');

        // Ambil jurusan yang sudah dijawab oleh user dari kategori 'spesifik'
        $answeredMajorIds = UserAnswer::where('user_id', $userId)
            ->whereHas('question', fn($q) => $q->where('category', 'spesifik'))
            ->pluck('question.major_id')
            ->unique();

        // Cek apakah semua jurusan utama sudah dijawab
        $isComplete = $recommendedMajors->diff($answeredMajorIds)->isEmpty();

        if (!$isComplete) {
            return redirect()->route('dashboard')->with('error', 'Silakan selesaikan dulu soal khusus dari jurusan yang sangat dan cukup direkomendasikan.');
        }

        // Hitung skor akhir
        $userAnswers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', fn($q) => $q->where('category', 'spesifik'))
            ->with('question.option')
            ->get();

        $scores = [];
        foreach ($userAnswers as $answer) {
            $majorId = $answer->question->major_id;

            if ($answer->option && $answer->option->is_correct) {
                $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
            }
        }

        if (empty($scores)) {
            return view('recommendations.final', [
                'topMajor' => null,
                'topScore' => 0
            ]);
        }

        // Ambil skor tertinggi (tanpa prioritas)
        $maxScore = max($scores);
        $topMajorIds = array_keys($scores, $maxScore);
        sort($topMajorIds);
        $topMajorId = $topMajorIds[0];

        $topMajor = Major::findOrFail($topMajorId);
        $topScore = $scores[$topMajorId];

        return view('recommendations.final', compact('topMajor', 'topScore'));
    }
}