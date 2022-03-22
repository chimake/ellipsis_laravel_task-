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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/update-profile', [App\Http\Controllers\UserController::class, 'update'])->name('update-view')->middleware('auth');
Route::post('/update-profile', [App\Http\Controllers\UserController::class, 'updateUser'])->name('update-profile')->middleware('auth');
Route::get('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password-view')->middleware('auth');
Route::post('/change-password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change-password')->middleware('auth');
Route::get('/home', [App\Http\Controllers\ShortUserController::class, 'index'])->name('user.links')->middleware('auth');
Route::get('/create', function () {
    return view('linkop.create');
})->name('short.create');

Route::post('/short',[App\Http\Controllers\ShortUrlController::class,'short'])->name('short.url');
Route::post('/short/update',[App\Http\Controllers\ShortUrlController::class,'update'])->name('update.short.url');
Route::get('/exit', function () {
    return view('exit');
})->name('short.exit');
Route::get('/show/{id}', [App\Http\Controllers\ShortUserController::class, 'show'])->name('user.link.show');
Route::get('/update/{id}', [App\Http\Controllers\ShortUserController::class, 'update'])->name('short.update');
Route::get('/disable/{id}', [App\Http\Controllers\ShortUserController::class, 'disable'])->name('user.link.disable');
Route::get('/enable/{id}', [App\Http\Controllers\ShortUserController::class, 'enable'])->name('user.link.enable');
Route::get('/delete/{id}', [App\Http\Controllers\ShortUserController::class, 'destory'])->name('user.link.delete');


Route::get('/{code}', [App\Http\Controllers\ShortUrlController::class, 'show'])->name('short.show');


