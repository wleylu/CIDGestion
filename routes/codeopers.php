<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeoperController;


    Route::middleware('auth')->group(function () {
    Route::get('/codeoper',[CodeoperController::class,'index'])->name('codeoper');
     Route::get('/codeoper/create',[CodeoperController::class,'create'])->name('codeoper.create');
    Route::post('/codeoper/create',[CodeoperController::class,'store'])->name('codeoper.store');
    Route::get('/codeoper/{id}/edit',[CodeoperController::class,'edit'])->name('codeoper.edit');
    Route::post('/codeoper/{id}',[CodeoperController::class,'update'])->name('codeoper.update');
    Route::get('/codeoper/delete/{id}',[CodeoperController::class,'destroy'])->name('codeoper.delete'); 

});
