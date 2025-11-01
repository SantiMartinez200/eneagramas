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
        Schema::create('eneagramas_frases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eneagramas_base_id')->constrained('eneagramas_base')->onDelete('cascade');
            $table->string('frase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eneagramas_frases');
    }
};
