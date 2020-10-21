<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <!-- Residentes -->
                <template v-if="action==1">
                    <div class="widget-content widget-content-area br-6">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <h5 class="text-secondary text-center"><strong>INFORMACIÓN RESIDENTES</strong></h5>
                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Nombre</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Apellido</th>
                                        <th class="text-center"><i class="fas fa-pager"></i> Edad</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(residente, index) in lista_residentes " :key="residente.id">
                                        <td v-text="index+1" class="text-center"></td>
                                        <td v-text="residente.codigo" class="text-center"></td>
                                        <td v-text="residente.nombre" class="text-center"></td>
                                        <td v-text="residente.apellido" class="text-center"></td>
                                        <td v-text="residente.edad" class="text-center"></td>
                                        <td class="text-center">
                                            <button type="button" @click="openModal(residente.id, residente.codigo, residente.nombre, residente.apellido)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-plus"></i></button>
                                            <button type="button" @click="openModalTable(residente.id, residente.nombre, residente.apellido)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-table"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>

                <template v-else-if="action==2">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing mx-auto">
                        <div class="widget-content widget-content-area ">
                            <div class="widget-header p-2">
                                <div class="d-flex justify-content-between">
                                    <div class="form-group float-lef">
                                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                                    </div>

                                    <div class="form-group text-center">
                                        <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                                        <h6>Residenciales Ciudad Palmeras</h6>
                                        <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                                        <h5 class="text-secondary"><strong>KARDEX</strong></h5>
                                        <h5><strong class="text-secondary">Residente: </strong>{{ residente_nombre }}</h5>
                                    </div>

                                    <div class="form-group float-right">
                                        <label for="" class="text-secondary">Buscar por fecha</label>
                                        <input type="date" class="form-control search-form-control" name="fecha" v-model="fecha" @input="change_date()">
                                    </div>
                                </div>

                                <table id="notas" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center" ><i class="fas fa-hashtag"></i></th>
                                            <th class="text-center" ><i class="fas fa-clock"></i> Hora</th>
                                            <th class="text-center" ><i class="fas fa-briefcase-medical"></i> Medicamento</th>
                                            <th class="text-center" ><i class="fas fa-hospital-user"></i> Estado del paciente</th>
                                            <th class="text-center" ><i class="fas fa-user"></i> Registró</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(kardex, index) in lista_kardex" :key="kardex.id">
                                            <td class="text-center" v-text="index+1"></td>
                                            <td class="text-center" v-text="kardex.hora"></td>
                                            <td class="text-center" v-text="kardex.nombre_medicamento +' '+kardex.presentacion_medicamento +' '+ kardex.nombre_unidad"></td>
                                            <td v-text="kardex.observacion"></td>
                                            <td class="text-center" v-text="kardex.empleado_nombre + ' ' + kardex.empleado_epellido"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <button type="button" @click="closeModalTable()" class="btn btn-cerrar">Salir <i class="fas fa-sign-out-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog modal-lg">
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
                            <label class="text-info">Datos del usuario</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-qrcode"></i> Usuario</label>
                                        <input id="usuario_usuario" type="text" name="usuario_usuario" v-model="usuario_usuario" class="form-control">
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="text-dark"><i class="fas fa-user"></i> Nombre</label>
                                        <input id="nombre_usuario" type="text" name="nombre_usuario" v-model="nombre_usuario" class="form-control">
                                    </div>
                                </div>
                            </fieldset>

                            <label class="text-danger">Datos del residente</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-qrcode"></i> Coódigo</label>
                                        <input id="codigo_paciente" type="text" name="codigo" v-model="codigo" class="form-control">
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="text-dark"><i class="fas fa-user-check"></i> Nombre</label>
                                        <input id="nombre_paciente" type="text" name="nombre_completo_paciente" v-model="nombre_completo_paciente" class="form-control">
                                    </div>
                                </div>
                            </fieldset>

                            <label class="text-danger">Medicamento</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-search"></i> Buscar</label>
                                        <select id="select_medicamento" class="form-control" v-model="medicamento_id">
                                            <option v-for="medicamento in lista_medicamentos" :key="medicamento.medicamento_id" :value="medicamento.medicamento_id" v-text="medicamento.nombre_medicamento+'/ '+medicamento.presentacion_medicamento+' '+medicamento.nombre_unidad"></option>
                                        </select>
                                    </div>


                                </div>
                            </fieldset>

                            <label class="text-success">Observaciones</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-file"></i> Estado en el que quedó el paciente</label>
                                        <textarea type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese observacion..."></textarea>
                                        <div v-if="hasError('observacion')" class="invalid-feedback">
                                            {{ errors.observacion[0] }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModal()">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" class="btn btn-guardar" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
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
            /** Datos del paciente */
            residente_id: 0,
            residente_nombre: '',
            lista_residentes: [],
            codigo: '',
            nombre_completo_paciente: '',

            /** Datos del usuario */
            nombre_usuario: '',
            usuario_usuario: '',

            /** Guardar */
            lista_medicamentos: [],
            medicamento_id: 0,
            observacion: '',

            /** observacions */
            lista_kardex: [],
            fecha: '',

            /** Modales */
            modal:0,
            modalTable: 0,
            action: 1,

            titulo: '',

            errors: [],
        }
    },
    methods: {
        openModal(id, codigo, nombre, apellido) {
            this.modal = 1
            this.showMedicamento()
            this.titulo = 'KARDEX'

            this.residente_id = id
            this.codigo = codigo
            this.nombre_completo_paciente = nombre + ' ' + apellido

            document.getElementById('codigo_paciente').disabled = true
            document.getElementById('nombre_paciente').disabled = true
        },
        closeModal(){
            this.modal = 0
            this.titulo = ''

            this.residente_id = ''
            this.codigo = ''
            this.nombre_completo_paciente = ''
            this.observacion = ''
            this.medicamento_id = 0,

            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openModalTable(id, nombre, apellido){
            let me = this
            me.destroyTable('#listado')
            me.action = 2

            me.residente_id = id
            me.residente_nombre = nombre + ' ' + apellido

            let url = '/kardex/kardex?id=' + me.residente_id

            axios.get(url).then(function (response) {
                if (response.data.status == 'error') {
                    me.lista_kardex = []
                    alerts.sweetAlert(response.data.status, response.data.message)
                } else {
                    me.lista_kardex = response.data.kardex
                    me.dataTable('#notas')
                }
            }).catch(function (error) {
                console.log(error)
            })
        },
        change_date() {
            let me = this
            me.destroyTable('#notas')

            let url = '/kardex/kardex_fecha?id=' + me.residente_id + '&fecha_buscar=' + me.fecha

            axios.get(url).then(function (response) {
                if (response.data.status == 'error') {
                    me.lista_kardex = []
                    alerts.sweetAlert(response.data.status, response.data.message)
                } else {
                    me.lista_kardex = response.data.kardex
                    me.dataTable('#notas')
                }
            }).catch(function (error) {
                console.log(error)
            })
        },
        closeModalTable() {
            this.destroyTable('#notas')
            this.showList()
            this.action = 1

            this.titulo = ''
            this.residente_id = 0
            this.residente_nombre = ''
            this.fecha = moment().format('YYYY-MM-DD')
            this.lista_kardex = []
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        showMedicamento() {
            let me = this
            let url = '/kardex/medicamentos'

            axios.get(url).then(function (response) {
                if (response.data.status == 'error') {
                    me.lista_medicamentos = []
                    alerts.sweetAlert(response.data.status, response.data.message)
                } else {
                    me.lista_medicamentos = response.data.medicamentos
                    $('#select_medicamento').select2({
                        placeholder: 'Seleccione medicamento'
                    })
                }
            }).catch(function (response) {
                console.log(error)
            })
        },
        change_medicamento() {
            let me = this

            $('#select_medicamento').on('change', function () {
                me.$emit('change', this.value)
                me.medicamento_id = this.value
            })
        },
        hasError(field) {
            return field in (this.errors)
        },
        otherError() {
            let errores = 0
            if (this.medicamento_id == 0) {
                alerts.sweetAlert('error', 'No ha seleccionado ningún medicamento')
                errores = 1
            }

            return errores
        },
        backendResponse(response) {
            if(response.data.status == 'success'){
                this.closeModal()
                this.showList()
                alerts.sweetAlert(response.data.status, response.data.message)
                this.opcionModal = 0
            } else{
                alerts.sweetAlert(response.data.status, response.data.message)
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
            let url = '/kardex/'

            axios.get(url).then(function (response) {
                me.lista_residentes = response.data.pacientes
                me.dataTable('#listado')

                me.usuario_usuario = response.data.usuario[0]['usuario']
                me.nombre_usuario = response.data.usuario[0]['nombre'] + ' ' + response.data.usuario[0]['apellido']

                document.getElementById('usuario_usuario').disabled = true
                document.getElementById('nombre_usuario').disabled = true
            }).catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/kardex/store'

            if (!me.otherError()) return
            else {
                axios.post(url, {
                    'residente_id': this.residente_id,
                    'producto_id': this.medicamento_id,
                    'observacion': this.observacion
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
    },
    mounted() {
        this.fecha = moment().format('YYYY-MM-DD')
        this.showList()
        this.change_medicamento()
    },
}
</script>

