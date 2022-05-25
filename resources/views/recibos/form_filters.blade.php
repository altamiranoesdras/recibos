
<form id="formFiltersDatatables">

    <div class="form-row">




        <div class="form-group col-sm-2">
            {!! Form::label('del', 'Desde:') !!}
            {!! Form::date('del', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-2">
            {!! Form::label('al', 'Hasta:') !!}
            {!! Form::date('al', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group col-sm-4">
            {!! Form::label('tipo_pago', 'Tipo pago:') !!}
            <multiselect v-model="tipo_pago" :options="tipo_pagos" label="nombre" placeholder="Seleccione uno...">
            </multiselect>
            <input type="hidden" name="tipo_pagos" :value="tipo_pago ? tipo_pago.id : null">
        </div>



        <div class="form-group col-sm-4">
            {!! Form::label('usuario', 'Usuario crea:') !!}
            <multiselect v-model="usuario" :options="usuarios" label="name" placeholder="Seleccione uno...">
            </multiselect>
            <input type="hidden" name="usuarios" :value="usuario ? usuario.id : null">
        </div>



        <div class="form-group col-sm-12 text-center">
            <a  href="{{route('recibos.index')}}" type="submit" id="boton" class="btn btn-secondary mr-4 ">
                <i class="fa fa-times"></i> Limpiar Filtros
            </a>
            &nbsp;
            &nbsp;
            <button type="submit" id="boton" class="btn btn-info ">
                <i class="fa fa-sync"></i> Aplicar Filtros
            </button>
        </div>
    </div>
</form>


@push('scripts')

    <script >

        $(function () {
            $('#formFiltersDatatables').submit(function(e){

                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];

                table.draw();
            });
        })

        new Vue({
            el: '#formFiltersDatatables',
            name: 'fromFiltersPartes',
            created() {

            },
            data: {
                tipo_pagos : @json(\App\Models\TipoPago::all() ?? []),
                tipo_pago: null,

                usuarios : @json(\App\Models\User::all() ?? []),
                usuario: null,


            },
            methods: {

            },
            computed:{

            }
        });
    </script>
@endpush
