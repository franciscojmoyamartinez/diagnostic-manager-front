<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/add', [App\Http\Controllers\HomeController::class, 'formView'])->name('patient.formView');
Route::get('/home/{patientId}', [App\Http\Controllers\HomeController::class, 'editView'])->name('patient.editView');
Route::get('/patient/diagnostic/{patientId}', [App\Http\Controllers\DiagnosticController::class, 'index'])->name('patient.diagnostic');
Route::post('/patient/diagnostic/{patientId}', [App\Http\Controllers\DiagnosticController::class, 'store'])->name('diagnostic.store');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'store'])->name('patient.store');
Route::post('/home/{patientId}', [App\Http\Controllers\HomeController::class, 'edit'])->name('patient.edit');
Route::delete('/patients/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('patients.delete');
