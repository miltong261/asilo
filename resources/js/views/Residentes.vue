<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="row">
                    <div id="flFormsGrid" class="col-lg-10 layout-spacing mx-auto">
                        <div class="widget-header p-2">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-center">REGISTRO DE RESIDENTES</h4>
                                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-formulario.jpeg" alt="logo" width="90" height="90">
                                </div>                                                                        
                            </div>
                        </div>

                        <div class="widget-content widget-content-area ">
                            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                                <label class="text-info">Datos personales</label>
                                <fieldset class="border border-fieldset rounded p-3">
                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-4">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" v-model="nombre" :class="hasError('nombre') ? 'is-invalid' : ''">
                                            <div v-if="hasError('nombre')" class="invalid-feedback">
                                                {{ errors.nombre[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" v-model="apellido" :class="hasError('apellido') ? 'is-invalid' : ''">
                                            <div v-if="hasError('apellido')" class="invalid-feedback">
                                                {{ errors.apellido[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="fecha_nacimiento" v-model="fecha_nacimiento" :class="hasError('fecha_nacimiento') ? 'is-invalid' : ''">
                                            <div v-if="hasError('fecha_nacimiento')" class="invalid-feedback">
                                                {{ errors.fecha_nacimiento[0] }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-2">
                                            <label for="">Lugar de nacimiento</label>
                                            <select class="form-control">
                                                <option selected></option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">-</label>
                                            <select class="form-control">
                                                <option selected></option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">DPI</label>
                                            <input type="text" class="form-control" v-model="dpi" :class="hasError('dpi') ? 'is-invalid' : ''">
                                            <div v-if="hasError('dpi')" class="invalid-feedback">
                                                {{ errors.dpi[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">Extendido en:</label>
                                            <select class="form-control">
                                                <option selected></option>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">-</label>
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
                                            <label for="">Familiar</label>
                                            <input type="text" class="form-control" name="familiar" v-model="familiar">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" v-model="direccion">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" v-model="telefono">
                                        </div>
                                    </div>

                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-4">
                                            <label for="inputPassword4">Persona referida</label>
                                            <input type="text" class="form-control" name="persona_referida" v-model="persona_referida">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="inputPassword4">Dirección</label>
                                            <input type="text" class="form-control" name="direccion_persona_referida" v-model="direccion_persona_referida">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputPassword4">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono_persona_referida" v-model="telefono_persona_referida">
                                        </div>
                                    </div>
                                </fieldset>

                                <label class="text-success">Estatus</label>
                                <fieldset class="border border-fieldset rounded p-3">
                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-4">
                                            <label for="">Motivo de llegada</label>
                                            <input type="text" class="form-control" :class="hasError('motivo') ? 'is-invalid' : ''" name="motivo">
                                            <div v-if="hasError('motivo')" class="invalid-feedback">
                                                {{ errors.motivo[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Estado del residente</label>
                                            <input type="text" class="form-control" :class="hasError('estado') ? 'is-invalid' : ''" name="estado">
                                            <div v-if="hasError('estado')" class="invalid-feedback">
                                                {{ errors.estado[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Historial</label>
                                            <input type="text" class="form-control" :class="hasError('historial') ? 'is-invalid' : ''" name="historial">
                                            <div v-if="hasError('historial')" class="invalid-feedback">
                                                {{ errors.historial[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-2">
                                            <label for="">Signos vitales</label>
                                            <input type="text" class="form-control" placeholder="Pulso..." :class="hasError('pulso') ? 'is-invalid' : ''" name="pulso">
                                            <div v-if="hasError('pulso')" class="invalid-feedback">
                                                {{ errors.pulso[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="">.</label>
                                            <input type="text" class="form-control" placeholder="Temperatura..." :class="hasError('temperatura') ? 'is-invalid' : ''" name="temperatura">
                                            <div v-if="hasError('temperatura')" class="invalid-feedback">
                                                {{ errors.temperatura[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Presión arterial</label>
                                            <input type="text" class="form-control" :class="hasError('presion') ? 'is-invalid' : ''" name="presion">
                                            <div v-if="hasError('presion')" class="invalid-feedback">
                                                {{ errors.presion[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Peso</label>
                                            <input type="text" class="form-control" :class="hasError('peso') ? 'is-invalid' : ''" name="peso">
                                            <div v-if="hasError('peso')" class="invalid-feedback">
                                                {{ errors.peso[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-12">
                                        <label for="" class="text-danger">Observaciones</label>
                                        <textarea class="form-control" rows="3" name="observacion" v-model="observacion"></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                                    <button type="button" class="btn btn-guardar">Guardar <i class="far fa-check-circle"></i></button>
                                    <button type="button" class="btn btn-warning">Actualizar <i class="fas fa-sync-alt"></i></button>
                                </div>
                            </form>                                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</template>

<script>
export default {

}
</script>
