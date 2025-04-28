<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserAnswer;
use App\Http\Controllers\RecommendationController;
use Illuminate\Http\Request;
use App\Models\Recommendation;


class DashboardController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    // Cek apakah user sudah menjawab pertanyaan umum
    $hasGeneralAnswers = \App\Models\UserAnswer::where('user_id', $userId)
        ->whereHas('question', fn($q) => $q->where('category', 'umum'))
        ->exists();

    // Cek apakah user sudah menjawab pertanyaan spesifik
    $hasSpecificAnswers = \App\Models\UserAnswer::where('user_id', $userId)
        ->whereHas('question', fn($q) => $q->where('category', 'spesifik'))
        ->exists();

    return view('dashboard', compact('hasGeneralAnswers', 'hasSpecificAnswers'));
}

}