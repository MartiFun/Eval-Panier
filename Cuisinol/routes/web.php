<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PlatController, PanierController};

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
Route::resource('paniers', PanierController::class)->middleware('auth');;

Route::get('type/{slug}/plats', [PlatController::class, 'index'])->name('plats.type')->middleware('auth');;
Route::get('ingredient/{slug}/plats', [PlatController::class, 'index'])->name('plats.ingredient')->middleware('auth');;
Route::get('nom/plats', [PlatController::class, 'index'])->name('plats.nom')->middleware('auth');;
Route::get('prix/plats', [PlatController::class, 'index'])->name('plats.prix')->middleware('auth');;
Route::post('updatePlat', [PlatController::class, 'updatePlat'])->name('plats.updatePlat')->middleware('auth')->middleware('admin');;
Route::post('storeIngredient', [PlatController::class, 'storeIngredient'])->name('plats.storeIngredient')->middleware('auth')->middleware('admin');;
Route::post('storeType', [PlatController::class, 'storeType'])->name('plats.storeType')->middleware('auth')->middleware('admin');;
Route::post('storeVegetarien', [PlatController::class, 'storeVegetarien'])->name('plats.storeVegetarien')->middleware('auth')->middleware('admin');;

Route::delete('destroyPanier', [PanierController::class, 'destroyPanier'])->name('paniers.destroyPanier')->middleware('auth');;
Route::post('updatePanier', [PanierController::class, 'updatePanier'])->name('paniers.updatePanier')->middleware('auth');;

// Route::get('indexAdmin', [PanierController::class, 'indexAdmin'])->name('plats.indexAdmin')->middleware('auth')->middleware('admin');;

Route::get('back', function () {
  return view('back/back');
})->name('plats.admin')->middleware('auth')->middleware('admin');
