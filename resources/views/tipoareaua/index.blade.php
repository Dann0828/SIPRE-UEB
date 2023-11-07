@extends('adminlte::page')

@section('template_title')
    Tipo de Área
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo de Área') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipoareaua.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" style="background-color: #81bb26;">
                                  {{ __('Crear') }}
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
                                        
										<th>Descripción</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoareauas as $tipoareaua)
                                        <tr>
                                            <td>{{ $tipoareaua->id }}</td>
                                            
											<td>{{ $tipoareaua->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('tipoareaua.destroy',$tipoareaua->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" style="background-color: #81bb26;" href="{{ route('tipoareaua.edit',$tipoareaua->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('') }}</a>
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
                {!! $tipoareauas->links('pagination') !!}
            </div>
        </div>
    </div>
@endsection
