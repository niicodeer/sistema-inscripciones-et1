<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ajustes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inscripcion');
            $table->date('fecha_preinscripcion');
            $table->time('hora_inscripcion');
            $table->time('hora_preinscripcion');
            $table->boolean('habilitar_inscripcion');
            $table->boolean('habilitar_preinscripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajustes');
    }
};
