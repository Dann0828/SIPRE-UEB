@extends('adminlte::page')

@section('template_title')
    Graficos
@endsection

@section('content')
<style>


    /* Tu estilo CSS aquí */
    .highchart-container {
        border: 1px solid black; /* Borde negro */
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1); /* Sombra */
    }

    #container {
    height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    h1#title {
        padding-top: 10px;
        margin: 0;
        background-color: #3d3d3d;
        text-align: center;
        color: white;
    }


</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h1> Estadísticas de Periféricos y Auxiliares </h1>
                        <br>
                        <div class="row">
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-0" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-1" class="highchart-container"></div>
                        </div>
                     </div>
                     <div id="dashboard-col-2" class="highchart-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    // Datos
    var tipos = <?php echo json_encode($data); ?>;
    var estado = <?php echo json_encode($data1); ?>;
    // Gráfica tipos
    Highcharts.chart('dashboard-col-0', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Periféricos y Auxiliares por Tipo'
        },
        xAxis: {
            categories: tipos.map(item => item.name),
            title: {
                text: null
            }
        },
        yAxis: {
            gridLineWidth: 0,
        },
        plotOptions: {
            bar: {
                color: '#81bb26' // Color de las barras
            }
        },
        series: [{
            name: 'Periféricos y Auxiliares',
            data: tipos.map(item => item.y)
        }]
    });

    Highcharts.chart('dashboard-col-1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Periféricos y Auxiliares por Estado',
            align: 'left'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Periféricos y Auxiliares',
            data: estado // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });
//
Highcharts.chart('dashboard-col-2', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Cantidades Totales'
    },
    xAxis: {
        categories: ['Ordenadores', 'Periféricos y Auxiliares'],
        title: {
            text: null
        }
    },
    yAxis: {
        gridLineWidth: 0,
    },
    plotOptions: {
        bar: {
            color: '#81bb26' // Color de las barras
        }
    },
    series: [{
        name: 'Total',
        data: [<?= $cantidadOrdenadores ?>, <?= $cantidadPerifericos ?>]
    }]
});


     


</script>

@endsection
