<?php

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

Route::get('/{home?}', function () {
    return view('home');
})->where('home', '(home)?')->name('home');

Route::get('race/create', '\App\Http\Controllers\RaceController@create');
Route::get('race/vote/{id}', '\App\Http\Controllers\RaceController@vote');
Route::get('race/{id}/results', '\App\Http\Controllers\RaceController@results');
Route::get('race/links/{id}', '\App\Http\Controllers\RaceController@links');
Route::get('race/qr/{id}', '\App\Http\Controllers\RaceController@showQR');
Route::get('race/dotd/{id}', '\App\Http\Controllers\RaceController@showDOTD');
Route::get('/race/create', function () {return view('race.create');})->name('race.create');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
