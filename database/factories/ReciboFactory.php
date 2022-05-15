<?php

namespace Database\Factories;

use App\Models\Recibo;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'fecha' => $this->faker->word,
        'monto' => $this->faker->word,
        'monto_letras' => $this->faker->text,
        'nombre_persona' => $this->faker->text,
        'motivo_o_concepto' => $this->faker->text,
        'tipo_pago_id' => $this->faker->randomDigitNotNull,
        'usuario_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
