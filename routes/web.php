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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/trainings', [App\Http\Controllers\TrainingController::class, 'index'])->name('trainings'); //tanpa named routes
Route::get('/trainings', [App\Http\Controllers\TrainingController::class, 'index'])->name('traininglist'); //->name(''):named routes

Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
//Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');

Route::get('/trainings/create',[App\Http\Controllers\TrainingController::class, 'create']);
Route::get('/trainings/create',[App\Http\Controllers\TrainingController::class, 'create'])->name('createlists');

Route::post('/trainings/create',[App\Http\Controllers\TrainingController::class, 'store']);

Route::get('/trainings/{id}', [App\Http\Controllers\TrainingController::class, 'show'])->name('training:show');
