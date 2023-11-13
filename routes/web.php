<?php

use App\Models\Address;
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


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', function(){
    return view('auth.login');
});

Route::get('/activities', [App\Http\Controllers\ActivityController::class, 'index'])->name('home')->middleware('verified');
Route::get('/activity/{id}', [App\Http\Controllers\ActivityController::class, 'show']);
Route::get('/activity', [App\Http\Controllers\ActivityController::class, 'create']);
Route::get('/activity/{id}/edit', [App\Http\Controllers\ActivityController::class, 'edit']);

Route::post('/activity', [App\Http\Controllers\ActivityController::class, 'store']);
Route::put('/activity/{id}/complete', [App\Http\Controllers\ActivityController::class, 'complete']);
Route::put('/activity/{id}/incomplete', [App\Http\Controllers\ActivityController::class, 'incomplete']);
Route::put('/activity/{id}/edit', [App\Http\Controllers\ActivityController::class, 'update']);
Route::delete('/activity/{id}', [App\Http\Controllers\ActivityController::class, 'destroy']);
