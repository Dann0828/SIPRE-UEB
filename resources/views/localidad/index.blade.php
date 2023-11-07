@role('admin')
@extends('adminlte::page')


@section('template_title')
    Localidad
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
                                {{ __('Localidad') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('localidad.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear nuevo') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Nombre Edificio</th>
										<th>Tipo de Área</th>
										<th>Nombre de Dependencia</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($localidads as $localidad)
                                        <tr>
                                            <td>{{ $localidad->id }}</td>

											<td>{{ $localidad->nombreEdificio }}</td>
											<td>{{ $localidad->tipoArea }}</td>
											<td>{{ $localidad->nombreDependencia }}</td>

                                            <td>
                                                <form action="{{ route('localidad.destroy',$localidad->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('localidad.edit',$localidad->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $localidads->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
