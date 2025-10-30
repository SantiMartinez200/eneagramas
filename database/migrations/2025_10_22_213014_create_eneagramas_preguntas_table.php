<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eneagramas_preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eneagramas_base_id')->constrained('eneagramas_base')->restrictOnDelete();
            $table->string('pregunta'); //la pregunta
            $table->integer('valor'); //el valor chakral papu
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eneagramas_preguntas');
    }
};
