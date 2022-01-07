<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CptBankController;





    Route::middleware('auth')->group(function () {
    Route::get('/cptbank/show/{client}',[CptBankController::class,'show'])->name('cptbank.show');
    Route::post('/cptbank/create',[CptBankController::class,'store'])->name('cptbank.store');
    Route::get('/cptbank/{id}/delete',[CptBankController::class,'destroy'])->name('cptbank.delete');
});
