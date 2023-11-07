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
                        <h1> Estadísticas de Mantenimientos para Ordenadores</h1>
                        <br>
                        <div class="row">
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-0" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-1" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-2" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-3" class="highchart-container"></div>
                        </div>
                     </div>
                     <div id="dashboard-col-2" class="highchart-container"></div>
                </div>
                <div id="dashboard-col-4" class="highchart-container"></div>
                <br>
                <div id="dashboard-col-5" class="highchart-container"></div>
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
    var encargados = <?php echo json_encode($data); ?>;
    var tipos = <?php echo json_encode($data1); ?>;
    var cambios = <?php echo json_encode($data2); ?>;
    var mes = <?php echo json_encode($data3); ?>;
    var tiposo = <?php echo json_encode($data4); ?>;
    // Gráfica tipos
    Highcharts.chart('dashboard-col-0', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Mantenimientos por Encargado'
        },
        xAxis: {
            categories: encargados.map(item => item.name),
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
            name: 'Mantenimientos',
            data: encargados.map(item => item.y)
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
            text: 'Mantenimientos por Tipo',
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
            name: 'Mantenimientos',
            data: tipos // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });
//
const nombresMeses = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];
Highcharts.chart('dashboard-col-2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mantenimientos por Mes'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: mes.map(item => nombresMeses[item.name - 1]),
        crosshair: true
    },
    yAxis: {
        min: 0,
        gridLineWidth: 0,
        title: {
            text: 'Cantidad de Mantenimientos'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            color: '#81bb26' // Cambia el color de las columnas a verde
        },
    },
    series: [{
        name: 'Mantenimientos',
        data: mes.map(item => item.y)
    }]
});

Highcharts.chart('dashboard-col-3', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Mantenimientos por Tipo de Cambio',
        align: 'left'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Mantenimientos',
        data: cambios
    }]
    });
Highcharts.chart('dashboard-col-4', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Mantenimientos por Tipo de Ordenador',
        align: 'left'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    plotOptions: {
        column: {
            depth: 25,
            color: '#81bb26' // Cambia el color de las columnas a verde
        }
    },
    xAxis: {
        categories: tiposo.map(item => item.name),
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: '',
            margin: 20
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    series: [{
        name: 'Mantenimientos',
        data: tiposo.map(item => item.y)
    }]
});

Highcharts.chart('dashboard-col-5', {
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
        data: [<?= $mantenimientoOrdenador ?>, <?= $mantenimientoperiferico ?>]
    }]
});
</script>

@endsection
