<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <!-- botón nuevo -->
                <div class="text-left ">
                    <button id="openForm" type="button" @click="openForm()" class="btn btn-info mb-2">Nueva <i class="fas fa-plus"></i> </button>
                </div>
                <div class="widget-content widget-content-area br-6">
                    <!-- Listado -->
                    <template v-if="action==1">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"> <i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                        <!-- <th class="text-center"> <i class="fas fa-qrcode"></i> Usuario</th> -->
                                        <th class="text-center"> <i class="fas fa-file"></i> Documento</th>
                                        <th class="text-center"> <i class="fas fa-calendar-alt"></i> Fecha de registro</th>
                                        <th class="text-center"> <i class="far fa-calendar-alt"></i> Fecha de compra</th>
                                        <th class="text-center"> <i class="fas fa-cogs"></i> Opciones </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(compra, index) in lista_compras" :key="compra.id">
                                        <td class="text-center" v-text="index+1"></td>
                                        <td class="text-center" v-text="compra.codigo"></td>
                                        <!-- <td class="text-center" v-text="compra.usuario"></td> -->
                                        <td class="text-center" v-text="compra.documento"></td>
                                        <td class="text-center" v-text="compra.fecha_registro"></td>
                                        <td class="text-center" v-text="compra.fecha_compra"></td>
                                        <td class="text-center">
                                            <button type="button" @click="showCompra(compra.id)" class="btn rounded-circle btn-info mb-1"> <i class="fas fa-eye"></i></button>
                                            <button type="button" @click="pdf(compra.id)" class="btn rounded-circle btn-danger mb-1"> <i class="fas fa-file-pdf"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>

                    <!-- Registro de compras -->
                    <template v-else-if="action==2">
                        <div class="form-group float-left">
                            <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                        </div>

                        <div class="form-row mb-0">
                            <div class="form-group col-md-12 text-center">
                                <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                                <h6>Residenciales Ciudad Palmeras</h6>
                                <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                                <h5 class="text-secondary"><strong>BODEGA DE INSUMOS</strong></h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <!-- Encabezado -->
                            <fieldset class="border border-fieldset rounded p-3 col-md-8 float-left">
                                <label class="text-danger">Encabezado</label>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark"><i class="fas fa-calendar-alt"></i> Fecha de compra</label>
                                        <input type="date" class="form-control" name="fecha_compra" v-model="fecha_compra" :class="hasError('fecha_salida') ? 'is-invalid' : ''">
                                        <div v-if="hasError('fecha_compra')" class="invalid-feedback">
                                            {{ errors.fecha_compra[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="text-dark"><i class="fas fa-store-alt"></i> Documento</label>
                                        <input id="area" type="text" class="form-control" name="documento" v-model="documento">
                                    </div>
                                </div>
                            </fieldset>

                            <br class="p-1">

                            <!-- Búsqueda -->
                            <fieldset class="border border-fieldset rounded p-3 col-md-4 float-right">
                                <label class="text-info">Búsqueda</label>
                                <div class="form-row">
                                    <div class="col-md-12 form-group" v-if="option_enabled">
                                        <label for="" class="text-dark"><i class="fas fa-store"></i> Medicamento o artículo</label>
                                        <select id="select_option" class="form-control" name="select_option" v-model="select_option" @change="showInventario(select_option)">
                                            <option v-for="option in options" :key="option.value" :value="option.value" v-text="option.type"></option>
                                        </select>
                                    </div>

                                    <div class="col-md-9 form-group" v-if="option_enabled==0">
                                        <label for="" class="text-dark"><i class="fas fa-store"></i> Seleccione</label>
                                        <select id="select_producto" class="form-control" v-model="producto_id">
                                            <option v-for="producto in lista_inventario" :key="producto.producto_id" :value="producto.producto_id" v-text="producto.nombre_producto"></option>
                                        </select>
                                    </div>

                                    <div class="col-md-1 form-group" style="padding:30px" v-if="option_enabled==0">
                                        <button  @click="openModalProducto()" class="btn btn-info mb-2 mr-2 rounded-circle"> <i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <br>

                        <!-- Detalle -->
                        <fieldset class="border border-fieldset rounded p-3" v-if="arrayDetalle.length">
                            <label class="text-secondary">Detalle</label>
                            <div class="table-responsive">
                                <table class="table table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> <i class="fas fa-hashtag"></i></th>
                                            <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                            <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                            <th class="text-center"> <i class="fas fa-store"></i> Presentación</th>
                                            <th class="text-center"> <i class="fas fa-search"></i> Observación</th>
                                            <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Cantidad</th>
                                            <th class="text-center"> <i class="fas fa-money-bill-alt"></i> Precio</th>
                                            <th class="text-center"> <i class="fas fa-cogs"></i> Eliminar </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center" v-if="arrayDetalle.length">
                                        <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.codigo_producto"></td>
                                            <td v-text="detalle.nombre_producto"></td>
                                            <td v-text="detalle.presentacion_producto"></td>
                                            <td v-text="detalle.observacion_producto"></td>
                                            <td>
                                                <input onkeypress="return event.charCode >= 48" v-model="detalle.cantidad" type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                <input onkeypress="return event.charCode >= 48" v-model="detalle.precio" type="number" value="2" class="form-control">
                                            </td>
                                            <td>
                                                <button class="btn btn-eliminar mb-2 mr-2 rounded-circle" @click="eliminarProductoDetalle(index)"> <i class="fa fa-trash-alt"></i></button>
                                            </td>
                                        </tr><br>
                                        <tr>
                                            <td colspan="7"></td>
                                            <td colspan="1" style="background-color: #CEECF5;" class="rounded"><h5 style="color:#1b55e2;"><strong>Total:</strong></h5></td>
                                            <td style="background-color: #CEECF5;"><h5>Q {{ total=(calcularTotal) }}</h5></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>

                        <br>

                        <!-- Acciones -->
                        <div class="text-center">
                            <button type="button" @click="closeForm()" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                            <button type="button" class="btn btn-guardar" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
                        </div>
                    </template>

                    <template v-else>
                        <div class="d-flex justify-content-between">
                            <div class="form-group float-lef">
                                <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                            </div>

                            <div class="form-group text-center">
                                <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                                <h6>Residenciales Ciudad Palmeras</h6>
                                <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                                <h5 class="text-secondary"><strong>BODEGA DE INSUMOS</strong></h5>
                            </div>

                            <div class="form-group float-right">
                                <h5 class="text-secondary p-5"><strong>{{ compra_codigo }}</strong></h5>
                            </div>

                        </div>

                        <!-- Encabezado -->
                        <label class="text-danger">Encabezado</label>
                        <fieldset class="border border-fieldset rounded p-3">
                            <div class="form-row mb-0">
                                <table>
                                    <tr>
                                        <td><i class="fas fa-calendar-alt"></i> <strong>Fecha de registro: </strong>{{ compra_fecha_registro }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-calendar-alt"></i> <strong>Fecha de compra: </strong>{{ compra_fecha_compra }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-file"></i> <strong>Documento: </strong>{{ compra_documento }}</td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>

                        <!-- Detalle -->
                        <label class="text-secondary">Detalle</label>
                        <fieldset class="border border-fieldset rounded p-3">
                            <div class="table-responsive">
                                <table class="table table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> <i class="fas fa-hashtag"></i></th>
                                            <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                            <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                            <th class="text-center"> <i class="fas fa-store"></i> Presentación</th>
                                            <th class="text-center"> <i class="fas fa-search"></i> Observación</th>
                                            <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Cantidad</th>
                                            <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                                            <td v-text="index+1"></td>
                                            <td v-text="detalle.codigo_producto"></td>
                                            <td v-text="detalle.nombre_producto"></td>
                                            <td v-text="detalle.presentacion_producto"></td>
                                            <td v-text="detalle.observacion_producto"></td>
                                            <td v-text="detalle.cantidad"></td>
                                            <td v-text="detalle.precio"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="text-center">Cantidad de productos comprados: <strong class="text-secondary">{{ cantidad_suma }}</strong></h6>
                            <h6 class="text-center">TOTAL : <strong class="text-secondary">Q{{ cantidad_suma }}</strong></h6>
                        </fieldset>

                        <br>

                        <!-- Acciones -->
                        <div class="text-right">
                            <button type="button" @click="closeShowSalida()" class="btn btn-cerrar">Salir <i class="fas fa-sign-out-alt"></i></button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Inicio modal -->
        <div :class="{'mostrar': modalProducto}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalProducto()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado_producto" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"> <i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                        <th class="text-center"> <i class="fas fa-store"></i> Presentación</th>
                                        <th class="text-center"> <i class="fas fa-search"></i> Observación</th>
                                        <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Existencia</th>
                                        <th class="text-center"> <i class="fas fa-cogs"></i> Opciones </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr  v-for="(producto, index) in lista_inventario" :key="producto.producto_id">
                                        <td v-text="index+1"></td>
                                        <td v-text="producto.codigo_producto"></td>
                                        <td v-text="producto.nombre_producto"></td>
                                        <td v-text="producto.presentacion_producto"></td>
                                        <td v-text="producto.observacion_producto"></td>
                                        <td v-text="producto.existencia"></td>
                                        <td>
                                            <button type="button" @click="agregarDetalle(producto)"  class="btn btn-guardar btn-sm">
                                                <i class="fa fa-check-circle"></i>
                                            </button> &nbsp;
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalProducto()">Cancelar <i class="far fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    var moment = require('moment')
    import * as alerts from '../functions/alerts.js'

    export default {
        data() {
            return {
                // Lista de compras
                id: 0,
                lista_compras: [],

                // Encabezado
                fecha_compra: '',
                documento: [],
                total: 0.0,

                /**Búsqueda */
                // Opciones (medicamento y artículo)
                options: [
                    {
                        type: 'Medicamento',
                        value: 0
                    },
                    {
                        type: 'Artículo',
                        value: 1
                    }
                ],
                select_option: '',
                option_enabled: 1,

                // Listar los productos de inventario
                modalProducto: 0,
                lista_inventario: [],
                producto_id: 0,
                // Agregar los productos al detalle de la compra
                arrayDetalle: [],

                // Acción del template (1 para listado de compras y 2 para registro)
                action: 1,

                titulo: '',
                errors: [],

                /** Ver compra */
                //Encabezado
                compra_codigo: 0,
                compra_fecha_registro: '',
                compra_fecha_compra: '',
                compra_documento: '',
                compra_precio: 0,
                cantidad_suma: 0
            }
        },
        methods: {
            openForm(){
                this.action = 2
                this.destroyTable('#listado')
                document.getElementById('openForm').style.display = 'none'
            },
            closeForm() {
                this.action = 1
                this.destroyTable('#listado_producto')
                this.showList()
                document.getElementById('openForm').style.display = 'block'

                this.fecha_compra = '',
                this.documento = '',
                this.total = 0.0

                this.select_option = ''
                this.option_enabled = 1
                this.lista_inventario = []
                this.arrayDetalle = []

                this.errors = []

                alerts.sweetAlert('error', 'Compra cancelada')
            },
            openModalProducto() {
                this.modalProducto = 1
                this.titulo = 'Lista de productos'

                this.lista_inventario
            },
            closeModalProducto() {
                this.modalProducto = 0
                this.titulo = ''
            },
            hasError(field) {
                return field in (this.errors)
            },
            otherError() {
                let errores = 0
                let actual = moment()

                if (!this.arrayDetalle.length) {
                    alerts.sweetAlert('error', 'No hay productos seleccionados')
                }

                if (this.arrayDetalle.length) {
                    for (var i = 0; i < this.arrayDetalle.length; i++) {
                        if (this.arrayDetalle[i].cantidad == 0 || this.arrayDetalle[i].cantidad == ''){
                            alerts.sweetAlert('error', 'Debe asignarle una cantidad al producto ' + this.arrayDetalle[i].nombre_producto)
                            errores = 1
                        }

                        if (this.arrayDetalle[i].precio == 0 || this.arrayDetalle[i].precio == '') {
                            alerts.sweetAlert('error', 'Debe asignarle precio al producto ' + this.arrayDetalle[i].nombre_producto)
                            errores = 1
                        }
                    }
                }

                // if (moment(this.fecha_salida).isAfter(actual)){
                //     alerts.sweetAlert('error', 'Esta tratando de asignar una fecha posterior al día de hoy')
                //     errores = 1
                // }

                return errores
            },
            backendResponse(response) {
                if(response.data.status == 'success'){
                    this.closeForm()
                    alerts.sweetAlert(response.data.status, response.data.message)
                }else{
                    alerts.sweetAlert(response.data.status, response.data.message)
                }
            },
            dataTable(table) {
                var datatable = $(table).DataTable()
                datatable.destroy()
                this.$nextTick(function() {
                    $(table).DataTable( {
                        "oLanguage": {
                            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                            "sInfo": "Mostrando página _PAGE_ de _PAGES_",
                            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                            "sSearchPlaceholder": "Buscar...",
                            "sLengthMenu": "Resultado :  _MENU_",
                        },
                        "stripeClasses": [],
                        "lengthMenu": [5, 10, 20, 50],
                        "pageLength": 5,
                        drawCallback: function () { $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5'); }
                    } );
                });
            },
            destroyTable(table) {
                var datatable = $(table).DataTable()
                datatable.destroy()
            },
            showInventario(type) {
                let me = this
                var url

                if (type == 0){
                    url = '/inventario/listar_medicamento_entrada'
                    me.option_enabled = 0
                }
                else if (type == 1){
                    url = '/inventario/listar_producto_entrada'
                    me.option_enabled = 0
                }

                axios.get(url).then(function (response) {
                    me.lista_inventario = response.data
                    me.dataTable('#listado_producto')
                    $('#select_producto').select2({
                        placeholder: 'Seleccione el producto'
                    })
                    me.change_select_producto()
                }).catch(function (error) {
                    console.log(error)
                })
            },
            change_select_producto() {
                let me = this

                $('#select_producto').on('change', function () {
                    me.$emit('change', this.value)
                    me.producto_id = this.value

                    me.selected_producto(me.producto_id)
                    me.producto_id = 0
                })
            },
            selected_producto(id) {
                for (var i = 0; i < this.lista_inventario.length; i++) {
                    if (id == this.lista_inventario[i].producto_id) {
                        if (this.productoEncontrado(id)) {
                            alerts.sweetAlert('error', 'El producto ya esta en la lista')
                        } else {
                            this.arrayDetalle.push({
                                producto_id: this.lista_inventario[i].producto_id,
                                codigo_producto: this.lista_inventario[i].codigo_producto,
                                nombre_producto: this.lista_inventario[i].nombre_producto,
                                presentacion_producto: this.lista_inventario[i].presentacion_producto,
                                observacion_producto: this.lista_inventario[i].observacion_producto,
                                cantidad: 1,
                                precio: 1
                            })
                        }
                    }
                }
            },
            agregarDetalle(data = []) {
                let me = this;

                if (me.productoEncontrado(data['producto_id'])) {
                    alerts.sweetAlert('error', 'El producto ya esta en la lista')
                } else {
                    me.arrayDetalle.push({
                        producto_id: data['producto_id'],
                        codigo_producto: data['codigo_producto'],
                        nombre_producto: data['nombre_producto'],
                        presentacion_producto: data['presentacion_producto'],
                        observacion_producto: data['observacion_producto'],
                        cantidad: 1,
                        precio: 1
                    })
                }
            },
            productoEncontrado(id) {
                var encontrado = false, i

                for (i = 0; i < this.arrayDetalle.length; i++) {
                    if(this.arrayDetalle[i].producto_id == id)
                        encontrado = true
                }

                return encontrado
            },
            eliminarProductoDetalle(index) {
                let me = this
                me.arrayDetalle.splice(index, 1)
            },
            showList() {
                let me = this;
                let url = '/compras';
                axios.get(url).then(function (response) {
                    me.lista_compras = response.data,
                    me.dataTable('#listado');
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            store(){
                let me = this
                let url = '/compras/store'

                if (me.otherError()) return
                else {
                    axios.post(url, {
                        'fecha_compra': this.fecha_compra,
                        'documento': this.documento,
                        'total': this.total,
                        'arrayData': this.arrayDetalle
                    }).then(function (response) {
                        me.backendResponse(response)
                    }).catch(error => {
                        if(error.response.status == 422)
                            this.errors = error.response.data.errors
                    })
                }
            },
            showCompra(id) {
                let me = this
                me.action = 3
                me.showList()
                me.dataTable('#listado')
                document.getElementById('openForm').style.display = 'none'

                let url_cabecera = '/compras/cabecera?id=' + id
                let cabecera = []

                axios.get(url_cabecera).then(function (response) {
                    cabecera = response.data

                    me.compra_codigo = cabecera[0]['codigo']
                    me.compra_fecha_registro = cabecera[0]['fecha_registro']
                    me.compra_fecha_compra = cabecera[0]['fecha_compra']
                    me.compra_documento = cabecera[0]['documento']
                    me.compra_total = cabecera[0]['total']

                }).catch(function (error) {
                    console.log(error)
                })

                let url_detalle = '/compras/detalle?id=' +id

                axios.get(url_detalle).then(function (response) {
                    me.arrayDetalle = response.data

                    for(var i = 0; i < me.arrayDetalle.length; i++)
                        me.cantidad_suma += me.arrayDetalle[0]['cantidad']
                }).catch(function (error) {
                    console.log(error)
                })
            },
            closeShowSalida() {
                this.action = 1
                this.showList()
                this.dataTable('#listado')
                document.getElementById('openForm').style.display = 'block'

                this.compra_codigo = 0
                this.compra_fecha_registro = ''
                this.compra_fecha_compra = ''
                this.documento = ''
                this.cantidad_suma = 0
                this.compra_total = 0.0

                this.arrayDetalle = []

                alerts.sweetAlert('success', 'INSPECCIÓN FINALIZADA')
            },
            pdf(id) {

            },
        },
        mounted() {
            this.showList()
        },
        computed: {
            calcularTotal: function() {
                let resultado = 0.0
                if (this.arrayDetalle.length) {
                    for (var i = 0; i < this.arrayDetalle.length; i++) {
                        resultado += (this.arrayDetalle[i].cantidad * this.arrayDetalle[i].precio)
                    }
                }
                return resultado
            }
        }
    }
</script>
