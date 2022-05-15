<?php

namespace App\DataTables\Scopes;

use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTableScope;

class ReciboScopeDataTable implements DataTableScope
{


    private $del;
    private $al;
    private $monto;
    private $nombre_persona;
    private $motivo_o_concepto;
    private $tipo_pago;
    private $usuario;


    public function __construct()
    {
        $this->del = request()->del ?? null;
        $this->al = request()->al ?? null;
        $this->monto = request()->monto ?? null;
        $this->nombre_persona = request()->nombre_persona ?? null;
        $this->motivo_o_concepto = request()->motivo_o_concepto ?? null;
        $this->tipo_pago = request()->tipo_pagos ?? null;
        $this->usuario = request()->usuarios ?? null;
    }


    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {

        if ($this->monto){
            $query->where('monto', $this->monto);
        }

        if ($this->nombre_persona){

            $query->where('nombre_persona','like', parseStrLike($this->nombre_persona));
        }

        if ($this->motivo_o_concepto){
            $query->where('motivo_o_concepto','like', parseStrLike($this->motivo_o_concepto));
        }

        if ($this->tipo_pago){
            if (is_array($this->tipo_pago)){
                $query->whereIn('tipo_pago_id', $this->tipo_pago);

            }else{
                $query->where('tipo_pago_id', $this->tipo_pago);
            }
        }

        if ($this->usuario){

            if (is_array($this->usuario)){
                $query->whereIn('usuario_id', $this->usuario);
            }else{
                $query->where('usuario_id', $this->usuario);
            }
        }

        if ($this->del && $this->al){

            $del = Carbon::parse($this->del);
            $al = Carbon::parse($this->al)->addDay();

            $query->whereBetween('fecha', [$del,$al]);

        }

    }
}
