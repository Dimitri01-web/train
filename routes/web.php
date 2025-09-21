<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RapportController;


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
Route::resource('trains', TrainController::class)->except(['show']);
Route::get('trains/search', [TrainController::class, 'search'])->name('trains.search');
Route::resource('itineraires', ItineraireController::class)->except(['show']);
Route::get('/itineraires/search', [ItineraireController::class, 'search'])->name('itineraires.search');
Route::resource('reservations', ReservationController::class)->except(['show']);
Route::get('/reservations/search', [ReservationController::class, 'search'])->name('reservations.search');
Route::resource('places', PlaceController::class);
Route::get('/places/{id}', [PlaceController::class, 'index']);


Route::get('trains/{train}/places', [PlaceController::class, 'index'])->name('places.index');
Route::patch('places/{place}', [PlaceController::class, 'update'])->name('places.update');
Route::get('rapports/jour', [RapportController::class, 'recettesParJour'])->name('rapports.jour');


