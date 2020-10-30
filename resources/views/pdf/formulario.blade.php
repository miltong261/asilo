<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path() }}/assets/css/style-formulario.css">
</head>
<body>
    <header>
        <table class="text-center" id="tabla-encabezado">
            <tr>
                <td id="td-img">
                    <img src="{{ public_path() }}/assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen">
                </td>
                <td>
                    <h4 > ASILO DE ANCIANOS RETALHULEU</h4>
                    <h5> Residenciales Ciudad Palmeras </h5>
                    <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                </td>
                <td></td>
                <tr>
                <td colspan="3">  <strong> <h4 style="margin-top: 1%; text-decoration: underline black;" >  DATOS PERSONALES</h4> </strong> </td>
                </tr>

            </tr>
        </table>

    </header>

    <!-- INICIO TABLA -->
    <div class="table-responsive">
        @foreach ($data as $residente)
            <table id="tabla-datos" class="text-center table table-bordered table-hover table-striped mb-4">
                <thead>
                    <tr>
                        <th class="titulo" style="width: 8%;" id=" fila-encabezado">Fecha de ingreso:</th>
                        <th colspan="3" style="width: 25%;" > {{ $residente->fecha_ingreso }} </th>
                    </tr>
                    <tr >
                        <th class="titulo">Nombre completo:</th>
                        <th colspan="3"> {{ $residente->nombre .' '. $residente->apellido }} </th>
                    </tr>
                    <tr >
                        <th class="titulo">Edad:</th>
                        <th > {{ $edad }} </th>
                        <th class="titulo" style="width: 8%;"> Fecha de Nacimiento: </th>
                        <th> {{ $residente->fecha_nacimiento }} </th>
                    </tr>
                    <tr >
                        <th class="titulo">Lugar de nacimiento:</th>
                        <th colspan="3"> {{ $residente->departamento_origen_nombre .', '. $residente->municipio_origen_nombre }} </th>
                    </tr>
                    <tr>
                        <th class="titulo">Número de DPI:</th>
                        <th> {{ $residente->dpi }} </th>
                        <th class="titulo"> Extendido en: </th>
                        <th> {{ $residente->departamento_dpi_nombre .', '. $residente->municipio_dpi_nombre }} </th>
                    </tr>

                    <tr>
                        <th class="titulo">Familiar:</th>
                        <th colspan="3"> {{ $residente->familia }} </th>
                    </tr>
                    <tr>
                        <th class="titulo"> Teléfono: </th>
                        <th colspan="3"> {{ $residente->telefono_familia }} </th>
                    </tr>
                    <tr>
                        <th class="titulo">Dirección:</th>
                        <th colspan="3"> {{ $residente->direccion }} </th>

                    </tr>

                    <tr>
                        <th class="titulo">Persona referida:</th>
                        <th > {{ $residente->persona_referida }} </th>

                    </tr>

                    <tr>
                        <th class="titulo"> Teléfono: </th>
                        <th colspan="3"> {{ $residente->telefono_persona_referida }} </th>
                    </tr>
                    <tr>
                        <th class="titulo">Dirección:</th>
                        <th colspan="3"> {{ $residente->direccion_persona_referida }} </th>

                    </tr>

                    <tr>
                        <th class="titulo">Motivo de llegada</th>
                        <th colspan="3"> {{ $residente->motivo }} </th>
                    </tr>
                    <tr>
                        <th class="titulo">Estado del residente</th>
                        <th  colspan="3"> {{ $residente->estado }} </th>
                    </tr>

                    <tr>
                        <th class="titulo">Historial</th>
                        <th  colspan="3"> {{ $residente->historial }} </th>
                    </tr>
                    <tr>
                        <th class="titulo">Observaciones</th>
                        <th colspan="3"> {{ $residente->observacion }} </th>
                    </tr>

                    <tr style="color:white">
                        <td>.</td>
                    </tr>

                    <tr  style="color:white">
                        <td>.</td>
                    </tr>

                    <tr>
                        <th class="titulo">Firma del anciano</th>
                        <th style="border-bottom: solid 1pt black" colspan="2">  </th>
                    </tr>

                    <tr style="color:white">
                        <td>.</td>
                    </tr>

                    <tr  style="color:white">
                        <td>.</td>
                    </tr>

                    <tr>
                        <th class="titulo">Firma de quien refiere</th>
                        <th style="border-bottom: solid 1pt black" colspan="2">  </th>
                    </tr>

                </thead>
            </table>
            @endforeach
    </div>
    <!-- FIN TABLA DATOS -->
</body>
</html>
