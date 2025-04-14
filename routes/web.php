<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitRecordController;

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('habits', HabitController::class);
});

// Route::middleware(['auth'])->group(function () {
//     Route::resource('tasks', TaskController::class);
//     Route::resource('habits', HabitController::class);
// });

Route::middleware(['auth'])->group(function () {
    // チェックトグル（POST or GETでもOK）
    Route::post('/habits/{habit}/toggle', [HabitRecordController::class, 'toggle'])->name('habits.toggle');
});



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
});

require __DIR__ . '/auth.php';
