<?php

use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PreinscriptoController;
use App\Livewire\InscripcionConfirm;
use App\Livewire\MultiStepForm;
use App\Livewire\PreinscripcionConfirm;
use App\Livewire\PreinscripcionForm;
use App\Livewire\VerificarCuilForm;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/preinscripcion', PreinscripcionForm::class)->name('preinscripcion');
Route::post('/preinscripcion', [PreinscriptoController::class, 'store'])->name('preinscripcion');
Route::get('/inscripcion', MultiStepForm::class)->name('inscripcion')->middleware('verificarCuil');
Route::post('/inscripcion', [InscripcionController::class, 'store'])->name('inscripcion');
Route::get('/preinscripcion-correcta', PreinscripcionConfirm::class)->name('confirmacion-preinscripcion')->middleware('checkPreinscripcion');
Route::get('/inscripcion-correcta', InscripcionConfirm::class)->name('confirmacion-inscripcion');
Route::get('/verificar-cuil', VerificarCuilForm::class)->name('verificar-cuil');
Route::post('/verificar-cuil', [PreinscriptoController::class, 'verificarCUIL'])->name('verificar-cuil');

/* Route::get('/admin')->name('admin');
 */
