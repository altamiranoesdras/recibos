<?php

namespace App\Http\Controllers;

use App\DataTables\TipoPagoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTipoPagoRequest;
use App\Http\Requests\UpdateTipoPagoRequest;
use App\Models\TipoPago;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TipoPagoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Tipo Pagos')->only(['show']);
        $this->middleware('permission:Crear Tipo Pagos')->only(['create','store']);
        $this->middleware('permission:Editar Tipo Pagos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Tipo Pagos')->only(['destroy']);
    }

    /**
     * Display a listing of the TipoPago.
     *
     * @param TipoPagoDataTable $tipoPagoDataTable
     * @return Response
     */
    public function index(TipoPagoDataTable $tipoPagoDataTable)
    {
        return $tipoPagoDataTable->render('tipo_pagos.index');
    }

    /**
     * Show the form for creating a new TipoPago.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_pagos.create');
    }

    /**
     * Store a newly created TipoPago in storage.
     *
     * @param CreateTipoPagoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPagoRequest $request)
    {
        $input = $request->all();

        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::create($input);

        Flash::success('Tipo Pago guardado exitosamente.');

        return redirect(route('tipoPagos.index'));
    }

    /**
     * Display the specified TipoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago no encontrado');

            return redirect(route('tipoPagos.index'));
        }

        return view('tipo_pagos.show')->with('tipoPago', $tipoPago);
    }

    /**
     * Show the form for editing the specified TipoPago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago no encontrado');

            return redirect(route('tipoPagos.index'));
        }

        return view('tipo_pagos.edit')->with('tipoPago', $tipoPago);
    }

    /**
     * Update the specified TipoPago in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPagoRequest $request)
    {
        /** @var TipoPago $tipoPago */
        $tipoPago = TipoPago::find($id);

        if (empty($tipoPago)) {
            Flash::error('Tipo Pago no encontrado');

            return redirect(route('tipoPagos.index'));
        }

        $tipoPago->fill($request->all());
        $tipoPago->save();

        Flash::success('Tipo Pago actualizado con éxito.');

        return redirect(route('tipoPagos.index'));
    }

    /**
     * Remove the specified TipoPago from storage.
     *
     * @param  int $id
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
            Flash::error('Tipo Pago no encontrado');

            return redirect(route('tipoPagos.index'));
        }

        $tipoPago->delete();

        Flash::success('Tipo Pago deleted successfully.');

        return redirect(route('tipoPagos.index'));
    }
}
