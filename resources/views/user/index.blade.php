@role('admin')
@extends('adminlte::page')

@section('template_title')
    Usuario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Usuarios') }}
                            </span>

                            <form method="GET" action="{{ route('user.index') }}" role="form">
                                <div class="mb-3 input-group">
                                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>

                             <div class="float-right">
                                <a href="{{ route('user.create') }}" class="float-right btn btn-primary btn-sm"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear Usuario') }}
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Cédula</th>
										<th>Nombre</th>
										<th>Correo</th>
                                        <th>Tipo de Usuario</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>

											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
                                            <td>{{ $userRoles[$user->id] }}</td>



                                            <td>
                                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('user.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $users->links('pagination') !!}
            </div>
        </div>
    </div>
@endsection
@endrole
