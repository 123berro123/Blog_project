<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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

    
    
    Route::get('/read_category',[CategoryController::class,'read_category'])->name('read_category');
    Route::get('/add_category',[CategoryController::class,'add_category'])->name('add_category');
    Route::post('/create_category',[CategoryController::class,'create_category'])->name('create_category');
    Route::get('/delete_category/{id}',[CategoryController::class,'delete_category'])->name('delete_category');
    Route::get('/edit_category/{id}',[CategoryController::class,'edit_category'])->name('edit_category');
    Route::post('/update_category/{id}',[CategoryController::class,'update_category'])->name('update_category');

    
    Route::get('/read_post',[PostController::class,'read_post'])->name('read_post');
    Route::get('/add_post',[PostController::class,'add_post'])->name('add_post');
    Route::post('/create_post',[PostController::class,'create_post'])->name('create_post');
    Route::get('/delete_post/{id}',[PostController::class,'delete_post'])->name('delete_post');
    Route::get('/edit_post/{id}',[PostController::class,'edit_post'])->name('edit_post');
    Route::post('/update_post/{id}',[PostController::class,'update_post'])->name('update_post');
});
Route::get('/', [PostController::class, 'frontend_index'])->name('home');          // already added earlier
Route::get('/blog/{id}', [PostController::class, 'frontend_show'])->name('blog.show');

require __DIR__.'/auth.php';
