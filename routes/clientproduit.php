<?php

use App\Http\Controllers\ClientProduitController;
use Illuminate\Support\Facades\Route;





     Route::get('/cliproduit',[ClientProduitController::class,'index'])->name('cliproduit');
     Route::get('/cliproduit/{id}/create',[ClientProduitController::class,'create'])->name('cliproduit.create');
     Route::post('/cliproduit/show',[ClientProduitController::class,'show'])->name('cliproduit.show');
     Route::post('/cliproduit/create',[ClientProduitController::class,'store'])->name('cliproduit.store');
     Route::get('/cliproduit/{id}/edit',[ClientProduitController::class,'edit'])->name('cliproduit.edit');
     Route::post('/cliproduit/{id}',[ClientProduitController::class,'update'])->name('cliproduit.update');
     Route::get('/cliproduit/delete/{id}',[ClientProduitController::class,'destroy'])->name('cliproduit.delete');

