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
            $table->string('cuil', 11)->unique();
            $table->string('nombre', 50);
            $table->string('genero', 10);
            $table->string('apellido', 50);
            $table->string('email', 100);
            $table->string('telefono',15);
            $table->date('fecha_nac')->nullable();
            $table->boolean('es_alumno')->default(false);
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->foreign('tutor_id')->references('id')->on('tutores')->onUpdate('set null')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar restricciones de clave externa antes de eliminar la tabla
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign(['tutor_id']);
        });
        Schema::dropIfExists('estudiantes');
    }
};
