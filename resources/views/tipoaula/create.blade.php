@role('admin')
@extends('adminlte::page')

@section('template_title')
    {{ __('Crear') }} Tipo de Aula
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tipo de Aula</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipoaula.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipoaula.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipoaula.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@endrole
