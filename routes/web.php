<?php

use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RankController::class, 'index'])->name('rank.index');
Route::post('/recalculate', [RankController::class, 'recalculate'])->name('rank.recalculate');
