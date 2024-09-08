<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\RankingTopsis;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/clear-cookies', function () {
    foreach (request()->cookies->keys() as $cookie) {
        Cookie::queue(Cookie::forget($cookie));
    }
    return redirect('/');
})->name('clear.cookies');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('{id}', [StudentController::class, 'show'])->name('students.show');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    });

    Route::prefix('criteria')->group(function () {
        Route::get('/', [CriteriaController::class, 'index'])->name('criteria.index');
    });

    Route::prefix('ranking-topsis')->group(function () {
        Route::get('/', [RankingTopsis::class, 'topsis'])->name('ranking.topsis');
    });
});
