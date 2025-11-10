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
        Schema::create('eneagramas_preguntas_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eneagrama_usuario_id')->constrained('eneagramas_usuario')->onDelete('cascade'); //el ID del eneagrama que corresponde a un usuario
            $table->string('pregunta');
            $table->integer('valor');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eneagramas_preguntas_usuario');
    }
};
