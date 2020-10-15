<template>
    <div>
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
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"><i class="fas fa-address-card"></i> Rol</th>
                                    <th class="text-center"> Empleado</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(usuario, index) in lista_usuarios " :key="usuario.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="usuario.rol_id" class="text-center"></td>
                                    <td v-text="usuario.empleado_id" class="text-center"></td>
                                    <td class="text-center">
                                        <button type="button" @click="openForm('update', usuario)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
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
                                    <label class="text-dark"> Empleado</label>
                                    <select id="select_empleado" class="form-control" :class="hasError('empleado_id') ? 'is-invalid' : ''" v-model="empleado_id">
                                        <option v-for="empleado in lista_empleados" :key="empleado.id" :value="empleado.id" v-text="empleado.nombre"></option>
                                    </select>
                                    <div v-if="hasError('empleado_id')" class="invalid-feedback">
                                        {{ errors.empleado_id[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-user-tag"></i> Rol</label>
                                    <select id="select_rol" class="form-control" :class="hasError('rol_id') ? 'is-invalid' : ''" v-model="rol_id">
                                        <option v-for="rol in lista_rol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                    </select>
                                    <div v-if="hasError('rol_id')" class="invalid-feedback">
                                        {{ errors.rol_id[0] }}
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

        <div :class="{'mostrar': modalFrom}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeForm()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label><i class="fas fa-chalkboard-teacher"></i> Contraña actual</label>
                                        <input style="height:35px" v-model="contra_actual" class="form-control text-dark" disabled>
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label><i class="fas fa-chalkboard-teacher"></i> Nueva contraseña</label>
                                        <input style="height:35px" v-model="nueva_contra" class="form-control text-dark" disabled>
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label><i class="fas fa-chalkboard-teacher"></i> Confirmar contraseña</label>
                                        <input style="height:35px" v-model="comprobar_contra" class="form-control text-dark" disabled>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeForm()">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" v-if="opcion==1" class="btn btn-guardar" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
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
                codigo: 0,
                lista_usuarios: [],
                empleado_id: '',
                rol_id: '',

                contra_actual: '',
                nueva_contra: '',
                comprobar_contra: '',

                lista_empleados: [], 
                lista_rol:[],

                action: 1,
                modal:0,
                modalForm: 0,
                opcion: 1,
                titulo: '',

                errors: [],
            }
        },
        methods: {
            openModal(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.modal = 1
                        this.titulo = "Registro de puesto"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 1
                        this.titulo = "Actualización de puesto"
                        this.opcion = 2
                        this.empleado_id = data['empleado_id']
                        this.rol_id = data['rol_id']
                        this.id = data['id']
                    }
                }
            },
            closeModal(){
                this.rol_id = ''
                this.empleado_id = ''

                this.modal = 0
                this.opcion = 0
                this.titulo = ''
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            openForm(data = []){
                this.modalForm = 2
                this.titulo = 'Cambio de contraseña'

                this.contra_actual = data['contra_actual']
                this.nueva_contra = data['nueva_contra'] + ' ' + data['apellido']
                this.comprobar_contra = data['comprobar_contra']
            },
            closeForm(){
                this.contra_actual = ''
                this.nueva_contra = ''
                this.comprobar_contra = ''
            },
            hasError(field) {
                return field in (this.errors)
            },
            backendResponse(response) {
                if(response.data.status == 'success'){
                    this.closeForm()
                    // this.showList()
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
        },
    }
</script>