@role('admin')
@extends('adminlte::page')

@section('template_title')
    Ordenador
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
                                {{ __('Ordenador') }}
                            </span>
                            
                             <div class="float-right">
                                <a href="{{ route('ordenador.create') }}" class="float-right btn btn-primary btn-sm" style="margin-left: 10px; background-color: #81bb26;">
                                    {{ __('Registrar') }}
                                </a>
                                <ul class="navbar-nav me-auto">
                                   
                                </ul>
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
                        <form method="GET" action="{{ route('ordenador.buscar') }}" role="form" class="flex-grow-1 mr-2">
                            <div class="input-group">
                                <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                                <div class="input-group-append">
                                <button class="btn btn-primary" style="background-color: #81bb26;" type="submit"><i class="fas fa-search"></i></button>                        </div>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('excelimportar.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group">
                                <input type="file" name="import_file" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
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
										<th>Marca</th>
										<th>Modelo</th>
										<th>Tipo de Computador</th>
										<th>Serie</th>
										<th>Procesador</th>
										<th>Espacio Disco Duro</th>
										<th>Tipo Disco Duro</th>
										<th>Espacio Ram</th>
										<th>Estado</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenadors as $ordenador)
                                        <tr>
                                            <td>{{ $ordenador->id }}</td>

											<td>{{ $ordenador->marca }}</td>
											<td>{{ $ordenador->modelo }}</td>
											<td>{{ $ordenador->tipocomputador->tipo_computador }}</td>
											<td>{{ $ordenador->serie }}</td>
                                            <td>{{ $ordenador->procesador->referencia }}</td>
											<td>{{ $ordenador->espacio_disco_duro }} </td>
											<td>{{ $ordenador->tipodiscoduro->tipoDiscoDuro}}</td>
											<td>{{ $ordenador->espacioRam }} </td>
											<td>{{ $ordenador->estadocomputador->estado_computador }}</td>


                                            <td>
                                                <form action="{{ route('ordenador.destroy',$ordenador->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('ordenador.show',$ordenador->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('ordenador.edit',$ordenador->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <select class="btn btn-sm btn-success pdfSelector" style="background-color: #008776;">
                                                        <option value="{{ route('ordenador.pdf1', $ordenador->id) }}" style="background-color: #008776;">HV</option>
                                                        <option value="{{ route('ordenador.pdf2', $ordenador->id) }}" style="background-color: #008776;">HV+PR</option>
                                                        <option value="{{ route('ordenador.pdf3', $ordenador->id) }}" style="background-color: #008776;">HV+MA</option>
                                                        <option value="{{ route('ordenador.pdf4', $ordenador->id) }}" style="background-color: #008776;">HV CO</option>
                                                    </select>
                                                    <a class="btn btn-sm btn-success downloadLink" href="#" style="display: none; background-color: #008776;"><i class="fa fa-file-pdf"></i></a>

                                                    <script>
                                                        document.querySelectorAll('.pdfSelector').forEach(function(selector) {
                                                            selector.addEventListener('input', function() {
                                                                var selectedOption = this.options[this.selectedIndex];
                                                                var downloadLink = this.nextElementSibling;

                                                                if (selectedOption.value) {
                                                                    downloadLink.href = selectedOption.value;
                                                                    downloadLink.style.display = 'block';
                                                                } else {
                                                                    downloadLink.style.display = 'none';
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $ordenadors->links('pagination') }}
            </div>
        </div>
    </div>
</body>


@endsection
@endrole
