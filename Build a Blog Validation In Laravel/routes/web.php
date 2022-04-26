<?php

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

Route::view('/blog' , 'blog.create');
Route::post('/blog-create' , [ \App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
Route::get('/blog-cookies' , [ \App\Http\Controllers\BlogController::class, 'getCokkies'])->name('blog.create');
