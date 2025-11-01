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
        Schema::create('eneagramas_usuario_verbos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eneagrama_usuario_id')->constrained('eneagramas_usuario')->onDelete('cascade');
            $table->string('verbo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eneagramas_usuario_verbos');
    }
};
