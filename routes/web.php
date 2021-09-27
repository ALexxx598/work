<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile', [App\Http\Controllers\Main::class, 'openProfile'])->name('openProfile');

Route::get('/information', [App\Http\Controllers\Main::class, 'showInf'])->name('showInf');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/showProfile', [App\Http\Controllers\Main::class, 'showProfile'])->name('showProfile');
    Route::get('/showProfile/{pages}', [App\Http\Controllers\Main::class, 'showProfile'])->name('showProfile');
    Route::post('/main', [App\Http\Controllers\Main::class, 'showMain'])->name('showMain');


    Route::get('/showUpdateCalendarEvent/{id}', [App\Http\Controllers\CalendarController::class, 'showUpdateEvent'])->name('showUpdateEvent');

    Route::put('/updateCalendarEvent/{id}', [App\Http\Controllers\CalendarController::class, 'UpdateEvent'])->name('UpdateEvent');

    Route::delete('/deleteCalendarEvent/{id}', [App\Http\Controllers\CalendarController::class, 'deleteEvent'])->name('deleteEvent');

    Route::get('/showAddCalendarEvent', [App\Http\Controllers\CalendarController::class, 'showAddEvent'])->name('showAddEvent');

    Route::post('/addCalendarEvent', [App\Http\Controllers\CalendarController::class, 'addEvent'])->name('addEvent');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

