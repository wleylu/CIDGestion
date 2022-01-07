<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CltValideController;




     /*routtes des   clients*/
     Route::get('/cltvalide',[CltValideController::class,'index'])->name('cltvalide');
     Route::get('/cltvalide/{id}/edit',[CltValideController::class,'edit'])->name('cltvalide.edit');
     Route::post('/cltvalide/{id}',[CltValideController::class,'update'])->name('cltvalide.update');
     /* Route::get('/comptecli/create',[CompteCliController::class,'create'])->name('comptecli.create');
     Route::get('/comptecli/show',[CompteCliController::class,'show'])->name('comptecli.show');
     Route::post('/comptecli/create',[CompteCliController::class,'store'])->name('comptecli.store');
     Route::get('/comptecli/delete/{id}',[CompteCliController::class,'destroy'])->name('comptecli.delete');



      */
     /*fin routtes des   clients*/
