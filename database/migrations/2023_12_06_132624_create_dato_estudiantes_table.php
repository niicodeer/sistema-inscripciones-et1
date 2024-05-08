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
        Schema::create('dato_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('provincia');
            $table->string('ciudad');
            $table->string('localidad');
            $table->json('medio_transporte');
            $table->string('calle');
            $table->unsignedInteger('numeracion');
            $table->string('piso')->nullable();
            $table->string('telefono');
            $table->string('obra_social');
            $table->string('nombre_obra_social')->nullable();
            $table->string('lugar_nacimiento');
            $table->date('fecha_ingreso')->nullable();
            $table->json('convivencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dato_estudiantes');
    }
};
