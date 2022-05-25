<?php

namespace App\Http\Controllers;

use App\DataTables\ReciboDataTable;
use App\DataTables\Scopes\ReciboScopeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
use App\Models\Recibo;
use Barryvdh\DomPDF\PDF;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\App;
use Response;

class ReciboController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Recibos')->only(['show']);
        $this->middleware('permission:Crear Recibos')->only(['create','store']);
        $this->middleware('permission:Editar Recibos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Recibos')->only(['destroy']);
    }

    /**
     * Display a listing of the Recibo.
     *
     * @param ReciboDataTable $reciboDataTable
     * @return Response
     */
    public function index(ReciboDataTable $reciboDataTable)
    {
        $scope = new ReciboScopeDataTable();

        $reciboDataTable->addScope($scope);

        return $reciboDataTable->render('recibos.index');
    }

    /**
     * Show the form for creating a new Recibo.
     *
     * @return Response
     */
    public function create()
    {
        return view('recibos.create');
    }

    /**
     * Store a newly created Recibo in storage.
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboRequest $request)
    {

        $request->merge([
            'usuario_id' => auth()->user()->id
        ]);

        /** @var Recibo $recibo */
        $recibo = Recibo::create($request->all());

        Flash::success('Recibo guardado exitosamente.');

        return redirect(route('recibos.index'));
    }

    /**
     * Display the specified Recibo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        return view('recibos.show')->with('recibo', $recibo);
    }

    /**
     * Show the form for editing the specified Recibo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        return view('recibos.edit')->with('recibo', $recibo);
    }

    /**
     * Update the specified Recibo in storage.
     *
     * @param  int              $id
     * @param UpdateReciboRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboRequest $request)
    {
        /** @var Recibo $recibo */
        $recibo = Recibo::find($id);

        if (empty($recibo)) {
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        $recibo->fill($request->all());
        $recibo->save();

        Flash::success('Recibo actualizado con éxito.');

        return redirect(route('recibos.index'));
    }

    /**
     * Remove the specified Recibo from storage.
     *
     * @param  int $id
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
            Flash::error('Recibo no encontrado');

            return redirect(route('recibos.index'));
        }

        $recibo->delete();

        Flash::success('Recibo deleted successfully.');

        return redirect(route('recibos.index'));
    }

    public function imprimir(Recibo $recibo)
    {
        return view('recibos.imprime',compact('recibo'));
    }

    public function htmlToPdf(Recibo $recibo)
    {
//        return view('recibos.html_pdf',compact('recibo'));



        /**
         * @var PDF $pdf
         */
        $pdf = App::make('dompdf.wrapper');

        $vita = view('recibos.html_pdf',compact('recibo'))->render();


        return $pdf->loadHTML($vita)
            ->setPaper('letter','portrait')
            ->stream("recibo_".$recibo->id.".pdf");
    }
}
