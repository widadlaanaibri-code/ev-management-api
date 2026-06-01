<?php

use App\Http\Controllers\MollieController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\organizer\EventsController;
use App\Http\Controllers\organizer\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\spectator\HomeController;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


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

Route::get('/', [HomeController::class , 'index']);


//Authentication
Auth::routes();
Route::get('authentication', function () {
    return view('authentication');
})->name('authentication');
Route::get('organizer_auth', [RegisterController::class, 'organizer_auth'])->name('organizer_auth');
Route::post('organizer', [RegisterController::class, 'organizer'])->name('organizer.post');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');


Route::get('auth/{provider}', [LoginController::class , 'redirectToProvider']);
Route::get('auth/{provider}/callback', [LoginController::class , 'handleProviderCallback']);



Route::get('profile', [ProfileController::class, 'profile'])->name('admin.profile');
Route::put('user-update', [ProfileController::class, 'updateProfile'])->name('user.update');


//Admin
Route::prefix('evento')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('booking' , [AdminController::class , 'booking'])->name('booking.admin');
    Route::resource('dashboard', AdminController::class);
    Route::resource('categories', CategoryController::class);
    Route::put('/users/{id}/update-status', [UserController::class, 'updateStatus'])->name('users.update-status');
    Route::resource('users', UserController::class);
    Route::put('/events/{id}/update-status', [EventController::class, 'updateEventsStatus'])->name('events.update-status');
    Route::resource('events', EventController::class);
});


//Organizer
Route::prefix('evento-org')->middleware(['auth', 'role:organizer'])->group(function () {
    Route::put('/updateStatus/{reservation}', [OrganizerController::class, 'updateStatus'])->name('updateStatus');
    Route::get('booking' , [OrganizerController::class , 'booking'])->name('booking.index');
    Route::resource('account', OrganizerController::class);
    Route::resource('event', EventsController::class);
});


//Spectator
Route::prefix('user')->middleware(['auth', 'role:spectator'])->group(function () {
    Route::resource('home', HomeController::class);
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('events', [HomeController::class , 'allEvents']);
    Route::get('ticket/{id}' , [HomeController::class , 'ticket'])->name('ticket');
});
Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');



Route::get('ticket' , function(){
    return view('pdf.ticket');
});

