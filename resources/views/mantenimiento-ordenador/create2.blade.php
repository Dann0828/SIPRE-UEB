@extends('adminlte::page')

@section('template_title')
    {{ __('Registrar') }} Mantenimiento Ordenador
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Registrar') }} Mantenimiento Ordenador</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('mantenimientoordenador.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('guardar-mantenimiento.store2') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('mantenimiento-ordenador.form2')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
