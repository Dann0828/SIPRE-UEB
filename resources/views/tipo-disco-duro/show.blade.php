@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $tipoDiscoDuro->name ?? "{{ __('Show') Tipo Disco Duro" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tipo Disco Duro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipoDiscoDuro.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Tipodiscoduro:</strong>
                            {{ $tipoDiscoDuro->tipoDiscoDuro }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
