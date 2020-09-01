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
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Dirección</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="example in listaExample " :key="example.id">
                                    <td v-text="example.nombre"></td>
                                    <td v-text="example.direccion"></td>
                                    <td class="text-center">
                                        <button type="button" @click="openModal('update', example)" class="btn btn-warning mb-2">Actualizar <i class="fas fa-sync-alt"></i></button>
                                        <button class="btn btn-eliminar mb-2">Eliminar <i class="fa fa-trash-alt"></i></button>
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
                            <div class="form-group">
                                <label for="nombre"><i class="fas fa-user"></i> Nombre</label>
                                <input type="text" v-model="nombre" class="form-control" name="nombre" placeholder="Ingrese Nombre">
                                <span style="color:red" v-if="errors.nombre">{{errors.nombre[0]}}</span>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-map-marker-alt"></i> Dirección</label>
                                <textarea class="form-control" v-model="direccion" name="direccion" rows="3" placeholder="Ingrese su dirección"></textarea>
                                <span style="color:red" v-if="errors.direccion">{{errors.direccion[0]}}</span>
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
    </div>
</template>

<script>
    import * as alerts from '../functions/alerts.js'

    export default {
        data() {
            return {
                id: 0,
                listaExample: [],
                nombre: '',
                direccion: '',

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
                        this.titulo = "Registro de ejemplos"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización de ejemplos"
                        this.opcion = 2
                        this.nombre = data['nombre']
                        this.direccion = data['direccion']
                        this.id = data['id']
                    }
                }
            },
            closeModal() {
                this.nombre = ''
                this.direccion = ''

                this.modal = 0
                this.titulo = ''
                this.opcion = 0
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            showList() {
                let me = this;
                let url = '/example';
                axios.get(url).then(function (response) {
                    me.listaExample = response.data
                    me.dataTable();
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            dataTable() {
                var datatable = $('#zero-config').DataTable()
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
            store(){
                let me = this
                var url = '/example/store'
                axios.post(url,{
                    'nombre': this.nombre,
                    'direccion': this.direccion,
                }).then(function (response) {
                    me.closeModal()
                    me.showList()
                    alerts.sweetAlert('success', 'Se guardó correctamente')
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            },
            update(){
                let me = this
                var url = 'example/update'
                axios.put(url,{
                    'nombre': this.nombre,
                    'direccion': this.direccion,
                    'id': this.id
                }).then(function (response){
                    me.closeModal()
                    me.showList()
                    alerts.sweetAlert('success', 'Se actualizó correctamente')
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        mounted() {
            this.showList()
        },
    }
</script>
