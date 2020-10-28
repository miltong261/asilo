<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
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
                            <h5><strong class="text-secondary">DASHBOARD DE COMPRAS</strong></h5>
                        </div>
                        <div class="car-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">ARTÍCULOS</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="canvas">
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Compra de artículos en los últimos meses.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-chart">
                                        <div class="card-header">
                                            <h4 class="text-center">MEDICAMENTOS</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="ct-chart">
                                                <canvas id="canvas1">
                                                </canvas>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p>Compra de medicamentos en los últimos meses.</p>
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
var Chart = require('chart.js');

export default {
    data() {
        return {
            fecha: moment().format('D MMMM YYYY'),
            compras_articulo: [],
            articulos_cantidad: [],
            articulos_meses: [],

            compras_medicamento: [],
            medicamento_cantidad: [],
            medicamento_meses: [],
            medicamento_chart: []
        }
    },
    methods: {
        showArticulos() {
            let me = this
            let url = '/dashboard/dashboard_compras'

            axios.get(url).then(function (response) {
                me.compras_articulo = response.data.compras_articulo

                for(var i = 0; i < me.compras_articulo.length; i++) {
                    me.articulos_meses.push(me.compras_articulo[i].mes)
                    me.articulos_cantidad.push(me.compras_articulo[i].cantidad)
                }

                new Chart(document.getElementById('canvas').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: me.articulos_meses,
                        datasets: [{
                            label: 'Cantidad de artículos',
                            data: me.articulos_cantidad,
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
        showMedicamentos() {
            let me = this
            let url = '/dashboard/dashboard_compras'

            axios.get(url).then(function (response) {
                me.compras_medicamento = response.data.compras_medicamento

                for(var i = 0; i < me.compras_medicamento.length; i++) {
                    me.medicamento_meses.push(me.compras_medicamento[i].mes)
                    me.medicamento_cantidad.push(me.compras_medicamento[i].cantidad)
                }

                new Chart(document.getElementById('canvas1').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: me.medicamento_meses,
                        datasets: [{
                            label: 'Cantidad de medicamentos',
                            data: me.medicamento_cantidad,
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
        this.showArticulos()
        this.showMedicamentos()
    },
}
</script>
