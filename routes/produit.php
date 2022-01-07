<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;


    Route::middleware('auth')->group(function () {
    Route::get('/produit',[ProduitController::class,'index'])->name('produit');
    Route::get('/produit/create',[ProduitController::class,'create'])->name('produit.create');
    Route::post('/produit/create',[ProduitController::class,'store'])->name('produit.store');
    Route::get('/produit/{id}/edit',[ProduitController::class,'edit'])->name('produit.edit');
    Route::post('/produit/{id}',[ProduitController::class,'update'])->name('produit.update');
    Route::get('/produit/delete/{id}',[ProduitController::class,'destroy'])->name('produit.delete');

});
