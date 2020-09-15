<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-store"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-cart-plus"></i> Entrada</th>
                                    <th class="text-center"><i class="fas fa-shopping-cart"></i> Salida</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(movimientoCaja, index) in lista_movimientoCaja" :key="movimientoCaja.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="movimientoCaja.codigo" class="text-center"></td>
                                    <td v-text="movimientoCaja.cantidad" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="movimientoCaja.entrada">
                                            <span class="badge outline -badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="movimientoCaja.salida">
                                            <span class="badge outline-badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" @click="openModal('update', movimientoCaja)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                        <button class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="cantidad"><i class="fas fa-pencil-alt"></i> Nombre</label>
                                    <input  @keyup.enter="store()" type="text" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" name="cantidad"    >
                                    <div v-if="hasError('cantidad')" class="invalid-feedback">
                                        {{ errors.cantidad[0] }}
                                    </div>
                                </div>
                            </div>

                            <label class="text-dark">Marcar <i class="fas fa-check"></i>  para...</label>
                            <fieldset class="border border-light rounded p-1">
                                <div class="n-chk text-center">
                                    <label class="new-control new-checkbox checkbox-outline-check">
                                        <input type="checkbox" class="new-control-input"  name="entrada" v-model="entrada">
                                        <span class="new-control-indicator"></span>Entrada
                                    </label>
                                    <label class="new-control new-checkbox checkbox-outline-check">
                                        <input type="checkbox" class="new-control-input" name="salida" v-model="salida">
                                        <span class="new-control-indicator"></span>Salida
                                    </label>
                                </div>
                            </fieldset>
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
    </div>
</template>

<script>
    import * as alerts from '../functions/alerts.js'

    export default {
        data() {
            return {
                id: 0,
                lista_movimientoCaja: [],
                nombre: '',
                entrada: false,
                salida: false,

                modal: 0,
                titulo: '',
                opcion: 0,
                errors: []
            }
        },
        methods: {
            openModal(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.modal = 1
                        this.titulo = "Registro movimiento"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización movimiento"
                        this.opcion = 2
                        this.nombre = data['nombre']
                        this.entrada = data['entrada']
                        this.salida = data['salida']
                        this.id = data['id']
                    }
                }
            },
            closeModal() {
                this.nombre = ''
                this.entrada = false
                this.salida = false

                this.modal = 0
                this.titulo = ''
                this.opcion = 0
                this.errors = []

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
                let me = this;
                let url = '/movimientos';
                axios.get(url).then(function (response) {
                    me.lista_movimientoCaja = response.data
                    me.dataTable();
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
        },
        mounted() {
            this.showList()
        },
    }
</script>