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
                                    <th class="text-center"><i class="fas fa-user-tag"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-user-tag"></i> Puesto</th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha nacimiento</th>
                                    <th class="text-center"><i class="fas fa-id-card"></i> Dpi</th>
                                    <th class="text-center"><i class="fas fa-at"></i> Email</th>
                                    <th class="text-center"><i class="fas fa-street-view"></i> Dirección</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(empleado, index) in lista_empleados" :key="empleado.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="empleado.nombre + ' ' + empleado.apellido" class="text-center"></td>
                                    <td v-text="empleado.puesto_nombre" class="text-center"></td>
                                    <td v-text="empleado.fecha_nacimiento" class="text-center"></td>
                                    <td v-text="empleado.dpi" class="text-center"></td>
                                    <td v-text="empleado.email" class="text-center"></td>
                                    <td v-text="empleado.direccion" class="text-center"></td>
                                    <td class="text-center">
                                        <button type="button" @click="openModal('update', empleado)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
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
                                    <label for="" class="text-dark"><i class="fas fa-user-tag"></i> Nombre</label>
                                    <input type="text" name="nombre" v-model="nombre" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-user-tag"></i>Apellido</label>
                                    <input type="text" name="apellido" v-model="apellido" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="far fa-calendar-alt"></i> Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" v-model="fecha_nacimiento" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-id-card"></i> DPI</label>
                                    <input type="text" name="dpi" v-model="dpi" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                    <input   type="text" name="direccion" v-model="direccion" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-at"></i> Teléfono</label>
                                    <input type="text" name="telefono" v-model="telefono" class="form-control">
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-at"></i> Email</label>
                                    <input type="text" name="email" v-model="email" class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" class="text-dark"><i class="fas fa-user-tag"></i> Puesto</label>
                                    <select class="form-control" v-model="puesto_id">
                                        <option value="0" disabled>Seleccione puesto</option>
                                        <option v-for="puesto in lista_puestos" :key="puesto.id" :value="puesto.id" v-text="puesto.nombre"></option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
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

            lista_puestos: [],
            puesto_id: 0,

            lista_empleados: [],
            nombre: '',
            apellido: '',
            fecha_nacimiento: '',
            dpi: '',
            direccion: '',
            telefono: '',
            email: '',


            modal: 0,
            titulo: '',
            opcion: 0,
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
                    this.puesto_id = data['puesto_id']
                    this.nombre = data['nombre']
                    this.apellido = data['apellido']
                    this.fecha_nacimiento = data['fecha_nacimiento']
                    this.dpi = data['dpi']
                    this.direccion = data['direccion']
                    this.telefono = data['telefono']
                    this.email = data['email']
                    this.id = data['id']
                }
            }
            this.comboPuesto()
        },
        closeModal() {
            this.nombre = '',
            this.apellido = '',
            this.fecha_nacimiento = '',
            this.dpi = '',
            this.direccion = '',
            this.telefono = '',
            this.email = '',

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
        comboPuesto() {
            let me = this;
            let url = '/puestos/combo';
            axios.get(url).then(function (response) {
                me.lista_puestos = response.data
            })
            .catch(function (error) {
                console.log(error)
            })
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
            let url = '/empleados';
            axios.get(url).then(function (response) {
                me.lista_empleados = response.data
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        store(){
            let me = this
            let url = '/empleados/store'
            axios.post(url,{
                'puesto_id': this.puesto_id,
                'nombre': this.nombre,
                'apellido': this.apellido,
                'fecha_nacimiento': this.fecha_nacimiento,
                'dpi': this.dpi,
                'direccion': this.direccion,
                'telefono': this.telefono,
                'email': this.email,
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
    },
}
</script>
