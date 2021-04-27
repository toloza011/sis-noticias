<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[NoticiaController::class,'index'])->name('home');




Route::prefix('noticia')->group(function () {
    Route::get('/',[NoticiaController::class,'index'])->name('noticia.index');
    Route::get('/show/{id}',[NoticiaController::class,'show'])->name('noticia.show');
    Route::middleware(['auth'])->group(function () {
        Route::get('/create',[NoticiaController::class,'create'])->name('noticia.create');
        Route::post('/store',[NoticiaController::class,'store'])->name('noticia.store');
        Route::post('ckeditor/upload', [NoticiaController::class,'upload'])->name('ckeditor.image-upload');
        Route::get('/edit/{id}',[NoticiaController::class,'edit'])->name('noticia.edit');
        Route::put('/update/{id}',[NoticiaController::class,'update'])->name('noticia.update');
        Route::delete('/delete/{id}',[NoticiaController::class,'destroy'])->name('noticia.destroy');
    });
});