<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Salidas</title>
    <link rel="stylesheet" href="../../assets/css/style-salidas.css">
    <link rel="stylesheet" href="../../../public/assets/css/main.min.css">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <body>
        @foreach ($reserva as $r)
        <header>
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img"> <img src="../../assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen"> </td>
                    <td>  <h3 class="text-secondary"> ASILO DE ANCIANOS RETALHULEU</h3>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                        <h4> BODEGA DE INSUMOS</h4>
                    <td> <h3 class="text-secondary" id="codigo">Requisición No. 000</h3> </td>
                </tr>
            </table>

            <table id="tabla-empleado">
                <tr>
                    <td style="width: 20%" > <strong>Empleado que solicita: </strong></td>
                    <td > </td>
                </tr>
                <tr>
                    <td> <strong>Área: </strong> </td> 
                    <td> </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Registro: </strong> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td > <strong>Fecha de Salida: </strong> </td>
                    <td> </td>
                </tr>
            </table>

        </header>
        
        @endforeach


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
                    <tbody >
                     

                        <tr>
                            <td>1</td>
                            <td >Shaun Park</td>
                            <td>10/08/2019</td>
                            <td>320</td>
                            <td > Observación</td>
                            <td>1</td>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td >Shaun Park</td>
                            <td>10/08/2019</td>
                            <td>320</td>
                            <td > Observación</td>
                            <td>1</td>
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