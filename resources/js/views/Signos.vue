<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <template v-if="action==1">
                    <div class="widget-content widget-content-area br-6">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <h5 class="text-secondary text-center"><strong>RESIDENTES</strong></h5>
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
                                            <button type="button" @click="openTable(residente.id, residente.nombre, residente.apellido)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-table"></i></button>
                                            <button type="button" @click="openDashboard(residente.id, residente.nombre, residente.apellido)" class="btn btn-success mb-1 mr-1 rounded-circle"> <i class="fas fa-chart-bar"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>

                <!-- tabla -->
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
                                        <h5 class="text-secondary"><strong>SIGNOS VITALES</strong></h5>
                                        <h5><strong class="text-secondary">Residente: </strong>{{ residente_nombre }}</h5>
                                    </div>

                                    <div class="form-group float-right">
                                        <label for="" class="text-secondary">Buscar por fecha</label>
                                        <input type="date" class="form-control search-form-control" name="fecha" v-model="fecha" @input="change_date()">
                                    </div>

                                </div>

                                <table id="signos" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                            <th class="text-center"><i class="fas fa-clock"></i> Hora</th>
                                            <th class="text-center"><i class="fas fa-lungs"></i> Respiración</th>
                                            <th class="text-cente"><i class="fas fa-file-medical-alt"></i> Presión</th>
                                            <th class="text-center"><i class="fas fa-thermometer-full"></i> Temperatura</th>
                                            <th class="text-center"><i class="fas fa-heartbeat"></i> Pulso</th>
                                            <th class="text-cente"><i class="fas fa-weight"></i> Peso</th>
                                            <th class="text-center"><i class="fas fa-search"></i> Observación</th>
                                            <th class="text-center"><i class="fas fa-user"></i> Registró</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(signos, index) in lista_signos" :key="signos.id">
                                            <td class="text-center" v-text="index+1"></td>
                                            <td class="text-center" v-text="signos.hora_registro"></td>
                                            <td class="text-center"> {{ signos.respiraciones }} rpm</td>
                                            <td class="text-center" v-text="signos.presion"></td>
                                            <td class="text-center">{{ signos.temperatura }} C&#176;</td>
                                            <td class="text-center"> {{ signos.pulso }} lpm</td>
                                            <td class="text-center">{{ signos.peso }} lbs</td>
                                            <td v-text="signos.observacion"></td>
                                            <td class="text-center" v-text="signos.empleado_nombre + ' ' + signos.empleado_epellido"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <button type="button" @click="closeTable()" class="btn btn-cerrar">Salir <i class="fas fa-sign-out-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Modal para guardar -->
        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog modal-xl">
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
                            <label class="text-info">Datos usuario</label>
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
                                        <label class="text-dark"><i class="fas fa-qrcode"></i> Código</label>
                                        <input id="codigo_paciente" type="text" name="codigo" v-model="codigo" class="form-control">
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="text-dark"><i class="fas fa-user-check"></i> Nombre</label>
                                        <input id="nombre_paciente" type="text" name="nombre_completo_paciente" v-model="nombre_completo_paciente" class="form-control">
                                    </div>
                                </div>
                            </fieldset>

                            <label class="text-success">Signos vitales</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label class="text-dark"><i class="fas fa-lungs"></i> Frecuencia respiratoria</label>
                                        <input type="text" name="respiraciones" v-model="respiraciones" class="form-control" :class="hasError('respiraciones') ? 'is-invalid' : ''" placeholder="Ingrese frecuencia respiratoria...">
                                        <div v-if="hasError('respiraciones')" class="invalid-feedback">
                                            {{ errors.respiraciones[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="text-dark"><i class="fas fa-file-medical-alt"></i> Presión arterial</label>
                                        <input type="text" name="presion" v-model="presion" class="form-control" :class="hasError('presion') ? 'is-invalid' : ''" placeholder="Ingrese presión...">
                                        <div v-if="hasError('presion')" class="invalid-feedback">
                                            {{ errors.presion[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-thermometer-full"></i> Temperatura</label>
                                        <input type="text" name="temperatura" v-model="temperatura" class="form-control" :class="hasError('temperatura') ? 'is-invalid' : ''" placeholder="Ingrese temperatura...">
                                        <div v-if="hasError('temperatura')" class="invalid-feedback">
                                            {{ errors.temperatura[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-heartbeat"></i> Pulso</label>
                                        <input type="text" name="pulso" v-model="pulso" class="form-control" :class="hasError('pulso') ? 'is-invalid' : ''" placeholder="Ingrese pulso...">
                                        <div v-if="hasError('pulso')" class="invalid-feedback">
                                            {{ errors.pulso[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-weight"></i> Peso</label>
                                        <input type="text" name="peso" v-model="peso" class="form-control" :class="hasError('peso') ? 'is-invalid' : ''" placeholder="Ingrese peso...">
                                        <div v-if="hasError('peso')" class="invalid-feedback">
                                            {{ errors.peso[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-search"></i> Observación</label>
                                        <input type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese observacion...">
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

        <!-- Modal para gráfica -->
        <div :class="{'mostrar': modalGrafica}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeDashboard()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <canvas id="canvas"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeDashboard()">Salir <i class="far fa-times-circle"></i></button>
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
            codigo: '',
            nombre_completo_paciente: '',
            lista_residentes: [],

            /** Datos del usuario */
            nombre_usuario: '',
            usuario_usuario: '',
            nota: '',

            /** Signos */
            lista_signos: [],
            fecha: '',

            /** Registro */
            hora: '',
            tiempo: '',
            respiraciones: '',
            presion: '',
            temperatura: '',
            pulso: '',
            peso: '',
            observacion: '',

            action: 1,
            modal: 0,
            titulo: '',

            errors: [],

            /** Gráfica */
            modalGrafica: 0,
            signos: [],
            signos_dias: [],
            signos_temperatura: [],
        }
    },
    methods: {
        openModal(id, codigo, nombre, apellido) {
            this.modal = 1
            this.titulo = 'REGISTRO DE SIGNOS VITALES'

            this.residente_id = id
            this.codigo = codigo
            this.nombre_completo_paciente = nombre + ' ' + apellido

            document.getElementById('codigo_paciente').disabled = true
            document.getElementById('nombre_paciente').disabled = true
        },
        closeModal() {
            this.modal = 0
            this.titulo = ''

            this.residente_id = ''
            this.codigo = ''
            this.nombre_completo_paciente = ''
            this.respiraciones = ''
            this.presion = ''
            this.temperatura = ''
            this.pulso = ''
            this.peso = ''
            this.observacion = ''

            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openTable(id, nombre, apellido) {
            let me = this
            me.destroyTable('#listado')

            me.action = 2

            me.residente_id = id
            me.residente_nombre = nombre + ' ' + apellido

            let url = '/signos/signos?id=' + me.residente_id

            axios.get(url).then(function (response) {
                if (response.data.status == 'error') {
                    me.lista_signos = []
                    alerts.sweetAlert(response.data.status, response.data.message)
                } else {
                    me.lista_signos = response.data.signos
                    me.dataTable('#signos')
                }
            }).catch(function (error) {
                console.log(error)
            })
        },
        change_date() {
            let me = this
            me.destroyTable('#signos')

            let url = '/signos/signos_fecha?id=' + me.residente_id + '&fecha_buscar=' + me.fecha

            axios.get(url).then(function (response) {
                if (response.data.status == 'error') {
                    me.lista_signos = []
                    alerts.sweetAlert(response.data.status, response.data.message)
                } else {
                    me.lista_signos = response.data.signos
                    me.dataTable('#signos')
                }
            }).catch(function (error) {
                console.log(error)
            })
        },
        closeTable() {
            this.destroyTable('#signos')
            this.showList()
            this.action = 1
            this.residente_id = 0
            this.residente_nombre = ''
            this.fecha = moment().format('YYYY-MM-DD')
            this.lista_signos = []
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openDashboard(id, nombre, apellido) {
            this.modalGrafica = 1
            this.titulo = 'RESIDENTE: ' + nombre.toUpperCase() + ' ' + apellido.toUpperCase()

            let me = this
            let url = '/signos/graficos?id=' + id

            axios.get(url).then(function (response) {
                me.signos = response.data.signos
                console.log(response.data)

                for(var i = 0; i < me.signos.length; i++) {
                    me.signos_dias.push(me.signos[i].dias)
                    me.signos_temperatura.push(me.signos[i].temperatura)
                }


                new Chart(document.getElementById('canvas').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: me.signos_dias,
                        datasets: [{
                            label: 'Grados Celsius',
                            data: me.signos_temperatura,
                            lineTension: 0,
                            fill: false,
                            borderColor: 'red',
                            backgroundColor: 'transparent',
                            borderDash: [10, 5],
                            pointBorderColor: 'red',
                            pointBackgroundColor: 'rgba(255,150,0,0.5)',
                            pointRadius: 5,
                            pointHoverRadius: 10,
                            pointHitRadius: 30,
                            pointBorderWidth: 2,
                            pointStyle: 'rectRounded'
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Media de la temperatura en los últimos días',
                            fontSize: 30,
                            padding: 30,
                            fontColor: '#5c1ac3'
                        },
                        elements: {
                            line: {
                                // fill: true,
                            }
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                boxWidth: 80,
                                fontColor: 'black'
                            }
                        }
                    }
                })
            })
        },
        closeDashboard() {
            this.modalGrafica = 0
            this.signos = []
            this.signos_dias = []
            this.signos_temperatura = []
            this.titulo = ''

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        hasError(field) {
            return field in (this.errors)
        },
        backendResponse(response) {
            if(response.data.status == 'success'){
                this.closeModal()
                this.showList()
                alerts.sweetAlert(response.data.status, response.data.message)
            }else{
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
            let url = '/signos/'

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
            let url = '/signos/store'

            axios.post(url, {
                'residente_id': this.residente_id,
                'respiraciones': this.respiraciones,
                'presion': this.presion,
                'pulso': this.pulso,
                'peso': this.peso,
                'temperatura': this.temperatura,
                'observacion': this.observacion
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error => {
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        }
    },
    mounted() {
        this.fecha = moment().format('YYYY-MM-DD')
        this.showList()
    },
}
</script>
