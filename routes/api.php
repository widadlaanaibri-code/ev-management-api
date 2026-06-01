<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\EventController as AdminEventController;
use App\Http\Controllers\organizer\EventController as OrganizerEventController;
use App\Http\Controllers\organizer\ReservationController as OrganizerReservationController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TagController;
use App\Http\Controllers\spectator\HomeController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public auth routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Public events routes (no authentication required)
Route::get('/events', [HomeController::class, 'getAcceptedEvents']);
Route::get('/events/{id}', [HomeController::class, 'getEventById']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'updateProfile']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Admin routes
    Route::prefix('admin')->group(function () {
        // Spectators management
        Route::get('/spectators', [UserController::class, 'getSpectators']);
        Route::put('/spectators/{id}/status', [UserController::class, 'updateSpectatorStatus']);

        // Organizers management
        Route::get('/organizers', [UserController::class, 'getOrganizers']);
        Route::put('/organizers/{id}/status', [UserController::class, 'updateOrganizerStatus']);

        // Delete user
        Route::delete('/users/{id}', [UserController::class, 'destroy']);

        // Events management
        Route::get('/events', [AdminEventController::class, 'index']);
        Route::get('/events/pending', [AdminEventController::class, 'pending']);
        Route::get('/events/{id}', [AdminEventController::class, 'show']);
        Route::put('/events/{id}/status', [AdminEventController::class, 'updateStatus']);
        Route::delete('/events/{id}', [AdminEventController::class, 'destroy']);
        Route::get('/events/organizer/{organizerId}', [AdminEventController::class, 'byOrganizer']);

        // Categories management (admin only)
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        // Tags management (admin only)
        Route::get('/tags', [TagController::class, 'index']);
        Route::post('/tags', [TagController::class, 'store']);
        Route::get('/tags/{id}', [TagController::class, 'show']);
        Route::put('/tags/{id}', [TagController::class, 'update']);
        Route::delete('/tags/{id}', [TagController::class, 'destroy']);
    });

    // Organizer routes
    Route::prefix('organizer')->group(function () {
        // Event management
        Route::get('/events', [OrganizerEventController::class, 'index']);
        Route::post('/events', [OrganizerEventController::class, 'store']);
        Route::get('/events/{id}', [OrganizerEventController::class, 'show']);
        Route::put('/events/{id}', [OrganizerEventController::class, 'update']);
        Route::delete('/events/{id}', [OrganizerEventController::class, 'destroy']);
        // Reservations (for organizer's events)
        Route::get('/reservations', [OrganizerReservationController::class, 'index']);
    });

    // Categories and Tags (accessible by organizers and admins for reading)
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/tags', [TagController::class, 'index']);

    // Reservations (spectators / authenticated users)
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}/ticket', [ReservationController::class, 'downloadTicket']);

    Route::post('/payment-intent', [PaymentController::class, 'createPaymentIntent']);

    
});
