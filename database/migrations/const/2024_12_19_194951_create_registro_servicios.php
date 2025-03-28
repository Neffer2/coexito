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
        Schema::create('registro_servicios', function (Blueprint $table) {
            $table->id();
            $table->foreign('recomendador_id')->references('id')->on('recomendadores');
            $table->foreignId('recomendador_id');
            $table->string('num_factura');
            $table->string('foto_factura');
            $table->string('segmento')->default('NULL');
            $table->integer('num_bonos');
            $table->integer('valor_factura')->default(0);
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id')->default(2);
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_servicios');
    }
};
