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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuil', 11);
            $table->string('nombre', 20);
            $table->string('genero', 10);
            $table->string('apellido', 20);
            $table->string('email', 100);
            $table->string('telefono');
            $table->date('fecha_nac')->nullable();
            $table->boolean('es_alumno')->default(false);
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->foreign('tutor_id')->references('id')->on('tutores')->onUpdate('set null')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar restricciones de clave externa antes de eliminar la tabla
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign(['dato_id']);
            $table->dropForeign(['tutor_id']);
        });
        Schema::dropIfExists('estudiantes');
    }
};
