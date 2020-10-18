<template>
    <div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <button type="button" @click="openModal()" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha registro</th>
                                    <th class="text-center"><i class="fas fa-user"></i> Usuario</th>
                                    <th class="text-center"><i class="fas fa-user"></i> Empleado</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(usuario, index) in lista_usuarios " :key="usuario.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="usuario.fecha_registro" class="text-center"></td>
                                    <td v-text="usuario.usuario" class="text-center"></td>
                                    <td v-text="usuario.nombre + ' ' + usuario.apellido" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="usuario.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td>
                                     <td class="text-center">
                                        <template v-if="usuario.id!=1">
                                            <template v-if="usuario.estado==1 && usuario.estado_empleado==1">
                                                <button type="button" @click="changeStatus('desactivate', usuario.id, usuario.usuario)" class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fas fa-lock"></i></button>
                                                <button type="button" @click="openForm(usuario.id, usuario.usuario)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                            </template>
                                            <template v-else-if="usuario.estado==0 && usuario.estado_empleado==1">
                                                <button type="button" @click="changeStatus('activate', usuario.id, usuario.usuario)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
                                            </template>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal registro usuarios -->
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
                                    <label class="text-dark"><i class="fas fa-user"></i> Empleado</label>
                                    <select id="select_empleado" class="form-control" :class="hasError('empleado_id') ? 'is-invalid' : ''" v-model="empleado_id">
                                        <option v-for="empleado in lista_empleados" :key="empleado.id" :value="empleado.id" v-text="empleado.nombre"></option>
                                    </select>
                                    <div v-if="hasError('empleado_id')" class="invalid-feedback">
                                        {{ errors.empleado_id[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
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
                        <button type="button" class="btn btn-guardar" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
                    </div>

                </div>
            </div>
        </div>

        <!-- modal cambio de contraseña  -->
        <div :class="{'mostrar': modalForm}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
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
                                        <label class="text-dark"><i class="fas fa-user"></i> Usuario</label>
                                        <input type="text" name="usuario" v-model="usuario" class="form-control" :class="hasError('usuario') ? 'is-invalid' : ''" placeholder="Ingrese usuario...">
                                        <div v-if="hasError('usuario')" class="invalid-feedback">
                                            {{ errors.usuario[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-key"></i> Nueva contraseña</label>
                                        <input type="password" name="password" v-model="password" class="form-control" :class="hasError('password') ? 'is-invalid' : ''" placeholder="Ingrese contraseña...">
                                        <div v-if="hasError('password')" class="invalid-feedback">
                                            {{ errors.password[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label class="text-dark"><i class="fas fa-key"></i> Confirmar contraseña</label>
                                        <input type="password" name="password_confirm" v-model="password_confirm" class="form-control" :class="hasError('password_confirm') ? 'is-invalid' : ''" placeholder="Confirmar contraseña...">
                                        <div v-if="hasError('password_confirm')" class="invalid-feedback">
                                            {{ errors.password_confirm[0] }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeForm()">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" class="btn btn-guardar" @click="change_password()">Guardar <i class="far fa-check-circle"></i></button>
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

            lista_usuarios: [],
            empleado_id: '',
            rol_id: '',

            usuario: '',
            password: '',
            password_confirm: '',

            lista_empleados: [],
            lista_rol:[],

            modal: 0,
            opcionModal: 0,
            modalForm: 0,
            opcionMoldalForm: 0,
            titulo: '',

            errors: [],
        }
    },
    methods: {
        openModal() {
            this.modal = 1
            this.titulo = "Registro de usuario"
            this.opcionModal = 1

            this.combo_rol()
            this.combo_empleado()
        },
        closeModal(){
            this.empleado_id = ''
            this.rol_id = ''

            this.modal = 0
            this.opcionModal = 0
            this.titulo = ''
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openForm(id_usuario, usuario_usuario){
            this.id = id_usuario
            this.opcionMoldalForm = 1

            this.modalForm = 1
            this.titulo = 'Cambio de contraseña del usuario: ' + usuario_usuario
        },
        closeForm(){
            this.id = ''
            this.usuario = ''
            this.password = ''
            this.password_confirm = ''

            this.modalForm = 0
            this.opcionMoldalForm = 0
            this.titulo = ''

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

                if (this.opcionMoldalForm == 1){
                    this.closeForm()
                    this.showList()
                    alerts.sweetAlert(response.data.status, response.data.message)
                    this.opcionMoldalForm = 0
                }


            }else{
                alerts.sweetAlert(response.data.status, response.data.message)
            }
        },
        change_select_rol() {
            let me = this

            $('#select_rol').on('change', function () {
                me.$emit('change', this.value)
                me.rol_id = this.value
            })
        },
        change_select_empleado() {
            let me = this

            $('#select_empleado').on('change', function () {
                me.$emit('change', this.value)
                me.empleado_id = this.value
            })
        },
        combo_rol() {
            let me = this
            let url = '/roles/combo'
            axios.get(url).then(function (response) {
                me.lista_rol = response.data
                $('#select_rol').select2({
                    placeholder: 'Seleccione el rol'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        combo_empleado() {
            let me = this
            let url = '/usuarios/empleado'
            axios.get(url).then(function (response) {
                me.lista_empleados = response.data
                $('#select_empleado').select2({
                    placeholder: 'Seleccione el empleado'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        changeStatus(action, id, usuario) {
            this.id = id
            swal({
                title: 'Cambio de estado',
                text: '¿Esta seguro de realizar la siguiente acción sobre el usuario "'+usuario+'"?',
                type: 'question',
                confirmButtonColor: '#25d5e4',
                cancelButtonColor: '#f8538d',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: '¡Cancelar!',
                confirmButtonClass: 'btn btn-guardar',
                cancelButtonClass: 'btn btn-cerrar',
                padding: '2em'
            }).then((result) => {
                if (action == 'activate')
                    var url = '/usuarios/activate'
                else if (action == 'desactivate')
                    var url = '/usuarios/desactivate'

                if (result.value) {
                    let me = this
                    axios.put(url, {
                        'id': id
                    }).then(function (response) {
                        me.showList()
                        swal(
                            'Cambio de estado',
                            'Se ha cambiado el estado correctamente',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error)
                    })
                } else if(result.dismiss === swal.DismissReason.cancel) {
                    swal(
                        'Cancelado',
                        'Se ha cancelado la operación',
                        'error'
                    )
                }
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
            let url = '/usuarios';
            axios.get(url).then(function (response) {
                me.lista_usuarios = response.data
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        store(){
            let me = this
            let url = '/usuarios/store'
            axios.post(url,{
                'empleado_id': this.empleado_id,
                'rol_id' : this.rol_id
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        },
        change_password(){
            let me = this
            let url = 'usuarios/update'
            axios.put(url,{
                'usuario': this.usuario,
                'password': this.password,
                'password_confirm': this.password_confirm,
                'id': this.id
            }).then(function (response){
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        }
    },
    mounted() {
        this.showList()
        this.change_select_rol()
        this.change_select_empleado()
    },
}
</script>
