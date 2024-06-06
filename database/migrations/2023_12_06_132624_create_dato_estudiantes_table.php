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
            $table->string('ciudad', 20);
            $table->string('barrio', 20);
            $table->json('medio_transporte');
            $table->string('calle', 30);
            $table->unsignedInteger('numeracion');
            $table->string('piso')->nullable();
            $table->string('telefono', 15);
            $table->boolean('obra_social');
            $table->string('nombre_obra_social', 15)->nullable();
            $table->string('lugar_nacimiento', 20);
            $table->date('fecha_ingreso')->nullable();
            $table->json('convivencia');
            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onUpdate('set null')->onDelete('set null');
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
