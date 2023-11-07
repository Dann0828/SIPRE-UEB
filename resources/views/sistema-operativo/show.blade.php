@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $sistemaOperativo->name ?? "{{ __('Show') Sistema Operativo" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Sistema Operativo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('sistemaOperativo.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Sistema Operativo:</strong>
                            {{ $sistemaOperativo->sistema_operativo }}
                        </div>
                        <div class="form-group">
                            <strong>Version:</strong>
                            {{ $sistemaOperativo->version }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
