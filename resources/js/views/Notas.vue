<template>
    <div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <!-- Tabla -->
                <template v-if="action==1">
                    <button type="button" @click="openForm('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                    <div class="widget-content widget-content-area br-6">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Nombre completo</th>
                                        <th class="text-center"><i class="fas fa-notes-medical"></i> Nota</th>
                                        <th class="text-center"><i class="fas fa-briefcase-medical"></i> Medicamento</th>
                                        <th class="text-center"><i class="fas fa-pencil-alt"></i> Cantidad</th>
                                        <th class="text-center"><i class="fas fa-user"></i> Responsable</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(notas, index) in lista_notas " :key="notas.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="notas.codigo" class="text-center"></td>
                                    <td v-text="notas.nombre_id" class="text-center"></td>
                                    <td v-text="notas.nota" class="text-center"></td>
                                    <td v-text="notas.medicamento_id" class="text-center"></td>
                                    <td v-text="notas.cantidad" class="text-center"></td>
                                    <td v-text="notas.responsable" class="text-center"></td>

                                    <td class="text-center">
                                        <button type="button" @click="openModal(notas)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                        <button type="button" @click="openForm('update', notas)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>

                <!-- Formulario -->
                <template v-else-if="action==2">
                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing mx-auto">
                            <div class="widget-content widget-content-area ">
                                <div class="widget-header p-2">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                                            <h4 class="text-center text-secondary" v-text="titulo"></h4>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                                    <label class="text-info">Datos paciente</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-briefcase-medical"></i> Nombre completo</label>
                                                <select id="select_residentes" class="form-control" :class="hasError('residentes_id') ? 'is-invalid' : ''" v-model="residentes_id">
                                                    <option v-for="residentes in lista_residentes" :key="residentes.id" :value="residentes.id" v-text="residentes.residentes"></option>
                                                </select>
                                                <div v-if="hasError('residentes_id')" class="invalid-feedback">
                                                    {{ errors.residentes_id[0] }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <label class="text-dark"><i class="fas fa-notes-medical"></i> historial</label>
                                                <input type="text" class="form-control" name="historial" v-model="historial" :class="hasError('historial') ? 'is-invalid' : ''">
                                                <div v-if="hasError('historial')" class="invalid-feedback">
                                                    {{ errors.historial[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <label class="text-success">Evaluación</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-12">
                                                <label class="text-dark"><i class="fas fa-notes-medical"></i> Nota evaluación</label>
                                                <input type="text" class="form-control" name="nota" v-model="nota" :class="hasError('nota') ? 'is-invalid' : ''">
                                                <div v-if="hasError('nota')" class="invalid-feedback">
                                                    {{ errors.nota[0] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-briefcase-medical"></i> Medicamento</label>
                                                <select id="select_medicamento" class="form-control" :class="hasError('medicamento_id') ? 'is-invalid' : ''" v-model="medicamento_id">
                                                    <option v-for="medicamento in lista_medicamentos" :key="medicamento.id" :value="medicamento.id" v-text="medicamento.nombre"></option>
                                                </select>
                                                <div v-if="hasError('medicamento_id')" class="invalid-feedback">
                                                    {{ errors.medicamento_id[0] }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-pencil-alt"></i> Cantidad</label>
                                                <input type="text" class="form-control" name="cantidad" v-model="cantidad" :class="hasError('cantidad') ? 'is-invalid' : ''">
                                                <div v-if="hasError('cantidad')" class="invalid-feedback">
                                                    {{ errors.cantidad[0] }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-user"></i> Responsable</label>
                                                <input type="text" class="form-control" name="responsable" v-model="responsable" :class="hasError('responsable') ? 'is-invalid' : ''">
                                                <div v-if="hasError('responsable')" class="invalid-feedback">
                                                    {{ errors.responsable[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-12">
                                            <label class="text-danger"><i class="fas fa-search"></i> Observaciones</label>
                                            <textarea class="form-control" rows="3" name="observacion" v-model="observacion"></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="button" @click="closeForm()" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                                        <button type="button" class="btn btn-guardar" v-if="opcion==1" @click="store()">Guardar <i class="far fa-check-circle"></i></button>
                                        <button type="button" class="btn btn-warning" v-if="opcion==2" @click="update()">Actualizar <i class="fas fa-sync-alt"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
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
                lista_notas: [],
                nombre_id: '',
                historial: '',
                nota: '',
                medicamento_id: '',
                cantidad: '',
                responsable: '',
                observacion: '',

                lista_medicamentos: [],
                lista_residentes: [],

                action: 1,
                modal:0,
                opcion: 1,
                titulo: '',

                errors: [],
            }
        },
        methods: {
            openForm(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.action = 2
                        this.opcion = 1
                        this.dataTable()
                        // this.showList()
                        this.titulo = "REGISTRO NOTAS ENFERMERIA"
                        break
                    }
                    case 'update': {
                        this.action = 2
                        this.opcion = 2
                        this.titulo = "ACTUALIZACIÓN DE FICHAs"

                        thi.nombre = data['nombre']
                        this.historial = data['historial']
                        this.nota = data['nota']
                        this.medicamento = data['medicamento']
                        this.cantidad = data['cantidad']
                        this.responsable = data['responsable']
                        this.observacion = data['observacion']
                        this.id = data['id']
                        break
                    }
                }
            },
            closeForm(){
                this.historial = ''
                this.nota = ''
                this.medicamento = ''
                this.cantidad = ''
                this.responsable = ''
                this.observacion = ''

                // this.showList()
                this.action = 1
                this.opcion = 0
                this.titulo = ''
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
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