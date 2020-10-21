<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-cogs"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="/assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha registro</th>
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"><i class="fas fa-briefcase-medical"></i> Medicamento</th>
                                    <th class="text-center"><i class="fas fa-cart-plus"></i> Entrada</th>
                                    <th class="text-center"><i class="fas fa-shopping-cart"></i> Salida</th>
                                    <th class="text-center"><i class="fas fa-plus"></i> Cantidad <i class="fas fa-minus"></i></th>
                                    <th class="text-center"><i class="fas fa-search"></i> Observacion</th>
                                    <th class="text-center"><i class="fas fa-user"></i> Registró </th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ajuste_medicamento, index) in lista_ajuste_medicamento" :key="ajuste_medicamento.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="ajuste_medicamento.fecha_registro" class="text-center"></td>
                                    <td v-text="ajuste_medicamento.codigo_producto" class="text-center"></td>
                                    <td v-text="ajuste_medicamento.nombre_producto" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="ajuste_medicamento.entrada">
                                            <span class="badge outline-badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="ajuste_medicamento.salida">
                                            <span class="badge outline-badge-check"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check"><i class="fa fa-times-circle"></i></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="ajuste_medicamento.entrada">
                                            <span class="text-dark" v-text="ajuste_medicamento.cantidad"></span>
                                        </div>
                                        <div v-else>
                                            <span class="text-danger" v-text="ajuste_medicamento.cantidad"></span>
                                        </div>
                                    </td>
                                    <td v-text="ajuste_medicamento.observacion" class="text-center"></td>
                                    <td v-text="ajuste_medicamento.nombre_usuario" class="text-center"></td>
                                    <td class="text-center">
                                        <button type="button" @click="openModalAjuste(ajuste_medicamento)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para guardar y actualizar -->
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
                                    <label class="text-dark"><i class="fas fa-briefcase-medical"></i> Medicamento</label>
                                    <select class="form-control" v-model="medicamento_id" :class="hasError('medicamento_id') ? 'is-invalid' : ''">
                                        <option v-for="medicamento in lista_medicamento" :key="medicamento.id" :value="medicamento.id" v-text="medicamento.nombre"></option>
                                    </select>
                                    <div v-if="hasError('medicamento_id')" class="invalid-feedback">
                                        {{ errors.medicamento_id[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark" for="cantidad"><i class="fas fa-pencil-alt"></i> Cantidad</label>
                                    <input  @keyup.enter="store()" type="text" v-model="cantidad" class="form-control" :class="hasError('cantidad') ? 'is-invalid' : ''" name="cantidad">
                                    <div v-if="hasError('cantidad')" class="invalid-feedback">
                                        {{ errors.cantidad[0] }}
                                    </div>
                                </div>
                            </div>

                            <label class="text-dark">Marcar <i class="fas fa-check"></i>  para...</label>
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
                            <div class="form-row mb-2">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Observacion</label>
                                    <textarea class="form-control" rows="3" name="observacion" v-model="observacion" :class="hasError('observacion') ? 'is-invalid' : ''"></textarea>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver visualizar el ajuste -->
        <div :class="{'mostrar': modalAjuste}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalAjuste()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-qrcode"></i> Código</label>
                                    <input v-model="codigo_medicamento" class="form-control text-dark"  disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-thermometer-full"></i> Unidad de medida</label>
                                    <input v-model="nombre_unidad" class="form-control text-dark"  disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-tags"></i> Categoría</label>
                                    <input v-model="nombre_categoria" class="form-control text-dark"  disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label><i class="fas fa-briefcase-medical"></i> Nombre del medicamento</label>
                                    <input v-model="nombre_medicamento" class="form-control text-dark"  disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><i class="fas fa-box-open"></i> Presentación</label>
                                    <input v-model="presentacion_medicamento" class="form-control text-dark"  disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label><i class="fas fa-search"></i> Observación</label>
                                    <input v-model="observacion" class="form-control text-dark"  disabled>
                                </div>
                            </div>

                            <div v-if="ajuste==1">
                                <h4 class="text-center">Entraron: <strong v-text="cantidad" class="text-secondary"></strong> unidades</h4>
                            </div>

                            <div class="mx-auto" v-else>
                                <h4 class="text-center">Salieron: <strong v-text="cantidad" class="text-secondary"></strong> unidades</h4>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalAjuste()">Salir <i class="fas fa-sign-out-alt"></i></button>
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
            lista_ajuste_medicamento: [],
            cantidad: '',
            entrada: false,
            salida: false,
            observacion: '',

            nombre_categoria: '',
            nombre_unidad: '',

            lista_medicamento: [],
            medicamento_id: 0,
            codigo_medicamento: '',
            nombre_medicamento: '',
            presentacion_medicamento: '',

            modal: 0,
            titulo: '',
            opcion: 0,
            errors: [],

            modalAjuste: 0,
            ajuste: ''
        }
    },
    methods: {
        openModal(metodo) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "AJUSTE DE MEDICAMENTO"
                    this.opcion = 1
                    break
                }
            }
            this.medicamento_inventario()
        },
        closeModal() {
            this.lista_medicamento = []
            this.cantidad = ''
            this.entrada = false
            this.salida = false
            this.observacion = ''

            this.modal = 0
            this.titulo = ''
            this.opcion = 0
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openModalAjuste(data = []) {
            this.modalAjuste = 1
            this.titulo = 'AJUSTE DEL MEDICAMENTO ' + data['nombre_producto'].toUpperCase()

            this.nombre_categoria = data['nombre_categoria']
            this.nombre_unidad = data['nombre_unidad']
            this.codigo_medicamento = data['codigo_producto']
            this.nombre_medicamento = data['nombre_producto']
            this.presentacion_medicamento = data['presentacion_producto']
            this.observacion = data['observacion']
            this.cantidad = data['cantidad']

            if (data['entrada'] == true)
                this.ajuste = 1
            else if(data['salida'] == true)
                this.ajuste = 0
        },
        closeModalAjuste() {
            this.nombre_categoria = ''
            this.nombre_unidad = ''
            this.codigo_medicamento = ''
            this.nombre_medicamento = ''
            this.presentacion_medicamento = ''
            this.observacion =
            this.cantidad = ''
            this.ajuste = ''

            this.modalAjuste = 0
            this.titulo = ''

            alerts.sweetAlert('success', 'Visualización del ajuste exitoso')
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
        medicamento_inventario() {
            let me = this;
            let url = '/inventario/combo_medicamento';
            axios.get(url).then(function (response) {
                me.lista_medicamento = response.data
                $('select').select2({
                    placeholder: 'Seleccione el medicamento'
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
            let me = this;
            let url = '/ajuste_producto/medicamento';
            axios.get(url).then(function (response) {
                me.lista_ajuste_medicamento = response.data
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/ajuste_producto/store'
            axios.post(url,{
                'producto_id': this.medicamento_id,
                'cantidad': this.cantidad,
                'observacion': this.observacion,
                'entrada': this.entrada,
                'salida': this.salida
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        },
        change_select() {
            let me = this;

            $('select').on('change', function () {
                me.$emit('change', this.value)
            })

            me.$on('change', function(data) {
                this.medicamento_id = data
                    console.log(this.medicamento_id)
            })
        },
    },
    mounted() {
        this.showList()
        this.change_select()
    },
}
</script>
