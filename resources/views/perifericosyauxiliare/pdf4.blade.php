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
        @foreach ($equipo as $perifericosyauxiliare1)
        <h1>Hoja de Vida de {{ $perifericosyauxiliare1->id }}</h1>
        @endforeach
    </div>
    <body>
        <div class="section">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th colspan="8" class="primera">Periferico</th>
                </tr>
                <thead class="thead">
                    <tr>
                        <th>No</th>

                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo de Auxiliar</th>
                        <th>Fecha de Compra</th>
                        <th>Vencimiento de Garantía </th>
                        <th>Valor</th>
                        <th>Estado</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipo as $perifericosyauxiliare1)
                        <tr>
                            <td>{{ $perifericosyauxiliare1->id }}</td>
                            <td>{{ $perifericosyauxiliare1->marca_pa }}</td>
                            <td>{{ $perifericosyauxiliare1->modelo_pa }}</td>
                            <td>{{ $perifericosyauxiliare1->tipoaux->tipo_aux }}</td>
                            <td>{{ $perifericosyauxiliare1->fecha_compra }}</td>
                            <td>{{ $perifericosyauxiliare1->fecha_ven_garantia }}</td>
                            <td>{{ $perifericosyauxiliare1->valor }}</td>
                            <td>{{ $perifericosyauxiliare1->estadoComputador->estado_computador }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    <div class="section">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr>
                    <th colspan="5" class="primera">Mantenimientos</th>
                </tr>
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Encargado</th>
                        <th>Tipo de Mantenimiento</th>
                        <th>Descripción</th>
                        <th>Fecha</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimiento as $mantenimiento1)
                        <tr>
                            <td>{{ $mantenimiento1->id }}</td>
                            <td>{{ $mantenimiento1->user->name }}</td>
                            <td>{{ $mantenimiento1->tipomantenimiento->descripcion}}</td>
                            <td>{{ $mantenimiento1->descripcion }}</td>
                            <td>{{ $mantenimiento1->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

