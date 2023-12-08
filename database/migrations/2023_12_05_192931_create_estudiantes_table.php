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
            $table->bigInteger('cuil');
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('email', 100);
            $table->date('fecha_nac')->nullable();
            $table->boolean('esAlumno')->default(false);
            $table->unsignedBigInteger('dato_id');
            $table->foreignId('user_id')->references('id')->on('dato_estudiantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
