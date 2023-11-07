@extends('adminlte::page')

@section('template_title')
{{ $mantenimientoordenador->name ?? "{{ __('Ver') Mantenimiento Ordenadores" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mantenimiento Ordenadores') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('mantenimientoordenador.index') }}">{{ __('Atrás') }}</a>
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
                                                <td>{{ $mantenimientoOrdenador->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nombre:</th>
                                                <td>{{ $mantenimientoOrdenador->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Correo:</th>
                                                <td>{{ $mantenimientoOrdenador->user->email }}</td>
                                            </tr>
                                            <!-- Agrega más información de encargado si es necesario -->
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="table-responsive">
                                    <div class="section-title">
                                        <h4>{{ __('Información General') }}</h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Descripción:</th>
                                                <td>{{ $mantenimientoOrdenador->descripcion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fecha:</th>
                                                <td>{{ $mantenimientoOrdenador->fecha }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Mantenimiento:</th>
                                                <td>{{ $mantenimientoOrdenador->tipomantenimiento->descripcion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Cambio:</th>
                                                <td>
                                                    @if ($mantenimientoOrdenador->tipocambio)
                                                        {{ $mantenimientoOrdenador->tipocambio->descripcion }}
                                                    @else
                                                        No definido
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Agrega más información de equipo si es necesario -->
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
                                                <td>{{ $mantenimientoOrdenador->ordenador->serie }}</td>
                                            </tr>
                                            <tr>
                                                <th>Marca:</th>
                                                <td>{{ $mantenimientoOrdenador->ordenador->marca }}</td>
                                            </tr>
                                            <tr>
                                                <th>Modelo:</th>
                                                <td>{{ $mantenimientoOrdenador->ordenador->modelo }}</td>
                                            </tr>
                                            <tr>
                                                <th>Placa Inventario:</th>
                                                <td>{{ $mantenimientoOrdenador->ordenador->placa_inventario }}</td>
                                            </tr>
                                            <!-- Agrega más información de ordenador si es necesario -->
                                        </tbody>
                                    </table>
                                    <div class="section-title">
                                        <h4>{{ __('Salon Asignado') }}</h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Edificio:</th>
                                                <td>{{ $salon ? $salon->edificio->descripcion ?? "No definido" : "No definido" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Salón:</th>
                                                <td>{{ $salon ? $salon->descripcion ?? "No definido" : "No definido" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Aula:</th>
                                                <td>{{ $salon ? $salon->tipoaula->descripcion ?? "No definido" : "No definido" }}</td>
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
