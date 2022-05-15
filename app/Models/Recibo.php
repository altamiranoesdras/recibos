<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Recibo
 * @package App\Models
 * @version May 15, 2022, 11:20 am CST
 *
 * @property \App\Models\TipoPago $tipoPago
 * @property \App\Models\User $usuario
 * @property string $fecha
 * @property number $monto
 * @property string $monto_letras
 * @property string $nombre_persona
 * @property string $motivo_o_concepto
 * @property integer $tipo_pago_id
 * @property integer $usuario_id
 */
class Recibo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'recibos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'fecha',
        'monto',
        'monto_letras',
        'nombre_persona',
        'motivo_o_concepto',
        'tipo_pago_id',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date:d/m/Y',
        'monto' => 'decimal:2',
        'monto_letras' => 'string',
        'nombre_persona' => 'string',
        'motivo_o_concepto' => 'string',
        'tipo_pago_id' => 'integer',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha' => 'required',
        'monto' => 'required|numeric',
        'monto_letras' => 'required|string',
        'nombre_persona' => 'required|string',
        'motivo_o_concepto' => 'required|string',
        'tipo_pago_id' => 'required|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPago()
    {
        return $this->belongsTo(\App\Models\TipoPago::class, 'tipo_pago_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
