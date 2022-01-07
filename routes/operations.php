<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OperationController;



     /*routtes des   clients*/
     Route::middleware('auth')->group(function () {
          Route::get('/operation',[OperationController::class,'index'])->name('operation');
          Route::get('/operation/show',[OperationController::class,'show'])->name('operation.show');
          Route::post('/operation/create',[OperationController::class,'store'])->name('operation.store');
         /*  Route::get('/comptecli/create',[CompteCliController::class,'create'])->name('comptecli.create');

           */
     });

     /*
     Route::get('/client/{id}/edit',[ClientController::class,'edit'])->name('client.edit');
     Route::post('/client/{id}',[ClientController::class,'update'])->name('client.update');
     Route::get('/client/delete/{id}',[ClientController::class,'destroy'])->name('client.delete'); */
     /*fin routtes des   clients*/
