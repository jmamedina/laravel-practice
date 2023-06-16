<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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

//show all the departments
Route::get('/', [ProjectController::class, 'getAllDepartments'])->name('home');

//show the appointments
Route::post('/showAppointments', [ProjectController::class, 'showAppointments'])->name('showAppointments')->middleware('auth');

//add the booking appoint, middleware auth prevents the users who are not logged in from booking .
Route::post('/bookAppointment', [ProjectController::class, 'bookAppointment'])->name('bookAppointment')->middleware('auth');

//show my bookings
Route::get('/myBookings', [ProjectController::class,'myBookings'])->name('myBookings')->middleware('auth');

//cancel bookings
Route::post('/cancelBooking', [ProjectController::class,'cancelBooking'])->name('cancelBooking')->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
