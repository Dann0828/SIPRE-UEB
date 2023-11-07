@role('admin')
@extends('adminlte::page')


@section('template_title')
    Programa
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
                                {{ __('Programa') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('programa.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear Programa') }}
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
                        <form method="POST" action="{{ route('excelfacultades.store') }}" role="form" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="import_file_facultades" class="form-control" aria-label="Selecciona un archivo" accept=".xlsx, .xls, .csv">
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
										<th>Nombre</th>
										<th>Facultad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programa as $programa1)
                                        <tr>
                                            <td>{{ $programa1->id }}</td>

											<td>{{ $programa1->nombre }}</td>
											<td>{{ $programa1->facultad->nombre }}</td>

                                            <td>
                                                <form action="{{ route('programa.destroy',$programa1->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('programa.show',$programa1->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('programa.edit',$programa1->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $programa->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
