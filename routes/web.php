<?php

use App\Events\Message;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Models\UserMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/{id}', [MessageController::class, 'index', 'id'])->middleware(['auth']);
Route::get('/broadcast', function(){
    broadcast(new Message(UserMessage::find(11)));
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
