<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\QuartierController;


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


Route::get('/cid', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::middleware(['auth'])->group(function () {
        /* routes des quartiers */
        Route::get('/quartier',[QuartierController::class,'index'])->name('quartier');
        Route::post('/quartier/create',[QuartierController::class,'store'])->name('quartier.store');
        Route::get('/quartier/create',[QuartierController::class,'create'])->name('quartier.create');
        Route::get('/quartier/{id}/edit',[QuartierController::class,'edit'])->name('quartier.edit');
        Route::post('/quartier/{id}',[QuartierController::class,'update'])->name('quartier.update');
        Route::get('/quartier/delete/{id}',[QuartierController::class,'destroy'])->name('quartier.delete');
           /* fin routes des quartiers */

        /*routtes des   activites*/
        Route::get('/activite',[ActiviteController::class,'index'])->name('activite');
        Route::get('/activite/create',[ActiviteController::class,'create'])->name('activite.create');
        Route::post('/activite/create',[ActiviteController::class,'store'])->name('activite.store');
        Route::get('/activite/{id}/edit',[ActiviteController::class,'edit'])->name('activite.edit');
        Route::post('/activite/{id}',[ActiviteController::class,'update'])->name('activite.update');
        Route::get('/activite/delete/{id}',[ActiviteController::class,'destroy'])->name('activite.delete');
        /*fin routtes des   activites*/

         /*routtes des   clients*/
         Route::get('/client',[ClientController::class,'index'])->name('client');
         Route::get('/client/create',[ClientController::class,'create'])->name('client.create');
          Route::post('/client/create',[ClientController::class,'store'])->name('client.store');
         Route::get('/client/{id}/edit',[ClientController::class,'edit'])->name('client.edit');
         Route::post('/client/{id}',[ClientController::class,'update'])->name('client.update');
         Route::get('/client/delete/{id}',[ClientController::class,'destroy'])->name('client.delete');
         /*fin routtes des   clients*/




    });



require __DIR__.'/auth.php';
require __DIR__.'/cptcli.php';
require __DIR__.'/com.php';
require __DIR__.'/produit.php';
require __DIR__.'/codeopers.php';
require __DIR__.'/typecpt.php';
require __DIR__.'/comptable.php';
require __DIR__.'/periode.php';
require __DIR__.'/clientproduit.php';
require __DIR__.'/operations.php';
require __DIR__.'/cptbank.php';
require __DIR__.'/cptclivalide.php';

