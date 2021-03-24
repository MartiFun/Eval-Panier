<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatController;

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
return view('home');
})->middleware('auth');

Route::get('home', function () {
  return view('home');
})->middleware('auth');

Route::resource('plats', PlatController::class)->middleware('auth');;

Route::get('type/{slug}/plats', [PlatController::class, 'index'])->name('plats.type')->middleware('auth');;
Route::get('ingredient/{slug}/plats', [PlatController::class, 'index'])->name('plats.ingredient')->middleware('auth');;
Route::get('nom/plats', [PlatController::class, 'index'])->name('plats.nom')->middleware('auth');;
Route::get('prix/plats', [PlatController::class, 'index'])->name('plats.prix')->middleware('auth');;

// Route::get('addPanier', [PlatController::class, 'addPanier'])->name('plats.addPanier')->middleware('auth');;
Route::get('panier', [PlatController::class, 'showPanier'])->name('plats.panier')->middleware('auth');;
Route::delete('destroyPanier', [PlatController::class, 'destroyPanier'])->name('plats.destroyPanier')->middleware('auth');;
Route::post('updatePanier', [PlatController::class, 'updatePanier'])->name('plats.updatePanier')->middleware('auth');;
