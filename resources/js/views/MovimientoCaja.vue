<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <button id="openForm" type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-cash-register"></i></button>
                <button id="openMes" type="button" @click="openModalReporte()" class="btn btn-danger mb-1 mr-1"> Reporte mensual <i class="fas fa-file-alt"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <template v-if="action==1">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <div v-for="saldo in caja" :key="saldo.id" class="text-center">
                            <span>Saldo en caja: <strong class="text-secondary">Q {{ saldo.saldo }}</strong></span>
                        </div>
                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Transacción</th>
                                        <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha</th>
                                        <th class="text-center"><i class="fas fa-paste"></i> Tipo movimiento</th>
                                        <th class="text-center"><i class="fas fa-search"></i> Concepto</th>
                                        <th class="text-center"><i class="fas fa-money-bill"></i> Entrada</th>
                                        <th class="text-center"><i class="fas fa-money-bill"></i> Salida</th>
                                        <!-- <th class="text-center"><i class="fas fa-user"></i> Registró</th> -->
                                        <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(movimiento, index) in lista_movimiento" :key="movimiento.id">
                                        <td v-text="index+1" class="text-center"></td>
                                        <td v-text="movimiento.no_transaccion" class="text-center"></td>
                                        <td v-text="movimiento.fecha_registro" class="text-center"></td>
                                        <td v-text="movimiento.tipo_movimiento_nombre" class="text-center"></td>
                                        <td v-text="movimiento.observacion" class="text-center"></td>
                                        <td class="text-center">
                                            <div v-if="movimiento.entrada">
                                                <span class="badge outline-badge-check" v-text="'Q '+movimiento.monto"></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="movimiento.salida">
                                                <span class="badge outline-badge-no-check" v-text="'Q '+movimiento.monto"></span>
                                            </div>
                                        </td>
                                        <!-- <td v-text="movimiento.nombre_usuario" class="text-center"></td> -->
                                        <td class="text-center">
                                            <template v-if="movimiento.tipo_movimiento_nombre!='Compra'">
                                                <button type="button" @click="openModal('update', movimiento)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </template>

                    <template v-else-if="action==2">
                         <div class="d-flex justify-content-between">
                            <div class="form-group float-lef">
                                <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                            </div>

                            <div class="form-group text-center">
                                <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                                <h6>Residenciales Ciudad Palmeras</h6>
                                <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                                <h5 class="text-secondary"><strong>Movimientos</strong></h5>
                                <label class="text-dark"><i class="fas fa-money-bill"></i> Entradas</label>
                                <label for="" class="text-secondary">Q. {{ mes_entrada }} | </label>
                                <label class="text-dark"><i class="fas fa-money-bill"></i> Salidas</label>
                                <label for="" class="text-secondary">Q. {{ mes_salida }}</label>
                            </div>

                            <div class="form-group float-right">
                                <h5 class="p-5">Mes: <strong class="text-secondary">{{ fecha_reporte }}</strong></h5>
                            </div>
                        </div>

                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado_mes" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Transacción</th>
                                        <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha</th>
                                        <th class="text-center"><i class="fas fa-paste"></i> Tipo movimiento</th>
                                        <th class="text-center"><i class="fas fa-search"></i> Concepto</th>
                                        <th class="text-center"><i class="fas fa-money-bill"></i> Entrada</th>
                                        <th class="text-center"><i class="fas fa-money-bill"></i> Salida</th>
                                        <!-- <th class="text-center"><i class="fas fa-user"></i> Registró</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(movimiento, index) in lista_mes" :key="movimiento.id">
                                        <td v-text="index+1" class="text-center"></td>
                                        <td v-text="movimiento.no_transaccion" class="text-center"></td>
                                        <td v-text="movimiento.fecha_registro" class="text-center"></td>
                                        <td v-text="movimiento.tipo_movimiento_nombre" class="text-center"></td>
                                        <td v-text="movimiento.observacion" class="text-center"></td>
                                        <td class="text-center">
                                            <div v-if="movimiento.entrada">
                                                <span class="badge outline-badge-check" v-text="'Q '+movimiento.monto"></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div v-if="movimiento.salida">
                                                <span class="badge outline-badge-no-check" v-text="'Q '+movimiento.monto"></span>
                                            </div>
                                        </td>
                                        <!-- <td v-text="movimiento.nombre_usuario" class="text-center"></td> -->
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Acciones -->
                            <div class="float-right">
                                <button type="button" @click="closeReporte()" class="btn btn-cerrar">Salir <i class="fas fa-sign-out-alt"></i></button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModal()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                            <div class="form-row mb-0">

                                <div class="form-group col-md-12" v-if="opcion==1">
                                    <label class="text-dark"><i class="fas fa-paste"></i> Tipo Movimiento</label>
                                    <select id="tipo_movimiento" class="form-control" name="tipo_movimiento_id" v-model="tipo_movimiento_id">
                                        <option v-for="tipo_movimiento in lista_tipo_movimiento" :key="tipo_movimiento.id" :value="tipo_movimiento.id" v-text="tipo_movimiento.nombre"></option>
                                    </select>
                                </div>


                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-money-bill"></i> Monto</label>
                                    <input type="number" name="monto" v-model="monto" class="form-control" :class="hasError('monto') ? 'is-invalid' : ''" placeholder="Ingrese monto...">
                                    <div v-if="hasError('monto')" class="invalid-feedback">
                                        {{ errors.monto[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Concepto</label>
                                    <input type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese concepto...">
                                    <div v-if="hasError('observacion')" class="invalid-feedback">
                                        {{ errors.observacion[0] }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModal()">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" v-if="opcion==1" class="btn btn-guardar" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
                        <button type="button" v-if="opcion==2" class="btn btn-warning" @click="update()">Actualizar <i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para el reporte -->
        <div :class="{'mostrar': modalReporte}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalReporte()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Mes</label>
                                    <select id="select_mes" class="form-control" v-model="fecha_reporte">
                                        <option v-for="fecha_reporte in lista_fechas" :key="fecha_reporte.nombre" :value="fecha_reporte.nombre" v-text="fecha_reporte.nombre"></option>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalReporte()">Salir <i class="fas fa-sign-out-alt"></i></button>
                        <button type="button" class="btn btn-info" @click="openReporte()">Ver <i class="fas fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import * as alerts from '../functions/alerts.js'

export default {
    data() {
        return {
            id: 0,

            lista_movimiento: [],
            monto: '',
            observacion: '',

            lista_tipo_movimiento: [],
            tipo_movimiento: 0,
            tipo_movimiento_id: 0,
            tipo_movimiento_entrada: 0,
            tipo_movimiento_salida: 0,

            caja: 0,

            modal: 0,
            modalReporte: 0,
            titulo: '',
            opcion: 0,
            errors: [],
            action: 1,

            fecha_reporte: '',
            lista_mes: [],
            mes_salida: 0,
            mes_entrada: 0,
            lista_fechas: [
                {
                    'nombre': 'Enero'
                },
                {
                    'nombre': 'Febrero'
                },
                {
                    'nombre': 'Marzo'
                },
                {
                    'nombre': 'Abril'
                },
                {
                    'nombre': 'Mayo'
                },
                {
                    'nombre': 'Junio'
                },
                {
                    'nombre': 'Julio'
                },
                {
                    'nombre': 'Agosto'
                },
                {
                    'nombre': 'Septiembre'
                },
                {
                    'nombre': 'Octubre'
                },
                {
                    'nombre': 'Noviembre'
                },
                {
                    'nombre': 'Diciembre'
                }
            ]
        }
    },
    methods:{
        openModal(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "REGISTRO DE MOVIMIENTO"
                    this.opcion = 1
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "ACTUALIZACIÓN DE MOVIMIENTO"
                    this.opcion = 2

                    this.monto = data['monto']
                    this.observacion = data['observacion']
                    this.tipo_movimiento_id = data['tipo_movimiento_id']
                    this.tipo_movimiento_entrada = data['entrada']
                    this.tipo_movimiento_salida = data['salida']
                    this.id = data['id']
                }
            }
            this.combo_tipo_movimiento()
        },
        closeModal() {
            this.tipo_movimiento_id = 0
            this.tipo_movimiento_entrada = 0
            this.tipo_movimiento_salida = 0
            this.monto = ''
            this.observacion = ''

            this.modal = 0
            this.titulo = ''
            this.opcion = 0
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openModalReporte(){
            this.modalReporte = 1
            this.titulo = 'REPORTE DE CAJA'
            this.combo_mes()
        },
        closeModalReporte(){
            this.titulo = ''
            this.fecha_reporte = ''
            this.modalReporte = 0

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openReporte() {
            let me = this
            if (me.fecha_reporte == '') {
                alerts.sweetAlert('error', 'Seleccione el mes')
            } else {
                me.action = 2
                me.destroyTable('#listado')
                this.titulo = ''
                this.modalReporte = 0
                document.getElementById('openForm').style.display = 'none'
                document.getElementById('openMes').style.display = 'none'

                let url = '/movimientos/mes?mes=' + me.fecha_reporte

                axios.get(url).then(function (response) {
                    me.lista_mes = response.data.movimientos
                    if (response.data.movimientos == '') {
                        alerts.sweetAlert('error', 'No hay registros para el mes de ' + me.fecha_reporte)

                    } else {
                        me.dataTable('#listado_mes')
                        me.mes_salida = response.data.salida
                        me.mes_entrada = response.data.entrada
                    }
                }).catch(function (error) {

                })
            }
        },
        closeReporte() {
            this.action = 1
            this.destroyTable('#listado_mes')
            this.showList()
            document.getElementById('openForm').style.display = 'inline'
            document.getElementById('openMes').style.display = 'inline'

            this.fecha_reporte = ''
            this.lista_mes = []
            this.mes_salida = ''
            this.mes_entrada = ''
        },
        change_select_mes() {
            let me = this
            $('#select_mes').on('change', function () {
                me.$emit('change', this.value)
                me.fecha_reporte = this.value
            })
        },
        combo_mes(){
            let me = this
            $('#select_mes').select2({
                placeholder: 'Seleccione el mes',
                width: '100%'
            })
        },
        hasError(field) {
            return field in (this.errors)
        },
        backendResponse(response) {
            if(response.data.status == 'success'){
                this.closeModal()
                this.showList()
                this.showSaldo()
                alerts.sweetAlert(response.data.status, response.data.message)
            }else{
                alerts.sweetAlert(response.data.status, response.data.message)
            }
        },
        combo_tipo_movimiento() {
            let me = this;
            let url = '/tipo_movimiento/combo';
            axios.get(url).then(function (response) {
                me.lista_tipo_movimiento = response.data
                $('#tipo_movimiento').select2({
                    placeholder: 'Seleccione tipo de movimiento'
                })
                me.change_select_tipo()
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        change_select_tipo() {
            let me = this

            $('#tipo_movimiento').on('change', function () {
                me.$emit('change', this.value)
                me.tipo_movimiento_id = this.value

                me.selected_tipo(me.tipo_movimiento_id)
            })
        },
        selected_tipo(id) {
            for (var i = 0; i < this.lista_tipo_movimiento.length; i++) {
                if (id == this.lista_tipo_movimiento[i].id) {
                    this.tipo_movimiento_entrada = this.lista_tipo_movimiento[i].entrada
                    this.tipo_movimiento_salida = this.lista_tipo_movimiento[i].salida
                }
            }
        },
        dataTable(table) {
            let datatable = $(table).DataTable()
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
            let datatable = $(table).DataTable()
            datatable.destroy()
        },
        showList() {
            let me = this
            let url = '/movimientos'
            axios.get(url).then(function (response) {
                me.lista_movimiento = response.data
                me.dataTable('#listado');
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        showSaldo() {
            let me = this
            let url = '/movimientos/saldo'
            axios.get(url).then(function (response) {
                me.caja = response.data
            }).catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/movimientos/store'

            if (me.tipo_movimiento_id == 0) {
                alerts.sweetAlert('error', 'Debe de seleccionar el tipo de movimiento')
                $('#tipo_movimiento').next().find('.select2-selection').addClass('has-error');
            } else {
                axios.post(url,{
                    'tipo_movimiento_id': this.tipo_movimiento_id,
                    'monto': this.monto,
                    'observacion': this.observacion,
                    'entrada': this.tipo_movimiento_entrada,
                    'salida': this.tipo_movimiento_salida
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        update() {
            let me = this
            let url = '/movimientos/update'
            axios.put(url,{
                'tipo_movimiento_id': this.tipo_movimiento_id,
                'monto': this.monto,
                'observacion': this.observacion,
                'entrada': this.tipo_movimiento_entrada,
                'salida': this.tipo_movimiento_salida,
                'id': this.id
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        },
    },
    mounted() {
        this.showList()
        this.showSaldo()
        this.change_select_mes()
    }
}
</script>
