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
        Schema::create('jugadoresfemeninos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('dni');
            $table->integer('habilidad');
            $table->integer('reaccion');
            $table->timestamps();
            $table->unique('dni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadoresmasculinos');
    }
};
