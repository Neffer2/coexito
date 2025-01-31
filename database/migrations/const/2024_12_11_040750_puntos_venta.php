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
        Schema::create('puntos_venta', function (Blueprint $table) {
            $table->id();
            $table->string('nit');
            $table->string('razon_social')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('maps')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('foto_punto')->nullable();
            $table->foreign('asesor_id')->references('id')->on('users');
            $table->foreignId('asesor_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntos_venta');
    }
};
