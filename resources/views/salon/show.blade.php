@role('admin')
@extends('adminlte::page')

@section('template_title')
    {{ $salon->name ?? "{{ __('Ver') Aula" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Aula</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('salon.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Descripción:</strong>
                            {{ $salon->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Edificio:</strong>
                            {{ $salon->edificio->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de Aula:</strong>
                            {{ $salon->tipoaula->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@endrole
