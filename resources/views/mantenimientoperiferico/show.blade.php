@extends('adminlte::page')

@section('template_title')
    {{ $prestamo->name ?? __('Información Mantenimiento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Información Mantenimiento') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('mantenimientoperiferico.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <div class="section-title">
                                        <h4>{{ __('Encargado') }}</h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Cédula:</th>
                                                <td>{{$mantenimientoperiferico->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nombre:</th>
                                                <td>{{ $mantenimientoperiferico->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Correo:</th>
                                                <td>{{ $mantenimientoperiferico->user->email }}</td>
                                            </tr>
                                            <!-- Agrega más información de encargado si es necesario -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <div class="section-title">
                                        <h4>{{ __('Ordenador') }}</h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Serie:</th>
                                                <td>{{ $mantenimientoperiferico->perifericosyauxiliare->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Marca:</th>
                                                <td>{{ $mantenimientoperiferico->perifericosyauxiliare->marca_pa  }}</td>
                                            </tr>
                                            <tr>
                                                <th>Modelo:</th>
                                                <td>{{ $mantenimientoperiferico->perifericosyauxiliare->modelo_pa  }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo Auxiliar:</th>
                                                <td>{{ $mantenimientoperiferico->perifericosyauxiliare->tipoaux->tipo_aux  }}</td>
                                            </tr>
                                            <!-- Agrega más información de persona si es necesario -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <div class="section-title">
                                            <h4>{{ __('Información General') }}</h4>
                                        </div>
                                        <tbody>
                                            <tr>
                                                <th>Descripción:</th>
                                                <td>{{ $mantenimientoperiferico->descripcion  }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fecha:</th>
                                                <td>{{ $mantenimientoperiferico->fecha }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Mantenimiento:</th>
                                                <td>{{ $mantenimientoperiferico->tipomantenimiento->descripcion }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

