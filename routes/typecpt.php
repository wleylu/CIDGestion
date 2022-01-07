<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypecptController;



    Route::middleware('auth')->group(function () {
    Route::get('/typecpt',[TypecptController::class,'index'])->name('typecpt');
     Route::get('/typecpt/create',[TypecptController::class,'create'])->name('typecpt.create');
    Route::post('/typecpt/create',[TypecptController::class,'store'])->name('typecpt.store');
    Route::get('/typecpt/{id}/edit',[TypecptController::class,'edit'])->name('typecpt.edit');
    Route::post('/typecpt/{id}',[TypecptController::class,'update'])->name('typecpt.update');
    Route::get('/typecpt/delete/{id}',[TypecptController::class,'destroy'])->name('typecpt.delete'); 

});
