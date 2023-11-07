@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $localidad->name ?? "{{ __('Show') Localidad" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Localidad</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('localidad.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombreedificio:</strong>
                            {{ $localidad->nombreEdificio }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoarea:</strong>
                            {{ $localidad->tipoArea }}
                        </div>
                        <div class="form-group">
                            <strong>Nombredependencia:</strong>
                            {{ $localidad->nombreDependencia }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
