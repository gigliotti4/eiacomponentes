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
        Schema::create('orderconsumidor', function (Blueprint $table) {
            $table->id();
            $table->string('nombreApellido', 255);
            $table->string('dniCuit', 20);
            $table->string('email', 255);
            $table->string('celular', 20);
            $table->string('direccion', 255);
            $table->string('localidad', 255);
            $table->string('provincia', 255);
            $table->string('codigoPostal', 10);
            $table->text('texto')->nullable();
            $table->string('metododepago', 50);
            $table->string('envio', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderconsumidor');
    }
};
