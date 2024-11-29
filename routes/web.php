<?php

use App\Http\Controllers\AjustesController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PreinscriptoController;
use App\Livewire\InscripcionConfirm;
use App\Livewire\MultiStepForm;
use App\Livewire\PreinscripcionConfirm;

use App\Models\Estudiante;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/', [AjustesController::class, 'index'])->name('inicio');

Route::get('/preinscripcion', [PreinscriptoController::class, 'index'])->name('preinscripcion.index')->middleware('checkHorario:preinscripcion');
Route::post('/preinscripcion', [PreinscriptoController::class, 'store'])->name('preinscripcion.store');
Route::get('/inscripcion', [InscripcionController::class, 'index'])->name('inscripcion')/* ->middleware('verificarCuil') */;
Route::post('/inscripcion', [InscripcionController::class, 'store'])->name('inscripcion.store');
Route::put('/inscripcion', [InscripcionController::class, 'update'])->name('inscripcion.update');
Route::get('/preinscripcion-correcta', [PreinscriptoController::class, 'preincripcion_correcta'])->name('confirmacion-preinscripcion')->middleware('checkPreinscripcion');
Route::get('/inscripcion-correcta', [InscripcionController::class, 'incripcion_correcta'])->name('confirmacion-inscripcion')->middleware('checkInscripcion');
Route::get('/verificar-cuil', function () {
    return view('formulario.verificar-cuil');
})->name('verificar-cuil.get')->middleware('checkHorario:inscripcion');
Route::post('/verificar-cuil', [PreinscriptoController::class, 'verificarCUIL'])->name('verificar-cuil.post');
Route::get('/convivenciaPDF', [InscripcionController::class, 'convivenciaPdf'])->name('convivencia.pdf');

Route::get('/preinscripcion/pdf', [PreinscriptoController::class, 'generarPdf'])->name('generarPdfPreinscripto');
Route::get('/inscripcion/pdf', [InscripcionController::class, 'generarPdf'])->name('generarPdfInscripto');

Route::get('/finalizar', function () {
    Session::flush();
    return redirect()->route('inicio');
})->name('finalizar');
