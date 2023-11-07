@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $estadoComputador->name ?? "{{ __('Mostrar') Estado Computador" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Estado Computador</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('estadoComputador.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>No:</strong>
                            {{ $estadoComputador->id}}
                        </div>
                        <div class="form-group">
                            <strong>Estado Computador:</strong>
                            {{ $estadoComputador->estado_computador }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
