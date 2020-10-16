<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                <button type="button" @click="openModalTable('create')" class="btn btn-info mb-2">Tabla <i class="fas fa-table"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <h5 class="text-secondary text-center"><strong>INFORMACIÓN RESIDENTES</strong></h5>
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"><i class="fas fa-user-check"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-user-check"></i> Apellido</th>
                                    <th class="text-center"><i class="fas fa-pager"></i> Edad</th>
                                    <th class="text-center"><i class="fas fa-id-card"></i> DPI</th>
                                    <!-- <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(signos, index) in lista_signos" :key="signos.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="signos.codigo" class="text-center"></td>
                                    <td v-text="signos.nombre" class="text-center"></td>
                                    <td v-text="signos.apellido" class="text-center"></td>
                                    <td v-text="signos.edad" class="text-center"></td>
                                    <td v-text="signos.dpi" class="text-center"></td>

                                    <!-- <td class="text-center">
                                        <button type="button" @click="openModal(signos)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                        <button type="button" @click="openForm('update', signos)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para guardar y actualizar -->
        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
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
                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-lungs"></i> Frecuencia respiratoria</label>
                                    <input type="text" name="frec_respiratoria" v-model="frec_respiratoria" class="form-control" :class="hasError('frec_respiratoria') ? 'is-invalid' : ''" placeholder="Ingrese frecuencia respiratoria...">
                                    <div v-if="hasError('frec_respiratoria')" class="invalid-feedback">
                                        {{ errors.frec_respiratoria[0] }}
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
                                    <label class="text-dark"><i class="fas fa-search"></i> Observacion</label>
                                    <input type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese observacion...">
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para la tabla -->
        <div :class="{'mostrar': modalTable}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header dark-header">
                                <button type="button" @click="closeModalTable()" class="close" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- <div class="d-flex justify-content-between"> -->
                                <div class="form-group float-center">
                                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                                    <h5 class="text-secondary text-center"><strong>DETALLE SIGNOS VITALES</strong></h5>
                                </div>
                                
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <form class="form-inline p-3">
                                    <div class="search-bar ">
                                        <input type="date" class="form-control search-form-control">
                                        <button class="btn btn-info mb-2 mr-2 rounded-circle "> <i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha</th>
                                        <th class="text-center"><i class="fas fa-clock"></i> Hora</th>
                                        <th class="text-center"><i class="fas fa-lungs"></i> Frecuencia respiratoria</th>
                                        <th class="text-cente"><i class="fas fa-file-medical-alt"></i> Presión arterial</th>
                                        <th class="text-center"><i class="fas fa-thermometer-full"></i> Temperatura</th>
                                        <th class="text-center"><i class="fas fa-heartbeat"></i> Pulso</th>
                                        <th class="text-cente"><i class="fas fa-weight"></i> Peso</th>
                                        <th class="text-center"><i class="fas fa-search"></i> Observacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(signos, index) in lista_signos" :key="signos.id">
                                        <td v-text="index+1"></td>
                                        <td v-text="signos.fecha_actual"></td>
                                        <td v-text="signos.hora"></td>
                                        <td v-text="signos.frec_respiratoria"></td>
                                        <td v-text="signos.presion"></td>
                                        <td v-text="signos.temperatura"></td>
                                        <td v-text="signos.pulso"></td>
                                        <td v-text="signos.peso"></td>
                                        <td v-text="signos.observacion"></td>
                                        <td>
                                            <button type="button" @click="openModalTable(signos)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
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
                fecha_actual: '',
                hora: '',
                frec_respiratoria: '',
                presion: '',
                temperatura: '',
                pulso: '',
                peso: '',
                observacion: '',

                lista_signos: '',

                modal: 0,
                titulo: '',
                opcion: 0,
                errors: [],

                modalTable: 0,
            }
        },
        methods: {
            openModal(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.modal = 1
                        this.titulo = "Registro de empleados"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización de empleados"
                        this.opcion = 2
                        this.fecha_actual = data['fecha_actual']
                        this.hora = data['hora']
                        this.frec_respiratoria = data['frec_respiratoria']
                        this.presion = data['presion']
                        this.temperatura = data['temperatura']
                        this.pulso = data['pulso']
                        this.peso = data['peso']
                        this.observacion = data['observacion']
                        this.id = data['id']
                    }
                }
            },
            closeModal() {
                this.fecha_actual = ''
                this.hora = ''
                this.frec_respiratoria = ''
                this.presion = ''
                this.temperatura = ''
                this.pulso = ''
                this.peso = ''
                this.observacion = ''

                this.modal = 0
                this.titulo = ''
                this.opcion = 0
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            openModalTable() {
                this.modalTable = 1
                this.titulo = 'Lista de Signos vitales'

            },
            closeModalTable() {
                this.modalTable = 0
                this.titulo = ''

                alerts.sweetAlert('success', 'Acción finalizada')
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
            dataTable() {
                let datatable = $('#zero-config').DataTable()
                datatable.destroy()
                this.$nextTick(function() {
                    $('#zero-config').DataTable( {
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
            showList() {
                let me = this
                let url = '/signos'

                axios.get(url).then(function (response) {
                    me.lista_signos = response.data
                    console.log(response.data)
                    me.dataTable()
                }).catch(function (error) {
                    console.log(error)
                })
            },
        },
        mounted() {
            this.showList()
        },
    }
</script>