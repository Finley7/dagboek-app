<?php

use App\Http\Controllers\DiaryArticleController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/diaries')->group(function () {
        Route::get('/', [DiaryController::class, 'index'])->name('diary.index');
        Route::get('/create', [DiaryController::class, 'create'])->name('diary.create');
        Route::get('/edit/{id}', [DiaryController::class, 'edit'])->name('diary.edit');
        Route::get('/delete/{id}', [DiaryController::class, 'delete'])->name('diary.delete');

        Route::post('/store', [DiaryController::class, 'store'])->name('diary.store');
        Route::post('/update/{id}', [DiaryController::class, 'update'])->name('diary.update');
    });

    Route::prefix('/diary-articles')->group(function () {
        Route::get('/create/{diaryId}', [DiaryArticleController::class, 'create'])->name('diary.article.create');
        Route::get('/edit/{diaryArticleId}', [DiaryArticleController::class, 'edit'])->name('diary.article.edit');
        Route::get('/delete/{diaryArticleId}', [DiaryArticleController::class, 'delete'])->name('diary.article.delete');

        Route::post('/store/{diaryId}', [DiaryArticleController::class, 'store'])->name('diary.article.store');
        Route::post('/update/{diaryArticleId}', [DiaryArticleController::class, 'update'])->name('diary.article.update');
    });


});

require __DIR__ . '/auth.php';
