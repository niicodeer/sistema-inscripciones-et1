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
    Schema::table('estudiantes', function (Blueprint $table) {
        $table->unsignedBigInteger('dato_id')->nullable();
        $table->foreign('dato_id')->references('id')->on('dato_estudiantes')->onUpdate('set null')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('estudiantes', function (Blueprint $table) {
        $table->dropForeign(['dato_id']);
        $table->dropColumn('dato_id');
    });
}
};
