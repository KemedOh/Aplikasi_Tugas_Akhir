<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserAnswerController;
use Illuminate\Contracts\View\View;

Route::get('/', function () {
    return View('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/questions', [QuestionController::class, 'showQuestionnaire'])->name('questions.show');
    Route::get('/recommendations', action: [RecommendationController::class, 'show'])->name('recommendations.show');
    Route::post('/answers', [QuestionController::class, 'store']);
});
Route::post('/pertanyaan', [QuestionController::class, 'submitAll'])->name('questions.submitAll');


Route::resource('users', UserController::class);
Route::get('/users/export/excel', [UserController::class, 'exportExcel'])->name('users.export.excel');
Route::get('/users/export/pdf', [UserController::class, 'exportPDF'])->name('users.export.pdf');

Route::resource('majors', MajorController::class);
Route::resource('questions', QuestionController::class);
Route::resource('user-answers', UserAnswerController::class);




require __DIR__.'/auth.php';