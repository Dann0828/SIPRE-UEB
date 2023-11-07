@role('admin')
@extends('adminlte::page')

@section('template_title')
    {{ $ordenador->name ?? __('Show Ordenador') }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Información Ordenador') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('ordenador.index') }}">{{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-title">
                                    <h4>{{ __('Información Básica del Computador') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Marca</th>
                                        <td>{{ $ordenador->marca }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo</th>
                                        <td>{{ $ordenador->modelo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Placa</th>
                                        <td>{{ $ordenador->placa_inventario }}</td>
                                    </tr>
                                    <tr>
                                        <th>Serie</th>
                                        <td>{{ $ordenador->serie }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo Computador</th>
                                        <td>{{ $ordenador->tipocomputador->tipo_computador }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo Adquisición</th>
                                        <td>{{ $ordenador->tipoadquisicion->tipo_adquisicion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Compra</th>
                                        <td>{{ $ordenador->fecha_compra }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Vencimiento de Garantía</th>
                                        <td>{{ $ordenador->fecha_vencimiento_garantia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor</th>
                                        <td>${{ number_format($ordenador->valor, 2, ',', '.') }}</td>
                                    </tr>
                                </table>


                                <div class="section-title">
                                    <h4>{{ __('Información de Asignación') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Fecha de Asignación</th>
                                        <td>{{ $ordenador->fecha_asignacion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Edificio</th>
                                        <td>{{ $ordenador->localidad->nombreEdificio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dependencia</th>
                                        <td>{{ $ordenador->localidad->nombreDependencia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $ordenador->localidad->tipoArea }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo de Usuario</th>
                                        <td>{{ $ordenador->rolcomputador->rol }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nombre de Usuario</th>
                                        <td>{{ $ordenador->usuario }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cargo</th>
                                        <td>{{ $ordenador->cargo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Extensión Telefónica</th>
                                        <td>{{ $ordenador->extension }}</td>
                                    </tr>

                                    <tr>
                                        <th>Nombre de Red</th>
                                        <td>{{ $ordenador->nombreRed }}</td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-md-6">
                                <div class="section-title">
                                    <h4>{{ __('Disco Duro') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Espacio Disco Duro</th>
                                        <td>{{ $ordenador->espacio_disco_duro }}</td>
                                    </tr>
                                    <tr>
                                        <th>Descripción Disco Duro</th>
                                        <td>{{ $ordenador->descripcionDiscoDuro }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo Disco Duro</th>
                                        <td>{{ $ordenador->tipodiscoduro->tipoDiscoDuro }}</td>
                                    </tr>
                                </table>

                                <div class="section-title">
                                    <h4>{{ __('Memoria RAM') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Modelo Ram</th>
                                        <td>{{ $ordenador->tiporam->tipoRam }}</td>
                                    </tr>
                                    <tr>
                                        <th>Espacio Ram</th>
                                        <td>{{ $ordenador->espacioRam }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slots Ram</th>
                                        <td>{{ $ordenador->slotsram->slotsRam }}</td>
                                    </tr>
                                    <tr>
                                        <th>Espacio Ram</th>
                                        <td>{{ $ordenador->slotsram->descripcion }}</td>
                                    </tr>
                                </table>
                                <div class="section-title">
                                    <h4>{{ __('Procesador') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Modelo</th>
                                        <td>{{ $ordenador->procesador->referencia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Frecuencia</th>
                                        <td>{{ $ordenador->procesador->frecuencia }}</td>
                                    </tr>
                                </table>
                                <div class="section-title">
                                    <h4>{{ __('Pantalla') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Marca Pantalla</th>
                                        <td>{{ $ordenador->marca_pantalla }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo Pantalla</th>
                                        <td>{{ $ordenador->modelo_pantalla }}</td>
                                    </tr>
                                    <tr>
                                        <th>Serial Pantalla</th>
                                        <td>{{ $ordenador->serial_pantalla }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pulgadas</th>
                                        <td>{{ $ordenador->pulgadas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo Pantalla</th>
                                        <td>{{ $ordenador->tipopantalla->tipoPantalla }}</td>
                                    </tr>
                                </table>
                                <div class="section-title">
                                    <h4>{{ __('Información de Red') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Dirección MAC LAN</th>
                                        <td>{{ $ordenador->direccionMacL}}</td>
                                    </tr>
                                    <tr>
                                        <th>Dirección MAC WIFI</th>
                                        <td>{{ $ordenador->direccionMacW}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="section-title">
                            <h4>{{ __('Información Adicional') }}</h4>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Perifericos Adicionales</th>
                                <td>{{ $ordenador->perifericos_adicionales}}</td>
                            </tr>
                            <tr>
                                <th>Observaciones</th>
                                <td>{{ $ordenador->observaciones}}</td>
                            </tr>
                            <tr>
                                <th>Software Licenciado</th>
                                <td>{{ $ordenador->softwareLicenciado}}</td>
                            </tr>
                            <tr>
                                <th>Software Libre</th>
                                <td>{{ $ordenador->softwareLibre}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
