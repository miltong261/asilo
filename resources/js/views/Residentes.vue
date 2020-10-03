<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">    
                <template v-if="axion">
                    <button type="button" @click="openForm('create')" class="btn btn-info mb-2">Nuevo <i class="fas fa-plus"></i></button>
                    <div class="widget-content widget-content-area br-6">
                        <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                        <div class="table-responsive mb-0 mt-0">
                            <table id="zero-config" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="fas fa-hashtag"></i></th>
                                        <th class="text-center"><i class="fas fa-qrcode"></i> Código</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Nombre</th>
                                        <th class="text-center"><i class="fas fa-user-check"></i> Apellido</th>
                                        <th class="text-center"><i class="fas fa-id-card"></i> DPI</th>
                                        <th class="text-center"><i class="far fa-calendar-alt"></i> Fecha nacimiento</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>1234</td>
                                    <td>Maria</td>
                                    <td>Werner</td>
                                    <td>123456789</td>
                                    <td>Milton Giron</td>
                                    <td>41802654</td>


                                    <!-- <tr v-for="(residentes, index) in lista_residentes " :key="residentes.id">
                                    <td v-text="index+1" class="text-center"></td>
                                    <td v-text="residentes.codigo" class="text-center"></td>
                                    <td v-text="residentes.nombre" class="text-center"></td>
                                    <td v-text="residentes.apellido" class="text-center"></td>
                                    <td class="text-center">
                                        <div v-if="residentes.estado">
                                            <span class="badge outline-badge-check">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge outline-badge-no-check">Inactivo</span>
                                        </div>
                                    </td> -->
                                    <td class="text-center">
                                        <button type="button" @click="openModal(recidentes)" class="btn btn-info mb-1 mr-1 rounded-circle"> <i class="fas fa-eye"></i></button>
                                        <button type="button" @click="openForm('update', residentes)" class="btn btn-warning mb-1 mr-1 rounded-circle"> <i class="fas fa-sync-alt"></i></button>
                                    </td>
                                <!-- </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing mx-auto">
                            <div class="widget-content widget-content-area ">
                                <div class="widget-header p-2">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                                            <h4 class="text-center">REGISTRO DE RESIDENTES</h4>
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
                                            <div class="form-group col-md-2">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Lugar de nacimiento</label>
                                                <select class="form-control">
                                                    <option selected></option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="text-dark">-</label>
                                                <select class="form-control">
                                                    <option selected></option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-id-card"></i> DPI</label>
                                                <input type="text" class="form-control" v-model="dpi" :class="hasError('dpi') ? 'is-invalid' : ''">
                                                <div v-if="hasError('dpi')" class="invalid-feedback">
                                                    {{ errors.dpi[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Extendido en:</label>
                                                <select class="form-control">
                                                    <option selected></option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="text-dark">-</label>
                                                <select class="form-control">
                                                    <option selected></option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <label class="text-secondary">Datos Familiares</label>
                                    <fieldset class="border border-fieldset rounded p-3">
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-male"></i> Familiar</label>
                                                <input type="text" class="form-control" name="familiar" v-model="familiar">
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                                <input type="text" class="form-control" name="direccion" v-model="direccion">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                                <input type="text" class="form-control" name="telefono" v-model="telefono">
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
                                                <input type="text" class="form-control" :class="hasError('motivo') ? 'is-invalid' : ''" name="motivo">
                                                <div v-if="hasError('motivo')" class="invalid-feedback">
                                                    {{ errors.motivo[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-thermometer"></i> Estado del residente</label>
                                                <input type="text" class="form-control" :class="hasError('estado') ? 'is-invalid' : ''" name="estado">
                                                <div v-if="hasError('estado')" class="invalid-feedback">
                                                    {{ errors.estado[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-notes-medical"></i> Historial</label>
                                                <input type="text" class="form-control" :class="hasError('historial') ? 'is-invalid' : ''" name="historial">
                                                <div v-if="hasError('historial')" class="invalid-feedback">
                                                    {{ errors.historial[0] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-0">
                                            <div class="form-group col-md-2">
                                                <label class="text-dark"><i class="fas fa-heartbeat"></i> Pulso</label>
                                                <input type="text" class="form-control" :class="hasError('pulso') ? 'is-invalid' : ''" name="pulso">
                                                <div v-if="hasError('pulso')" class="invalid-feedback">
                                                    {{ errors.pulso[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label class="text-dark"><i class="fas fa-thermometer-three-quarters"></i> Temperatura</label>
                                                <input type="text" class="form-control" :class="hasError('temperatura') ? 'is-invalid' : ''" name="temperatura">
                                                <div v-if="hasError('temperatura')" class="invalid-feedback">
                                                    {{ errors.temperatura[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-stethoscope"></i> Presión arterial</label>
                                                <input type="text" class="form-control" :class="hasError('presion') ? 'is-invalid' : ''" name="presion">
                                                <div v-if="hasError('presion')" class="invalid-feedback">
                                                    {{ errors.presion[0] }}
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="text-dark"><i class="fas fa-weight"></i> Peso</label>
                                                <input type="text" class="form-control" :class="hasError('peso') ? 'is-invalid' : ''" name="peso">
                                                <div v-if="hasError('peso')" class="invalid-feedback">
                                                    {{ errors.peso[0] }}
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
                                        <button type="button" @click="closeFrom()" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                                        <button type="button" class="btn btn-guardar">Guardar <i class="far fa-check-circle"></i></button>
                                        <button type="button" class="btn btn-warning">Actualizar <i class="fas fa-sync-alt"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Modal para ver los residentes -->
        <div :class="{'mostrar': Modal}" class="modal fadeInDown show" role="dialog" style="display: none;" aria-hidden="true">
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
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-qrcode"></i> Código</label>
                                    <input v-text="codigo" v-model="codigo" class="form-control"  disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-user-check"></i> Nombre</label>
                                    <input v-text="nombre" v-model="nombre" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-user-check"></i> Apellido</label>
                                    <input v-text="apellido" v-model="apellido" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="far fa-calendar-alt"></i> Fecha nacimiento</label>
                                    <input v-text="fecha_nacimiento" v-model="fecha_nacimiento" class="form-control" disabled>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="text-dark"><i class="fas fa-street-view"></i> Lugar nacimiento</label>
                                    <input v-text="municipio" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                    <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-id-card"></i> DPI</label>
                                    <input v-text="fecha"  class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-8">
                                    <label class="text-dark"><i class="fas fa-street-view"></i> Extendido en:</label>
                                    <input v-text="extendido" class="form-control" disabled>
                                </div>

                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-male"></i> Familiar</label>
                                    <input v-text="familia" v-model="familia" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                    <input v-text="direccion" v-model="direccion" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input v-text="telefono" v-model="telefono" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-male"></i> Persona referida</label>
                                    <input v-text="persona_referida" v-model="persona_referida" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-street-view"></i> Dirección</label>
                                    <input v-text="direccion_persona_referida" v-model="direccion_persona_referida" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-phone-alt"></i> Teléfono</label>
                                    <input v-text="telefono_persona_referida" v-model="telefono_persona_referida" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-chalkboard-teacher"></i> Motivo de llegada</label>
                                    <input v-text="motivo" v-model="motivo" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-thermometer"></i> Estado del residente</label>
                                    <input v-text="estado" v-model="estado" class="form-control" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="text-dark"><i class="fas fa-notes-medical"></i> Historial</label>
                                    <input v-text="historial" v-model="historial" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-row mb-0">
                                <div class="form-group col-md-12">
                                    <label class="text-dark"><i class="fas fa-search"></i> Observaciones</label>
                                    <input v-text="observacion" v-model="observacion" class="form-control" disabled>
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
    import * as alerts from '../functions/alerts.js'

    export default {
        data() {
            return {
                id: 0,
                lista_residentes: [],
                codigo: '',
                nombre: '',
                apellido: '',
                fecha_nacimiento: '',
                dpi: '',
                familia: '',
                direccion: '',
                telefono: '',
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

                errors: [],
                axion: 1,
                titulo: '',
                opcion: 1,
                
                Modal:0
            }
        },
        methods: {
            openForm(metodo, data = []) {
                switch(metodo){
                    case 'create': {
                        this.modal = 1
                        this.titulo = "Registro de recidentes"
                        this.axion = 0
                        this.opcion = 1
                        break
                    }
                    case 'update': {
                        this.modal = 2
                        this.titulo = "Actualización de recidentes"
                        this.opcion = 2
                        
                        this.nombre = data['nombre']
                        this.apellido = data['apellido']
                        this.fecha_nacimiento = dara['fecha_nacimiento']
                        this.dpi = data['dpi']
                        this.familia = data['familia']
                        this.direccion = data['direccion']
                        this.telefono = data['telefono']
                        this.persona_referida = data['persona_referida']
                        this.direccion_persona_referida = data['direccion_persona_referida']
                        this.telefono_persona_referida = data['telefono_persona_referida']
                        this.motivo = data['motivo']
                        this.estado = data['estado']
                        this.historial = data['historial']
                        this.observacion = data['observacion']
                        this.id = data['id']
                    }
                }
            },
            openModal(data = []) {
                this.Modal = 1
                this.titulo = 'VISUALIZACIÓN DE RESIDENTES'

                this.nombre = data['nombre']
                    this.apellido = data['apellido']
                    this.fecha_nacimiento = dara['fecha_nacimiento']
                    this.dpi = data['dpi']
                    this.familia = data['familia']
                    this.direccion = data['direccion']
                    this.telefono = data['telefono']
                    this.persona_referida = data['persona_referida']
                    this.direccion_persona_referida = data['direccion_persona_referida']
                    this.telefono_persona_referida = data['telefono_persona_referida']
                    this.motivo = data['motivo']
                    this.estado = data['estado']
                    this.historial = data['historial']
                    this.observacion = data['observacion']
            },
            closeFrom(){
                this.nombre = ''
                this.apellido = ''
                this.fecha_nacimiento = ''
                this.dpi = ''
                this.familia = ''
                this.direccion = ''
                this.telefono = ''
                this.persona_referida = ''
                this.direccion_persona_referida = ''
                this.telefono_persona_referida = ''
                this.motivo = ''
                this.estado = ''
                this.historial = ''
                this.observacion = ''

                this.modal = 0
                this.titulo = ''
                this.opcion = 0
                this.axion = 1  
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },  
            closeModal(){
                this.nombre = ''
                this.apellido = ''
                this.fecha_nacimiento = ''
                this.dpi = ''
                this.familia = ''
                this.direccion = ''
                this.telefono = ''
                this.persona_referida = ''
                this.direccion_persona_referida = ''
                this.telefono_persona_referida = ''
                this.motivo = ''
                this.estado = ''
                this.historial = ''
                this.observacion = ''

                this.Modal = 0
                this.titulo = ''
                this.opcion = 0
                this.errors = []

                alerts.sweetAlert('error', 'Operación cancelada')
            },          
            hasError(field) {
                return field in (this.errors)
            }
        }
    }
</script>
