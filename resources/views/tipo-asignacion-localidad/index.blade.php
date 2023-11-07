@role('admin')
@extends('adminlte::page')


@section('template_title')
    Tipo Asignación
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
                                {{ __('Tipo Asignación') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipoAsignacionLocalidad.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear Nuevo') }}
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

										<th>Tipo Asignación</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoAsignacionLocalidads as $tipoAsignacionLocalidad)
                                        <tr>
                                            <td>{{ $tipoAsignacionLocalidad->id }}</td>

											<td>{{ $tipoAsignacionLocalidad->tipoAsignacion }}</td>

                                            <td>
                                                <form action="{{ route('tipoAsignacionLocalidad.destroy',$tipoAsignacionLocalidad->id) }}" method="POST">

                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('tipoAsignacionLocalidad.edit',$tipoAsignacionLocalidad->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $tipoAsignacionLocalidads->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
