<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Compras</title>
    <link rel="stylesheet" href="C:/xampp/htdocs/asilo/resources/assets/css/style-compras.css">
    <link rel="stylesheet" href="../../assets/css/style-compras.css">  
     <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <body>
        <header>
            @foreach ($encabezado_compra as $encabezado)
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img">
                        <img src="C:/xampp/htdocs/asilo/resources/assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen">
                    </td>
                    <td> 
                        <h4 > ASILO DE ANCIANOS RETALHULEU</h4>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                        <h4> BODEGA DE INSUMOS</h4>
                    <td style="display: table-cell;vertical-align: middle;">
                        <h4 id="codigo">{{ $encabezado->codigo }}</h4>
                    </td>
                </tr>
            </table>

            <table id="tabla-empleado">
                <tr>
                    <td style="width: 30%" > <strong>Documento: </strong></td>
                    <td > {{ $encabezado->documento }} </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Registro: </strong> </td>
                    <td> {{ $encabezado->fecha_registro }} </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Compra: </strong> </td>
                    <td> {{ $encabezado->fecha_compra }} </td>
                </tr>
            </table>
            @endforeach
        </header>

        @foreach ($detalle_compra as $index => $detalle)
        <!-- INICIO TABLA -->
        <div class="table-responsive">
            <table id="tabla-datos" class="text-center table ">
                <thead>
                    <tr id="fila-encabezado">
                        <th style="width: 10%;"> # </th>
                        <th> <i class="fas fa-qrcode"></i> CÓDIGO</th>
                        <th> <i class="fas fa-store"></i> NOMBRE</th>
                        <th> PRECIO </th>
                        <th> <i class="fas fa-store"></i> PRESENTACIÓN</th>
                        <th> <i class="fas fa-search"></i> OBSERVACIÓN</th>
                        <th> <i class="fas fa-sort-numeric-up-alt"></i> CANTIDAD</th>
                    </tr>
                </thead>
                <tbody  style="text-align: center;">
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $detalle->codigo_producto }}</td>
                        <td >{{ $detalle->nombre_producto }}</td>
                        <td> 1 </td>
                        <td>{{ $detalle->presentacion_producto }}</td>
                        <td>{{ $detalle->observacion_producto }}</td>
                        <td > {{ $detalle->cantidad }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="  color:#5c1ac3;" colspan="6">TOTAL</th>
                        <th> 1</th>
                    </tr>
                </tfoot>
            </table>
        </div> <!--fin tabla responsive -->
        <!-- FIN TABLA DATOS -->

        <footer>
            <table id="pie">
                <tr>
                    <td >Recibió (F)</td>
                    <td class="info"></td>
                    <td>Nombre </td>
                    <td class="info"></td>
                </tr>

                <tr>
                    <td>Autorizó (F)</td>
                    <td class="info"></td>
                    <td>Nombre</td>
                    <td class="info"></td>
                </tr>

                <tr>
                    <td>Entregó (F)</td>
                    <td class="info"></td>

                    <td>Nombre</td>
                    <td class="info"></td>
                </tr>
            </table>
        </footer>
    </body>
</html>
