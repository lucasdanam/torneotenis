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
        Schema::create('torneo_jugador', function (Blueprint $table) {
            $table->unsignedBigInteger('torneo_id');
            $table->unsignedBigInteger('jugador_id');
            $table->timestamps();
            $table->foreign('torneo_id')->references('id')->on('torneos');
            $table->foreign('jugador_id')->references('id')->on('jugadoresmasculinos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneo_jugador');
    }
};
