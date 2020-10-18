<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div v-for="saldo in caja" :key="saldo.id" class="text-center">
                        <span>Saldo en caja: <strong class="text-secondary">Q {{ saldo.saldo }}</strong></span>
                    </div>
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Transacción</th>
                                    <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha</th>
                                    <th class="text-center"><i class="fas fa-paste"></i> Tipo movimiento</th>
                                    <th class="text-center"><i class="fas fa-search"></i> Concepto</th>
                                    <th class="text-center"><i class="fas fa-money-bill"></i> Entrada</th>
                                    <th class="text-center"><i class="fas fa-money-bill"></i> Salida</th>
                                    <th class="text-center"><i class="fas fa-user"></i> Registró</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(movimiento, index) in lista_movimiento" :key="movimiento.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="movimiento.no_transaccion" class="text-center"></td>
                                    <td v-text="movimiento.fecha_registro" class="text-center"></td>
                                    <td v-text="movimiento.tipo_movimiento_nombre" class="text-center"></td>
                                    <td v-text="movimiento.observacion" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="movimiento.entrada">
                                            <span class="badge outline-badge-check" v-text="'Q '+movimiento.monto"></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div v-if="movimiento.salida">
                                            <span class="badge outline-badge-no-check" v-text="'Q '+movimiento.monto"></span>
                                        </div>
                                    </td>
                                    <td v-text="movimiento.nombre_usuario" class="text-center"></td>
                                    <td class="text-center">
                                        <template v-if="movimiento.tipo_movimiento_nombre!='Compra'&&movimiento.tipo_movimiento_nombre!='Donación'">
                                            <button type="button" @click="openModal('update', movimiento)" class="btn btn-warning mb-2 mr-2 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
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
                            <div class="form-row mb-0">

                                <div class="form-group col-md-12" v-if="opcion==1">
                                    <label class="text-dark"><i class="fas fa-paste"></i> Tipo Movimiento</label>
                                    <select class="form-control" v-model="tipo_movimiento" :class="hasError('tipo_movimiento_id') ? 'is-invalid' : ''" placeholder="Ingrese tipo movimiento...">
                                        <option v-for="tipo_movimiento in lista_tipo_movimiento" :key="tipo_movimiento.id" :value="tipo_movimiento" v-text="tipo_movimiento.nombre"></option>
                                    </select>
                                    <div v-if="hasError('tipo_movimiento_id')" class="invalid-feedback">
                                        {{ errors.tipo_movimiento_id[0] }}
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-money-bill"></i> Monto</label>
                                    <input type="number" name="monto" v-model="monto" class="form-control" :class="hasError('monto') ? 'is-invalid' : ''" placeholder="Ingrese monto...">
                                    <div v-if="hasError('monto')" class="invalid-feedback">
                                        {{ errors.monto[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Concepto</label>
                                    <input type="text" name="observacion" v-model="observacion" class="form-control" :class="hasError('observacion') ? 'is-invalid' : ''" placeholder="Ingrese concepto...">
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

            lista_movimiento: [],
            monto: '',
            observacion: '',

            lista_tipo_movimiento: [],
            tipo_movimiento: 0,
            tipo_movimiento_id: 0,
            tipo_movimiento_entrada: 0,
            tipo_movimiento_salida: 0,

            caja: 0,

            modal: 0,
            titulo: '',
            opcion: 0,
            errors: []
        }
    },
    methods:{
        openModal(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "Registro de movimiento"
                    this.opcion = 1
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "Actualización de movimiento"
                    this.opcion = 2

                    this.monto = data['monto']
                    this.observacion = data['observacion']
                    this.tipo_movimiento_id = data['tipo_movimiento_id']
                    this.tipo_movimiento_entrada = data['entrada']
                    this.tipo_movimiento_salida = data['salida']
                    this.id = data['id']
                }
            }
            this.combo_tipo_movimiento()
        },
        closeModal() {
            this.tipo_movimiento = 0
            this.monto = ''
            this.observacion = ''

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
                this.showSaldo()
                alerts.sweetAlert(response.data.status, response.data.message)
            }else{
                alerts.sweetAlert(response.data.status, response.data.message)
            }
        },
        combo_tipo_movimiento() {
            let me = this;
            let url = '/tipo_movimiento/combo';
            axios.get(url).then(function (response) {
                me.lista_tipo_movimiento = response.data
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
            let url = '/movimientos'
            axios.get(url).then(function (response) {
                me.lista_movimiento = response.data
                me.dataTable();
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        showSaldo() {
            let me = this
            let url = '/movimientos/saldo'
            axios.get(url).then(function (response) {
                me.caja = response.data
            }).catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/movimientos/store'
            axios.post(url,{
                'tipo_movimiento_id': this.tipo_movimiento['id'],
                'monto': this.monto,
                'observacion': this.observacion,
                'entrada': this.tipo_movimiento['entrada'],
                'salida': this.tipo_movimiento['salida']
            }).then(function (response) {
                me.backendResponse(response)
            }).catch(error =>{
                if(error.response.status == 422)
                    this.errors = error.response.data.errors
            })
        },
        update() {
            let me = this
            let url = '/movimientos/update'
            axios.put(url,{
                'tipo_movimiento_id': this.tipo_movimiento_id,
                'monto': this.monto,
                'observacion': this.observacion,
                'entrada': this.tipo_movimiento_entrada,
                'salida': this.tipo_movimiento_salida,
                'id': this.id
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
        this.showSaldo()
    }
}
</script>
