<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#fecha').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control']) !!}
</div>

<!-- Monto Letras Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('monto_letras', 'Monto Letras:') !!}
    {!! Form::textarea('monto_letras', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Persona Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('nombre_persona', 'Nombre Persona:') !!}
    {!! Form::textarea('nombre_persona', null, ['class' => 'form-control']) !!}
</div>

<!-- Motivo O Concepto Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('motivo_o_concepto', 'Motivo O Concepto:') !!}
    {!! Form::textarea('motivo_o_concepto', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Pago Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_pago_id', 'Tipo Pago Id:') !!}
    {!! Form::number('tipo_pago_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::number('usuario_id', null, ['class' => 'form-control']) !!}
</div>