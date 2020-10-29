<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <button type="button" @click="openModal('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-store"></i></button>
                <button type="button" @click="openVencimiento(false)" class="btn btn-warning mb-2">Artículos a vencer <i class="fas fa-calendar-alt"></i></button>
                <button type="button" @click="openVencimiento(true)" class="btn btn-cerrar mb-2">Artículos vencidos <i class="fas fa-calendar-alt"></i></button>
                <!-- <button type="button" @click="openModalPDF('create')" class="btn btn-danger mb-1 mr-1"> PDF <i class="fas fa-file-pdf"></i></button> -->
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div class="table-responsive mb-0 mt-0">
                        <table id="listado" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                    <th class="text-center"><i class="fas fa-qrcode"></i> Codigo</th>
                                    <th class="text-center"><i class="fas fa-store"></i> Nombre</th>
                                    <th class="text-center" width="12%"><i class="fas fa-thermometer-full"></i> Unidad medida</th>
                                    <th class="text-center" width="10%"><i class="fas fa-tags"></i> Categoria</th>
                                    <th class="text-center" width="10%"><i class="fas fa-calendar-alt"></i> Vencimiento</th>
                                    <th class="text-center" width="10%"><i class="fas fa-store-alt"></i> Existencia</th>
                                    <th class="text-center" width="8%"><i class="fas fa-user"></i> Registró </th>
                                    <th class="text-center" width="8%"><i class="fas fa-lock"></i> Estado</th>
                                    <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(producto, index) in lista_productos" :key="producto.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="producto.codigo" class="text-center"></td>
                                    <td v-text="producto.nombre" class="text-center"></td>
                                    <td v-text="producto.unidad_nombre" class="text-center"></td>
                                    <td v-text="producto.categoria_nombre" class="text-center"></td>
                                    <td v-text="producto.fecha_vencimiento" class="text-center"></td>
                                    <td v-text="producto.existencia" class="text-center"></td>
                                    <td v-text="producto.nombre_usuario" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="producto.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <template v-if="rol_id==1">
                                            <button type="button" @click="openModalProducto(producto)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                            <template v-if="producto.estado">
                                                <button type="button" @click="changeStatus('desactivate', producto.id, producto.nombre)" class="btn btn-eliminar mb-1 mr-1 rounded-circle"> <i class="fas fa-lock"></i></button>
                                                <button type="button" @click="openModal('update', producto)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                            </template>
                                            <template v-else>
                                                <button type="button" @click="changeStatus('activate', producto.id, producto.nombre)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <button type="button" @click="openModalProducto(producto)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                            <button type="button" @click="openModal('update', producto)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para guardar y actualizar -->
        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
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
                                <div class="form-group col-md-8">
                                    <label class="text-dark"><i class="fas fa-store"></i> Nombre</label>
                                    <input type="text" name="nombre" v-model="nombre" class="form-control" :class="hasError('nombre') ? 'is-invalid' : ''" placeholder="Ingrese nombre...">
                                    <div v-if="hasError('nombre')" class="invalid-feedback">
                                        {{ errors.nombre[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-tags"></i> Categoría</label>
                                    <select id="select_tipo" class="form-control" v-model="tipo_producto_id" :class="hasError('tipo_producto_id') ? 'is-invalid' : ''">
                                        <option v-for="tipo_producto in lista_tipo_producto" :key="tipo_producto.id" :value="tipo_producto.id" v-text="tipo_producto.nombre"></option>
                                    </select>
                                    <div v-if="hasError('tipo_producto_id')" class="invalid-feedback">
                                        {{ errors.tipo_producto_id[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-box-open"></i> Presentación</label>
                                    <input type="text" name="presentacion" v-model="presentacion" class="form-control" :class="hasError('presentacion') ? 'is-invalid' : ''" placeholder="Ingrese presentacion...">
                                    <div v-if="hasError('presentacion')" class="invalid-feedback">
                                        {{ errors.presentacion[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-thermometer-full"></i> Unidad de medida</label>
                                    <select id="select_unidad" class="form-control" v-model="unidad_medida_id" :class="hasError('unidad_medida_id') ? 'is-invalid' : ''">
                                        <option v-for="unidad_medida in lista_unidad_medida" :key="unidad_medida.id" :value="unidad_medida.id" v-text="unidad_medida.nombre"></option>
                                    </select>
                                    <div v-if="hasError('unidad_medida_id')" class="invalid-feedback">
                                        {{ errors.unidad_medida_id[0] }}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha vencimiento</label>
                                    <input type="date" name="fecha_vencimiento" v-model="fecha_vencimiento" class="form-control" :class="hasError('fecha_vencimiento') ? 'is-invalid' : ''" placeholder="Ingrese observación...">
                                    <div v-if="hasError('fecha_vencimiento')" class="invalid-feedback">
                                        {{ errors.fecha_vencimiento[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-0">
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

        <!-- Modal para ver el producto -->
        <div :class="{'mostrar': modalProducto}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalProducto()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-qrcode"></i> Código</label>
                                    <input v-text="codigo" v-model="codigo" class="form-control"  disabled>
                                </div>

                                <div class="form-group col-md-8">
                                    <label class="text-dark"><i class="fas fa-store"></i> Nombre</label>
                                    <input v-text="nombre" v-model="nombre" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-tags"></i> Categoría</label>
                                    <input v-text="tipo_producto_nombre" v-model="tipo_producto_nombre" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-box-open"></i> Presentación</label>
                                    <input v-text="presentacion" v-model="presentacion" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-thermometer-full"></i> Unidad de medida</label>
                                    <input v-text="unidad_medida_nombre" v-model="unidad_medida_nombre" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Observación</label>
                                    <input v-text="observacion" v-model="observacion" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha de registro</label>
                                    <input v-text="fecha_registro" v-model="fecha_registro" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i>  Fecha de vencimiento</label>
                                    <input v-text="fecha_vencimiento" v-model="fecha_vencimiento" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Última compra</label>
                                    <input v-text="fecha_ultima_compra" v-model="fecha_ultima_compra" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i>  Última salida</label>
                                    <input v-text="fecha_ultima_salida" v-model="fecha_ultima_salida" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i>  Último ajuste</label>
                                    <input v-text="fecha_ultimo_ajuste" v-model="fecha_ultimo_ajuste" class="form-control" disabled>
                                </div>

                                <div class="mx-auto">
                                    <h4>Existencias: <strong v-text="existencia" class="text-secondary"></strong> </h4>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalProducto()">Salir <i class="fas fa-sign-out-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver el producto vencido -->
        <div :class="{'mostrar': modalVencimiento}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeVencimiento()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="listado_producto" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"> <i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                        <th class="text-center"> <i class="fas fa-store"></i> Presentación</th>
                                        <th class="text-center"> <i class="fas fa-thermometer-full"></i> Unidad</th>
                                        <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Existencia</th>
                                        <th class="text-center"> <i class="far fa-calendar-alt"></i> Vencimiento</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr v-for="(vencimiento, index) in lista_vencimiento" :key="vencimiento.id">
                                        <td v-text="index+1"></td>
                                        <td v-text="vencimiento.codigo"></td>
                                        <td v-text="vencimiento.nombre"></td>
                                        <td v-text="vencimiento.presentacion"></td>
                                        <td v-text="vencimiento.nombre_unidad"></td>
                                        <td v-text="vencimiento.existencia"></td>
                                        <td class="text-center">
                                            <div v-if="opcionModalVencimiento">
                                                <span class="badge outline-badge-danger">{{ vencimiento.fecha_vencimiento }}</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge outline-badge-warning">{{ vencimiento.fecha_vencimiento }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeVencimiento()">Salir <i class="fas fa-sign-out-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para el pdf -->
        <div :class="{'mostrar': modalPDF}" class="modal fadeInDown show" role="dialog" style="display: none; overflow-y: auto" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header dark-header">
                        <h5 class="modal-title text-white m-1" v-text="titulo"></h5>
                        <button type="button" @click="closeModalPDF()" class="close" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Selecciones el mes</label>
                                    <select id="select_mes" class="form-control" v-model="fecha_inventario">
                                        <option v-for="fecha_inventario in lista_fechas" :key="fecha_inventario.nombre" :value="fecha_inventario.nombre" v-text="fecha_inventario.nombre"></option>
                                    </select>
                                    <!-- <div v-if="hasError('fecha_inventario_id')" class="invalid-feedback">
                                        {{ errors.fecha_inventario_id[0] }}
                                    </div> -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModalPDF()">Salir <i class="fas fa-sign-out-alt"></i></button>
                        <button type="button" class="btn btn-danger">Descargar <i class="fas fa-download"></i></button>
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

            lista_productos: [],
            codigo: '',
            nombre: '',
            presentacion: '',
            observacion: '',
            fecha_registro: '',
            fecha_vencimiento: '',
            fecha_ultima_compra: '',
            fecha_ultima_salida: '',
            fecha_ultimo_ajuste: '',
            estado: 0,
            existencia: 0,

            lista_unidad_medida: [],
            unidad_medida_id: 0,
            unidad_medida_nombre: '',

            fecha_inventario: '',
            lista_fechas: [
                {
                    'nombre': 'Enero'
                },
                {
                    'nombre': 'Febrero'
                },
                {
                    'nombre': 'Marzo'
                },
                {
                    'nombre': 'Abril'
                },
                {
                    'nombre': 'Mayo'
                },
                {
                    'nombre': 'Junio'
                },
                {
                    'nombre': 'Julio'
                },
                {
                    'nombre': 'Agosto'
                },
                {
                    'nombre': 'Septiembre'
                },
                {
                    'nombre': 'Octubre'
                },
                {
                    'nombre': 'Noviembre'
                },
                {
                    'nombre': 'Diciembre'
                }
            ],

            lista_tipo_producto: [],
            tipo_producto_id: 0,
            tipo_producto_nombre: '',

            modal: 0,
            titulo: '',
            opcion: 0,
            errors: [],

            modalProducto: 0,
            modalPDF: 0,

            lista_vencimiento: [],
            modalVencimiento: 0,
            opcionModalVencimiento: '',

            rol_id : 0
        }
    },
    methods: {
        openModal(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.modal = 1
                    this.titulo = "REGISTRO DE ARTÍCULO"
                    this.opcion = 1
                    break
                }
                case 'update': {
                    this.modal = 2
                    this.titulo = "ACTUALIZACIÓN DE ARTÍCULO"
                    this.opcion = 2

                    this.unidad_medida_id = data['unidad_medida_id']
                    this.tipo_producto_id = data['tipo_producto_id']
                    this.nombre = data['nombre']
                    this.presentacion = data['presentacion']
                    this.observacion = data['observacion']
                    this.fecha_vencimiento = data['fecha_vencimiento']
                    this.id = data['id']
                }
            }
            this.combo_producto_unidad_medida()
            this.combo_producto_tipo_producto()
            this.combo_mes()
        },
        openModalProducto(data = []) {
            this.modalProducto = 1
            this.titulo = 'ARTÍCULO: ' + data['nombre'].toUpperCase()

            this.codigo = data['codigo']
            this.unidad_medida_nombre = data['unidad_nombre']
            this.tipo_producto_nombre = data['categoria_nombre']
            this.nombre = data['nombre']
            this.presentacion = data['presentacion']
            this.observacion = data['observacion'],
            this.fecha_registro = data['fecha_registro']
            this.fecha_vencimiento = data['fecha_vencimiento']
            this.fecha_ultima_compra = data['fecha_ultima_compra']
            this.fecha_ultima_salida = data['fecha_ultima_salida']
            this.fecha_ultimo_ajuste = data['fecha_ultimo_ajuste']
            this.estado = data['estado']
            this.existencia = data['existencia']
        },
        closeModal() {
            this.unidad_medida_id = 0
            this.tipo_producto_id = 0
            this.nombre = ''
            this.presentacion = ''
            this.observacion = ''
            this.fecha_vencimiento = ''

            this.modal = 0
            this.titulo = ''
            this.opcion = 0
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        closeModalProducto() {
            this.codigo = ''
            this.unidad_medida_nombre = ''
            this.tipo_producto_nombre = ''
            this.nombre = ''
            this.presentacion = ''
            this.observacion = ''
            this.fecha_registro = ''
            this.fecha_vencimiento = ''
            this.fecha_ultima_compra = ''
            this.fecha_ultima_salida = ''
            this.fecha_ultimo_ajuste = ''
            this.estado = ''
            this.existencia = ''

            this.modalProducto = 0
            this.titulo = ''

            alerts.sweetAlert('success', 'Visualización de producto exitosa')
        },
        openVencimiento(type) {
            if (type == false) {
                this.titulo = 'VENCIMIENTO DE ARTÍCULOS EN LOS PRÓXIMOS 30 DÍAS'
                this.opcionModalVencimiento = false
            }
            else if (type == true) {
                this.titulo = 'ARTÍCULOS VENCIDOS'
                this.opcionModalVencimiento = true
            }

            this.modalVencimiento = 1
            this.destroyTable('#listado')
            this.showVencimiento(type)
        },
        closeVencimiento() {
            this.destroyTable('#listado_producto')
            this.modalVencimiento = 0
            this.showList()
            this.lista_vencimiento = []
            this.opcionModalVencimiento = ''

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        openModalPDF(){
            this.modalPDF = 1
            this.titulo = 'REPORTE ARTÍCULOS'
            this.combo_mes()
        },
        closeModalPDF(){
            this.titulo = ''
            this.fecha_inventario = ''
            this.modalPDF = 0

            alerts.sweetAlert('error', 'Descarga cancelada')
        },
        hasError(field) {
            return field in (this.errors)
        },
        otherError() {
            let errores = 0
            let actual = moment().format('YYYY-MM-DD')

            if (moment(this.fecha_vencimiento).format('YYYY-MM-DD') < actual){
                alerts.sweetAlert('error', 'Esta tratando de asignar una fecha anterior al día de hoy')
                errores = 1
            }

            if (this.unidad_medida_id == 0) {
                alerts.sweetAlert('error', 'Seleccione unidad de medida')
                errores = 1
            }

            if (this.tipo_producto_id == 0) {
                alerts.sweetAlert('error', 'Seleccione categoría')
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
        changeStatus(action, id, nombre) {
            swal({
                title: 'Cambio de estado',
                text: '¿Esta seguro de realizar la siguiente acción sobre el artículo: '+nombre+'?',
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
                    var url = '/productos/activate'
                else if (action == 'desactivate')
                    var url = '/productos/desactivate'

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
        change_select_unidad() {
            let me = this

            $('#select_unidad').on('change', function () {
                me.$emit('change', this.value)
                me.unidad_medida_id = this.value
            })
        },
        change_select_tipo() {
            let me = this

            $('#select_tipo').on('change', function () {
                me.$emit('change', this.value)
                me.tipo_producto_id = this.value
            })
        },
        change_select_mes() {
            let me = this
            $('#select_mes').on('change', function () {
                me.$emit('change', this.value)
                me.fecha_inventario = this.value
            })
        },
        combo_producto_unidad_medida() {
            let me = this
            let url = '/unidad_medida/combo_producto'
            axios.get(url).then(function (response) {
                me.lista_unidad_medida = response.data
                $('#select_unidad').select2({
                    placeholder: 'Seleccione unidad de medida',
                    width: '100%'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        combo_producto_tipo_producto() {
            let me = this
            let url = '/tipo_producto/combo_producto'
            axios.get(url).then(function (response) {
                me.lista_tipo_producto = response.data
                $('#select_tipo').select2({
                    placeholder: 'Seleccione la categoría',
                    width: '100%'
                })
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        combo_mes(){
             $('#select_mes').select2({
                placeholder: 'Seleccione el mes',
                width: '100%'
            })
        },
        dataTable(table) {
            let datatable = $(table).DataTable()
            datatable.destroy()
            this.$nextTick(function() {
                $(table).DataTable( {
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
        destroyTable(table) {
            var datatable = $(table).DataTable()
            datatable.destroy()
        },
        showList() {
            let me = this
            let url = '/productos'
            axios.get(url).then(function (response) {
                me.lista_productos = response.data.query
                me.rol_id = response.data.rol
                me.dataTable('#listado');
            })
            .catch(function (error) {
                console.log(error)
            })
        },
        showVencimiento(type) {
            let me = this

            if (type == false)
                var url = '/productos/vencimiento'
            else if (type == true)
                var url = '/productos/vencidos'

            axios.get(url).then(function (response) {
                me.lista_vencimiento = response.data
                me.dataTable('#listado_producto')
            }).catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/productos/store'

            if (me.otherError()) return
            else {
                axios.post(url,{
                    'unidad_medida_id': this.unidad_medida_id,
                    'tipo_producto_id': this.tipo_producto_id,
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'presentacion': this.presentacion,
                    'observacion': this.observacion
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        update() {
            let me = this
            let url = '/productos/update'

            if (me.otherError()) return
            else {
                axios.put(url,{
                    'unidad_medida_id': this.unidad_medida_id,
                    'tipo_producto_id': this.tipo_producto_id,
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'presentacion': this.presentacion,
                    'observacion': this.observacion,
                    'id': this.id
                }).then(function (response) {
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
        this.change_select_unidad()
        this.change_select_tipo()
        this.change_select_mes()
    },
}
</script>
