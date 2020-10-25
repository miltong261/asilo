<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                <div class="form-group">
                    <!-- <div class="d-flex justify-content-between"> -->
                    <div class="col-md-11 mx-auto">
                        <div class="form-group float-left">
                            <img class="rounded-circle mx-auto d-block" src="/assets/img/logo-formulario.jpeg" alt="logo" width="100" height="100">
                        </div>

                        <div class="form-group text-center">
                            <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                            <h6>Residenciales Ciudad Palmeras</h6>
                            <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                        </div>

                        <div class="form-group float-right mx-auto">
                            <h6 class="float-right">Fecha: <strong class="text-secondary">{{ fecha }}</strong></h6>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="card col-md-11 mx-auto">
                        <div class="card-header text-center text-secondary">
                            <i class="fas fa-hospital-user"></i> PERFIL DE USUARIO
                        </div>
                        <div class="card-body">
                            <h6 class="text-info">Datos de registro</h6>
                            <blockquote class="blockquote mb-0 blockquote-primero" style="border-left: 5px solid #bae7ff;">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-info"><i class="fas fa-calendar-alt"></i> FECHA DE REGISTRO </label><br>
                                        <label>{{ fecha_registro }}</label>
                                    </div>

                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-info"><i class="fas fa-qrcode"></i> CÓDIGO DE EMPLEADO</label><br>
                                        <label>{{ codigo }}</label>
                                    </div>

                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-info"><i class="fas fa-user-check"></i> NOMBRE DE USUARIO</label><br>
                                        <label>{{ usuario }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-info"><i class="fas fa-store-alt"></i> ÁREA </label><br>
                                        <label>{{ nombre_area }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-info"><i class="fas fa-address-card"></i> PUESTO</label><br>
                                        <label>{{ nombre_puesto }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                    </div>
                                </div>
                            </blockquote>

                            <br>

                            <h6 class="text-secondary">Datos personales</h6>
                            <blockquote class="blockquote mb-0 blockquote-primero" style="border-left: 5px solid #5c1ac3;">
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-secondary"><i class="fas fa-calendar-alt"></i> FECHA DE INGRESO </label><br>
                                        <label>{{ fecha_ingreso }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-secondary"><i class="fas fa-user"></i> NOMBRE COMPLETO</label><br>
                                        <label>{{ nombre }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-secondary"><i class="fas fa-phone-alt"></i> TELÉFONO </label><br>
                                        <label>{{ telefono }}</label>
                                    </div>

                                    <div class="form-group col-md-3 text-center">
                                        <label class="text-secondary"><i class="fas fa-street-view"></i> DIRECCIÓN </label><br>
                                        <label>{{ direccion }}</label>
                                    </div>

                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-secondary"><i class="fas fa-calendar-alt"></i> FECHA DE NACIMIENTO </label><br>
                                        <label>{{ fecha_nacimiento }}</label>
                                    </div>

                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-secondary"><i class="fas fa-pager"></i> EDAD </label><br>
                                        <label>{{ edad }}</label>
                                    </div>

                                    <div class="form-group col-md-4 text-center">
                                        <label class="text-secondary"><i class="fas fa-id-card"></i> DPI </label><br>
                                        <label>{{ dpi }}</label>
                                    </div>
                                </div>
                            </blockquote>

                            <br>

                            <div class="text-right">
                                <button id="changePassword" type="button" @click="changePassword()" class="btn btn-warning">Cambiar contraseña <i class="fas fa-key"></i></button>
                            </div>

                            <h6 class="text-warning" v-if="action">Cambio de contraseña</h6>
                            <blockquote class="blockquote mb-0" style="border-left: 5px solid #e2a03f;" v-if="action">
                                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate action="javascript:void(0)">
                                    <div class="form-row mb-0">
                                        <div class="form-group col-md-4">
                                            <label class="text-dark"><i class="fas fa-lock"></i> CONTRASEÑA ACTUAL </label><br>
                                            <input type="password" class="form-control" name="password_actual" v-model="password_actual" :class="hasError('password_actual') ? 'is-invalid' : ''">
                                            <div v-if="hasError('password_actual')" class="invalid-feedback">
                                                {{ errors.password_actual[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="text-dark"><i class="fas fa-key"></i> NUEVA CONTRASEÑA </label><br>
                                            <input type="password" class="form-control" name="password_nueva" v-model="password_nueva" :class="hasError('password_nueva') ? 'is-invalid' : ''">
                                            <div v-if="hasError('password_nueva')" class="invalid-feedback">
                                                {{ errors.password_nueva[0] }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="text-dark"><i class="fas fa-key"></i> CONFIRMAR CONTRASEÑA </label><br>
                                            <input type="password" class="form-control" name="password_confirm" v-model="password_confirm" :class="hasError('password_confirm') ? 'is-invalid' : ''">
                                            <div v-if="hasError('password_confirm')" class="invalid-feedback">
                                                {{ errors.password_confirm[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button id="update" type="button" @click="close()" class="btn btn-cerrar">Cancelar <i class="far fa-times-circle"></i></button>
                                        <button id="update" type="button" @click="update()" class="btn btn-warning">Actualizar <i class="fas fa-sync-alt"></i></button>
                                    </div>
                                </form>
                            </blockquote>
                        </div>
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
            fecha: '',
            action: 0,

            id: 0,
            fecha_registro: '',
            codigo: '',
            usuario: '',
            nombre_area: '',
            nombre_puesto: '',
            fecha_ingreso: '',
            nombre: '',
            telefono: '',
            direccion: '',
            fecha_nacimiento: '',
            edad: 0,
            dpi: '',

            password_actual: '',
            password_nueva: '',
            password_confirm: '',

            errors: []
        }
    },
    methods: {
        hasError(field) {
            return field in (this.errors)
        },
        backendResponse(response) {
            if(response.data.status == 'success'){
                this.close()
                alerts.sweetAlert(response.data.status, response.data.message)
            }else{
                alerts.sweetAlert(response.data.status, response.data.message)
            }
        },
        changePassword() {
            this.action = 1
            document.getElementById('changePassword').style.display = 'none'
        },
        close() {
            this.action = 0,
            this.password_actual = '',
            this.password_nueva = '',
            this.password_confirm = ''
            document.getElementById('changePassword').style.display = 'inline'
        },
        showUser() {
            let me = this
            let url = '/usuarios/perfil'

            axios.get(url).then(function (response) {
                me.fecha_registro = moment(response.data.user[0].fecha_registro).format('D MMMM YYYY')
                me.codigo = response.data.user[0].codigo
                me.usuario = response.data.user[0].usuario
                me.nombre_area = response.data.user[0].nombre_area
                me.nombre_puesto = response.data.user[0].nombre_puesto
                me.fecha_ingreso = moment(response.data.user[0].fecha_registro).format('D MMMM YYYY')
                me.nombre = response.data.user[0].nombre
                me.telefono = response.data.user[0].telefono
                me.direccion = response.data.user[0].direccion
                me.fecha_nacimiento = response.data.user[0].fecha_nacimiento
                me.edad = response.data.user[0].edad
                me.dpi = response.data.user[0].dpi
                me.id = response.data.user[0].id
            }).catch(function (error) {
                console.log(error)
            })
        },
        update() {
            let me = this
            let url = '/usuarios/password_update'

            axios.put(url, {
                'password_actual': this.password_actual,
                'password_nueva': this.password_nueva,
                'password_confirm': this.password_confirm,
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
        this.showUser()
        this.fecha = moment().format('D MMMM YYYY')
    },
}
</script>
