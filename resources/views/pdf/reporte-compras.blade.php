<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Compras</title>
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/style-compras.css">
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/main.min.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <body>
        <header>
            @foreach ($encabezado_compra as $encabezado)
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img"> <img src="/var/www/html/proyectos/asilo/public/assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen"> </td>
                    <td>  <h3 class="text-secondary"> ASILO DE ANCIANOS RETALHULEU</h3>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                        <h4> BODEGA DE INSUMOS</h4>
                    <td> <h3 class="text-secondary" id="codigo">{{ $encabezado_compra }}</h3> </td>
                </tr>
            </table>

            <table id="tabla-empleado">
                <tr>
                    <td style="width: 20%" > <strong>Documento: </strong></td>
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
                            <th style="width: 10%;">  <i class="fas fa-hashtag"></i> </th>
                            <th> <i class="fas fa-qrcode"></i> CÓDIGO</th>
                            <th> <i class="fas fa-store"></i> NOMBRE</th>
                            <th> <i class="fas fa-store"></i> PRESENTACIÓN</th>
                            <th> <i class="fas fa-search"></i> OBSERVACIÓN</th>
                            <th> <i class="fas fa-sort-numeric-up-alt"></i> Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <td>1</td>
                            <td >Shaun Park</td>
                            <td>10/08/2019</td>
                            <td>320</td>
                            <td > Observación</td>
                            <td>1</td>
                            <td>2</td>
                            <td>100</td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td >Shaun Park</td>
                            <td>10/08/2019</td>
                            <td>320</td>
                            <td > Observación</td>
                            <td>1</td>
                            <td>2</td>
                            <td>100</td>
                        </tr>

                    </tbody>
                </table>
        </div> <!--fin tabla responsive -->
        <!-- FIN TABLA DATOS -->

        <footer>
            <table id="pie">
                <tr>
                    <td >Recibió (F)</td>
                    <td class="info"></td>

                    <td>Entregó </td>
                    <td class="info"></td>

                    <td>Autorizó (F)</td>
                    <td class="info"></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td class="info"></td>

                    <td>Nombre</td>
                    <td class="info"></td>

                    <td>Nombre</td>
                    <td class="info"></td>
                </tr>
            </table>
        </footer>
    </body>
</html>
