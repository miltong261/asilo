<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Inventario</title>
    <link rel="stylesheet" href="../../assets/css/style-inventario.css">
    <link rel="stylesheet" href="../../../public/assets/css/main.min.css">
    <body>

        <header>
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img"> <img src="../../assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen"> </td>
                    <td>  <h3 class="text-secondary"> ASILO DE ANCIANOS RETALHULEU</h3>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5></td>
                    <td> </td>
                </tr>
            </table>

            <table id="tabla-fecha">
                <tr>
                    <td style="width: 15%"> <strong>Fecha: </strong> </td>
                    <td> </td>
                </tr>
            </table>

        </header>



        <!-- INICIO TABLA -->
        <div class="table-responsive">
                <table id="tabla-datos" class="text-center table table-bordered table-hover table-striped mb-4">
                    <thead id="fila-encabezado">
                        <tr id>
                            <th colspan="3">REPORTE DE MOVIMIENTOS DE BODEGA DE MEDICAMENTOS</th>
                            <th colspan="3">OCTUBRE 2020</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th >Existencia inicial</th>
                            <th >Entradas </th>
                            <th >Salidas</th>
                            <th >Existencia Actual</th>
                        </tr>
                        <tr>
                            <th >Descripción del artículo</th>
                            <th>Unidad de medida</th>
                            <th>Cant.</th>

                            <th>Cant.</th>

                            <th>Cant.</th>

                            <th>Cant.</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td >Shaun Park</td>
                            <td>Libra</td>
                            <td>320</td>
                            <td>320</td>
                            <td>320</td>
                            <td class="text-success">320</td>
                        </tr>
                        <tr>
                            <td>Shaunnn Park</td>
                            <td>Libra</td>
                            <td>320</td>
                            <td>320</td>
                            <td>320</td>
                            <td class="text-success">320</td>
                        </tr>
                        <tr>
                            <td >Shaun Park</td>
                            <td>Libra</td>
                            <td>320</td>
                            <td>320</td>
                            <td>320</td>
                            <td class="text-success">320</td>
                        </tr>
                    </tbody>
                </table>
        </div>
        <!-- FIN TABLA DATOS -->

    </body>
</html>
