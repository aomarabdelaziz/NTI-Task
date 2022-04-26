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

/*Route::view('/blog' , 'blog.create');
Route::post('/blog-create' , [ \App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
Route::get('/blog-cookies' , [ \App\Http\Controllers\BlogController::class, 'getCokkies'])->name('blog.create');*/


Route::view('/login' , 'auth.login')->name('login.page');
Route::post('/login-post' , [\App\Http\Controllers\UserController::class , 'login'])->name('login.post.page');
Route::view('/register' , 'auth.register')->name('register.page');
Route::post('/register-post' , [\App\Http\Controllers\UserController::class , 'register'])->name('register.post.page');
Route::get('/home' , [\App\Http\Controllers\UserController::class , 'index'])->name('home');
Route::get('/logout' , [\App\Http\Controllers\UserController::class , 'logout'])->name('logout');
