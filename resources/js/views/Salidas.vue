<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
           <!-- botón nuevo -->
            <div class="text-left ">
                <button type="button" @click="openDetalle()" class="btn btn-info mb-2">Nuevo<i class="fas fa-shopping-cart"></i> </button>               
            </div>
              <div class="widget-content widget-content-area br-6">
                   
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <h4 class="text-center"> Fecha </h4>
                    <h4 class="text-center">Usuario</h4>

                   
                   
                   <template v-if="lista">
                    <!-- Inicio dataTable -->                 
                    <div class="table-responsive mb-0 mt-0">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"> <i class="fas fa-file-alt"></i> Documento</th>
                                    <th class="text-center"> <i class="fas fa-calendar-alt"></i> Fecha salida</th>
                                    <th class="text-center"> <i class="fas fa-money-bill-alt"></i> Total</th>
                                    <th class="text-center"> <i class="fas fa-cogs"></i> Opciones </th>   
                                </tr>
                            </thead>
                            <tbody>
                                 <tr >
                                    <td ></td>
                                    <td ></td>
                                    <td ></td>
                                    <td></td>
                                    <td class="text-center">
                                        <button type="button" @click="openModal('update', salidas)" class="btn rounded-circle btn-warning mb-2"> <i class="fas fa-sync-alt"></i></button>
                                        <button class="btn rounded-circle btn-eliminar mb-2"> <i class="fa fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </template>
                    <template v-else>
                    <div class="form-group row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> <i class="fas fa-calendar-alt"></i> Fecha salida</label>
                               <input type="date" class="form-control" name="fecha_salida" v-model="fecha_salida" placeholder="fecha_nacimiento">              
                          </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                 <label> <i class="fas fa-user"></i> Empleado </label> 
                                <select class="form-control" name="empleado" v-model="empleado">
                                    <option> Empleado 1</option>
                                    <option> Empleado 2</option>      
                                </select>            
                                         
                          </div>
                        </div>
                    </div>

                    <div class="form-group row col-md-12 inline">
                        <div class="col-md-5 form-group">
                            <select class="form-control" name="buscar_producto" v-model="buscar_producto" >  
                                <option> Opción 1 </option>
                            </select>                                   
                        </div>  

                        <div class="col-md-1 form-group">                                  
                            <button  @click="openModal('create')" class="btn btn-info form-control"> <i class="fas fa-search"></i> </button> 
                        </div>  
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                    <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                    <th class="text-center"> <i class="fas fa-search"></i> Observación</th>
                                    <th class="text-center"> <i class="fas fa-sort-numeric-up"></i> Cantidad</th>
                                    <th class="text-center"> <i class="fas fa-cogs"></i> Opciones </th>                               
                                </tr>
                            </thead>
                            <tbody class="text-center" v-if="arrayDetalle.length">
                                <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                    <td v-text="detalle.producto_id"></td>
                                    <td v-text="detalle.producto_nombre"></td>
                                    <td v-text="detalle.producto_unidad_medida"></td>
                                    <td v-text="detalle.producto_categoria"></td>
                                    <td>  <button class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fa fa-trash-alt"></i></button> </td>
                                </tr>
                                
                            </tbody>
                            <tfoot style="font-weight: bold">
                                <tr>
                                    <td class="text-center" colspan="6"> Total </td>
                                    <td> Q </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- fin  tabla salidas-->

                    <div class="text-center">
                        <button type="button" @click="closeDetalle()" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                        <button type="button" class="btn btn-guardar">Guardar <i class="far fa-check-circle"></i></button>                                 
                    </div>
                    </template>
           
                </div>
            </div>
        </div>

        <!-- Inicio modal -->
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
                            <div class="form-group">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> <i class="fas fa-qrcode"></i> Código</th>
                                            <th class="text-center"> <i class="fas fa-store"></i> Nombre</th>
                                            <th class="text-center"> <i class="fas fa-search"></i>  Categoría</th>
                                            <th class="text-center"> <i class="fas fa-sort-numeric-up"></i>Unidad de Medida</th>
                                            <th class="text-center"> <i class="fas fa-cogs"></i> Opciones </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr  v-for="producto in arrayProducto" :key="producto.id">
                                            <td v-text="producto.id"></td>
                                            <td v-text="producto.nombre"></td>
                                            <td v-text="producto.unidad_medida"></td>
                                            <td v-text="producto.categoria"></td>
                                            <td>
                                                <button type="button" @click="agregarDetalle(producto)"  class="btn btn-success btn-sm">
                                                    <i class="fa fa-check-circle"></i>
                                                </button> &nbsp;
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                arrayProducto: [
                {
                    "id": "1",
                    "nombre": "milton",
                    "categoria": "milton",
                    "unidad_medida": "kg"
                },
                {
                   "id": "2",
                    "nombre": "milton",
                    "categoria": "milton",
                    "unidad_medida": "lb"
                }
            ],
            arrayDetalle: [],
            producto_id: 0,
            producto_nombre: '',
            producto_unidad_medida: '',
            producto_categoria: '',
                id: 0,
                listasalidas: [],
                código: '',
                documento: '',
                fecha_salida: '',
                total: '',
                
                
                modal: 0,
                lista: 1,
                titulo: '',
                opcion: 0,
                errors: []
            }
        },
        methods: {
            agregarDetalle(data = []) {
                let me = this;
                me.arrayDetalle.push({
                    producto_id: data['id'],
                    producto_nombre: data['nombre'],
                    producto_unidad_medida: data['unidad_medida'],
                    producto_categoria: data['categoria']
                })
            },
            
            openDetalle(){
                this.lista = 0
            },

            closeDetalle(){
                this.lista = 1
            },
            openModal(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.modal = 1
                        this.titulo = "Registro de ejemplos"
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización de ejemplos"
                        this.opcion = 2
                        this.nombre = data['nombre']
                        this.direccion = data['direccion']
                        this.id = data['id']
                    }
                }
            },
            closeModal() {
                this.nombre = ''
                this.direccion = ''

                this.modal = 0
                this.titulo = ''
                this.opcion = 0
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },
            showList() {
                let me = this;
                let url = '/salidas';
                axios.get(url).then(function (response) {
                    me.listasalidas = response.data,
                    me.dataTable();
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            dataTable() {
                var datatable = $('#zero-config').DataTable()
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
            store(){
                let me = this
                var url = '/salidas/store'
                axios.post(url,{
                    'nombre': this.nombre,
                    'direccion': this.direccion,
                }).then(function (response) {
                    me.closeModal()
                    me.showList()
                    alerts.sweetAlert('success', 'Se guardó correctamente')
                }).catch(error =>{
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            },
            update(){
                let me = this
                var url = 'salidas/update'
                axios.put(url,{
                    'nombre': this.nombre,
                    'direccion': this.direccion,
                    'id': this.id
                }).then(function (response){
                    me.closeModal()
                    me.showList()
                    alerts.sweetAlert('success', 'Se actualizó correctamente')
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
