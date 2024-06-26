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
            $table->string('turno', 10);
            $table->string('modalidad', 15);
            $table->string('escuela_proviene', 30);
            $table->string('condicion_alumno', 10);
            $table->string('estado_inscripcion')->default('pendiente');
            $table->boolean('adeuda_materias')->nullable();
            $table->string('nombre_materias', 50)->nullable();
            $table->json('reconocimientos');
            $table->date('fecha_inscripcion');
            $table->string('curso_inscripto', 15);
            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->string('comprobante_inscripcion')->unique()->nullable();
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
