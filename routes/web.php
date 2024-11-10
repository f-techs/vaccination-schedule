<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/parents', [ParentController::class, 'index'])->name('parents');
    Route::get('/create-parent', [ParentController::class, 'create'])->name('parent.create');
    Route::get('/edit-parent/{id}', [ParentController::class, 'edit'])->name('parent.edit');
    Route::get('/voices', [VoiceController::class, 'index'])->name('voices');
    Route::get('/create-voice', [VoiceController::class, 'create'])->name('voice.create');
    Route::get('/edit-voice/{id}', [ParentController::class, 'edit'])->name('voice.edit');
});

//app routes

require __DIR__.'/auth.php';
