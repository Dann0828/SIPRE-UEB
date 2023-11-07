@extends('adminlte::page')

@section('template_title')
    {{ __('Crear') }} Dependencia
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Dependencia</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('dependenciaua.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('dependenciaua.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('dependenciaua.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
