@role('admin')
@extends('adminlte::page')


@section('template_title')
    Procesador
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
                                {{ __('Procesador') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('procesador.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
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

										<th>Referencia</th>
										<th>Frecuencia</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($procesadors as $procesador)
                                        <tr>
                                            <td>{{ $procesador->id }}</td>

											<td>{{ $procesador->referencia }}</td>
											<td>{{ $procesador->frecuencia }}</td>

                                            <td>
                                                <form action="{{ route('procesador.destroy',$procesador->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('procesador.edit',$procesador->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $procesadors->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
