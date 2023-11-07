@role('admin')
@extends('adminlte::page')
@section('template_title')
Tipo Auxiliar
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
                                {{ __('Tipo Auxiliar') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipoaux.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
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

										<th>Tipo Auxiliar</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoauxes as $tipoaux)
                                        <tr>
                                            <td>{{ $tipoaux->id }}</td>

											<td>{{ $tipoaux->tipo_aux }}</td>

                                            <td>
                                                <form action="{{ route('tipoaux.destroy',$tipoaux->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('tipoaux.edit',$tipoaux->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $tipoauxes->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
