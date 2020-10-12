<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Donaciones</title>
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/style-donaciones.css">
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/main.min.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <body>
        <header>
            @foreach ($encabezado_donacion as $encabezado)
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img"> <img src="/var/www/html/proyectos/asilo/public/assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen"> </td>
                    <td>  <h3 class="text-secondary"> ASILO DE ANCIANOS RETALHULEU</h3>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                        <h4> BODEGA DE INSUMOS</h4>
                    <td> <h3 class="text-secondary" id="codigo">{{ $encabezado->codigo }}</h3> </td>
                </tr>
            </table>

            <table id="tabla-donador">
                <tr>
                    <td style="width: 20%" > <strong>Donador: </strong></td>
                    <td > {{ $encabezado->donador }} </td>
                </tr>
                <tr>
                    <td> <strong>Dirección: </strong> </td>
                    <td> {{ $encabezado->direccion}} </td>
                </tr>
                <tr>
                    <td > <strong>Fecha: </strong> </td>
                    <td> {{ $encabezado->fecha_donacion }} </td>
                </tr>
            </table>
            @endforeach
        </header>


        @foreach ($detalle_donacion as $index => $detalle)
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
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $detalle->codigo_producto }}</td>
                        <td >{{ $detalle->nombre_producto }}</td>
                        <td>{{ $detalle->presentacion_producto }}</td>
                        <td>{{ $detalle->observacion_producto }}</td>
                        <td class="text-center">{{ $detalle->cantidad }}</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- FIN TABLA DATOS -->
        @endforeach

        <footer>
            <table id="pie">
                <tr>
                    <td>Recibió (F)</td>
                    <td class="info"></td>
                    <td>Vo.Bo. (F)</td>
                    <td class="info"></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td class="info"></td>
                    <td>Nombre</td>
                    <td class="info"></td>
                </tr>
            </table>
        </footer>
    </body>
</html>
