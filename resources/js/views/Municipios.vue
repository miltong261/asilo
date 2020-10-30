<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-street-view"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-flag"></i> Departamento</th>
                                    <th class="text-center"><i class="fas fa-map-marked-alt"></i> Nombre</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Actualizar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(municipio, index) in lista_municipios" :key="municipio.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="municipio.departamento_nombre" class="text-center"></td>
                                    <td v-text="municipio.nombre" class="text-center"></td>
                                    <td class="text-center">
                                            <button type="button" @click="openModal('update', municipio)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
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
                            <div class="form-group" v-if="opcion==1">
                                <label class="text-dark"><i class="fas fa-flag"></i> Departamento</label>
                                <select id="select_departamento" class="form-control" :class="hasError('departamento_id') ? 'is-invalid' : ''" v-model="departamento_id">
                                    <option v-for="departamento in lista_departamentos" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                </select>
                                <div v-if="hasError('departamento_id')" class="invalid-feedback">
                                    {{ errors.area_id[0] }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-dark" for="nombre"><i class="fas fa-map-marked-alt"></i> Nombre</label>
                                <input  @keyup.enter="store()" type="text" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" name="nombre" placeholder="Ingrese municipio...">
                                <div v-if="hasError('nombre')" class="invalid-feedback">
                                    {{ errors.nombre[0] }}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModal()">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" v-if="opcion==1" class="btn btn-guardar"  @click="store()">Guardar <i class="far fa-check-circle"></i></button>
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
            lista_municipios: [],
            nombre: '',

            lista_departamentos: [],
            departamento_id: 0,

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
                    this.titulo = "REGISTRO DE MUNICIPIO"
                    this.opcion = 1
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "ACTUALIZACIÓN DE MUNICIPIO"
                    this.opcion = 2
                    this.departamento_id = data['departamento_id']
                    this.nombre = data['nombre']
                    this.id = data['id']
                }
            }
            this.combo_departamento()
        },
        closeModal() {
            this.departamento_id = ''
            this.nombre = ''

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
        change_select() {
            let me = this

            $('select').on('change', function () {
                me.$emit('change', this.value)
                me.departamento_id = this.value
            })
        },
        combo_departamento() {
            let me = this
            let url = '/departamentos/combo'
            axios.get(url).then(function (response) {
                me.lista_departamentos = response.data
                $('select').select2({
                    placeholder: 'Seleccione el departamento'
                })
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
            let url = '/municipios'
            axios.get(url).then(function (response) {
                me.lista_municipios = response.data
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        store(){
            let me = this
            let url = '/municipios/store'

            if (me.departamento_id == 0) {
                alerts.sweetAlert('error', 'Debe de seleccionar el tipo de movimiento')
                $('#select_departamento').next().find('.select2-selection').addClass('has-error');
            } else {
                axios.post(url,{
                    'departamento_id': this.departamento_id,
                    'nombre': this.nombre,
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
            let url = '/municipios/update'
            axios.put(url,{
                'departamento_id': this.departamento_id,
                'nombre': this.nombre,
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
        this.change_select()
    },
}
</script>
