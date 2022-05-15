<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TipoPago
 * @package App\Models
 * @version May 15, 2022, 11:19 am CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $recibos
 * @property string $nombre
 */
class TipoPago extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tipo_pagos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function recibos()
    {
        return $this->hasMany(\App\Models\Recibo::class, 'tipo_pago_id');
    }
}
