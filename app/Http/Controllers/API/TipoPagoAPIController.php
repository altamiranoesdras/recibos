<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoPagoAPIRequest;
use App\Http\Requests\API\UpdateTipoPagoAPIRequest;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TipoPagoController
 * @package App\Http\Controllers\API
 */

class TipoPagoAPIController extends AppBaseController
{
    /**
     * Display a listing of the TipoPago.
     * GET|HEAD /tipoPagos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = TipoPago::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tipoPagos = $query->get();

        return $this->sendResponse($tipoPagos->toArray(), 'Tipo Pagos retrieved successfully');
    }

    /**
     * Store a newly created TipoPago in storage.
     * POST /tipoPagos
     *
     * @param CreateTipoPagoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPagoAPIRequest $request)
    {
        $input = $request->all();

        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::create($input);

        return $this->sendResponse($tipoPago->toArray(), 'Tipo Pago guardado exitosamente');
    }

    /**
     * Display the specified TipoPago.
     * GET|HEAD /tipoPagos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        return $this->sendResponse($tipoPago->toArray(), 'Tipo Pago retrieved successfully');
    }

    /**
     * Update the specified TipoPago in storage.
     * PUT/PATCH /tipoPagos/{id}
     *
     * @param int $id
     * @param UpdateTipoPagoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPagoAPIRequest $request)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        $tipoPago->fill($request->all());
        $tipoPago->save();

        return $this->sendResponse($tipoPago->toArray(), 'TipoPago actualizado con éxito');
    }

    /**
     * Remove the specified TipoPago from storage.
     * DELETE /tipoPagos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            return $this->sendError('Tipo Pago no encontrado');
        }

        $tipoPago->delete();

        return $this->sendSuccess('Tipo Pago deleted successfully');
    }
}
