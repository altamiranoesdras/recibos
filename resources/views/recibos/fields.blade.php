<div class="form-row" id="camposRecibo">

    <!-- Fecha Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('fecha', 'Fecha:') !!}
        {!! Form::date('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
    </div>

    <!-- Monto Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('monto', 'Monto:') !!}
        {!! Form::number('monto', null, ['class' => 'form-control','step' =>'any']) !!}
    </div>

    <!-- Tipo Pago Id Field -->
    <div class="form-group col-sm-4">
        <select_tipo_pago v-model="tipo_pago" label="Tipo pago"></select_tipo_pago>
    </div>


    <!-- Monto Letras Field -->
    <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('monto_letras', 'Monto Letras:') !!}
        {!! Form::text('monto_letras', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Nombre Persona Field -->
    <div class="form-group col-sm-6 col-lg-6">
        {!! Form::label('nombre_persona', 'Nombre Persona:') !!}
        {!! Form::text('nombre_persona', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Motivo O Concepto Field -->
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('motivo_o_concepto', 'Motivo O Concepto:') !!}
        {!! Form::textarea('motivo_o_concepto', null, ['class' => 'form-control','rows' =>2]) !!}
    </div>

</div>
@push('scripts')
<script>
    const app = new Vue({
        el: '#camposRecibo',
        name: 'camposRecibo',
        created() {

        },
        data: {
            tipo_pago : @json($recibo->tipoPago ?? null)
        },
        methods: {

        }
    });
</script>
@endpush
