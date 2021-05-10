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
Route::post('/home/{patientId}', [App\Http\Controllers\HomeController::class, 'edit'])->name('patient.edit');
Route::get('/home/{patientId}', [App\Http\Controllers\HomeController::class, 'editView'])->name('patient.editView');
Route::delete('/patients/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('patients.delete');
