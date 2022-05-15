<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TipoPago;

class TipoPagoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_pago()
    {
        $tipoPago = TipoPago::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_pagos', $tipoPago
        );

        $this->assertApiResponse($tipoPago);
    }

    /**
     * @test
     */
    public function test_read_tipo_pago()
    {
        $tipoPago = TipoPago::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_pagos/'.$tipoPago->id
        );

        $this->assertApiResponse($tipoPago->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_pago()
    {
        $tipoPago = TipoPago::factory()->create();
        $editedTipoPago = TipoPago::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_pagos/'.$tipoPago->id,
            $editedTipoPago
        );

        $this->assertApiResponse($editedTipoPago);
    }

    /**
     * @test
     */
    public function test_delete_tipo_pago()
    {
        $tipoPago = TipoPago::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_pagos/'.$tipoPago->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_pagos/'.$tipoPago->id
        );

        $this->response->assertStatus(404);
    }
}
