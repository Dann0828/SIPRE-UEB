@role('admin')
@extends('adminlte::page')

@section('template_title')
    Tipo Software de Computador
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
                                {{ __('Tipo Software de Computador') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipoSoftwareComputador.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
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

										<th>Tipo Software de Computador</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoSoftwareComputadors as $tipoSoftwareComputador)
                                        <tr>
                                            <td>{{ $tipoSoftwareComputador->id }}</td>

											<td>{{ $tipoSoftwareComputador->tipoSoftware }}</td>

                                            <td>
                                                <form action="{{ route('tipoSoftwareComputador.destroy',$tipoSoftwareComputador->id) }}" method="POST">

                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('tipoSoftwareComputador.edit',$tipoSoftwareComputador->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $tipoSoftwareComputadors->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
