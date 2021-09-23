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
    Route::post('/main', [App\Http\Controllers\Main::class, 'showMain'])->name('showMain');

    Route::get('/deleteCalendarEvent/{id}', [App\Http\Controllers\CalendarController::class, 'deleteEvent'])->name('deleteEvent');

    Route::get('/updateCalendarEvent/{id}', [App\Http\Controllers\CalendarController::class, 'showUpdateEvent'])->name('showUpdateEvent');
    Route::post('/updateCalendarEvent', [App\Http\Controllers\CalendarController::class, 'updateEvent'])->name('updateEvent');
    Route::post('/addCalendarEvent', [App\Http\Controllers\CalendarController::class, 'addEvent'])->name('addEvent');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

