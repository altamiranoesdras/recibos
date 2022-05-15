<?php

namespace Database\Seeders;

use App\Models\Recibo;
use Illuminate\Database\Seeder;

class RecibosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        Recibo::factory()->count(100)->create();


    }
}
