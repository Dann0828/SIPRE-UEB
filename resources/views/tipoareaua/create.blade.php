@extends('adminlte::page')
@section('template_title')
    {{ __('Crear') }} Tipo de Área
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tipo de Área</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipoareaua.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipoareaua.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipoareaua.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
