<?php

namespace Database\Factories;

use App\Models\Recibo;
use App\Models\TipoPago;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use NumeroALetras;

class ReciboFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recibo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $monto = $this->random(50.2, 200.7);


        $montoLetras = NumeroALetras::convertir(nfp($monto,2),'QUETZALES','CENTAVOS',true);

        return [
            'fecha' => $this->faker->date,
            'monto' => $monto,
            'monto_letras' => $montoLetras,
            'nombre_persona' => $this->faker->name,
            'motivo_o_concepto' => $this->faker->paragraph,
            'tipo_pago_id' => TipoPago::all()->random()->id,
            'usuario_id' => User::all()->random()->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        ];
    }

    public function random($min, $max){
        $decimals = max($this->count_decimals($min), $this->count_decimals($max));
        $factor = pow(10, $decimals);
        return rand($min*$factor, $max*$factor) / $factor;
    }

    function count_decimals($x){
        return  strlen(substr(strrchr($x."", "."), 1));
    }
}
