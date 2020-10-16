<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <link style="">
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        height: 75px;
        width: 100px;
        border-radius: 50%;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 50%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
	
        background: red;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: red;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facservicio{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facservicio thead{
        padding: 20px;
        background: red;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }

    </style>
    <body>
        @foreach ($reserva as $r)
        <header>
            <div id="logo">
                <img src="img/Hotel.jpg" alt="incanatoIT" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Hotel Royal</b><br>Retalhuleu - Retalhuleu, Guatemala<br>Telefono:(+502)4180-2654<br>Email:hotelroyal@gmail.com
                </p>
            </div>
            <div id="fact">
                <p>{{'RESERVA-'.$r->id}}<br></p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">HUESPED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a). {{$r->nombre}}<br>
                            Correo Electrónico: {{$r->email}}<br>
                            </p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>USUARIO</th>
                            <th>FECHA RESERVA</th>
                            <th>FECHA ENTRADA</th>
                            <th>FECHA SALIDA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$r->name}}</td>
                            <td>{{$r->fecha_reserva}}</td>
                            <td>{{$r->fecha_inicio}}</td>
                            <td>{{$r->fecha_fin}}</td>
                        </tr>
                    </tbody>
                </table>

                <table id="facvendedor">
                        <thead>
                            <tr id="fv">
                                <th>No. HABITACIÓN</th>
                                <th>TIPO DE HABITACIÓN</th>
                                <th>TARIFA</th>
                                <th>DÍAS HOSPEDADOS</th>
                                <th>% PROMOCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$r->no_habitacion}}</td>
                                <td>{{$r->nombre_tipo_habitacion}}</td>
                                <td>{{$r->tarifa}}</td>
                                <td>{{$r->dias}}</td>
                                <td>{{(($r->tarifa*$r->porcentaje)/100)}}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <label for="">SERVICIOS</label>
                <table id="facservicio">
                    <thead>
                        <tr id="fa">
                            <th>#</th>
                            <th>CANT</th>
                            <th>DESCRIPCIÓN SERVICIO</th>
                            <th>PRECIO</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalle_reserva as $det)
                        <tr>
                            <td></td>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->nombre_detalle}}</td>
                            <td>{{$det->precio}}</td>
                            <td>{{$det->cantidad*$det->precio}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($reserva as $r)
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>SUBTOTAL</th>
                            <td>Q {{round(($r->total+$r->descuento),2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>DESCUENTO</th>
                            <td>Q {{round($r->descuento,2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>$ {{$r->total}}</td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>!Gracias por su hospedaje, vuelva pronto!</b></p>
            </div>
        </footer>
    </body>
</html>