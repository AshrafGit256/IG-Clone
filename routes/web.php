<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileHome;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Livewire component route
Route::get('/', Home::class)->middleware( middleware:'auth'); // This is correct for rendering the Livewire component

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/{user}', [ProfileHome::class, 'show'])->name('profile.home');
});

require __DIR__.'/auth.php';
