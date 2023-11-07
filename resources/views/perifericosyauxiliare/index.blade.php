@role('admin')
@extends('adminlte::page')


@section('template_title')
Periféricos y Auxiliares
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
                                {{ __('Periféricos y Auxiliares') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('perifericosyauxiliares.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="margin-left: 10px; background-color: #81bb26;">
                                  {{ __('Registar') }}
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
                        <form method="GET" action="{{ route('perifericosyauxiliares.buscar') }}" role="form" class="flex-grow-1 mr-2">
                            <div class="mb-3 input-group">
                                <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                </div>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('excelimportarpa.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group">
                                <input type="file" name="import_filepa" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
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
										<th>Tipo de Auxiliar</th>
										<th>Valor</th>
										<th>Estado</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perifericosyauxiliares as $perifericosyauxiliare)
                                        <tr>
                                            <td>{{ $perifericosyauxiliare->id }}</td>

											<td>{{ $perifericosyauxiliare->marca_pa }}</td>
											<td>{{ $perifericosyauxiliare->modelo_pa }}</td>
											<td>{{ $perifericosyauxiliare->tipoaux->tipo_aux }}</td>
											<td>{{ $perifericosyauxiliare->valor }}</td>
											<td>{{ $perifericosyauxiliare->estadoComputador->estado_computador ?? '' }}</td>



                                            <td>
                                                <form action="{{ route('perifericosyauxiliares.destroy',$perifericosyauxiliare->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('perifericosyauxiliares.show',$perifericosyauxiliare->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('perifericosyauxiliares.edit',$perifericosyauxiliare->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <select class="btn btn-sm btn-success pdfSelector" style="background-color: #008776;">
                                                        <option value="{{ route('perifericosyauxiliare.pdf1', $perifericosyauxiliare->id) }}" style="background-color: #008776;">HV</option>
                                                        <option value="{{ route('perifericosyauxiliare.pdf2', $perifericosyauxiliare->id) }}" style="background-color: #008776;">HV+PR</option>
                                                        <option value="{{ route('perifericosyauxiliare.pdf3', $perifericosyauxiliare->id) }}" style="background-color: #008776;">HV+MA</option>
                                                        <option value="{{ route('perifericosyauxiliare.pdf4', $perifericosyauxiliare->id) }}" style="background-color: #008776;">HV CO</option>
                                                    </select>
                                                    <a class="btn btn-sm btn-success downloadLink" href="#" style="display: none; background-color: #008776;"><i class="fa fa-file-pdf"></i></a>

                                                    <script>
                                                        document.querySelectorAll('.pdfSelector').forEach(function(selector) {
                                                            selector.addEventListener('change', function() {
                                                                var selectedOption = this.options[this.selectedIndex];
                                                                var downloadLink = this.nextElementSibling; // Encuentra el enlace siguiente al selector

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
                {!! $perifericosyauxiliares->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
