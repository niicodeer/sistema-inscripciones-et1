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
            $table->bigInteger("CUIL");
            $table->string("nombre");
            $table->string("apellido");
            $table->string("email");
            $table->date("fecha_nac");
            $table->boolean("esAlumno")->default(false);
            $table->unsignedBigInteger("idTutor")->nullable();
            $table->foreign("idTutor")->references("id")->on("tutores");
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
