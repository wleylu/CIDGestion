<?php

use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;




    Route::middleware('auth')->group(function () {
    Route::get('/periode',[PeriodeController::class,'index'])->name('periode');
     Route::get('/periode/create',[PeriodeController::class,'create'])->name('periode.create');
    Route::post('/periode/create',[PeriodeController::class,'store'])->name('periode.store');
    Route::get('/periode/{id}/edit',[PeriodeController::class,'edit'])->name('periode.edit');
    Route::post('/periode/{id}',[PeriodeController::class,'update'])->name('periode.update');
    Route::get('/periode/delete/{id}',[PeriodeController::class,'destroy'])->name('periode.delete'); 

});
