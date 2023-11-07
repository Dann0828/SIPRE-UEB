@role('admin')
@extends('adminlte::page')


@section('template_title')
    Tipo Disco Duro
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
                                {{ __('Tipo Disco Duro') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipoDiscoDuro.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
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

										<th>Tipo Disco Duro</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoDiscoDuros as $tipoDiscoDuro)
                                        <tr>
                                            <td>{{ $tipoDiscoDuro->id }}</td>

											<td>{{ $tipoDiscoDuro->tipoDiscoDuro }}</td>

                                            <td>
                                                <form action="{{ route('tipoDiscoDuro.destroy',$tipoDiscoDuro->id) }}" method="POST">

                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('tipoDiscoDuro.edit',$tipoDiscoDuro->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $tipoDiscoDuros->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
@endrole
