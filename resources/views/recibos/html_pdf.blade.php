<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo</title>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/factura.css')}}">
</head>

<body>

    <header class='clearfix pb-0'>
        <table width="100%">
            <tr>
                <td>
                    <div id='logo'>
                        <img src='{{getLogo()}}' style="max-width: 400px;  height: 100px">
                    </div>
                </td>
                <td align="right">
                    <div id='company'>
                    <h3>Recibo No. <u>{{$recibo->id}}</u></h3>
                    </div>
                </td>
            </tr>
        </table>
    </header>

    <main style="height: auto">

        <table class="table table-borderless table-sm mb-0" width="100%">
            <tr>

                <td width="20%">
                fecha:
                </td>
                <td class="border-bottom">
                    <b>{{$recibo->fecha->format('d'). " de ".mesLetras($recibo->fecha->format('m'))." de ".$recibo->fecha->format('Y')}}</b>
                </td>
            </tr>
            <tr>
                <td>
                Recibí de:
                </td>
                <td class="border-bottom">
                    <b>
                    {{$recibo->nombre_persona}}
                    </b>
                </td>
            </tr>
            <tr>
                <td>
                    La cantidad de:
                </td>
                <td class="border-bottom">
                    <b>{{dvs().nfp($recibo->monto)}}</b>
                </td>
            </tr>

        </table>

        <div class="ml-2 mb-2">
            Cantidad en letras:
        </div>
        <div class=" bg-light px-3 py-1" style="border: solid;border-radius: 2rem !important;">
            <b>{{$recibo->monto_letras}}</b>
        </div>


        <table class="table table-borderless" width="100%">
            <tr>

                <td width="20%">
                    Por concepto de:
                </td>
                <td class="border-bottom">
                    <b>{{$recibo->motivo_o_concepto}}</b>
                </td>
            </tr>


        </table>

        <br>

        <div class="justify-content-center mt-5" style="padding-right: 10rem;padding-left: 10rem">

            <div class="text-center" style="border-top: solid">
                Nombre y firma de quien recibe
            </div>

        </div>


    </main>


</body>
</html>
