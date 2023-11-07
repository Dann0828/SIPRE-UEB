@extends('layouts.app')

@section('template_title')
    Importarexcelpa
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
                                {{ __('Importarexcelpa') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('importarexcelpas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($importarexcelpas as $importarexcelpa)
                                        <tr>
                                            <td>{{ ++$i }}</td>


                                            <td>
                                                <form action="{{ route('importarexcelpas.destroy',$importarexcelpa->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('importarexcelpas.show',$importarexcelpa->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('importarexcelpas.edit',$importarexcelpa->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $importarexcelpas->links('pagination') !!}
            </div>
        </div>
    </div>
</body>
@endsection
