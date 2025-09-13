<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Admin category
        
    Route::get('/read_category',[CategoryController::class,'read_category'])->name('read_category');
    Route::get('/add_category',[CategoryController::class,'add_category'])->name('add_category');
    Route::post('/create_category',[CategoryController::class,'create_category'])->name('create_category');
    Route::get('/delete_category/{id}',[CategoryController::class,'delete_category'])->name('delete_category');
    Route::get('/edit_category/{id}',[CategoryController::class,'edit_category'])->name('edit_category');
    Route::post('/update_category/{id}',[CategoryController::class,'update_category'])->name('update_category');

});

require __DIR__.'/auth.php';

