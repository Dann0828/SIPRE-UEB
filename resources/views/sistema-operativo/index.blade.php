@role('admin')
@extends('adminlte::page')


@section('template_title')
    Sistema Operativo
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
                                {{ __('Sistema Operativo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('sistemaOperativo.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
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

										<th>Sistema Operativo</th>
										<th>Versión</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sistemaOperativos as $sistemaOperativo)
                                        <tr>
                                            <td>{{ $sistemaOperativo->id }}</td>

											<td>{{ $sistemaOperativo->sistema_operativo }}</td>
											<td>{{ $sistemaOperativo->version }}</td>

                                            <td>
                                                <form action="{{ route('sistemaOperativo.destroy',$sistemaOperativo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('sistemaOperativo.edit',$sistemaOperativo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $sistemaOperativos->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
