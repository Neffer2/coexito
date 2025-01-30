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
        Schema::create('codigos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('serial');
            $table->integer('conteo');
            $table->foreign('estado_cod')->references('id')->on('estados');
            $table->foreignId('estado_cod')->default(1);
            $table->foreign('estado_serial')->references('id')->on('estados');
            $table->foreignId('estado_serial')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigos');
    }
};
