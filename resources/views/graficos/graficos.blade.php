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
                        <h1> Estadísticas de Ordenadores </h1>
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
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-4" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-5" class="highchart-container"></div>
                        </div>
                   
                     </div>
                       <div id="dashboard-col-8" class="highchart-container"></div>
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
    var asignacion = <?php echo json_encode($data1); ?>;
    var estado = <?php echo json_encode($data2); ?>;
    var ram = <?php echo json_encode($data3); ?>;
    var disco = <?php echo json_encode($data4); ?>;
    var sistema = <?php echo json_encode($data5); ?>;
    var ordenadores = <?php echo $cantidadOrdenadores; ?>;


    
    // Gráfica tipos
    Highcharts.chart('dashboard-col-0', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Ordenadores por Tipo'
        },
        // Configuración de la gráfica 0
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
            name: 'Ordenadores',
            data: tipos.map(item => item.y)
        }]
    });

        // Gráfica tipos
    Highcharts.chart('dashboard-col-1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ordenadores por Localidad Asignada'
        },
        // Configuración de la gráfica 0
        xAxis: {
            categories: asignacion.map(item => item.name),
            title: {
                text: null
            }
        },
        yAxis: {
            gridLineWidth: 0,
        },
        plotOptions: {
            column: {
                color: '#81bb26' // Cambia el color de las columnas a verde
            }
        },
        series: [{
            name: 'Ordenadores',
            data: asignacion.map(item => item.y)
        }]
    });
    //Graficas estado
    
    Highcharts.chart('dashboard-col-2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ordenadores por Estado',
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
            name: 'Ordenadores',
            data: estado // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });

    //Graficas Ram
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
        text: 'Ordenadores por Tipo de Ram',
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
        categories: ram.map(item => item.name),
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
        name: 'Ordenadores',
        data: ram.map(item => item.y)
    }]
});

    //Graficas Disco Duro
Highcharts.chart('dashboard-col-5', {
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
        text: 'Ordenadores por Tipo de Disco Duro',
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
        categories: disco.map(item => item.name),
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
        name: 'Ordenadores',
        data: disco.map(item => item.y)
    }]
});


//Ordenadores Sistemas
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
        text: 'Ordenadores por Sistema Operativo',
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
        name: 'Ordenadores',
        data: sistema
    }]
});

//totales
Highcharts.chart('dashboard-col-8', {
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
