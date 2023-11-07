@extends('adminlte::page')


@section('template_title')
Préstamos Ordenadores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Préstamos Ordenadores') }}
                            </span>
                            <form method="GET" role="form" id="searchForm">
                                <div class="mb-3 input-group">
                                    <select id="opcionBusqueda" name="opcionBusqueda" class="form-control" style="background-color: #81bb26;">
                                        <option value="{{ route('prestamo.buscarPorId') }}">Buscar por ID</option>
                                        <option value="{{ route('prestamo.buscarPorPersona') }}">Buscar por Persona</option>
                                        <option value="{{ route('prestamo.buscarPorEquipo') }}">Buscar por Equipo</option>
                                        <option value="{{ route('prestamo.buscarPorUsuario') }}">Buscar por Encargado</option>
                                        <option value="{{ route('prestamo.buscarPorFechaPrestamo') }}">Buscar por Fecha de Préstamo</option>
                                        <option value="{{ route('prestamo.buscarPorFechaEntrega') }}">Buscar por Fecha de Entrega</option>
                                        <option value="{{ route('prestamo.buscarPorEstado') }}">Buscar por Estado</option>
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
                                var placeholderText = '';

                                if (selectedOption === '{{ route('prestamo.buscarPorFechaPrestamo') }}') {
                                    busquedaInput.setAttribute('type', 'date');
                                    placeholderText = 'Fecha de Préstamo';
                                } else if (selectedOption === '{{ route('prestamo.buscarPorFechaEntrega') }}') {
                                    busquedaInput.setAttribute('type', 'date');
                                    placeholderText = 'Fecha de Entrega';
                                } else {
                                    busquedaInput.setAttribute('type', 'text');
                                    placeholderText = 'Buscar';
                                }

                                busquedaInput.setAttribute('placeholder', placeholderText);
                                });

                                document.getElementById('searchForm').addEventListener('submit', function (event) {
                                var selectedOption = document.getElementById('opcionBusqueda').value;
                                this.action = selectedOption;
                                });

                            </script>

                             <div class="float-right">

                                <a href="{{ route('prestamo.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Registrar Préstamo') }}
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

										<th>Encargado</th>
										<th>Persona</th>
										<th>Equipo</th>
										<th>Fecha Hora Prestamo</th>
										<th>Fecha Hora Entrega</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamo as $prestamo1)
                                        <tr>
                                            <td>{{ $prestamo1->id }}</td>

											<td>{{ $prestamo1->user->name}}</td>
											<td>{{ $prestamo1->persona->nombre}}</td>
											<td>{{ $prestamo1->equipo_id }}</td>
											<td>{{ $prestamo1->fecha_hora_prestamo }}</td>
											<td>{{ $prestamo1->fecha_hora_entrega }}</td>
											<td>{{ $prestamo1->estado }}</td>

                                            <td>
                                                <form action="{{ route('prestamo.destroy',$prestamo1->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('prestamo.show',$prestamo1->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('prestamo.edit',$prestamo1->id) }}"> {{ __('Devolver') }}</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prestamo->links('pagination') !!}
            </div>
        </div>
    </div>
@endsection
