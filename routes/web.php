<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketBookingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
 Route::resource('event', EventController::class);
 Route::resource('venue', VenueController::class);
 Route::resource('wishlist', WishlistController::class);
 Route::resource('ticket_booking', TicketBookingController::class);
