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
                        <h1> Préstamos de Ordenadores</h1>
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
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-6" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-7" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-9" class="highchart-container"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div id="dashboard-col-10" class="highchart-container"></div>
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
    var estado = <?php echo json_encode($data); ?>;
    var user = <?php echo json_encode($data1); ?>;
    var tipo = <?php echo json_encode($data2); ?>;
    var edificio = <?php echo json_encode($data3); ?>;
    var facultad = <?php echo json_encode($data4); ?>;
    var programa = <?php echo json_encode($data5); ?>;
    var rol = <?php echo json_encode($data6); ?>;
    var fecha = <?php echo json_encode($data7); ?>;
    var dependencia = <?php echo json_encode($data8); ?>;
    var area = <?php echo json_encode($data9); ?>;

    // Gráfica estado
       Highcharts.chart('dashboard-col-0', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Préstamos por Estado',
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
            name: 'Préstamos',
            data: estado // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });
    //Prestamo por User
     Highcharts.chart('dashboard-col-1', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Préstamos por Encargado'
        },
        xAxis: {
            categories: user.map(item => item.name),
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
            name: 'Préstamos',
            data: user.map(item => item.y)
        }]
    });
    //Prestamos por tipo de Dispositivo
     Highcharts.chart('dashboard-col-2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Préstamos por Tipo de Ordenador'
        },
        xAxis: {
            categories: tipo.map(item => item.name),
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
            name: 'Préstamos',
            data: tipo.map(item => item.y)
        }]
    });
    //Prestamos por Edificio
    Highcharts.chart('dashboard-col-3', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Edificios con más Préstamos'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: edificio.map(item => item.name),
        crosshair: true
    },
    yAxis: {
        min: 0,
        gridLineWidth: 0,
        title: {
            text: ''
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
        name: 'Préstamos',
        data: edificio.map(item => item.y)
    }]
});

//Prestamos por facultad
Highcharts.chart('dashboard-col-4', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Préstamos por Facultad'
        },
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
            name: 'Préstamos',
            data: facultad.map(item => item.y)
        }]
    });
    //Prestamos por Programa
    Highcharts.chart('dashboard-col-5', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Préstamos por Programa'
        },
        xAxis: {
            categories: programa.map(item => item.name),
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
            name: 'Préstamos',
            data: programa.map(item => item.y)
        }]
    });
    //Prestamo por roles
     Highcharts.chart('dashboard-col-6', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Préstamos por Rol',
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
            name: 'Préstamos',
            data: rol // No necesitas usar 'map' aquí, asumiendo que 'estado' tiene el formato correcto
        }]
    });

    //Prestamos por dependencia 
     Highcharts.chart('dashboard-col-9', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Dependencias con más Préstamos'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: dependencia.map(item => item.name),
        crosshair: true
    },
    yAxis: {
        min: 0,
        gridLineWidth: 0,
        title: {
            text: ''
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
        name: 'Préstamos',
        data: dependencia.map(item => item.y)
    }]
});
//Prestamos por Tipo de Area
     Highcharts.chart('dashboard-col-10', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Áreas con más Préstamos'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: area.map(item => item.name),
        crosshair: true
    },
    yAxis: {
        min: 0,
        gridLineWidth: 0,
        title: {
            text: ''
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
        name: 'Préstamos',
        data: area.map(item => item.y)
    }]
});

    //Prestamo por Fecha
    const nombresMeses = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];
Highcharts.chart('dashboard-col-7', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Préstamos por Mes'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: fecha.map(item => nombresMeses[item.name - 1]),
        crosshair: true
    },
    yAxis: {
        min: 0,
        gridLineWidth: 0,
        title: {
            text: 'Préstamos'
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
        name: 'Préstamos',
        data: fecha.map(item => item.y)
    }]
});
//Totales
Highcharts.chart('dashboard-col-8', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Totales'
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
        name: 'Totales',
        data: [<?= $prestamosOrdTotales ?>, <?= $prestamosPerTotales ?>]
    }]
});

</script>
@endsection
