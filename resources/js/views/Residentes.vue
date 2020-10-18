<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <!-- Tabla -->
                <template v-if="action==1">
                    <template v-if="rol_id==1">
                        <button type="button" @click="openForm('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                    </template>
                    <div class="widget-content widget-content-area br-6">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"><i class="fas fa-calendar-alt"></i> Ingresó</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Nombre</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Apellido</th>
                                        <th class="text-center"><i class="fas fa-lock"></i> Estado</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(residente, index) in lista_residentes " :key="residente.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="residente.codigo" class="text-center"></td>
                                    <td v-text="residente.fecha_ingreso" class="text-center"></td>
                                    <td v-text="residente.nombre" class="text-center"></td>
                                    <td v-text="residente.apellido" class="text-center"></td>

                                    <td class="text-center">
                                        <div v-if="residente.activo==1 && residente.defuncion==0">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else-if="residente.activo==0 && residente.defuncion==0">
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                        <div v-else-if="residente.defuncion==1">
                                            <span class="badge outline-badge-secondary">Fallecido</span>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <template v-if="rol_id==1">
                                            <template v-if="residente.activo===1 && residente.defuncion===0">
                                                <button type="button" @click="changeStatus('desactivate', residente.id, residente.nombre, residente.apellido)" class="btn btn-eliminar mb-2 mr-2 rounded-circle"> <i class="fas fa-lock"></i></button>
                                                <button type="button" @click="openModal(residente)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                                <button type="button" @click="pdf(residente.id)" class="btn btn-danger mb-1 mr-1 rounded-circle"> <i class="fas fa-file-pdf"></i></button>
                                                <button type="button" @click="openForm('update', residente)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                                <button type="button" @click="death(residente.id, residente.nombre, residente.apellido)" class="btn btn-secondary mb-1 mr-1 rounded-circle"> <i class="fas fa-cross"></i></button>
                                            </template>
                                            <template v-else-if="residente.activo===0 && residente.defuncion===0">
                                                <button type="button" @click="changeStatus('activate', residente.id, residente.nombre, residente.apellido)" class="btn btn-guardar mb-2 mr-2 rounded-circle"> <i class="fas fa-unlock"></i></button>
                                                <button type="button" @click="openModal(residente)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                                <button type="button" @click="pdf(residente.id)" class="btn btn-danger mb-1 mr-1 rounded-circle"> <i class="fas fa-file-pdf"></i></button>
                                            </template>
                                        </template>
                                        <template v-else-if="rol_id==2">
                                                <button type="button" @click="openModal(residente)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                                <button type="button" @click="pdf(residente.id)" class="btn btn-danger mb-1 mr-1 rounded-circle"> <i class="fas fa-file-pdf"></i></button>
                                        </template>
                                        <template v-else-if="rol_id==3">
                                                <button type="button" @click="openModal(residente)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                        </template>
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
                                    <label class="text-info">Datos personales</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-user-check"></i> Nombre</label>
                                                <input type="text" class="form-control" name="nombre" v-model="nombre" :class="hasError('nombre') ? 'is-invalid' : ''">
                                                <div v-if="hasError('nombre')" class="invalid-feedback">
                                                    {{ errors.nombre[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-user-check"></i> Apellido</label>
                                                <input type="text" class="form-control" name="apellido" v-model="apellido" :class="hasError('apellido') ? 'is-invalid' : ''">
                                                <div v-if="hasError('apellido')" class="invalid-feedback">
                                                    {{ errors.apellido[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha de nacimiento</label>
                                                <input type="date" class="form-control" name="fecha_nacimiento" v-model="fecha_nacimiento" :class="hasError('fecha_nacimiento') ? 'is-invalid' : ''">
                                                <div v-if="hasError('fecha_nacimiento')" class="invalid-feedback">
                                                    {{ errors.fecha_nacimiento[0] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-2" v-if="opcion==1">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Lugar de nacimiento</label>
                                                <select id="departamento_origen" name="departamento_origen_id" v-model="departamento_origen_id" class="form-control">
                                                    <option v-for="departamento in lista_departamentos_origen" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2" v-if="opcion==1">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Lugar de nacimiento</label>
                                                <select id="municipio_origen" name="municipio_origen_id" v-model="municipio_origen_id" class="form-control" :class="hasError('municipio_origen') ? 'is-invalid' : ''">
                                                    <option v-for="municipio in lista_municipios_origen" :key="municipio.id" :value="municipio.id" v-text="municipio.nombre"></option>
                                                </select>
                                                <div v-if="hasError('municipio_origen')" class="invalid-feedback">
                                                    {{ errors.municipio_origen[0] }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4" v-if="opcion==1">
                                                <label class="text-dark"><i class="fas fa-id-card"></i> DPI</label>
                                                <input type="text" class="form-control" v-model="dpi" :class="hasError('dpi') ? 'is-invalid' : ''">
                                                <div v-if="hasError('dpi')" class="invalid-feedback">
                                                    {{ errors.dpi[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2" v-if="opcion==1">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Extendido en:</label>
                                                <select id="departamento_dpi" v-model="departamento_dpi_id" class="form-control" :class="hasError('municipio_dpi') ? 'is-invalid' : ''" @change="combo_municipio_dpi()">
                                                    <option v-for="departamento in lista_departamentos_dpi" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2" v-if="opcion==1">
                                                <label class="text-dark">-</label>
                                                <select id="municipio_dpi" name="municipio_dpi_id" v-model="municipio_dpi_id"  class="form-control">
                                                    <option v-for="municipio in lista_municipios_dpi" :key="municipio.id" :value="municipio.id" v-text="municipio.nombre"></option>
                                                </select>
                                                <div v-if="hasError('municipio_dpi')" class="invalid-feedback">
                                                    {{ errors.municipio_dpi[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <label>Datos Familiares</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-male"></i> Familiar</label>
                                                <input type="text" class="form-control" name="familia" v-model="familia">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                                <input type="text" class="form-control" name="direccion" v-model="direccion">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_familia" v-model="telefono_familia">
                                            </div>
                                        </div>

                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-male"></i> Persona referida</label>
                                                <input type="text" class="form-control" name="persona_referida" v-model="persona_referida">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                                <input type="text" class="form-control" name="direccion_persona_referida" v-model="direccion_persona_referida">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                                <input type="text" class="form-control" name="telefono_persona_referida" v-model="telefono_persona_referida">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <label class="text-success">Estatus</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-chalkboard-teacher"></i> Motivo de llegada</label>
                                                <input type="text" class="form-control" :class="hasError('motivo') ? 'is-invalid' : ''" name="motivo" v-model="motivo">
                                                <div v-if="hasError('motivo')" class="invalid-feedback">
                                                    {{ errors.motivo[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-thermometer"></i> Estado del residente</label>
                                                <input type="text" class="form-control" :class="hasError('estado') ? 'is-invalid' : ''" name="estado" v-model="estado">
                                                <div v-if="hasError('estado')" class="invalid-feedback">
                                                    {{ errors.estado[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-notes-medical"></i> Historial</label>
                                                <input type="text" class="form-control" :class="hasError('historial') ? 'is-invalid' : ''" name="historial" v-model="historial">
                                                <div v-if="hasError('historial')" class="invalid-feedback">
                                                    {{ errors.historial[0] }}
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

        <!-- Modal para ver los residentes -->
        <div :class="{'mostrar': modal}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
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
                                <div class="form-group col-md-3">
                                    <label><i class="fas fa-qrcode"></i> Código</label>
                                    <input style="height:35px" v-model="codigo" class="form-control text-dark"  disabled>
                                </div>

                                <div class="form-group col-md-5">
                                    <label><i class="fas fa-user-check"></i> Nombre completo</label>
                                    <input style="height:35px" v-model="nombre" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-2">
                                    <label><i class="far fa-calendar-alt"></i> Fecha nacimiento</label>
                                    <input style="height:35px" v-model="fecha_nacimiento" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-2">
                                    <label><i class="fas fa-pager"></i> Edad</label>
                                    <input style="height:35px" v-model="edad" class="form-control text-dark" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-street-view"></i> Lugar nacimiento</label>
                                    <input style="height:35px" class="form-control text-dark" v-model="lugar_nacimiento" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-id-card"></i> DPI</label>
                                    <input style="height:35px" class="form-control text-dark" v-model="dpi" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-street-view"></i> Extendido en:</label>
                                    <input style="height:35px" class="form-control text-dark" v-model="lugar_dpi_extendido" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-male"></i> Familiar</label>
                                    <input style="height:35px" v-model="familia" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-street-view"></i> Dirección</label>
                                    <input style="height:35px" v-model="direccion" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input style="height:35px" class="form-control text-dark" v-model="telefono_familia" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-male"></i> Persona referida</label>
                                    <input style="height:35px" v-model="persona_referida" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-street-view"></i> Dirección</label>
                                    <input style="height:35px" v-model="direccion_persona_referida" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input style="height:35px" v-model="telefono_persona_referida" class="form-control text-dark" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-chalkboard-teacher"></i> Motivo de llegada</label>
                                    <input style="height:35px" v-model="motivo" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-thermometer"></i> Estado del residente</label>
                                    <input style="height:35px" v-model="estado" class="form-control text-dark" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><i class="fas fa-notes-medical"></i> Historial</label>
                                    <input style="height:35px" v-model="historial" class="form-control text-dark" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label><i class="fas fa-search"></i> Observaciones</label>
                                    <input style="height:35px" v-model="observacion" class="form-control text-dark" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cerrar" @click="closeModal()">Salir <i class="fas fa-sign-out-alt"></i></button>
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
            codigo: 0,
            lista_residentes: [],
            codigo: '',
            nombre: '',
            apellido: '',
            fecha_nacimiento: '',
            edad : '',
            dpi: '',
            familia: '',
            direccion: '',
            telefono_familia: '',
            persona_referida: '',
            direccion_persona_referida: '',
            telefono_persona_referida: '',
            motivo: '',
            estado: '',
            historial: '',
            pulso: '',
            temperatura: '',
            presion: '',
            peso: '',
            observacion: '',

            lista_departamentos_origen: [],
            lista_departamentos_dpi: [],
            departamento_origen_id: 0,
            departamento_dpi_id: 0,
            departamento_origen_nombre: '',
            departamento_dpi_nombre: '',

            lista_municipios_origen: [],
            lista_municipios_dpi: [],
            municipio_origen_id: 0,
            municipio_dpi_id: 0,
            municipio_origen_nombre: '',
            municipio_dpi_nombre: '',

            lugar_nacimiento: '',
            lugar_dpi_extendido: '',

            action: 1,
            modal:0,
            opcion: 1,
            titulo: '',

            errors: [],

            rol_id: 0,
        }
    },
    methods: {
        openForm(metodo, data = []) {
            switch(metodo){
                case 'create': {
                    this.action = 2
                    this.opcion = 1
                    this.dataTable()
                    this.showList()
                    this.titulo = "FICHA DE REGISTRO"
                    this.combo_departamento_origen()
                    this.combo_departamento_dpi()
                    this.fecha_nacimiento = moment().format('YYYY-MM-DD')
                    break
                }
                case 'update': {
                    this.action = 2
                    this.opcion = 2
                    this.dataTable()
                    this.showList()
                    this.titulo = "ACTUALIZACIÓN DE FICHA"

                    this.nombre = data['nombre']
                    this.apellido = data['apellido']
                    this.fecha_nacimiento = data['fecha_nacimiento']
                    this.familia = data['familia']
                    this.direccion = data['direccion']
                    this.telefono_familia = data['telefono_familia']
                    this.persona_referida = data['persona_referida']
                    this.direccion_persona_referida = data['direccion_persona_referida']
                    this.telefono_persona_referida = data['telefono_persona_referida']
                    this.motivo = data['motivo']
                    this.estado = data['estado']
                    this.historial = data['historial']
                    this.observacion = data['observacion']
                    this.id = data['id']
                    break
                }
            }
        },
        openModal(data = []) {
            this.modal = 1
            this.titulo = 'FICHA DEL RESIDENTE: ' + data['nombre'].toUpperCase() + ' ' + data['apellido'].toUpperCase()

            this.codigo = data['codigo']
            this.nombre = data['nombre'] + ' ' + data['apellido']
            this.fecha_nacimiento = data['fecha_nacimiento']
            this.edad = data['edad']
            this.lugar_nacimiento = data['departamento_origen_nombre'] + ', ' + data['municipio_origen_nombre']
            this.dpi = data['dpi']
            this.lugar_dpi_extendido = data['departamento_dpi_nombre'] + ', ' + data['municipio_dpi_nombre']
            this.familia = data['familia']
            this.direccion = data['direccion']
            this.telefono_familia = data['telefono_familia']
            this.persona_referida = data['persona_referida']
            this.direccion_persona_referida = data['direccion_persona_referida']
            this.telefono_persona_referida = data['telefono_persona_referida']
            this.motivo = data['motivo']
            this.estado = data['estado']
            this.historial = data['historial']
            this.observacion = data['observacion']

            let actual = moment()
            this.edad = actual.diff(this.fecha_nacimiento, 'years')
        },
        closeForm(){
            this.departamento_origen_id = 0
            this.departamento_dpi_id = 0
            this.municipio_origen_id = 0
            this.municipio_dpi_id = 0
            this.nombre = ''
            this.apellido = ''
            this.fecha_nacimiento = ''
            this.dpi = ''
            this.familia = ''
            this.direccion = ''
            this.telefono_familia = ''
            this.persona_referida = ''
            this.direccion_persona_referida = ''
            this.telefono_persona_referida = ''
            this.motivo = ''
            this.estado = ''
            this.historial = ''
            this.observacion = ''

            this.showList()
            this.action = 1
            this.opcion = 0
            this.titulo = ''
            this.errors = []

            alerts.sweetAlert('error', 'Operación cancelada')
        },
        closeModal(){
            this.codigo = ''
            this.nombre = ''
            this.fecha_nacimiento = ''
            this.edad = ''
            this.lugar_nacimiento = ''
            this.dpi = ''
            this.lugar_dpi_extendido = ''
            this.familia = ''
            this.direccion = ''
            this.telefono_familia = ''
            this.persona_referida = ''
            this.direccion_persona_referida = ''
            this.telefono_persona_referida = ''
            this.motivo = ''
            this.estado = ''
            this.historial = ''
            this.observacion = ''

            this.titulo = ''
            this.modal = 0

            alerts.sweetAlert('success', 'VISUALIZACIÓN DE FICHA EXITOSA')
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
                this.closeForm()
                this.showList()
                alerts.sweetAlert(response.data.status, response.data.message)
            }else{
                alerts.sweetAlert(response.data.status, response.data.message)
            }
        },
        changeStatus(action, id, nombre, apellido) {
            swal({
                title: 'Cambio de estado',
                text: '¿Esta seguro de realizar la siguiente acción sobre el residente '+nombre+' '+apellido+'?',
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
                    var url = '/residentes/activate'
                else if (action == 'desactivate')
                    var url = '/residentes/desactivate'

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
        death(id, nombre, apellido) {
            swal({
                title: 'Fallecimiento',
                text: '¿Esta seguro de realizar la siguiente acción sobre el residente '+nombre+' '+apellido+'?',
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
                let url = '/residentes/defuncion'

                if (result.value) {
                    let me = this
                    axios.put(url, {
                        'id': id
                    }).then(function (response) {
                        me.showList()
                        swal(
                            'Fallecimiento',
                            'Se ha realizado la acción correctamente',
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
        change_select_departamento_origen() {
            let me = this

            $('#departamento_origen').on('change', function () {
                me.municipio_origen_id = 0
                me.$emit('change', this.value)
                me.departamento_origen_id = this.value
                me.combo_municipio_origen()
            })
        },
        change_select_municipio_origen() {
            let me = this

            $('#municipio_origen').on('change', function () {
                me.$emit('change', this.value)
                me.municipio_origen_id = this.value
            })
        },
        change_select_departamento_dpi() {
            let me = this

            $('#departamento_dpi').on('change', function () {
                me.municipio_dpi_id = 0
                me.$emit('change', this.value)
                me.departamento_dpi_id = this.value
                me.combo_municipio_dpi()
            })
        },
        change_select_municipio_dpi() {
            let me = this

            $('#municipio_dpi').on('change', function () {
                me.$emit('change', this.value)
                me.municipio_dpi_id = this.value
            })
        },
        combo_departamento_origen() {
            let me = this
            let url = '/departamentos/combo'

            axios.get(url).then(function (response) {
                me.lista_departamentos_origen = response.data
                $('#departamento_origen').select2({
                    placeholder: 'Seleccione departamento',
                    display: 'block'
                })
                me.change_select_departamento_origen()
            }).catch(function (error) {
                console.log(error)
            })
        },
        combo_departamento_dpi() {
            let me = this
            let url = '/departamentos/combo'

            axios.get(url).then(function (response) {
                me.lista_departamentos_dpi = response.data
                $('#departamento_dpi').select2({
                    placeholder: 'Seleccione departamento',
                })
                me.change_select_departamento_dpi()
            }).catch(function (error) {
                console.log(error)
            })
        },
        combo_municipio_origen() {
            let me = this
            let url = '/municipios/combo'

            axios.get(url, {params:
                {departamento_origen_id: this.departamento_origen_id}
            }).then(function (response) {
                me.lista_municipios_origen = response.data
                me.change_select_municipio_origen()
                $('#municipio_origen').select2({
                    placeholder: 'Seleccione municipio'
                })
            }).catch(function (error) {
                console.log(error)
            })
        },
        combo_municipio_dpi() {
            let me = this
            let url = '/municipios/combo'

            axios.get(url, {params:
                {departamento_origen_id: this.departamento_dpi_id}
            }).then(function (response) {
                me.lista_municipios_dpi = response.data
                me.change_select_municipio_dpi()
                $('#municipio_dpi').select2({
                    placeholder: 'Seleccione municipio'
                })
            }).catch(function (error) {
                console.log(error)
            })
        },
        showList() {
            let me = this
            let url = '/residentes'

            axios.get(url).then(function (response) {
                me.lista_residentes = response.data.query
                me.rol_id = response.data.rol
                console.log(response.data)
                me.dataTable()
            }).catch(function (error) {
                console.log(error)
            })
        },
        store() {
            let me = this
            let url = '/residentes/store'

            if (me.otherError()) return
            else {
                axios.post(url, {
                    'municipio_origen': this.municipio_origen_id,
                    'municipio_dpi': this.municipio_dpi_id,
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'fecha_nacimiento': this.fecha_nacimiento,
                    'dpi': this.dpi,
                    'familia': this.familia,
                    'direccion': this.direccion,
                    'telefono_familia': this.telefono_familia,
                    'persona_referida': this.persona_referida,
                    'direccion_persona_referida': this.direccion_persona_referida,
                    'telefono_persona_referida': this.telefono_persona_referida,
                    'motivo': this.motivo,
                    'estado': this.estado,
                    'historial': this.historial,
                    'observacion': this.observacion
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        update() {
            let me = this
            let url = '/residentes/update'

            if (me.otherError()) return
            else {
                axios.put(url, {
                    'nombre': this.nombre,
                    'apellido': this.apellido,
                    'fecha_nacimiento': this.fecha_nacimiento,
                    'familia': this.familia,
                    'direccion': this.direccion,
                    'telefono_familia': this.telefono_familia,
                    'persona_referida': this.persona_referida,
                    'direccion_persona_referida': this.direccion_persona_referida,
                    'telefono_persona_referida': this.telefono_persona_referida,
                    'motivo': this.motivo,
                    'estado': this.estado,
                    'historial': this.historial,
                    'observacion': this.observacion,
                    'id': this.id
                }).then(function (response) {
                    me.backendResponse(response)
                }).catch(error => {
                    if(error.response.status == 422)
                        this.errors = error.response.data.errors
                })
            }
        },
        pdf(id) {
            window.open('/residentes/pdf/'+ id + ',' + '_blank');
        }
    },
    mounted() {
        this.showList()
    },
}
</script>
