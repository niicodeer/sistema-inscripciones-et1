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
        Schema::create('preinscriptos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuil');
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('email', 100);
            $table->string('telefono', 15);
            $table->string('genero');
            $table->date('fecha_nac');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preinscriptos');
    }
};
