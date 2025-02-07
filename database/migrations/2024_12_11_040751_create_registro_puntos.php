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
        Schema::create('registro_puntos', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id');
            $table->foreign('pdv_id')->references('id')->on('puntos_venta');
            $table->foreignId('pdv_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreignId('estado_id');
            $table->string('observaciones')->nullable();
            $table->integer('bonos_entregados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_puntos');
    }
};
