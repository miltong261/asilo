<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area">
                    <img class="rounded-circle mx-auto d-block" src="assets/img/logo-tablas.jpeg" alt="logo" width="90" height="90">
                    <div v-for="saldo in caja" :key="saldo.id" class="text-center">
                        <span>Saldo en caja: <strong class="text-secondary">Q {{ saldo.saldo }}</strong></span>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <h5><strong class="text-secondary">DASHBOARD DE MOVIMIENTOS</strong></h5>
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
                                            <p>Movimientos de los últimos días.</p>
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
                                            <p>Movimientos de los últimos días.</p>
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

var Chart = require('chart.js');

export default {
    data() {
        return {
            caja: 0,
            salidas: [],
            salidas_monto: [],
            salidas_dias: [],

            entradas: [],
            entradas_monto: [],
            entradas_dias: [],
        }
    },
    methods: {
        cajaSaldo() {
            let me = this
            let url = '/dashboard'

            axios.get(url).then(function (response) {
                me.caja = response.data.caja
            })
        },
        showSalidas() {
            let me = this
            let url = '/dashboard'

            axios.get(url).then(function (response) {
                me.salidas = response.data.salidas
                console.log(response.data)

                for(var i = 0; i < me.salidas.length; i++) {
                    me.salidas_dias.push(me.salidas[i].dias)
                    me.salidas_monto.push(me.salidas[i].monto)
                }


                new Chart(document.getElementById('canvas').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: me.salidas_dias,
                        datasets: [{
                            label: 'Quetzales Q.',
                            data: me.salidas_monto,
                            lineTension: 0,
                            fill: false,
                            borderColor: 'red',
                            backgroundColor: 'transparent',
                            borderDash: [5, 5],
                            pointBorderColor: 'red',
                            pointBackgroundColor: 'rgba(255,150,0,0.5)',
                            pointRadius: 5,
                            pointHoverRadius: 10,
                            pointHitRadius: 30,
                            pointBorderWidth: 2,
                            pointStyle: 'rectRounded'
                        }]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                            boxWidth: 80,
                            fontColor: 'black'
                            }
                        }
                    }
                })
            })
        },
        showEntradas() {
            let me = this
            let url = '/dashboard'

            axios.get(url).then(function (response) {
                me.entradas = response.data.entradas

                for(var i = 0; i < me.entradas.length; i++) {
                    me.entradas_dias.push(me.entradas[i].dias)
                    me.entradas_monto.push(me.entradas[i].monto)
                }

                new Chart(document.getElementById('canvas1').getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: me.entradas_dias,
                        datasets: [{
                            label: 'Quetzales Q.',
                            data: me.entradas_monto,
                            lineTension: 0,
                            fill: false,
                            borderColor: 'green',
                            backgroundColor: 'transparent',
                            borderDash: [5, 5],
                            pointBorderColor: 'green',
                            pointBackgroundColor: 'rgba(255,150,0,0.5)',
                            pointRadius: 5,
                            pointHoverRadius: 10,
                            pointHitRadius: 30,
                            pointBorderWidth: 2,
                            pointStyle: 'rectRounded'
                        }]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                            boxWidth: 80,
                            fontColor: 'black'
                            }
                        }
                    }
                })
            })
        }
    },
    mounted() {
        this.cajaSaldo()
        this.showSalidas()
        this.showEntradas()
    },
}
</script>
