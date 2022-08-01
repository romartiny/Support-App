<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/questions', [QuestionController::class, 'index'])->name('index');

Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('show');

Route::post('/questions', [QuestionController::class, 'store'])->name('store');

Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('update');

Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('destroy');


