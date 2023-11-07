@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $procesador->name ?? "{{ __('Show') Procesador" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Procesador</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('procesador.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $procesador->referencia }}
                        </div>
                        <div class="form-group">
                            <strong>Frecuencia:</strong>
                            {{ $procesador->frecuencia }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
