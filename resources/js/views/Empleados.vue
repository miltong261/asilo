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
                                    <th class="text-center"><i class="fas fa-qrcode"></i></th>
                                    <th class="text-center"><i class="fas fa-user"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-store-alt"></i> Área</th>
                                    <th class="text-center"><i class="fas fa-user-tag"></i> Puesto</th>
                                    <th class="text-center"><i class="fas fa-street-view"></i> Dirección</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(empleado, index) in lista_empleados" :key="empleado.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="empleado.codigo" class="text-center"></td>
                                    <td v-text="empleado.nombre + ' ' + empleado.apellido" class="text-center"></td>
                                    <td v-text="empleado.area_nombre" class="text-center"></td>
                                    <td v-text="empleado.puesto_nombre" class="text-center"></td>
                                    <td v-text="empleado.direccion" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="empleado.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <template v-if="empleado.puesto_nombre != 'Administrador'">
                                            <button type="button" @click="openModalEmpleado(empleado)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                            <template v-if="empleado.estado">
                                                <button type="button" @click="changeStatus('desactivate', empleado.id, empleado.nombre)" class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fas fa-lock"></i></button>
                                                <button type="button" @click="openModal('update', empleado)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                            </template>
                                            <template v-else>
                                                <button type="button" @click="changeStatus('activate', empleado.id, empleado.nombre)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
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
                                    <label class="text-dark"><i class="fas fa-user"></i> Nombre</label>
                                    <input type="text" name="nombre" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" placeholder="Ingrese nombre...">
                                    <div v-if="hasError('nombre')" class="invalid-feedback">
                                        {{ errors.nombre[0] }}
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-user"></i> Apellido</label>
                                    <input type="text" name="apellido" v-model="apellido" class="form-control" :class="hasError('apellido') ? 'is-invalid' : ''" placeholder="Ingrese apellido...">
                                    <div v-if="hasError('apellido')" class="invalid-feedback">
                                        {{ errors.apellido[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0" v-if="opcion==1">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" v-model="fecha_nacimiento" class="form-control" :class="hasError('fecha_nacimiento') ? 'is-invalid' : ''">
                                    <div v-if="hasError('fecha_nacimiento')" class="invalid-feedback">
                                        {{ errors.fecha_nacimiento[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-id-card"></i> DPI</label>
                                    <input type="text" name="dpi" v-model="dpi" class="form-control" :class="hasError('dpi') ? 'is-invalid' : ''" placeholder="Ingrese dpi...">
                                    <div v-if="hasError('dpi')" class="invalid-feedback">
                                        {{ errors.dpi[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input type="text" name="telefono" v-model="telefono" class="form-control" :class="hasError('telefono') ? 'is-invalid' : ''" placeholder="Ingrese teléfono...">
                                    <div v-if="hasError('telefono')" class="invalid-feedback">
                                        {{ errors.telefono[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0" v-if="opcion==2">
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" v-model="fecha_nacimiento" class="form-control" :class="hasError('fecha_nacimiento') ? 'is-invalid' : ''">
                                    <div v-if="hasError('fecha_nacimiento')" class="invalid-feedback">
                                        {{ errors.fecha_nacimiento[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input type="text" name="telefono" v-model="telefono" class="form-control" :class="hasError('telefono') ? 'is-invalid' : ''" placeholder="Ingrese teléfono...">
                                    <div v-if="hasError('telefono')" class="invalid-feedback">
                                        {{ errors.telefono[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-user-tag"></i> Área</label>
                                    <select id="select_area" class="form-control" :class="hasError('area_id') ? 'is-invalid' : ''" v-model="area_id">
                                        <option v-for="area in lista_areas" :key="area.id" :value="area.id" v-text="area.nombre"></option>
                                    </select>
                                    <div v-if="hasError('area_id')" class="invalid-feedback">
                                        {{ errors.area_id[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-user-tag"></i> Puesto</label>
                                    <select id="select_puesto" class="form-control" :class="hasError('puesto_id') ? 'is-invalid' : ''" v-model="puesto_id">
                                        <option v-for="puesto in lista_puestos" :key="puesto.id" :value="puesto.id" v-text="puesto.nombre"></option>
                                    </select>
                                    <div v-if="hasError('puesto_id')" class="invalid-feedback">
                                        {{ errors.puesto_id[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                    <input   type="text" name="direccion" v-model="direccion" class="form-control" :class="hasError('direccion') ? 'is-invalid' : ''" placeholder="Ingrese dirección...">
                                    <div v-if="hasError('direccion')" class="invalid-feedback">
                                        {{ errors.direccion[0] }}
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

        <!-- Modal para visualizar al empleado -->
        <div :class="{'mostrar': modalEmpleado}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalEmpleado()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-qrcode"></i> Código</label>
                                    <input type="text" name="codigo" v-model="codigo" class="form-control text-dark" disabled>
                                </div>
                                <div class="form-group col-md-8">
                                    <label><i class="fas fa-user"></i> Nombre</label>
                                    <input type="text" name="nombre" v-model="nombre" class="form-control text-dark" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="far fa-calendar-alt"></i> Fecha de nacimiento</label>
                                    <input type="text" name="fecha_nacimiento" v-model="fecha_nacimiento" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-2">
                                    <label><i class="fas fa-pager"></i> Edad</label>
                                    <input type="text" name="edad" v-model="edad" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><i class="fas fa-id-card"></i> DPI</label>
                                    <input type="text" name="dpi" v-model="dpi" class="form-control text-dark" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="far fa-calendar-alt"></i> Fecha de ingreso</label>
                                    <input type="date" class="form-control text-dark" name="fecha_ingreso" v-model="fecha_ingreso" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-store-alt"></i> Aréa</label>
                                    <input type="text" class="form-control text-dark" name="area_nombre" v-model="area_nombre" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-address-card"></i> Puesto</label>
                                    <input type="text" class="form-control text-dark" name="puesto_nombre" v-model="puesto_nombre" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-8">
                                    <label><i class="fas fa-street-view"></i> Dirección</label>
                                    <input type="text" name="direccion text-dark" v-model="direccion" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input type="text" name="telefono" v-model="telefono" class="form-control text-dark" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalEmpleado()">Salir <i class="fas fa-sign-out-alt"></i></button>
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
            id: 0,

            codigo: '',

            lista_areas: [],
            area_id: 0,
            area_nombre: '',

            lista_puestos: [],
            puesto_id: 0,
            puesto_nombre: '',

            lista_empleados: [],
            nombre: '',
            apellido: '',
            fecha_ingreso: '',
            fecha_nacimiento: '',
            edad: '',
            dpi: '',
            direccion: '',
            telefono: '',

            modal: 0,
            titulo: '',
            opcion: 0,
            errors: [],

            modalEmpleado: 0
        }
    },
    methods: {
        openModal(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "Registro de empleados"
                    this.opcion = 1
                    this.fecha_nacimiento = moment().format('YYYY-MM-DD')
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "Actualización de empleados"
                    this.opcion = 2
                    this.area_id = data['area_id']
                    this.puesto_id = data['puesto_id']
                    this.nombre = data['nombre']
                    this.apellido = data['apellido']
                    this.fecha_nacimiento = data['fecha_nacimiento']
                    this.dpi = data['dpi']
                    this.direccion = data['direccion']
                    this.telefono = data['telefono']
                    this.id = data['id']
                }
            }
            this.combo_puesto()
            this.combo_area()
        },
        closeModal() {
            this.nombre = ''
            this.apellido = ''
            this.fecha_nacimiento = ''
            this.dpi = ''
            this.direccion = ''
            this.telefono = ''
            // this.fecha_ingreso = ''

            this.area_id = 0
            this.puesto_id = 0

            this.modal = 0
            this.titulo = ''
            this.opcion = 0
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openModalEmpleado(data = []) {
            this.modalEmpleado = 1
            this.titulo = 'EMPLEADO ' + data['nombre'].toUpperCase() + ' ' + data['apellido'].toUpperCase()

            this.area_nombre = data['area_nombre']
            this.puesto_nombre = data['puesto_nombre']
            this.codigo = data['codigo']
            this.nombre = data['nombre'] + ' ' + data['apellido']
            this.fecha_ingreso = data['fecha_ingreso']
            this.fecha_nacimiento = data['fecha_nacimiento']
            this.dpi = data['dpi']
            this.direccion = data['direccion']
            this.telefono = data['telefono']

            let actual = moment()

            this.edad = actual.diff(this.fecha_nacimiento, 'years')
        },
        closeModalEmpleado() {
            this.modalEmpleado = 0
            this.titulo = ''

            this.area_nombre = ''
            this.puesto_nombre = ''
            this.codigo = ''
            this.nombre = ''
            this.fecha_ingreso = ''
            this.fecha_nacimiento = ''
            this.edad = ''
            this.dpi = ''
            this.direccion = ''
            this.telefono = ''

            alerts.sweetAlert('success', 'Visualización de empleado exitosa')
        },
        hasError(field) {
            return field in (this.errors)
        },
        otherError() {
            let errores = 0
            let actual = moment().format('YYYY-MM-DD')

            if (moment(this.fecha_nacimiento).format('YYYY-MM-DD') > actual){
                alerts.sweetAlert('error', 'Esta tratando de asignar una fecha posterior al día de hoy')
                errores = 1
            }

            return errores
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
        change_select_area() {
            let me = this

            $('#select_area').on('change', function () {
                me.$emit('change', this.value)
                me.area_id = this.value
            })
        },
        change_select_puesto() {
            let me = this

            $('#select_puesto').on('change', function () {
                me.$emit('change', this.value)
                me.puesto_id = this.value
            })
        },
        combo_area() {
            let me = this
            let url = '/areas/combo'
            axios.get(url).then(function (response) {
                me.lista_areas = response.data
                $('#select_area').select2({
                    placeholder: 'Seleccione el área'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        combo_puesto() {
            let me = this
            let url = '/puestos/combo'
            axios.get(url).then(function (response) {
                me.lista_puestos = response.data
                $('#select_puesto').select2({
                    placeholder: 'Seleccione el puesto'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        changeStatus(action, id, nombre) {
            swal({
                title: 'Cambio de estado',
                text: '¿Esta seguro de realizar la siguiente acción sobre el empleado "'+nombre+'"?',
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
                    var url = '/empleados/activate'
                else if (action == 'desactivate')
                    var url = '/empleados/desactivate'

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
            let me = this
            let url = '/empleados'
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

            if (me.otherError()) return
            else {
                axios.post(url,{
                    'area_id': this.area_id,
                    'puesto_id': this.puesto_id,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'fecha_nacimiento': this.fecha_nacimiento,
                    'dpi': this.dpi,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        update(){
            let me = this
            let url = 'empleados/update'

            if (me.otherError()) return
            else {
                axios.put(url,{
                    'area_id': this.area_id,
                    'puesto_id': this.puesto_id,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'fecha_nacimiento': this.fecha_nacimiento,
                    'dpi': this.dpi,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'id': this.id
                }).then(function (response){
                    me.backendResponse(response)
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        }
    },
    mounted() {
        this.showList()
        this.change_select_area()
        this.change_select_puesto()
    },
}
</script>
