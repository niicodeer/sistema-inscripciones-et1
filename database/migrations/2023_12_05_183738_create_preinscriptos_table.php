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
            $table->string('cuil', 11)->unique();
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('email', 100);
            $table->string('telefono', 15);
            $table->string('genero', 10);
            $table->date('fecha_nac');
            $table->string('condicion_preinscripcion')->nullable();
            $table->string('comprobante_preinscripcion')->unique()->nullable();
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
        Schema::dropIfExists('preinscriptos');
    }
};
