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
            $table->string('departamento');
            $table->string('localidad');
            $table->string('barrio', 100)->nullable();
            $table->json('medio_transporte')->nullable();
            $table->string('calle', 100)->nullable();
            $table->unsignedInteger('numeracion')->nullable();
            $table->string('piso')->nullable();
            $table->boolean('obra_social')->nullable();
            $table->string('nombre_obra_social', 100)->nullable();
            $table->string('lugar_nacimiento', 50)->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->json('convivencia');
            $table->unsignedBigInteger('estudiante_id')->nullable();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onUpdate('set null')->onDelete('set null');
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
        Schema::dropIfExists('dato_estudiantes');
    }
};
