<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Salidas</title>
    <link rel="stylesheet" href="{{ public_path() }}/assets/css/style-salidas.css">
    <body>
        <header>
            @foreach ($encabezado_salida as $encabezado)
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img">
                        <img src="{{ public_path() }}/assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen">
                    </td>
                    <td>
                        <h4 > ASILO DE ANCIANOS RETALHULEU</h4>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                        <br>
                        <h4> BODEGA DE INSUMOS</h4>
                    <td style="display: table-cell;vertical-align: middle;">
                        <h4 id="codigo">{{ $encabezado->codigo }}</h4>
                    </td>
                </tr>
            </table>

            <table id="tabla-empleado">
                <tr>
                    <td style="width: 35%" > <strong>Solicitó: </strong></td>
                    <td > {{ $encabezado->nombre_empleado .' '. $encabezado->apellido_empleado }} </td>
                </tr>
                <tr>
                    <td> <strong>Área: </strong> </td>
                    <td> {{ $encabezado->nombre_area }} </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Registro: </strong> </td>
                    <td> {{ $encabezado->fecha_registro }} </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Salida: </strong> </td>
                    <td> {{ $encabezado->fecha_salida }} </td>
                </tr>
            </table>
            @endforeach
        </header>

        <!-- INICIO TABLA -->
        <div class="table-responsive">
            <table id="tabla-datos" class="text-center table ">
                <thead>
                    <tr id="fila-encabezado">
                        <th style="width: 10%;"> # </th>
                        <th> <i class="fas fa-store"></i> NOMBRE</th>
                        <th> <i class="fas fa-store"></i> UNIDAD</th>
                        <th> <i class="fas fa-store"></i> PRESENTACIÓN</th>
                        <th> <i class="fas fa-search"></i> OBSERVACIÓN</th>
                        <th> <i class="fas fa-sort-numeric-up-alt"></i> CANTIDAD</th>
                    </tr>
                </thead>

                @foreach ($detalle_salida as $index => $detalle)
                <tbody  style="text-align: center;">
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td >{{ $detalle->nombre_producto }}</td>
                        <td >{{ $detalle->nombre_unidad }}</td>
                        <td>{{ $detalle->presentacion_producto }}</td>
                        <td>{{ $detalle->observacion_producto }}</td>
                        <td > {{ $detalle->cantidad }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div> <!--fin tabla responsive -->
        <!-- FIN TABLA DATOS -->

        <footer>
            @foreach ($encabezado_salida as $encabezado)
            <table id="pie">
                <tr>
                    <td style="width: 10%"><strong>Recibió: </strong></td>
                    <td style="width: 35%"> {{ $encabezado->nombre_empleado .' '. $encabezado->apellido_empleado }}</td>
                    <td style="width: 10%"><strong>(F):</strong></td>
                    <td style="width: 35%" class="info"></td>
                </tr>

                <tr style="color:white">
                        <td>.</td>
                    </tr>

                <tr  style="color:white">
                    <td>.</td>
                </tr>

                <tr>
                    <td><strong>Autorizó: </strong></td>
                    <td>Israel Gómez Juárez</td>
                    <td ><strong>(F):</strong></td>
                    <td class="info"></td>
                </tr>

                <tr style="color:white">
                        <td>.</td>
                    </tr>

                <tr  style="color:white">
                    <td>.</td>
                </tr>

                <tr>
                    <td><strong>Entregó: </strong></td>
                    <td>{{ $encabezado->nombre_registro .' '. $encabezado->apellido_registro }}</td>
                    <td ><strong>(F):</strong></td>
                    <td class="info"></td>
                </tr>
            </table>
            @endforeach
        </footer>
    </body>
</html>
