<?php

declare(strict_types=1);

use App\Http\Controllers\ITNController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ITNController::class, 'index']);
Route::post('/check', [ITNController::class, 'check'])->name('itn.check');
