@extends('adminlte::page')

@section('template_title')
    Dependencia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Dependencia') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('dependenciaua.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" style="background-color: #81bb26;">
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

                    <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <form method="POST" action="{{ route('excelua.store') }}" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="import_file_UA" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
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
                                        
										<th>Dependencia</th>
										<th>Área</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dependenciauas as $dependenciaua)
                                        <tr>
                                            <td>{{ $dependenciaua->id }}</td>
                                            
											<td>{{ $dependenciaua->dependencia }}</td>
											<td>{{ $dependenciaua->tipoareaua->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('dependenciaua.destroy',$dependenciaua->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('dependenciaua.edit',$dependenciaua->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $dependenciauas->links('pagination') !!}
            </div>
        </div>
    </div>
@endsection
