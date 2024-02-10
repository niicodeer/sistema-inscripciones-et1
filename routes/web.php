<?php

use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PreinscriptoController;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/preinscripcion', [PreinscriptoController::class, 'index'])->name('preinscripcion');
Route::post('/preinscripcion', [PreinscriptoController::class, 'store'])->name('preinscripcion');

/* Route::get('/preinscripcion-correcta', function () {
    return view('preinscripcion-correcta');
})->name('confirmacion-preinscripcion'); */

Route::get('/preinscripcion-correcta', function () {
    return view('preinscripcion-correcta');
})->name('confirmacion-preinscripcion')->middleware('checkPreinscripcion');

/* Route::get('/preinscripcion', function () {
    return view('livewire.preinscripcion-form');
})->name('preinscipcion'); */


Route::get('/verificar-cuil', [PreinscriptoController::class, 'verificacion'])->name('verificar-cuil');
Route::post('/verificar-cuil', [PreinscriptoController::class, 'verificarCUIL'])->name('verificar-cuil');

/* Route::get('/admin')->name('admin');
 */

Route::get('/inscripcion', [InscripcionController::class, 'index'])->name('inscripcion');
