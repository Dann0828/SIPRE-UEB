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
                            <span class="card-title">{{ __('Información Periferico') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('perifericosyauxiliares.index') }}">{{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-title">
                                    <h4>{{ __('Información Básica del Periferico') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Marca</th>
                                        <td>{{ $perifericosyauxiliare->marca_pa  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Modelo</th>
                                        <td>{{ $perifericosyauxiliare->modelo_pa }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo de Auxiliar</th>
                                        <td>{{ $perifericosyauxiliare->tipoaux->tipo_aux }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Compra</th>
                                        <td>{{$perifericosyauxiliare->fecha_compra }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vencimiento de Garantía </th>
                                        <td>{{ $perifericosyauxiliare->fecha_ven_garantia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor</th>
                                        <td>{{ $perifericosyauxiliare->valor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado</th>
                                        <td>{{ $perifericosyauxiliare->estadocomputador->estado_computador }}</td>
                                    </tr>
                                </table>
                                <div class="section-title">
                                    <h4>{{ __('Localidad') }}</h4>
                                </div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Edificio</th>
                                        <td>{{ $perifericosyauxiliare->localidad->nombreEdificio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dependencia</th>
                                        <td>{{ $perifericosyauxiliare->localidad->nombreDependencia }}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $perifericosyauxiliare->localidad->tipoArea }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
