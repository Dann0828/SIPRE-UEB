@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ __('Crear') }} Tipo Asignación Localidad
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tipo Asignación Localidad</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipoAsignacionLocalidad.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipoAsignacionLocalidad.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipo-asignacion-localidad.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
