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
    Schema::create('eneagramas_usuario', function (Blueprint $table) {
        $table->id();
        
        // Foreign key con tabla users
        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');
        $table->foreignId('base_id')
            ->constrianed('eneagramas_base');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eneagramas_usuario');
    }
};
