@extends('adminlte::page')


@section('template_title')
    {{ $persona->name ?? __('Ver Persona') }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Persona</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('persona.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $persona->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $persona->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Celular:</strong>
                            {{ $persona->celular }}
                        </div>
                        <div class="form-group">
                            <strong>Programa:</strong>
                            @foreach ($persona->programas as $programa)
                                {{ $programa->nombre }}
                            @endforeach 
                        </div>
                        <div class="form-group">
                            <strong>Rol:</strong>
                            @foreach ($persona->roles as $rol)
                                {{ $rol->descripcion }}
                            @endforeach 
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $persona->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
