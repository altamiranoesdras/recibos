<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoPagosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipo_pagos')->delete();
        
        \DB::table('tipo_pagos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Efectivo',
                'created_at' => '2022-05-15 11:44:32',
                'updated_at' => '2022-05-15 11:44:32',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Cheque',
                'created_at' => '2022-05-15 11:44:38',
                'updated_at' => '2022-05-15 11:44:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Transferencia',
                'created_at' => '2022-05-15 11:44:48',
                'updated_at' => '2022-05-15 11:44:48',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}