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

Route::get('/trainings/{training}', [App\Http\Controllers\TrainingController::class, 'show'])->name('training:show');

//Route::get('/trainings/{id}/edit', [App\Http\Controllers\TrainingController::class, 'edit'])->name('training:edit');
Route::get('/trainings/{training}/edit', [App\Http\Controllers\TrainingController::class, 'edit'])->name('training:edit');
//Route::post('/trainings/{id}/edit', [App\Http\Controllers\TrainingController::class, 'update'])->name('training:update'); //guna url yg sama dgn edit, nak create baru pon bole tp better guna sama dari form edit tu
//yg ni guna binding instead of terima id shj -- refer pd controller yg pass Training utk update
Route::post('/trainings/{training}/edit', [App\Http\Controllers\TrainingController::class, 'update'])->name('training:update');

Route::get('/trainings/{training}/delete', [App\Http\Controllers\TrainingController::class, 'delete'])->name('training:delete');