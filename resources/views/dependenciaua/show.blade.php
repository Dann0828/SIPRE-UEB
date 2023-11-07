@extends('adminlte::page')
@section('template_title')
    {{ $dependenciaua->name ?? "{{ __('Ver') Dependencia" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} Dependencia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('dependenciaua.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Dependencia:</strong>
                            {{ $dependenciaua->dependencia }}
                        </div>
                        <div class="form-group">
                            <strong>Área:</strong>
                            {{ $dependenciaua->tipoareaua->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
