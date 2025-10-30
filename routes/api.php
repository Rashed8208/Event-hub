<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\VenueController;
use App\Http\Controllers\Api\TicketBookingController;
use App\Http\Controllers\Api\WishlistController;
// Public routes
Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('events', EventController::class);
    Route::apiResource('venue', VenueController::class);
    Route::apiResource('ticket-booking', TicketBookingController::class);
    Route::apiResource('wishlist', WishlistController::class);
});
