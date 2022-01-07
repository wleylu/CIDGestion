<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteCliController;



     /*routtes des   clients*/
     Route::get('/comptecli',[CompteCliController::class,'index'])->name('comptecli');
     Route::get('/comptecli/create',[CompteCliController::class,'create'])->name('comptecli.create');
     Route::get('/comptecli/show',[CompteCliController::class,'show'])->name('comptecli.show');
     Route::post('/comptecli/create',[CompteCliController::class,'store'])->name('comptecli.store');
     Route::get('/comptecli/delete/{id}',[CompteCliController::class,'destroy'])->name('comptecli.delete');
     /*
     Route::get('/client/{id}/edit',[ClientController::class,'edit'])->name('client.edit');
     Route::post('/client/{id}',[ClientController::class,'update'])->name('client.update');
      */
     /*fin routtes des   clients*/
