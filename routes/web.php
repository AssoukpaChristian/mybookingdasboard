<?php

use App\Livewire\Home;
use App\Livewire\Pays;
use App\Livewire\Users;
use App\Livewire\Booking;
use App\Livewire\Clients;
use App\Livewire\Communes;
use App\Livewire\Quartiers;
use App\Livewire\Operations;
use App\Livewire\Residences;
use App\Livewire\Statistiques;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Bookings;
use App\Livewire\Calendar;
use App\Livewire\Transactions;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/users', Users::class)->name('users');
    Route::get('/clients', Clients::class)->name('clients');
    Route::get('/bookings', Bookings::class)->name('bookings');
    Route::get('/calendar', Calendar::class)->name('calendar');
    Route::get('/operations', Operations::class)->name('operations');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/residences', Residences::class)->name('residences');
    Route::get('/pays', Pays::class)->name('pays');
    Route::get('/communes', Communes::class)->name('communes');
    Route::get('/quartiers', Quartiers::class)->name('quartiers');
    Route::get('/statistiques', Statistiques::class)->name('statistiques');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
