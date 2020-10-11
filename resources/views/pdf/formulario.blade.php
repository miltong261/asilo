<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
    <link rel="stylesheet" href="../../assets/css/style-formulario.css">
    <link rel="stylesheet" href="../../../public/assets/css/main.min.css">
    <body>
        @foreach ($reserva as $r)
        <header>
            <table class="text-center" id="tabla-encabezado">
                <tr>
                    <td id="td-img"> <img src="../../assets/img/logo-pdf.jpeg" alt="Logo asilo" id="imagen"> </td>
                    <td>  <h3 class="text-secondary"> ASILO DE ANCIANOS RETALHULEU</h3>
                        <h5> Residenciales Ciudad Palmeras </h5>
                        <h5>Cantón Recuerdo Ocosito, Retalhuleu </h5>
                    <td>  </td>
                </tr>
                <tr>
                    <td style="text-decoration:  underline black" colspan="3">  <strong> <h4> DATOS PERSONALES</h4> </strong> </td>
                </tr>
            </table>

        </header>
        
        @endforeach

        <!-- INICIO TABLA -->
        <div class="table-responsive">
                <table id="tabla-datos" class="text-center table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th style="width: 25%;" id=" fila-encabezado">Fecha de ingreso:</th>
                            <th style="width: 25%;" > </th>
                        </tr>
                        <tr >
                            <th>Nombre completo:</th>
                            <th > </th> 
                        </tr>
                        <tr >
                            <th>Edad:</th>
                            <th ></th>
                            <th style="width: 25%;"> Fecha de Nacimiento: </th>
                            <th></th>
                        </tr>
                        <tr >
                            <th>Lugar de nacimiento:</th>
                            <th > </th>
                        </tr>
                        <tr>
                            <th>Número de DPI:</th>
                            <th > </th>
                            <th> Extendida en: </th>
                            <th> </th>
                        </tr>

                        <tr>
                            <th>Familiar:</th>
                            <th > </th>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <th >  </th>
                            <th > Teléfono: </th>
                            <th>  </th>
                        </tr>

                        <tr>
                            <th>Persona referida:</th>
                            <th > </th>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <th >  </th>
                            <th > Teléfono: </th>
                            <th>  </th>
                        </tr>

                        <tr>
                            <th>Motivo de llegada</th>
                            <th > </th>
                        </tr>
                        <tr>
                            <th>Estado del residente</th>
                            <th > </th>
                            <th>Historial</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Observaciones</th>
                            <th > </th>
                        </tr>

                       
                    </thead>
                </table>
        </div>
        <!-- FIN TABLA DATOS -->
    </body>
</html>