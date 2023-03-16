<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('conversation/{userid}', [MessageController::class, 'conversation'])->name('message.conversation');
    Route::any('sendMessage', [MessageController::class,'sendMessage'])->name('message.send');
    Route::get('allSmsFetched/{userid}', [MessageController::class, 'smsFetch'])->name('sms.fetch');
});



require __DIR__.'/auth.php';
