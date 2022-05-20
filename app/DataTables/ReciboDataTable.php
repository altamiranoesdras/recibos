<?php

namespace App\DataTables;

use App\Models\Recibo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReciboDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->addColumn('action', function(Recibo $recibo){

                 $id = $recibo->id;

                 return view('recibos.datatables_actions',compact('recibo','id'))->render();
             })
            ->editColumn('motivo_o_concepto',function (Recibo $recibo){
                return str_limit($recibo->motivo_o_concepto,50);
            })
             ->editColumn('id',function (Recibo $recibo){

                 return $recibo->id;

                 //se debe crear la vista modal_detalles
                 //return view('recibos.modal_detalles',compact('recibo'))->render();

             })
            ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Recibo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Recibo $model)
    {
        return $model->newQuery()->with(['tipoPago','usuario']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->ajax([
                        'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
                    ])
                    ->info(true)
                    ->language(['url' => asset('js/SpanishDataTables.json')])
                    ->responsive(true)
                    ->orderBy(0,'desc')
                    ->dom('
                        <"row mb-2"
                            <"col-sm-12 col-md-6" B>
                            <"col-sm-12 col-md-6" f>
                        >
                        rt
                        <"row"
                            <"col-sm-6 order-2 order-sm-1" ip>
                            <"col-sm-6 order-1 order-sm-2 text-right" l>

                        >
                    ')
                    ->buttons(

                        Button::make('print')
                            ->text('<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'),
                        Button::make('reset')
                            ->text('<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'),
                        Button::make('export')
                            ->text('<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('fecha'),
            Column::make('monto'),
            Column::make('monto_letras'),
            Column::make('nombre_persona'),
            Column::make('motivo_o_concepto'),
            Column::make('tipo_pago')->data('tipo_pago.nombre')->name('tipoPago.nombre'),
            Column::make('usuario')->data('usuario.name')->name('usuario.name'),
            Column::computed('action')
                            ->exportable(false)
                            ->printable(false)
                            ->width('15%')
                            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'recibos_'  . date('YmdHis');
    }
}
