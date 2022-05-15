<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recibos', function (Blueprint $table) {
            $table->foreign('tipo_pago_id', 'fk_recibos_tipo_pagos1')->references('id')->on('tipo_pagos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('usuario_id', 'fk_recibos_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recibos', function (Blueprint $table) {
            $table->dropForeign('fk_recibos_tipo_pagos1');
            $table->dropForeign('fk_recibos_users');
        });
    }
}
