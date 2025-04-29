<?php

namespace App\Http\Controllers;

use App\Exports\RecommendationsExport;
use App\Models\TemporaryRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;
use App\Models\Major;
use App\Models\Question;
use App\Models\Recommendation;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RecommendationController extends Controller
{
    public function exportPdfFiltered(Request $request)
{
    $majorId = $request->input('major_id');

    $users = User::with(['recommendations.major'])
        ->whereHas('recommendations', function ($query) use ($majorId) {
            $query->where('major_id', $majorId);
        })->get();

    return Pdf::loadView('recommendations.export-pdf', compact('users'))
        ->setPaper('A4', 'landscape')
        ->download('rekomendasi_user_filtered.pdf');
}
public function exportPdf()
{
    $users = User::with('recommendations.major')->get();

    return Pdf::loadView('recommendations.export-pdf', compact('users'))
        ->setPaper('A4', 'landscape')
        ->download('rekomendasi_user.pdf');
}
    // Tampilkan Form Export
    public function showExportForm()
    {
        // Ambil data jurusan untuk dropdown
        $majors = Major::all();

        return view('recommendations.export', compact('majors'));
    }

    // Export Semua Data
    public function exportAll(Request $request)
    {
        // Export semua data tanpa filter
        return Excel::download(new RecommendationsExport(), 'semua_rekomendasi_user.xlsx');
    }

    // Export Data dengan Filter Jurusan
    public function exportFiltered(Request $request)
    {
        // Mendapatkan major_id yang dipilih dari filter
        $majorId = $request->input('major_id');

        // Export data berdasarkan jurusan yang dipilih
        return Excel::download(new RecommendationsExport($majorId), 'rekomendasi_user_filtered.xlsx');
    }
public function adminResults()
{
    // Ambil semua user yang memiliki rekomendasi (final)
    $users = User::with(['recommendations.major'])
        ->whereHas('recommendations') // hanya user yang memiliki rekomendasi
        ->get();

    $majors = Major::all();
return view('recommendations.users-result', compact('users', 'majors'));
}
public function export()
{
    return Excel::download(new RecommendationsExport, 'hasil_rekomendasi_user.xlsx');
}

public function show()
{
    $userId = Auth::id();

    // Ambil semua jawaban user
    $answers = UserAnswer::where('user_id', $userId)
        ->with(['question', 'option'])
        ->get();

    $scores = [];
    $hasGeneralAnswers = false;

    foreach ($answers as $answer) {
        if ($answer->question && $answer->question->category === 'umum') {
            $hasGeneralAnswers = true;
        }

        if ($answer->question && $answer->question->major_id) {
            $majorId = $answer->question->major_id;

            if ($answer->value == 1) {
                $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
            }

            if (!is_null($answer->option) && $answer->option->is_correct) {
                $scores[$majorId] = ($scores[$majorId] ?? 0) + 2;
            }
        }
    }

    $levelPriority = ['sangat' => 1, 'cukup' => 2, 'kurang' => 3, 'tidak' => 4];
    $tempResults = [];

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

        $tempResults[] = [
            'major' => $major,
            'level' => $level,
        ];
    }

    // DEBUGGING: Periksa isi $tempResults sebelum diurutkan
    Log::debug('Temp Results Before Sorting: ', $tempResults);

    // Urutkan berdasarkan prioritas level
    usort($tempResults, function ($a, $b) use ($levelPriority) {
        return $levelPriority[$a['level']] <=> $levelPriority[$b['level']];
    });

    // DEBUGGING: Periksa isi $tempResults setelah diurutkan
    Log::debug('Temp Results After Sorting: ', $tempResults);

    // Langsung ambil semua hasil
    $results = collect($tempResults);

    // DEBUGGING: Periksa hasil akhir di $results
    Log::debug('Final Results: ', $results->toArray());

    // Cek berapa jurusan sangat dan cukup yang sudah dijawab soal spesifiknya
    $recommendedMajors = $results->whereIn('level', ['sangat', 'cukup'])->pluck('major.id');

    $answeredSpecialCount = UserAnswer::where('user_id', $userId)
        ->whereHas('question', function ($query) use ($recommendedMajors) {
            $query->whereIn('major_id', $recommendedMajors)
                  ->where('category', 'spesifik');
        })
        ->select('question_id')
        ->distinct()
        ->pluck('question.major_id')
        ->unique()
        ->count();

    $hasSpecificAnswers = UserAnswer::where('user_id', $userId)
        ->whereHas('question', function ($query) {
            $query->where('category', 'spesifik');
        })
        ->exists();

    return view('recommendations.index', [
        'results' => $results,
        'answeredSpecialQuestions' => $answeredSpecialCount >= 2,
        'answeredSpecialCount' => $answeredSpecialCount,
        'hasGeneralAnswers' => $hasGeneralAnswers,
        'hasSpecificAnswers' => $hasSpecificAnswers,
    ]);
}


    public function intermediateResult(Request $request, $majorId)
    {
        $userId = Auth::id();

        $major = Major::findOrFail($majorId);

        $answers = UserAnswer::where('user_id', $userId)
            ->whereHas('question', fn($q) => 
                $q->where('category', 'spesifik')->where('major_id', $majorId)
            )
            ->with('option')
            ->get();

        $score = 0;
        foreach ($answers as $answer) {
            if ($answer->option && $answer->option->is_correct) {
                $score++;
            }
        }

        $level = $this->determineLevel($score);

        TemporaryRecommendation::updateOrCreate(
            ['user_id' => $userId, 'major_id' => $majorId],
            ['score' => $score, 'level' => $level]
        );

        $otherMajors = TemporaryRecommendation::where('user_id', $userId)
            ->where('major_id', '!=', $majorId)
            ->with('major')
            ->get();

        return view('recommendations.intermediate', compact('major', 'score', 'otherMajors'));
    }

public function finalResult(Request $request)
{
    $userId = Auth::id();

    // Ambil semua jawaban dari form
    $answers = $request->input('answers', []);
    $majorId = $request->input('major_id');

    // Simpan ke tabel user_answers
    foreach ($answers as $questionId => $answer) {
    $question = Question::find($questionId); // 🔥 ambil data pertanyaan dari database

    UserAnswer::updateOrCreate(
        [
            'user_id' => $userId,
            'question_id' => $questionId,
        ],
        [
            'major_id' => $question->major_id ?? null,
            'option_id' => $answer['option_id'] ?? null,
            'value' => $answer['value'] ?? null,
        ]
    );
}


    // Ambil semua jawaban user dari database, terutama yang terkait dengan kategori 'spesifik'
    $userAnswers = UserAnswer::where('user_id', $userId)
        ->whereHas('question', fn($q) => $q->where('category', 'spesifik'))
        ->with(['question', 'option'])
        ->get();

    // Hitung skor tiap jurusan
    $scores = [];
    foreach ($userAnswers as $answer) {
        $majorId = $answer->question->major_id;

        if ($answer->option && $answer->option->is_correct) {
            $scores[$majorId] = ($scores[$majorId] ?? 0) + 1;
        }
    }

    // Bersihkan rekomendasi lama (jika ada)
    Recommendation::where('user_id', $userId)->delete();

    // Simpan hasil baru hanya berdasarkan soal khusus
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

    // Ambil kembali jurusan tertinggi untuk ditampilkan
    $topMajorId = array_key_first($scores);
    $topMajor = Major::find($topMajorId);
    $topScore = $scores[$topMajorId] ?? 0;

    // Cek apakah user sudah menjawab semua soal spesifik
    $totalQuestions = Question::where('category', 'spesifik')->count();
    $answeredQuestions = $userAnswers->count();

    // Jika jumlah jawaban sama dengan jumlah soal, maka user sudah selesai
    $allAnswered = $totalQuestions === $answeredQuestions;

    return view('recommendations.final', compact('topMajor', 'topScore', 'allAnswered'));
}



    private function determineLevel($score)
    {
        if ($score >= 5) {
            return 'sangat';
        } elseif ($score >= 3) {
            return 'cukup';
        } elseif ($score >= 1) {
            return 'kurang';
        } else {
            return 'tidak';
        }
    }
}