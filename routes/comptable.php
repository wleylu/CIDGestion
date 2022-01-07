<?php

use App\Http\Controllers\ComptableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypecptController;



    Route::middleware('auth')->group(function () {
    Route::get('/comptable',[ComptableController::class,'index'])->name('comptable');
    Route::get('/comptable/create',[ComptableController::class,'create'])->name('comptable.create');
    Route::post('/comptable/create',[ComptableController::class,'store'])->name('comptable.store');
    Route::get('/comptable/{id}/edit',[ComptableController::class,'edit'])->name('comptable.edit');
    Route::post('/comptable/{id}',[ComptableController::class,'update'])->name('comptable.update');
    Route::get('/comptable/delete/{id}',[ComptableController::class,'destroy'])->name('comptable.delete'); 

});
