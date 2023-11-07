@role('admin')
@extends('adminlte::page')

@section('template_title')
    Aula
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Aula') }}
                            </span>
                                                        <form method="GET" role="form" id="searchForm">
                                <div class="mb-3 input-group">
                                    <select id="opcionBusqueda" name="opcionBusqueda" class="form-control" style="background-color: #81bb26;">
                                        <option value="{{ route('salon.buscarPorId') }}">Buscar por Aula</option>
                                        <option value="{{ route('salon.buscarPorEdificio') }}">Buscar por Edificio</option>
                                        <option value="{{ route('salon.buscarPorTipoAula') }}">Buscar por Tipo de Aula</option>
                                    </select>
                                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>

                            <script>
                                document.getElementById('opcionBusqueda').addEventListener('change', function () {
                                    var selectedOption = this.value;
                                    var busquedaInput = document.querySelector('input[name="busqueda"]');
                                });

                                document.getElementById('searchForm').addEventListener('submit', function (event) {
                                    var selectedOption = document.getElementById('opcionBusqueda').value;
                                    this.action = selectedOption;
                                });
                            </script>
                             <div class="float-right">
                                <a href="{{ route('salon.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="background-color: #81bb26;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                            <div class="alert alert-success" style="background-color: #fc0000;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                        <div class="table-responsive">
                        <div class="d-flex justify-content-between mb-3">
                        <form method="POST" action="{{ route('importarAulas.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group">
                                <input type="file" name="import_file_aulas" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success" type="submit" style="background-color: #81bb26;">
                                        <i class="bi bi-cloud-upload"></i> Importar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Descripción</th>
										<th>Edificio</th>
										<th>Tipo de Aula</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salons as $salon)
                                        <tr>
                                            <td>{{ $salon->id }}</td>

											<td>{{ $salon->descripcion }}</td>
											<td>{{ $salon->edificio->descripcion }}</td>
											<td>{{ $salon->tipoaula->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('salon.destroy',$salon->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('salon.show',$salon->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('salon.edit',$salon->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $salons->links('pagination') !!}
            </div>
        </div>
    </div>
@endsection
@endrole
