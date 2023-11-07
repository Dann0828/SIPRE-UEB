@extends('adminlte::page')

@section('template_title')
    {{ $prestamo->name ?? __('Información Préstamo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Información Préstamo') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('prestamop.index') }}"> {{ __('Atrás') }}</a>
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
                                                <td>{{ $prestamop->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nombre:</th>
                                                <td>{{ $prestamop->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Correo:</th>
                                                <td>{{ $prestamop->user->email }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <div class="section-title">
                                        <h4>{{ __('Persona') }}</h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Cédula:</th>
                                                <td>{{ $prestamop->persona->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nombre:</th>
                                                <td>{{ $prestamop->persona->nombre }}</td>
                                            </tr>
                                            <tr>
                                                <th>Correo:</th>
                                                <td>{{ $prestamop->persona->correo }}</td>
                                            </tr>
                                            <tr>
                                                <th>Celular:</th>
                                                <td>{{ $prestamop->persona->celular }}</td>
                                            </tr>
                                            <tr>
                                                <th>Programa:</th>
                                                <td>
                                                @foreach ($programas as $programa)
                                                    {{ $programa }}
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Depenencia:</th>
                                                <td>
                                                @foreach ($dependencias as $dependencia)
                                                    {{ $dependencia }}
                                                @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <div class="section-title">
                                            <h4>{{ __('Ordenador') }}</h4>
                                        </div>
                                        <tbody>
                                            <tr>
                                                <th>Equipo:</th>
                                                <td>{{ $prestamop->perifericosyauxiliare->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Marca:</th>
                                                <td>{{ $prestamop->perifericosyauxiliare->marca_pa }}</td>
                                            </tr>
                                            <tr>
                                                <th>Modelo:</th>
                                                <td>{{ $prestamop->perifericosyauxiliare->modelo_pa }}</td>
                                            </tr>
                                            <tr>
                                                <th>Serie:</th>
                                                <td>{{ $prestamop->perifericosyauxiliare->tipoaux->tipo_aux }}</td>
                                            </tr>
                                            <!-- Agrega más información de equipo si es necesario -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <div class="section-title">
                                            <h4>{{ __('Información del prestamo') }}</h4>
                                        </div>
                                        <tbody>
                                            <tr>
                                                <th>Fecha Hora Prestamo:</th>
                                                <td>{{ $prestamop->fecha_hora_prestamo }}</td>
                                            </tr>
                                            <tr>
                                                <th>Fecha Hora Entrega:</th>
                                                <td>{{ $prestamop->fecha_hora_entrega }}</td>
                                            </tr>
                                            <tr>
                                                <th>Estado:</th>
                                                <td>{{ $prestamop->estado }}</td>
                                            </tr>
                                            <tr>
                                                <th>Observaciones:</th>
                                                <td>{{ $prestamop->observaciones }}</td>
                                            </tr>
                                            <tr>
                                                <th>Edificio:</th>
                                                <td>{{ $edificio ? $edificio->descripcion : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Aula:</th>
                                                <td>{{ $prestamop->salon ? $prestamop->salon->descripcion : '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tipo de Aula:</th>
                                                <td>{{ $tipoaula ? $tipoaula->descripcion : '' }}</td>
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

