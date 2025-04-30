<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\UserAnswerController;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return View('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/user-guide', 'pages.user-guide')->name('user.guide');
Route::view('/about', 'pages.about')->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/questions', [QuestionController::class, 'showQuestionnaire'])->name('questions.show');
    Route::get('/recommendations', [RecommendationController::class, 'show'])->name('recommendations.show');
    Route::post('/answers', [QuestionController::class, 'store']);
});
Route::post('/pertanyaan', [QuestionController::class, 'submitAll'])->name('questions.submitAll');


Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class.':admin,superadmin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/users/export/excel', [UserController::class, 'exportExcel'])->name('users.export.excel');
    Route::get('/users/export/pdf', [UserController::class, 'exportPDF'])->name('users.export.pdf');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});



Route::resource('majors', MajorController::class);
Route::resource('questions', QuestionController::class);
Route::resource('user-answers', UserAnswerController::class);

Route::get('/recommendations/intermediate/{majorId}', [RecommendationController::class, 'intermediateResult'])->name('recommendations.intermediate');
Route::post('/recommendations/final', [RecommendationController::class, 'finalResult'])->name('recommendations.finalResult');

Route::get('/answers/{major}/detail', [UserAnswerController::class, 'detail'])
    ->middleware(['auth'])
    ->name('answers.detail'); 
Route::get('/questions/special/{majorId}', [QuestionController::class, 'specialQuestions'])->name('questions.nextSpecialQuestion');

Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('/recommendations/users-result', [RecommendationController::class, 'adminResults'])->name('recommendations.users-result');
    Route::get('/recommendations/export', [RecommendationController::class, 'export'])->name('recommendations.export');
    Route::get('recommendations/export', [RecommendationController::class, 'showExportForm'])->name('recommendations.showExportForm');
    Route::get('recommendations/export/all', [RecommendationController::class, 'exportAll'])->name('recommendations.exportAll');
    Route::get('recommendations/export/filtered', [RecommendationController::class, 'exportFiltered'])->name('recommendations.exportFiltered');
    Route::get('/recommendations/export/pdf', [RecommendationController::class, 'exportPdf'])->name('recommendations.exportPdf');
    Route::get('/recommendations/export/pdf/filtered', [RecommendationController::class, 'exportPdfFiltered'])->name('recommendations.exportPdfFiltered');
});





require __DIR__.'/auth.php';