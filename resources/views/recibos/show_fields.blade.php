<!-- Fecha Field -->
{!! Form::label('fecha', 'Fecha:') !!}
{!! fechaLtn($recibo->fecha) !!}<br>


<!-- Monto Field -->
{!! Form::label('monto', 'Monto:') !!}
{!! dvs().nfp($recibo->monto) !!}<br>


<!-- Monto Letras Field -->
{!! Form::label('monto_letras', 'Monto Letras:') !!}
{!! $recibo->monto_letras !!}<br>


<!-- Nombre Persona Field -->
{!! Form::label('nombre_persona', 'Nombre Persona:') !!}
{!! $recibo->nombre_persona !!}<br>


<!-- Motivo O Concepto Field -->
{!! Form::label('motivo_o_concepto', 'Motivo O Concepto:') !!}
{!! $recibo->motivo_o_concepto !!}<br>


<!-- Tipo Pago Id Field -->
{!! Form::label('tipo_pago_id', 'Tipo Pago:') !!}
{!! $recibo->tipoPago->nombre ?? '' !!}<br>


<!-- Usuario Id Field -->
{!! Form::label('usuario_id', 'Usuario:') !!}
{!! $recibo->usuario->name ?? '' !!}<br>


