<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <!-- Tabla -->
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
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>123456</td>
                                    <td>Maria</td>
                                    <td>Werner</td>
                                    <td>23</td>

                                    <!-- <tr v-for="(notas, index) in lista_notas " :key="notas.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="notas.codigo" class="text-center"></td>
                                    <td v-text="notas.nombre_id" class="text-center"></td>
                                    <td v-text="notas.nota" class="text-center"></td>
                                    <td v-text="notas.medicamento_id" class="text-center"></td>
                                    <td v-text="notas.cantidad" class="text-center"></td>
                                    <td v-text="notas.responsable" class="text-center"></td> -->

                                    <td class="text-center">
                                        <button type="button" @click="openModal('create')" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-plus"></i></button>
                                        <button type="button" @click="openModalTable('create')" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-table"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>        
            </div>
        </div>


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
                            <label class="text-info">Datos usuario</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-qrcode"></i> Usuario</label>
                                        <input type="text" name="usuario" v-model="usuario" class="form-control" :class="hasError('usuario') ? 'is-invalid' : ''">
                                        <div v-if="hasError('usuario')" class="invalid-feedback">
                                            {{ errors.usuario[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="text-dark"><i class="fas fa-user"></i> Nombre</label>
                                        <input type="text" name="nombre" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''">
                                        <div v-if="hasError('nombre')" class="invalid-feedback">
                                            {{ errors.nombre[0] }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <label class="text-danger">Datos del residente</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                        <label class="text-dark"><i class="fas fa-qrcode"></i> Codigo</label>
                                        <input type="text" name="codigo" v-model="codigo" class="form-control" :class="hasError('codigo') ? 'is-invalid' : ''">
                                        <div v-if="hasError('codigo')" class="invalid-feedback">
                                            {{ errors.codigo[0] }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label class="text-dark"><i class="fas fa-user-check"></i> Nombre</label>
                                        <input type="text" name="nombre" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''">
                                        <div v-if="hasError('nombre')" class="invalid-feedback">
                                            {{ errors.nombre[0] }}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <label class="text-success">Notas residentes</label>
                            <fieldset class="border border-fieldset rounded p-3">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-search"></i> Observacion</label>
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

        
        <!-- Modal tabla-->
        <div :class="{'mostrar': modalTable}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="widget-content widget-content-area ">
                        <div class="widget-header p-2">
                            <div class="form-group float-center">
                                <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                                <h5 class="text-secondary text-center"><strong>DETALLE NOTAS</strong></h5>
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
                                        <th class="text-center"><i class="fas fa-search"></i> Observacion</th>
                                        <th class="text-center"><i class="fas fa-user"></i> Registró</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(detalle, index) in lista_detalle" :key="detalle.id">
                                        <td v-text="index+1"></td>
                                        <td v-text="detalle.fecha_actual"></td>
                                        <td v-text="detalle.hora"></td>
                                        <td v-text="detalle.observacion"></td>
                                        <td v-text="detalle.nombre_usuario"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <button type="button" @click="closeModalTable()" class="btn btn-cerrar">Salir <i class="fas fa-sign-out-alt"></i></button>
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
                codigo: '',
                lista_notas: [],
                nombre: '',
                usuario: '',
                observacion: '',

                lista_detalle: [],

                modal:0,
                opcionModal: 1,
                modalTable: 0,
                opcionModalTable: 1,
                titulo: '',

                errors: [],
            }
        },
        methods: {
            openModal(metodo, data = []) {
                this.modal = 1
                this.titulo = "Registro de notas"
                this.opcionModal = 1
                    
            },
            closeModal(){
                this.nombre = ''
                this.observacion = ''

                this.modal = 0
                this.titulo = ''
                this.opcionModal = 0
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            openModalTable(data = []){
                this.titulo = 'Lista de notas'

                this.modalTable = 1
                this.openModalTable = 1
            },
            closeModalTable(){
                this.modalTable = 0
                this.openModalTable = 0
                this.titulo = ''
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            hasError(field) {
                return field in (this.errors)
            },
            backendResponse(response) {
                if(response.data.status == 'success'){
                    if (this.opcionModal == 1){
                    this.closeModal()
                    this.showList()
                    alerts.sweetAlert(response.data.status, response.data.message)
                    this.opcionModal = 0
                }

                if (this.openModalTable == 1){
                    this.closeModalTable()
                    this.showList()
                    alerts.sweetAlert(response.data.status, response.data.message)
                    this.opcionModalTable = 0
                }
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
        },
    }
</script>