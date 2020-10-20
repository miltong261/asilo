<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nueva <i class="fas fa-tag"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"><i class="fas fa-tags"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-capsules"></i> Medicamento</th>
                                    <th class="text-center"><i class="fas fa-store"></i> Artículo</th>
                                    <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tipo_producto, index) in lista_tipo_producto" :key="tipo_producto.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="tipo_producto.codigo" class="text-center"></td>
                                    <td v-text="tipo_producto.nombre" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="tipo_producto.medicamento">
                                            <span class="badge outline-badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="tipo_producto.producto">
                                            <span class="badge outline-badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="tipo_producto.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <template v-if="rol_id==1">
                                            <template v-if="tipo_producto.id!=1&&tipo_producto.id!=2&&tipo_producto.id!=3&&tipo_producto.id!=4">
                                                <template v-if="tipo_producto.estado">
                                                    <button type="button" @click="changeStatus('desactivate', tipo_producto.id, tipo_producto.nombre, tipo_producto.medicamento, tipo_producto.producto)" class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fas fa-lock"></i></button>
                                                    <button type="button" @click="openModal('update', tipo_producto)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                                </template>
                                                <template v-else>
                                                    <button type="button" @click="changeStatus('activate', tipo_producto.id, tipo_producto.nombre, tipo_producto.medicamento, tipo_producto.producto)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
                                                </template>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <button type="button" @click="openModal('update', tipo_producto)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
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
                                <label class="text-dark" for="nombre"><i class="fas fa-tags"></i> Nombre</label>
                                <input  @keyup.enter="store()" type="text" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" name="nombre" placeholder="Ingrese categoría...">
                                <div v-if="hasError('nombre')" class="invalid-feedback">
                                    {{ errors.nombre[0] }}
                                </div>
                            </div>

                            <label class="text-dark">Marcar <i class="fas fa-check"></i>  para...</label>
                                <div class="n-chk text-center">
                                    <label class="new-control new-checkbox checkbox-outline-check">
                                        <input type="checkbox" class="new-control-input"  name="medicamento" v-model="medicamento">
                                        <span class="new-control-indicator"></span>Medicamento
                                    </label>
                                    <label class="new-control new-checkbox checkbox-outline-check">
                                        <input type="checkbox" class="new-control-input" name="producto" v-model="producto">
                                        <span class="new-control-indicator"></span>Artículo
                                    </label>
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
            lista_tipo_producto: [],
            nombre: '',
            medicamento: false,
            producto: false,

            modal: 0,
            titulo: '',
            opcion: 0,
            errors: [],

            rol_id: 0
        }
    },
    methods: {
        openModal(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "REGISTRO DE CATEGORÍA"
                    this.opcion = 1
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "ACTUALIZACIÓN DE CATEGORÍA"
                    this.opcion = 2
                    this.nombre = data['nombre']
                    this.medicamento = data['medicamento']
                    this.producto = data['producto']
                    this.id = data['id']
                }
            }
        },
        closeModal() {
            this.nombre = ''
            this.medicamento = false
            this.producto = false

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
        changeStatus(action, id, nombre, medicamento, producto) {
            swal({
                title: 'Cambio de estado',
                text: '¿Esta seguro de realizar la siguiente acción sobre el tipo producto "'+nombre+'"?',
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
                    var url = '/tipo_producto/activate'
                else if (action == 'desactivate')
                    var url = '/tipo_producto/desactivate'

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
            let url = '/tipo_producto';
            axios.get(url).then(function (response) {
                me.lista_tipo_producto = response.data.query
                me.rol_id = response.data.rol
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        store(){
            let me = this
            let url = '/tipo_producto/store'
            axios.post(url,{
                'nombre': this.nombre,
                'medicamento': this.medicamento,
                'producto': this.producto
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        },
        update(){
            let me = this
            let url = 'tipo_producto/update'
            axios.put(url,{
                'nombre': this.nombre,
                'medicamento': this.medicamento,
                'producto': this.producto,
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
    },
}
</script>

