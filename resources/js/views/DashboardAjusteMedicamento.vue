<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <div class="form-group float-left">
                            <img class="rounded-circle mx-auto d-block" src="/assets/img/logo-tablas.jpeg" alt="logo" width="100" height="100">
                        </div>

                        <div class="form-group text-center">
                            <h6><strong>ASILO DE ANCIANOS RETALHULEU</strong></h6>
                            <h6>Residenciales Ciudad Palmeras</h6>
                            <h6>Cantón Recuerdo Ocosito, Retalhuleu</h6>
                            <h5 class="text-secondary"><strong>BODEGA DE INSUMOS</strong></h5>
                        </div>

                        <div class="form-group float-right">
                            <h5 class="p-5">Fecha: <strong class="text-secondary ">{{ fecha }}</strong></h5>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <h5><strong class="text-secondary">DASHBOARD DE MEDICAMENTOS</strong></h5>
                        </div>
                        <div class="car-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">SALIDAS</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="canvas">
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Ajuste de medicamentos en los últimos meses.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">ENTRADAS</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="canvas1">
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Ajuste de medicamentos en los últimos meses.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
var moment = require('moment')
moment.locale('es');
var Chart = require('chart.js')

export default {
    data() {
        return {
            fecha: moment().format('D MMMM YYYY'),
            salidas: [],
            salidas_cantidad: [],
            salidas_meses: [],

            entradas: [],
            entradas_cantidad: [],
            entradas_meses: [],
        }
    },
    methods: {
        showSalidas() {
            let me = this
            let url = '/dashboard/ajuste_medicamento'

            axios.get(url).then(function (response) {
                me.salidas = response.data.salidas

                for(var i = 0; i < me.salidas.length; i++) {
                    me.salidas_meses.push(me.salidas[i].mes)
                    me.salidas_cantidad.push(me.salidas[i].cantidad)
                }

                new Chart(document.getElementById('canvas').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: me.salidas_meses,
                        datasets: [{
                            label: 'Cantidad de artículos',
                            data: me.salidas_cantidad,
                            backgroundColor: '#e7515a',
                            borderWidth: '10'
                        }]
                    },
                    options: {
                        scales: {
                              yAxes : [{ ticks : { beginAtZero : true } }],
                            xAxes: [{ barPercentage: 0.4 }]
                        },
                        scaleBeginAtZero: false
                    }
                })
            })
        },
        showEntradas() {
            let me = this
            let url = '/dashboard/ajuste_medicamento'

            axios.get(url).then(function (response) {
                me.entradas = response.data.entradas

                for(var i = 0; i < me.entradas.length; i++) {
                    me.entradas_meses.push(me.entradas[i].mes)
                    me.entradas_cantidad.push(me.entradas[i].cantidad)
                }

                new Chart(document.getElementById('canvas1').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: me.entradas_meses,
                        datasets: [{
                            label: 'Cantidad de medicamentos',
                            data: me.entradas_cantidad,
                            backgroundColor: '#bae7ff',
                            borderWidth: '10'
                        }]
                    },
                    options: {
                        scales: {
                            yAxes : [{ ticks : { beginAtZero : true } }],
                            xAxes: [{ barPercentage: 0.4 }]
                        },
                        scaleBeginAtZero: false
                    }
                })
            })
        }
    },
    mounted() {
        this.showSalidas()
        this.showEntradas()
    },
}
</script>
