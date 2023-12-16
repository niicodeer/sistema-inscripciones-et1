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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->boolean('aceptado');
            $table->date('fechaInscripcion');
            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onUpdate('set null')->onDelete('set null');
            $table->foreign('curso_id')->references('id')->on('cursos')->onUpdate('set null')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
