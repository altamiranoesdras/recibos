<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Recibo;

class ReciboApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_recibo()
    {
        $recibo = Recibo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/recibos', $recibo
        );

        $this->assertApiResponse($recibo);
    }

    /**
     * @test
     */
    public function test_read_recibo()
    {
        $recibo = Recibo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/recibos/'.$recibo->id
        );

        $this->assertApiResponse($recibo->toArray());
    }

    /**
     * @test
     */
    public function test_update_recibo()
    {
        $recibo = Recibo::factory()->create();
        $editedRecibo = Recibo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/recibos/'.$recibo->id,
            $editedRecibo
        );

        $this->assertApiResponse($editedRecibo);
    }

    /**
     * @test
     */
    public function test_delete_recibo()
    {
        $recibo = Recibo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/recibos/'.$recibo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/recibos/'.$recibo->id
        );

        $this->response->assertStatus(404);
    }
}
