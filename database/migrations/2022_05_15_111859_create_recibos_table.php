<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('monto', 10);
            $table->text('monto_letras');
            $table->text('nombre_persona');
            $table->text('motivo_o_concepto');
            $table->unsignedInteger('tipo_pago_id')->index('fk_recibos_tipo_pagos1_idx');
            $table->unsignedBigInteger('usuario_id')->index('fk_recibos_users_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos');
    }
}
