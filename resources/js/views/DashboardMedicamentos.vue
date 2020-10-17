<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">

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
                                            <p>Salidas de medicamentos en los últimos meses.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">DONACIONES</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="canvas1">
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Donaciones de medicamentos en los últimos meses.</p>
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
 var moment = require('moment');
 require("moment/min/locales.min");
moment.locale('es');
var Chart = require('chart.js');

export default {

    data() {
        return {
            salidas: [],
            salidas_cantidad: [],
            salidas_meses: [],

            donaciones: [],
            donaciones_cantidad: [],
            donaciones_meses: [],
        }
    },
    methods: {
        showSalidas() {
            let me = this
            let url = '/dashboard/dashboard_medicamentos'

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
                            label: 'Cantidad de medicamentos',
                            data: me.salidas_cantidad,
                            backgroundColor: '#e7515a',
                            borderWidth: '10'
                        }]
                    },
                    options: {
                        scales: {

                            xAxes: [{ barPercentage: 0.4 }],
                            yAxes : [{ ticks : { beginAtZero : true } }]
                        },
                        scaleBeginAtZero: true
                    }
                })
            })
        },
        showDonaciones() {
            let me = this
            let url = '/dashboard/dashboard_medicamentos'

            axios.get(url).then(function (response) {
                me.donaciones = response.data.donaciones

                for(var i = 0; i < me.donaciones.length; i++) {
                    me.donaciones_meses.push(me.donaciones[i].mes)
                    me.donaciones_cantidad.push(me.donaciones[i].cantidad)
                }

                new Chart(document.getElementById('canvas1').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: me.donaciones_meses,
                        datasets: [{
                            label: 'Cantidad de medicamentos',
                            data: me.donaciones_cantidad,
                            backgroundColor: '#bae7ff',
                            borderWidth: '10'
                        }]
                    },
                    options: {
                        scales: {
                            yAxes : [{ ticks : { beginAtZero : true } }],
                            xAxes: [{ barPercentage: 0.4 }]
                        },
                        scaleBeginAtZero: true
                    }
                })
            })
        }
    },
    mounted() {
        this.showSalidas()
        this.showDonaciones()
    },
}
</script>
