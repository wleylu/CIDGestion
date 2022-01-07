<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommissionController;






Route::middleware('auth')->group(function () {
     Route::get('/commission',[CommissionController::class,'index'])->name('commission');
     Route::get('/commission/create',[CommissionController::class,'create'])->name('commission.create');
     Route::post('/commission/create',[CommissionController::class,'store'])->name('commission.store');
     Route::get('/commission/{id}/edit',[CommissionController::class,'edit'])->name('commission.edit');
     Route::post('/commission/{id}',[CommissionController::class,'update'])->name('commission.update');
     Route::get('/commission/delete/{id}',[CommissionController::class,'destroy'])->name('commission.delete');

});
