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
            $table->boolean('habilitar_inscripcion')->default(false);
            $table->date('inicio_fecha_inscripcion')->nullable();
            $table->time('inicio_hora_inscripcion')->nullable();
            $table->date('fin_fecha_inscripcion')->nullable();
            $table->time('fin_hora_inscripcion')->nullable();
            $table->boolean('habilitar_preinscripcion')->default(false);
            $table->date('inicio_fecha_preinscripcion')->nullable();
            $table->date('fin_fecha_preinscripcion')->nullable();
            $table->time('inicio_hora_preinscripcion')->nullable();
            $table->time('fin_hora_preinscripcion')->nullable();
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
