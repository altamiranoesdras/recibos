<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReciboAPIRequest;
use App\Http\Requests\API\UpdateReciboAPIRequest;
use App\Models\Recibo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReciboController
 * @package App\Http\Controllers\API
 */

class ReciboAPIController extends AppBaseController
{
    /**
     * Display a listing of the Recibo.
     * GET|HEAD /recibos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Recibo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $recibos = $query->get();

        return $this->sendResponse($recibos->toArray(), 'Recibos retrieved successfully');
    }

    /**
     * Store a newly created Recibo in storage.
     * POST /recibos
     *
     * @param CreateReciboAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboAPIRequest $request)
    {
        $input = $request->all();

        /** @var Recibo $recibo */
        $recibo = Recibo::create($input);

        return $this->sendResponse($recibo->toArray(), 'Recibo guardado exitosamente');
    }

    /**
     * Display the specified Recibo.
     * GET|HEAD /recibos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo no encontrado');
        }

        return $this->sendResponse($recibo->toArray(), 'Recibo retrieved successfully');
    }

    /**
     * Update the specified Recibo in storage.
     * PUT/PATCH /recibos/{id}
     *
     * @param int $id
     * @param UpdateReciboAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboAPIRequest $request)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo no encontrado');
        }

        $recibo->fill($request->all());
        $recibo->save();

        return $this->sendResponse($recibo->toArray(), 'Recibo actualizado con éxito');
    }

    /**
     * Remove the specified Recibo from storage.
     * DELETE /recibos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            return $this->sendError('Recibo no encontrado');
        }

        $recibo->delete();

        return $this->sendSuccess('Recibo deleted successfully');
    }
}
