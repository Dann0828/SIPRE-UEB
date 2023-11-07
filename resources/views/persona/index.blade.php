@extends('adminlte::page')


@section('template_title')
    Persona
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
                                {{ __('Persona') }}
                            </span>
                            <div class="d-flex justify-content-between mb-3">
                                <form method="GET" action="{{ route('persona.index') }}" role="form">
                                        <div class="mb-3 input-group">
                                            <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                </form>
                            </div>

                             <div class="float-right">
                                <a href="{{ route('persona.create') }}" class="btn btn-primary"  data-placement="left" style="background-color: #81bb26;">
                                    {{ __('Registrar') }}
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Celular</th>
                                        <th>Programa</th>
                                        <th>Rol</th>
                                        <th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($persona as $persona1)
                                        <tr>
                                            <td>{{ $persona1->id }}</td>
                                            <td>{{ $persona1->nombre }}</td>
                                            <td>{{ $persona1->correo }}</td>
                                            <td>{{ $persona1->celular }}</td>
                                            <td> @foreach ($persona1->programas as $programa)
                                                {{ $programa->nombre }}
                                            @endforeach </td>
                                            <td>@foreach ($persona1->roles as $rol)
                                                {{ $rol->descripcion }}
                                            @endforeach </td>
                                            <td>{{ $persona1->estado }}</td>

                                            <td>
                                                <form action="{{ route('persona.destroy',$persona1->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " style="background-color: #f08013;" href="{{ route('persona.show',$persona1->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('') }}</a>
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('persona.edit',$persona1->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $persona->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection


