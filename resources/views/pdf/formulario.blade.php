<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/style-formulario.css">
    <link rel="stylesheet" href="/var/www/html/proyectos/asilo/public/assets/css/main.min.css">
</head>
<body>
    <header>
        <table class="text-center" id="tabla-encabezado">
            <tr>
                <td id="td-img"> <img src="/var/www/html/proyectos/asilo/public/assets/img/logo-formulario.jpeg" alt="Logo asilo" id="imagen"> </td>
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

    <!-- INICIO TABLA -->
    <div class="table-responsive">
        @foreach ($data as $residente)
            <table id="tabla-datos" class="text-center table table-bordered table-hover table-striped mb-4">
                <thead>
                    <tr>
                        <th style="width: 25%;" id=" fila-encabezado">Fecha de ingreso:</th>
                        <th style="width: 25%;" > {{ $residente->fecha_ingreso }} </th>
                    </tr>
                    <tr >
                        <th>Nombre completo:</th>
                        <th > {{ $residente->nombre .' '. $residente->apellido }} </th>
                    </tr>
                    <tr >
                        <th>Edad:</th>
                        <th > {{ $edad }} </th>
                        <th style="width: 25%;"> Fecha de Nacimiento: </th>
                        <th> {{ $residente->fecha_nacimiento }} </th>
                    </tr>
                    <tr >
                        <th>Lugar de nacimiento:</th>
                        <th> {{ $residente->departamento_origen_nombre .', '. $residente->municipio_origen_nombre }} </th>
                    </tr>
                    <tr>
                        <th>Número de DPI:</th>
                        <th> {{ $residente->dpi }} </th>
                        <th> Extendida en: </th>
                        <th> {{ $residente->departamento_dpi_nombre .', '. $residente->municipio_dpi_nombre }} </th>
                    </tr>

                    <tr>
                        <th>Familiar:</th>
                        <th > {{ $residente->familia }} </th>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <th > {{ $residente->direccion }} </th>
                        <th > Teléfono: </th>
                        <th> {{ $residente->telefono_familia }} </th>
                    </tr>

                    <tr>
                        <th>Persona referida:</th>
                        <th > {{ $residente->persona_referida }} </th>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <th > {{ $residente->direccion_persona_referida }} </th>
                        <th > Teléfono: </th>
                        <th> {{ $residente->telefono_persona_referida }} </th>
                    </tr>

                    <tr>
                        <th>Motivo de llegada</th>
                        <th > {{ $residente->motivo }} </th>
                    </tr>
                    <tr>
                        <th>Estado del residente</th>
                        <th > {{ $residente->estado }} </th>
                        <th>Historial</th>
                        <th> {{ $residente->historial }} </th>
                    </tr>
                    <tr>
                        <th>Observaciones</th>
                        <th > {{ $residente->observacion }} </th>
                    </tr>


                </thead>
            </table>
            @endforeach
    </div>
    <!-- FIN TABLA DATOS -->
</body>
</html>

