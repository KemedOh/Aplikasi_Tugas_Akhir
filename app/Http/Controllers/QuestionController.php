<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Ambil pertanyaan berdasarkan kategori (umum/spesifik)
    public function index(Request $request)
    {
    $category = $request->query('category', 'umum'); // Default: umum
    $majorId = $request->query('major_id'); // Untuk pertanyaan spesifik

    $questions = Question::where('category', $category)
        ->when($category === 'spesifik' && $majorId, function ($query) use ($majorId) {
            return $query->where('major_id', $majorId);
        })
        ->inRandomOrder() // Mengacak urutan pertanyaan
        ->get();

    return response()->json($questions);

    }

    // Simpan jawaban pengguna
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|in:ya,tidak',
        ]);

        UserAnswer::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'question_id' => $request->question_id,
            ],
            ['answer' => $request->answer]
        );

        return response()->json(['message' => 'Jawaban disimpan!']);
    }
}