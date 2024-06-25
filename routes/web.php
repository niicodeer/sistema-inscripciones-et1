<?php

use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PreinscriptoController;
use App\Livewire\InscripcionConfirm;
use App\Livewire\MultiStepForm;
use App\Livewire\PreinscripcionConfirm;
use App\Livewire\PreinscripcionForm;
use App\Livewire\VerificarCuilForm;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {
    return view('welcome');
})->name('inicio');

Route::get('/preinscripcion', PreinscripcionForm::class)->name('preinscripcion');
Route::post('/preinscripcion', [PreinscriptoController::class, 'store'])->name('preinscripcion');
Route::get('/inscripcion', MultiStepForm::class)->name('inscripcion')->middleware(['verificarCuil', 'InscripcionConfirmCheck']);
//Route::post('/inscripcion', [InscripcionController::class, 'store'])->name('inscripcion');// esta ruta no anda
Route::get('/preinscripcion-correcta', PreinscripcionConfirm::class)->name('confirmacion-preinscripcion')->middleware('checkPreinscripcion');
Route::get('/inscripcion-correcta', InscripcionConfirm::class)->name('confirmacion-inscripcion');
Route::get('/verificar-cuil', VerificarCuilForm::class)->name('verificar-cuil');
Route::post('/verificar-cuil', [PreinscriptoController::class, 'verificarCUIL'])->name('verificar-cuil');
Route::get('/convivenciaPDF', [InscripcionController::class, 'convivenciaPdf'])->name('convivencia.pdf');
/* Route::get('/admin')->name('admin');
 */

Route::get('/preinscripcion/pdf', [PreinscriptoController::class, 'generarPdf'])->name('generarPdfPreinscripto');
Route::get('/inscripcion/pdf', [MultiStepForm::class, 'generarPdf'])->name('generarPdfInscripto');

Route::get('/finalizar', function () {
    Session::flush();
    return redirect()->route('inicio');
})->name('finalizar');
