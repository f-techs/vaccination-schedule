<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/vaccine-alert/{code}',[MessageController::class, 'alert'])->name('vaccine.alert');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/parents', [ParentController::class, 'index'])->name('parents');
    Route::get('/create-parent', [ParentController::class, 'create'])->name('parent.create');
    Route::get('/edit-parent/{id}', [ParentController::class, 'edit'])->name('parent.edit');
    Route::get('/voices', [VoiceController::class, 'index'])->name('voices');
    Route::get('/create-voice/{message?}', [VoiceController::class, 'create'])->name('voice.create');
    Route::get('/message', [MessageController::class, 'index'])->name('messages');
    Route::get('/create-message', [MessageController::class, 'create'])->name('message.create');
    Route::get('/vaccine-messages', [MessageController::class, 'indexVaccineMessage'])->name('vaccine-messages');
    Route::get('/create-vaccine-messages', [MessageController::class, 'createVaccineMessage'])->name('vaccine-message.create');
    Route::get('/edit-vaccine-messages', [MessageController::class, 'editVaccineMessage'])->name('vaccine-message.edit');
});

//app routes

require __DIR__.'/auth.php';
