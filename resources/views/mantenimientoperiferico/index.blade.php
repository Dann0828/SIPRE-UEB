@extends('adminlte::page')

@section('template_title')
    Mantenimiento Periféricos y Auxiliares
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
                                {{ __('Mantenimiento Periféricos y Auxiliares') }}
                            </span>
                            <form method="GET" role="form" id="searchForm">
                                <div class="mb-3 input-group">
                                    <select id="opcionBusqueda" name="opcionBusqueda" class="form-control" style="background-color: #81bb26;">
                                        <option value="{{ route('mantenimientoperiferico.buscarPorId') }}">Buscar por ID</option>
                                        <option value="{{ route('mantenimientoperiferico.buscarPorEquipo') }}">Buscar por Equipo</option>
                                        <option value="{{ route('mantenimientoperiferico.buscarPorUsuario') }}">Buscar por Encargado</option>
                                        <option value="{{ route('mantenimientoperiferico.buscarPorTipoMantenimiento') }}">Buscar por Tipo Mantenimiento</option>
                                        <option value="{{ route('mantenimientoperiferico.buscarPorFecha') }}">Buscar por Fecha</option>
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

                                    if (selectedOption === '{{ route('mantenimientoperiferico.buscarPorFecha') }}') {
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
                                <a href="{{ route('mantenimientoperiferico.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear Mantenimiento') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Equipo</th>
										<th>Encargado</th>
										<th>Tipo de Mantenimiento</th>
										<th>Descripción</th>
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mantenimientoperifericos as $mantenimientoperiferico)
                                        <tr>
                                            <td>{{ $mantenimientoperiferico->id }}</td>

											<td>{{ $mantenimientoperiferico->perifericos_id }}</td>
											<td>{{ $mantenimientoperiferico->user->name}}</td>
											<td>{{ $mantenimientoperiferico->tipomantenimiento->descripcion }}</td>
											<td>{{ $mantenimientoperiferico->descripcion }}</td>
											<td>{{ $mantenimientoperiferico->fecha }}</td>

                                            <td>
                                                <form action="{{ route('mantenimientoperiferico.destroy',$mantenimientoperiferico->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('mantenimientoperiferico.show',$mantenimientoperiferico->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('mantenimientoperiferico.edit',$mantenimientoperiferico->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $mantenimientoperifericos->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
