@extends('adminlte::page')

@section('template_title')
    Graficos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h1> Estadísticas de Personas </h1>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>

var rol = <?php echo json_encode($data); ?>;
var programa = <?php echo json_encode($data1); ?>;
var facultad = <?php echo json_encode($data2); ?>;

Highcharts.chart('dashboard-col-0', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Personas por Rol'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: rol.map(item => item.name),
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Personas',
        data: rol.map(item => item.y)
    }]
});

//Programas
Highcharts.chart('dashboard-col-1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Personas por Programa',
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
            name: 'Personas',
            data: programa // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });

//Por Facultad
Highcharts.chart('dashboard-col-2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Personas por Facultad'
        },
        // Configuración de la gráfica 0
        xAxis: {
            categories: facultad.map(item => item.name),
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
            name: 'Personas',
            data: facultad.map(item => item.y)
        }]
    });
</script>
@endsection