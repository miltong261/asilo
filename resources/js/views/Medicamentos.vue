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
                                    <th class="text-center"><i class="fas fa-hashtag"></i> Codigo</th>
                                    <th class="text-center"><i class="fas fa-medkit"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-tags"></i> Categoria</th>
                                    <th class="text-center"><i class="fas fa-user-tag"></i> Unidad medida</th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha registro</th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha vencimiento</th>
                                    <th class="text-center"><i class="fas fa-store-alt"></i> Existencia</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(medicamento, index) in lista_medicamento" :key="medicamento.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="medicamento.nombre" class="text-center"></td>
                                    <td v-text="medicamento.tipo_producto_id" class="text-center"></td>
                                    <td v-text="medicamento.unidad_medida_id" class="text-center"></td>
                                    <td v-text="medicamento.fecha_registro" class="text-center"></td> 
                                    <td v-text="medicamento.fecha_vencimiento" class="text-center"></td>
                                    <td v-text="medicamento.existencia_inicial" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="puesto.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" @click="openModal('update', medicamento)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                        <template v-if="medicamento.estado">
                                            <button type="button" @click="changeStatus('desactivate', medicamento.id, medicamento.nombre)" class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fas fa-lock"></i></button>
                                        </template>
                                        <template v-else>
                                            <button type="button" @click="changeStatus('activate', medicamento.id, medicamento.nombre)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
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
                                    <label class="text-dark"><i class="fas fa-thermometer-full"></i> Unidad de medida</label>
                                    <select class="form-control" v-model="unidad_medida" :class="hasError('unidad_medida') ? 'is-invalid' : ''">
                                        <option value="0" disabled>Seleccione unidad de medida</option>
                                        <option v-for="unidad_medida in lista_unidad_medida" :key="unidad_medida.id" :value="unidad_medida" v-text="unidad_medida.nombre"></option>
                                    </select>
                                    <div v-if="hasError('unidad_medida_id')" class="invalid-feedback">
                                        {{ errors.unidad_medida_id[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-tags"></i> Tipo producto</label>
                                    <select class="form-control" v-model="tipo_producto" :class="hasError('tipo_producto') ? 'is-invalid' : ''">
                                        <option value="0" disabled>Seleccione tipo producto</option>
                                        <option v-for="tipo_producto in lista_tipo_producto" :key="tipo_producto.id" :value="tipo_producto" v-text="tipo_producto.nombre"></option>
                                    </select>
                                    <div v-if="hasError('tipo_producto_id')" class="invalid-feedback">
                                        {{ errors.tipo_producto_id[0] }}
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="fas fa-medkit"></i> Nombre</label>
                                    <input type="text" name="nombre" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" placeholder="Ingrese nombre...">
                                    <div v-if="hasError('nombre')" class="invalid-feedback">
                                        {{ errors.nombre[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha vencimiento</label>
                                    <input type="date" name="fecha_vencimiento" v-model="fecha_vencimiento" class="form-control" :class="hasError('fecha_vencimiento') ? 'is-invalid' : ''" placeholder="Ingrese observación...">
                                    <div v-if="hasError('fecha_vencimiento')" class="invalid-feedback">
                                        {{ errors.fecha_vencimiento[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Observación</label>
                                    <input type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese observación...">
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

                lista_medicamento: [],
                nombre: '',
                observacion: '',
                fecha_vencimiento: '',

                lista_unidad_medida: [],
                unidad_medida: 0,

                lista_tipo_producto: [],
                tipo_producto: 0,

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
                        this.titulo = "Registro de medicamento"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización de medicamento"
                        this.opcion = 2

                        this.nombre = data['nombre']
                        this.observacion = data['observacion']
                        this.fecha_vencimiento = data['fecha_vencimiento']
                        this.id = data['id']
                    }
                }
                this.combo_medicamento_unidad_medida()
                this.combo_medicamento_tipo_producto()
            },
            closeModal() {
                this.nombre = ''
                this.observacion = ''
                this.fecha_vencimiento = ''

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
            combo_medicamento_unidad_medida() {
                let me = this;
                let url = '/unidad_medida/combo_medicamento';
                axios.get(url).then(function (response) {
                    me.lista_unidad_medida = response.data
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            combo_medicamento_tipo_producto() {
                let me = this;
                let url = '/tipo_producto/combo_producto';
                axios.get(url).then(function (response) {
                    me.lista_tipo_producto = response.data
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
                let me = this
                let url = '/medicamentos'
                axios.get(url).then(function (response) {
                    me.lista_medicamento = response.data
                    me.dataTable();
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            store() {
                let me = this
                let url = '/medicamentos/store'
                axios.post(url,{
                    'unidad_medida_id': this.unidad_medida['id'],
                    'tipo_producto_id': this.tipo_producto['id'],
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'observacion': this.observacion,
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            },
            update() {
                let me = this
                let url = '/medicamentos/update'
                axios.put(url,{
                    'unidad_medida_id': this.unidad_medida['id'],
                    'tipo_producto_id': this.tipo_producto['id'],
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'observacion': this.observacion,
                    'id': this.id
                }).then(function (response) {
                    me.backendResponse(response)
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