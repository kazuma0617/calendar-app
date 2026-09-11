<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;

Route::get('/', [ScheduleController::class, 'index'])->name('index');
Route::get('/add', [ScheduleController::class, 'add'])->name('add');
Route::get('/detail', [ScheduleController::class, 'detail'])->name('detail');
