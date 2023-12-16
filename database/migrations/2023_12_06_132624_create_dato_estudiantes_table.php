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
            $table->string('medioTransporte');
            $table->string('domicilio');
            $table->string('obraSocial');
            $table->string('lugarNacimiento');
            $table->date('fechaIngreso');
            $table->string('convivencia');
            $table->string('escuelaProviene');
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
