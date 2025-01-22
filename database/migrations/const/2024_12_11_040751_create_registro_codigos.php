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
        Schema::create('registro_codigos', function (Blueprint $table) {
            $table->id();
            $table->foreign('codigo_id')->references('id')->on('codigos');
            $table->foreignId('codigo_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('user_id');
            $table->string('foto_factura');
            $table->boolean('baterias_auto')->nullable();
            $table->boolean('baterias_moto')->nullable();
            $table->boolean('lubricantes_auto')->nullable();
            $table->boolean('lubricantes_moto')->nullable();
            $table->boolean('energiteca')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_codigos');
    }
};
