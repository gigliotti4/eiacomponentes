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
        Schema::create('comprars', function (Blueprint $table) {
            $table->id();
            $table->string('orden')->nullable();
            $table->string('icono')->nullable(); // Campo para el icono
            $table->string('numero')->nullable(); // Campo para el número
            $table->text('texto')->nullable(); // Campo para el texto
            $table->timestamps(); // 
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprars');
    }
};
