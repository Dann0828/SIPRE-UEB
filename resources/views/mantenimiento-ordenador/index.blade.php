@extends('adminlte::page')

@section('template_title')
    Mantenimiento Ordenador
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Mantenimiento Ordenador') }}
                            </span>

                            <form method="GET" role="form" id="searchForm">
                                <div class="mb-3 input-group">
                                    <select id="opcionBusqueda" name="opcionBusqueda" class="form-control" style="background-color: #81bb26;">
                                        <option value="{{ route('mantenimientoordenador.buscarPorId') }}">Buscar por ID</option>
                                        <option value="{{ route('mantenimientoordenador.buscarPorEquipo') }}">Buscar por Equipo</option>
                                        <option value="{{ route('mantenimientoordenador.buscarPorUsuario') }}">Buscar por Encargado</option>
                                        <option value="{{ route('mantenimientoordenador.buscarPorTipoMantenimiento') }}">Buscar por Tipo Mantenimiento</option>
                                        <option value="{{ route('mantenimientoordenador.buscarPorFecha') }}">Buscar por Fecha</option>
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

                                    if (selectedOption === '{{ route('mantenimientoordenador.buscarPorFecha') }}') {
                                        busquedaInput.setAttribute('type', 'date');
                                        busquedaInput.setAttribute('placeholder', 'Fecha');
                                    } else {
                                        busquedaInput.setAttribute('type', 'text');
                                        busquedaInput.setAttribute('placeholder', 'Buscar');
                                    }
                                });

                                document.getElementById('searchForm').addEventListener('submit', function (event) {
                                    var selectedOption = document.getElementById('opcionBusqueda').value;
                                    this.action = selectedOption;
                                });
                            </script>

                             <div class="float-right">
                                <a href="{{ route('mantenimientoordenador.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear Mantenimiento Ordenador') }}
                                </a>
                              </div>
                              <div class="float-right">
                               <a href="{{ route('matenimiento-ordenador.create2') }}" class="btn btn-primary btn-sm" style="background-color: #81bb26;">
                                    {{ __('Crear Mantenimiento Salon') }}
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

                    <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <form method="POST" action="{{ route('agregar') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="file" name="import_file_salonOrdenador" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-success" type="submit" style="background-color: #81bb26;">
                                        <i class="bi bi-cloud-upload"></i> Importar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Equipo</th>
										<th>Encargado</th>
										<th>Tipo de Mantenimiento</th>
										<th>Cambio</th>
										<th>Descripción</th>
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mantenimientoOrdenadors as $mantenimientoOrdenador)
                                        <tr>
                                            <td>{{ $mantenimientoOrdenador->id }}</td>

											<td>{{ $mantenimientoOrdenador->ordenador_id }}</td>
											<td>{{ $mantenimientoOrdenador->user->name }}</td>
											<td>{{ $mantenimientoOrdenador->tipomantenimiento->descripcion }}</td>
											<td>
                                                @if ($mantenimientoOrdenador->tipocambio)
                                                    {{ $mantenimientoOrdenador->tipocambio->descripcion }}
                                                @else
                                                    Asignado a un Aula
                                                @endif
                                            </td>
											<td>{{ $mantenimientoOrdenador->descripcion }}</td>
											<td>{{ $mantenimientoOrdenador->fecha }}</td>

                                            <td>
                                                <form action="{{ route('mantenimientoordenador.destroy',$mantenimientoOrdenador->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('mantenimientoordenador.show',$mantenimientoOrdenador->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('mantenimientoordenador.edit',$mantenimientoOrdenador->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $mantenimientoOrdenadors->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
