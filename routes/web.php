<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');

// Export
Route::get('/export/visitor', [ExportController::class, 'visitor'])->name('exports.visitor');
Route::get('/export/answer-essay', [ExportController::class, 'essay'])->name('exports.answer-essay');
