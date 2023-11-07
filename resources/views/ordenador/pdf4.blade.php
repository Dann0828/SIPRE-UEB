<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoja de Vida</title>
    <img src='vendor/adminlte/dist/img/logo_ubosque.png' class="titulo-imagen">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #81bb26;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .section {
            margin: 10px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #81bb26;
            color: #fff;
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .titulo-imagen {
            position: absolute;
            top: 10px;
            left: 20px;
            width: 100px;
            height: auto;
        }

        .titulo {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .titulo h1 {
            font-size: 24px;
            color: #333;
        }
        .primera {
        color: #404827;
        }
    </style>
</head>
<body>
    <div class="titulo">
        @foreach ($ordenador as $ordenador1)
        <h1>Hoja de Vida de {{ $ordenador1->placa_inventario }}</h1>
        @endforeach
    </div>
    <div class="section">
        <table colspan="2" class="table table-bordered">
            @foreach ($ordenador as $ordenador1)
                <tr>
                    <th colspan="2" class="primera">Información Básica del Computador</th>
                </tr>
                <tr>
                    <th>Marca</th>
                    <td>{{ $ordenador1->marca }}</td>
                </tr>
                <tr>
                    <th>Modelo</th>
                    <td>{{ $ordenador1->modelo }}</td>
                </tr>
                <tr>
                    <th>Placa</th>
                    <td>{{ $ordenador1->placa_inventario }}</td>
                </tr>
                <tr>
                    <th>Serie</th>
                    <td>{{ $ordenador1->serie }}</td>
                </tr>
                <tr>
                    <th>Tipo Computador</th>
                    <td>{{ $ordenador1->tipocomputador->tipo_computador }}</td>
                </tr>
                <tr>
                    <th>Tipo Adquisición</th>
                    <td>{{ $ordenador1->tipoadquisicion->tipo_adquisicion }}</td>
                </tr>
                <tr>
                    <th>Fecha de Compra</th>
                    <td>{{ $ordenador1->fecha_compra }}</td>
                </tr>
                <tr>
                    <th>Fecha de Vencimiento de Garantía</th>
                    <td>{{ $ordenador1->fecha_vencimiento_garantia }}</td>
                </tr>
                <tr>
                    <th>Valor</th>
                    <td>${{ number_format($ordenador1->valor, 2, ',', '.') }}</td>
                </tr>
                <tr>
                <th>Software Licenciado</th>
                <td>{{ $ordenador1->softwareLicenciado}}</td>
            </tr>
            <tr>
                <th>Software Libre</th>
                <td>{{ $ordenador1->softwareLibre}}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Pantalla</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
                <tr>
                    <th>Marca Pantalla</th>
                    <td>{{ $ordenador1->marca_pantalla }}</td>
                </tr>
                <tr>
                    <th>Modelo Pantalla</th>
                    <td>{{ $ordenador1->modelo_pantalla }}</td>
                </tr>
                <tr>
                    <th>Serial Pantalla</th>
                    <td>{{ $ordenador1->serial_pantalla }}</td>
                </tr>
                <tr>
                    <th>Pulgadas</th>
                    <td>{{ $ordenador1->pulgadas }}</td>
                </tr>
                <tr>
                    <th>Tipo Pantalla</th>
                    <td>{{ $ordenador1->tipopantalla->tipoPantalla }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Disco Duro</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
            <tr>
                <th>Espacio Disco Duro</th>
                <td>{{ $ordenador1->espacio_disco_duro }}</td>
            </tr>
            <tr>
                <th>Descripción Disco Duro</th>
                <td>{{ $ordenador1->descripcionDiscoDuro }}</td>
            </tr>
            <tr>
                <th>Tipo Disco Duro</th>
                <td>{{ $ordenador1->tipodiscoduro->tipoDiscoDuro }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Memoria RAM</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
            <tr>
                <th>Modelo Ram</th>
                <td>{{ $ordenador1->tiporam->tipoRam }}</td>
            </tr>
            <tr>
                <th>Espacio Ram</th>
                <td>{{ $ordenador1->espacioRam }}</td>
            </tr>
            <tr>
                <th>Slots Ram</th>
                <td>{{ $ordenador1->slotsram->slotsRam }}</td>
            </tr>
            <tr>
                <th>Espacio Ram</th>
                <td>{{ $ordenador1->slotsram->descripcion }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Procesador</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
            <tr>
                <th>Modelo</th>
                <td>{{ $ordenador1->procesador->referencia }}</td>
            </tr>
            <tr>
                <th>Frecuencia</th>
                <td>{{ $ordenador1->procesador->frecuencia }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Ubicación</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
                <tr>
                    <th>Fecha de Asignación</th>
                    <td>{{ $ordenador1->fecha_asignacion }}</td>
                </tr>
                <tr>
                    <th>Edificio</th>
                    <td>{{ $ordenador1->localidad->nombreEdificio }}</td>
                </tr>
                <tr>
                    <th>Dependencia</th>
                    <td>{{ $ordenador1->localidad->nombreDependencia }}</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>{{ $ordenador1->localidad->tipoArea }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="2" class="primera">Roles</th>
            </tr>
            @foreach ($ordenador as $ordenador1)
                <tr>
                    <th>Rol</th>
                    <td>{{ $ordenador1->rolcomputador->rol }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="section">
        <table class="table table-bordered">
            <tr>
                <th colspan="6" class="primera">Préstamos</th>
            </tr>
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Encargado</th>
                    <th>Persona</th>
                    <th>Fecha Hora Prestamo</th>
                    <th>Fecha Hora Entrega</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamo as $prestamo1)
                    <tr>
                        <td>{{$prestamo1->id}}</td>
                        <td>{{ $prestamo1->user->name}}</td>
                        <td>{{ $prestamo1->persona->nombre}}</td>
                        <td>{{ $prestamo1->fecha_hora_prestamo }}</td>
                        <td>{{ $prestamo1->fecha_hora_entrega }}</td>
                        <td>{{ $prestamo1->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th colspan="6" class="primera">Mantenimientos</th>
                </tr>
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Encargado</th>
                        <th>Tipo de Mantenimiento</th>
                        <th>Cambio</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimiento as $mantenimiento1)
                        <tr>
                            <tr>
                                <td>{{ $mantenimiento1->id }}</td>
                                <td>{{ $mantenimiento1->user->name }}</td>
                                <td>{{ $mantenimiento1->tipomantenimiento->descripcion}}</td>
                                <td>{{ $mantenimiento1->tipocambio->descripcion}}</td>
                                <td>{{ $mantenimiento1->descripcion }}</td>
                                <td>{{ $mantenimiento1->fecha }}</td>
                            </tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

