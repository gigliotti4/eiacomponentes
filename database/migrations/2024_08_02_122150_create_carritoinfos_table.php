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
        Schema::create('carritoinfos', function (Blueprint $table) {
            $table->id();
            $table->string('desc_mp')->nullable();
            $table->string('desc_lo')->nullable();
            $table->string('desc_tb')->nullable();
            $table->text('info_retiro_local')->nullable();
            $table->text('info_envio_caba')->nullable();
            $table->text('info_envio_caba2')->nullable();
            $table->string('minimo')->default('50000');
            $table->text('info_expreso')->nullable();
            $table->text('expreso_detalle')->default("Traslado del pedido de la fábrica al expreso a cargo del comprador");
            $table->text('info_tc')->nullable();
            $table->text('info_tb')->nullable();
            $table->text('info_pago_local')->nullable();
            $table->text('texto_mp')->nullable();
            $table->text('texto_tb')->nullable();
            $table->text('datos_tb')->nullable();
            $table->text('terminos_detalle')->nullable();
            $table->text('terminos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritoinfos');
    }
};
